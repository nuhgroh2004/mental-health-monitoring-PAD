// bagian dropdown tombol aksi
function toggleActionMenu(button) {
    const actionMenu = button.closest('td').querySelector('.action-menu');
    const allActionMenus = document.querySelectorAll('.action-menu');

    allActionMenus.forEach(menu => {
        if (menu !== actionMenu) {
            menu.classList.add('hidden');
            menu.classList.remove('flex');
        }
    });

    actionMenu.classList.toggle('hidden');
    actionMenu.classList.toggle('flex');

    const rect = actionMenu.getBoundingClientRect();
    const tableHeight = document.querySelector('table').offsetHeight;
    const pageHeight = window.innerHeight;

    if (rect.bottom > pageHeight || rect.bottom > tableHeight) {
        actionMenu.style.top = 'auto';
        actionMenu.style.bottom = '100%';
    } else {
        actionMenu.style.top = '100%';
        actionMenu.style.bottom = 'auto';
    }

    const allButtons = document.querySelectorAll('.action-button');
    allButtons.forEach(btn => {
        if (btn !== button) {
            btn.disabled = !actionMenu.classList.contains('hidden');
        }
    });
}


// fungsi pencarian mahasiswa
document.getElementById('search').addEventListener('input', function() {
    let query = this.value;
    let searchUrl = document.getElementById('search').getAttribute('data-search-url');

    fetch(`${searchUrl}?query=${query}`, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.text())
    .then(data => {
        document.getElementById('mahasiswaTable').innerHTML = data;
    })
    .catch(error => console.error('Error:', error));
});


// fungsi delete mahasiswa
function handleDelete(mahasiswaId) {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success w-24 mx-2",
            cancelButton: "btn btn-danger w-24 mx-2"
        },
        buttonsStyling: false
    });

    swalWithBootstrapButtons.fire({
        title: "Apa kamu yakin?",
        text: "Ingin menghapus user ini!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Ya!",
        cancelButtonText: "Tidak!",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`/dosen/mahasiswa/delete/${mahasiswaId}`, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    swalWithBootstrapButtons.fire({
                        title: "Dihapus!",
                        text: "User berhasil dihapus.",
                        icon: "success"
                    }).then(() => {
                        window.location.href = "/dosen/home";
                    });
                } else {
                    swalWithBootstrapButtons.fire({
                        title: "Gagal",
                        text: "Terjadi kesalahan saat menghapus user.",
                        icon: "error"
                    });
                }
            })
            .catch(error => {
                swalWithBootstrapButtons.fire({
                    title: "Error",
                    text: "Terjadi kesalahan server.",
                    icon: "error"
                });
            });
        } else {
            swalWithBootstrapButtons.fire({
                title: "Dibatalkan",
                text: "User batal dihapus :)",
                icon: "error"
            });
        }
    });
}


// fungsi edit role mahasiswa
// Refactored handleEditRole function
function handleEditRole(mahasiswaId) {
    // Get saved custom templates from localStorage
    const savedCustomTemplates = JSON.parse(localStorage.getItem('customMoodTemplates') || '[]');

    Swal.fire({
        title: "Konfigurasi Rentang Intensitas Mood",
        html: createMoodConfigHTML(savedCustomTemplates),
        width: 600,
        showConfirmButton: true,
        showCancelButton: true,
        confirmButtonText: "Simpan",
        cancelButtonText: "Batal",
        customClass: {
            confirmButton: "btn btn-success w-32 mx-2 bg-green-600 hover:bg-green-700",
            cancelButton: "btn btn-danger w-32 mx-2 bg-red-600 hover:bg-red-700",
            popup: "swal-wide-popup",
        },
        didOpen: () => setupMoodConfigModal(mahasiswaId),
        preConfirm: () => handleMoodConfigSubmit(mahasiswaId)
    }).then(handleMoodConfigResult);
}

// Create HTML content for the modal
function createMoodConfigHTML(savedCustomTemplates) {
    const customTemplateButtonsHTML = createCustomTemplateButtons(savedCustomTemplates);

    return `
        <div class="mx-auto max-w-md p-4 rounded-lg bg-gray-50 shadow-inner">
            <div class="space-y-6">
                <div class="text-center">
                    <div class="flex items-center justify-center mb-3">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        <h3 class="font-semibold text-lg text-gray-800">Rentang Intensitas Mood</h3>
                    </div>

                    <p class="text-sm text-gray-600 mb-3">
                        Silakan pilih template rentang mood atau buat kustom Anda sendiri.
                    </p>

                    <!-- Template Selection: Built-in and Custom Templates -->
                    <div class="template-container flex flex-wrap justify-center gap-2 mb-4">
                        <div class="built-in-templates flex flex-wrap justify-center gap-2">
                            <button id="template-1-5" class="template-btn bg-blue-600 text-white py-3 px-5 rounded-lg hover:bg-blue-700 transition-colors">
                                Skala 1-5
                            </button>
                            <button id="template-1-10" class="template-btn bg-blue-600 text-white py-3 px-5 rounded-lg hover:bg-blue-700 transition-colors">
                                Skala 1-10
                            </button>
                        </div>

                        <div id="custom-templates-container" class="custom-templates flex flex-wrap justify-center gap-2">
                            ${customTemplateButtonsHTML}
                        </div>

                        <button id="template-custom" class="template-btn bg-white text-blue-600 py-3 px-5 rounded-lg border border-blue-600 transition-colors hover:bg-blue-600 hover:text-white">
                            Kustom Baru
                        </button>
                    </div>

                    <div id="active-template" class="text-sm font-medium text-blue-600 mb-4">
                        Template Aktif: Skala 1-5
                    </div>

                    <div class="flex flex-col items-center justify-center space-y-4 mb-4">
                        <div class="text-center w-full">
                            <label for="minMood" class="block text-sm font-medium text-gray-700 mb-1">Nilai Minimum</label>
                            <div class="flex justify-center">
                                <input type="number" id="minMood"
                                    class="swal2-input py-2 px-4 w-48 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-center"
                                    placeholder="1" min="1" max="100" value="1">
                            </div>
                        </div>

                        <div class="text-center w-full">
                            <label for="maxMood" class="block text-sm font-medium text-gray-700 mb-1">Nilai Maksimum</label>
                            <div class="flex justify-center">
                                <input type="number" id="maxMood"
                                    class="swal2-input py-2 px-4 w-48 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-center"
                                    placeholder="5" min="1" max="100" value="5">
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-center mt-2 mb-1">
                        <button id="save-custom-template" class="h-10 px-3 py-1.5 bg-green-500 text-white text-sm rounded-md hover:bg-green-600 transition-colors flex items-center">

                            Simpan Template Kustom
                        </button>
                    </div>

                    <div id="rangeError" class="text-red-500 text-sm mt-3 hidden p-2 bg-red-50 rounded-md border border-red-200 mx-auto max-w-xs">
                        <div class="flex items-center justify-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zm-1 9a1 1 0 01-1-1v-4a1 1 0 112 0v4a1 1 0 01-1 1z" clip-rule="evenodd"></path>
                            </svg>
                            Rentang tidak valid. Min harus < Max (1-100).
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;
}

// Create the HTML for custom template buttons
function createCustomTemplateButtons(savedCustomTemplates) {
    if (!savedCustomTemplates.length) return '';

    return savedCustomTemplates.map((template, index) => `
        <div class="custom-template-item relative group">
            <button id="template-${template.min}-${template.max}" data-min="${template.min}" data-max="${template.max}"
                class="custom-template-btn bg-indigo-100 text-indigo-800 py-2 px-4 rounded-lg
                hover:bg-indigo-200 transition-colors mx-1">
                Skala ${template.min}-${template.max}
            </button>
            <button data-index="${index}" class="delete-template-btn absolute -top-2 -right-2 bg-red-500
                text-white rounded-full w-5 h-5 flex items-center justify-center">
                <span class="text-xs">×</span>
            </button>
        </div>
    `).join('');
}

// Set up the modal and attach event handlers
function setupMoodConfigModal() {
    addCustomStyles();
    initializeUIElements();
}

// Add custom CSS styles for the modal
function addCustomStyles() {
    const style = document.createElement('style');
    style.innerHTML = `
        .swal-wide-popup {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden !important;
        }
        .btn {
            transition: all 0.3s ease;
            border: none;
            color: white;
            font-weight: 500;
            padding: 12px 20px;
            border-radius: 6px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.12);
        }
        .btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        }
        .template-btn, .custom-template-btn {
            transition: all 0.2s ease;
            font-weight: 500;
            box-shadow: 0 1px 3px rgba(0,0,0,0.12);
        }
        .template-btn:hover, .custom-template-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(0,0,0,0.18);
        }
        .template-btn.active, .custom-template-btn.active {
            outline: 2px solid white;
            outline-offset: -2px;
            box-shadow: 0 0 0 2px #2563eb;
        }
        #template-custom.active {
            background-color: #2563eb;
            color: white;
            outline: 2px solid white;
            outline-offset: -2px;
            box-shadow: 0 0 0 2px #2563eb;
        }
        .custom-template-btn.active {
            background-color: #4f46e5 !important;
            color: white !important;
        }
         .delete-template-btn {
            transition: all 0.2s ease;
            z-index: 10;
            opacity: 1; /* Make buttons visible by default */
        }
        .delete-template-btn:hover {
            background-color: #e11d48;
            transform: scale(1.1);
        }
        .swal2-html-container {
            overflow-x: hidden !important;
        }
        .swal2-popup {
            overflow-x: hidden !important;
        }
        #minMood, #maxMood {
            margin-left: auto !important;
            margin-right: auto !important;
        }
        .custom-template-item {
            display: inline-block;
            margin: 0 2px;
        }
        .template-container {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            justify-content: center;
        }
             /* If you still want hover effect but need to ensure it works: */
        @media (min-width: 768px) {
            .delete-template-btn {
                opacity: 0;
            }
            .custom-template-item:hover .delete-template-btn {
                opacity: 1;
            }
        }

    `;
    document.head.appendChild(style);

    // Disable horizontal scrolling
    const popupEl = document.querySelector('.swal2-popup');
    const htmlContainerEl = document.querySelector('.swal2-html-container');
    if (popupEl) popupEl.style.overflowX = 'hidden';
    if (htmlContainerEl) htmlContainerEl.style.overflowX = 'hidden';
}

// Initialize UI elements and attach event handlers
function initializeUIElements() {
    const elements = {
        minInput: document.getElementById("minMood"),
        maxInput: document.getElementById("maxMood"),
        errorDiv: document.getElementById("rangeError"),
        activeTemplateText: document.getElementById("active-template"),
        template1to5: document.getElementById("template-1-5"),
        template1to10: document.getElementById("template-1-10"),
        templateCustom: document.getElementById("template-custom"),
        saveCustomTemplateBtn: document.getElementById("save-custom-template"),
        customTemplatesContainer: document.getElementById("custom-templates-container")
    };

    // Set default template active
    elements.template1to5.classList.add("active");

    // Setup event handlers
    setupTemplateButtons(elements);
    setupInputHandlers(elements);
    setupCustomTemplateButtons(elements);
    setupSaveTemplateHandler(elements);

    // Initial validation
    validateRange(elements.minInput, elements.maxInput, elements.errorDiv);
}

// Set up template button handlers
function setupTemplateButtons(elements) {
    const { template1to5, template1to10, templateCustom, minInput } = elements;

    template1to5.addEventListener("click", () => {
        setTemplate(1, 5, "Skala 1-5", elements);
        template1to5.classList.add("active");
    });

    template1to10.addEventListener("click", () => {
        setTemplate(1, 10, "Skala 1-10", elements);
        template1to10.classList.add("active");
    });

    templateCustom.addEventListener("click", () => {
        // Allow custom input by activating the button
        elements.activeTemplateText.textContent = "Template Aktif: Kustom Baru";

        // Reset active state on all buttons
        resetActiveButtons();
        templateCustom.classList.add("active");

        // Focus on min input for better UX
        minInput.focus();
        minInput.select();
    });
}

// Set up input handlers for min and max values
function setupInputHandlers(elements) {
    const { minInput, maxInput, errorDiv, activeTemplateText, templateCustom } = elements;

    [minInput, maxInput].forEach(input => {
        input.style.transition = "all 0.2s ease";
        input.style.margin = "0 auto";

        input.addEventListener("focus", () => {
            input.style.borderColor = "#3B82F6";

            // When user starts editing, switch to custom template
            const min = parseInt(minInput.value) || 1;
            const max = parseInt(maxInput.value) || 5;

            activeTemplateText.textContent = `Template Aktif: Kustom (${min}-${max})`;
            resetActiveButtons();
            templateCustom.classList.add("active");
        });

        input.addEventListener("blur", () => {
            input.style.borderColor = "";
        });

        input.addEventListener("input", () => {
            const min = parseInt(minInput.value) || 1;
            const max = parseInt(maxInput.value) || 5;

            activeTemplateText.textContent = `Template Aktif: Kustom (${min}-${max})`;
            validateRange(minInput, maxInput, errorDiv);
        });
    });
}

// Set up custom template button handlers
function setupCustomTemplateButtons(elements) {
    document.querySelectorAll('.custom-template-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const min = parseInt(this.dataset.min);
            const max = parseInt(this.dataset.max);

            setTemplate(min, max, `Skala ${min}-${max}`, elements);
            this.classList.add("active");
        });
    });

    // Add delete button handlers
    document.querySelectorAll('.delete-template-btn').forEach(btn => {
        btn.addEventListener('click', e => handleDeleteTemplate(e, btn, elements));
    });
}

// Handle deletion of a custom template
function handleDeleteTemplate(e, btn, elements) {
    e.stopPropagation(); // Prevent triggering the parent button click
    const templateIndex = parseInt(btn.dataset.index);
    const templates = JSON.parse(localStorage.getItem('customMoodTemplates') || '[]');
    const template = templates[templateIndex];

    // Show confirmation
    Swal.fire({
        title: "Hapus template?",
        text: `Yakin ingin menghapus template Skala ${template.min}-${template.max}?`,
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Ya, Hapus",
        cancelButtonText: "Batal",
        customClass: {
            confirmButton: "btn btn-sm btn-danger",
            cancelButton: "btn btn-sm btn-secondary"
        }
    }).then((result) => {
        if (result.isConfirmed) {
            deleteTemplateAndUpdateUI(templateIndex, template, elements);
        }
    });
}

// Delete template and update the UI
function deleteTemplateAndUpdateUI(templateIndex, template, elements) {
    // Get existing templates
    const existingTemplates = JSON.parse(localStorage.getItem('customMoodTemplates') || '[]');

    // Remove template at index
    existingTemplates.splice(templateIndex, 1);

    // Save updated templates
    localStorage.setItem('customMoodTemplates', JSON.stringify(existingTemplates));

    // Remove the template from the UI
    const templateItem = document.querySelector(`#template-${template.min}-${template.max}`).closest('.custom-template-item');
    if (templateItem) templateItem.remove();

    // Update data-index attributes for remaining delete buttons
    document.querySelectorAll('.delete-template-btn').forEach((btn, idx) => {
        btn.dataset.index = idx;
    });

    showTemplateToast('success', `Template Skala ${template.min}-${template.max} telah dihapus`);

    // Reset to default template if the active one was deleted
    if (elements.activeTemplateText.textContent.includes(`Skala ${template.min}-${template.max}`)) {
        setTemplate(1, 5, "Skala 1-5", elements);
        elements.template1to5.classList.add("active");
    }
}

// Set up save template button handler
function setupSaveTemplateHandler(elements) {
    const { saveCustomTemplateBtn, minInput, maxInput, errorDiv } = elements;

    saveCustomTemplateBtn.addEventListener("click", () => {
        const min = parseInt(minInput.value) || 1;
        const max = parseInt(maxInput.value) || 5;

        if (!validateRange(minInput, maxInput, errorDiv)) {
            return;
        }

        saveCustomTemplate(min, max, elements);
    });
}

// Save a custom template
// Save a custom template
function saveCustomTemplate(min, max, elements) {
    // Get existing templates from localStorage
    const existingTemplates = JSON.parse(localStorage.getItem('customMoodTemplates') || '[]');

    // Check if template already exists
    const templateExists = existingTemplates.some(template =>
        template.min === min && template.max === max);

    if (templateExists) {
        // Show centered animation for duplicate template
        Swal.fire({
            position: 'center',
            icon: 'warning',
            title: 'Template Sudah Ada',
            text: `Template dengan Skala ${min}-${max} sudah tersimpan sebelumnya.`,
            showConfirmButton: false,
            timer: 1500,
            timerProgressBar: true,
            customClass: {
                popup: 'animated faster fadeInUp'
            }
        });
        return;
    }

    // Add new template
    existingTemplates.push({ min, max });

    // Save to localStorage
    localStorage.setItem('customMoodTemplates', JSON.stringify(existingTemplates));

    // Add the new template to the UI immediately
    addCustomTemplateToUI({ min, max }, existingTemplates.length - 1, elements);

    // Show centered animation for successful save
    Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'Template Tersimpan',
        text: `Template Skala ${min}-${max} berhasil disimpan.`,
        showConfirmButton: false,
        timer: 1500,
        timerProgressBar: true,
        customClass: {
            popup: 'animated faster fadeInUp'
        }
    }).then(() => {
        // After the animation, set this as the active template
        setTemplate(min, max, `Skala ${min}-${max}`, elements);

        // Find the button for this template and make it active
        setTimeout(() => {
            const templateBtn = document.getElementById(`template-${min}-${max}`);
            if (templateBtn) {
                resetActiveButtons();
                templateBtn.classList.add('active');
            }
        }, 100); // Short delay to ensure DOM is updated
    });
}

// Add a new custom template to the UI
// Add a new custom template to the UI
function addCustomTemplateToUI(template, index, elements) {
    const templateDiv = document.createElement('div');
    templateDiv.className = 'custom-template-item relative group';
    templateDiv.innerHTML = `
        <button id="template-${template.min}-${template.max}" data-min="${template.min}" data-max="${template.max}"
            class="custom-template-btn bg-indigo-100 text-indigo-800 py-2 px-4 rounded-lg
            hover:bg-indigo-200 transition-colors mx-1">
            Skala ${template.min}-${template.max}
        </button>
        <button data-index="${index}" class="delete-template-btn absolute -top-2 -right-2 bg-red-500
            text-white rounded-full w-5 h-5 flex items-center justify-center">
            <span class="text-xs">×</span>
        </button>
    `;

    // Add event listener to the new button
    const btn = templateDiv.querySelector('.custom-template-btn');
    btn.addEventListener('click', function() {
        const min = parseInt(this.dataset.min);
        const max = parseInt(this.dataset.max);

        setTemplate(min, max, `Skala ${min}-${max}`, elements);
        resetActiveButtons();
        this.classList.add("active");
    });

    // Add to the container
    elements.customTemplatesContainer.appendChild(templateDiv);

    // Add event listener for delete button
    const deleteBtn = templateDiv.querySelector('.delete-template-btn');
    deleteBtn.addEventListener('click', e => handleDeleteTemplate(e, deleteBtn, elements));
}

// Show toast notification
function showTemplateToast(icon, title) {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer);
            toast.addEventListener('mouseleave', Swal.resumeTimer);
        }
    });

    Toast.fire({ icon, title });
}

// Set template values
function setTemplate(min, max, templateName, elements) {
    const { minInput, maxInput, activeTemplateText } = elements;

    minInput.value = min;
    maxInput.value = max;

    // Update active template indicator
    activeTemplateText.textContent = `Template Aktif: ${templateName}`;

    // Reset active state on all buttons
    resetActiveButtons();

    validateRange(minInput, maxInput, elements.errorDiv);
}

// Reset active state on all template buttons
function resetActiveButtons() {
    document.querySelectorAll('.template-btn, .custom-template-btn').forEach(btn => {
        btn.classList.remove("active");
    });
}

// Validate min/max range
function validateRange(minInput, maxInput, errorDiv) {
    const min = parseInt(minInput.value) || 0;
    const max = parseInt(maxInput.value) || 0;

    if (min >= max || min < 1 || max > 100) {
        errorDiv.classList.remove("hidden");
        return false;
    } else {
        errorDiv.classList.add("hidden");
        return true;
    }
}

// Handle form submission
function handleMoodConfigSubmit(mahasiswaId) {
    const minMood = document.getElementById("minMood").value;
    const maxMood = document.getElementById("maxMood").value;

    // Validate range
    if (parseInt(minMood) >= parseInt(maxMood) ||
        parseInt(minMood) < 1 ||
        parseInt(maxMood) > 100) {
        Swal.showValidationMessage("Rentang mood tidak valid. Min harus < Max dan nilai harus 1-100.");
        return false;
    }

    // Create configuration object
    const config = {
        range: {
            min: parseInt(minMood),
            max: parseInt(maxMood)
        }
    };

    // Determine if it's closer to role_1 or role_2 based on the range
    const selectedRole = config.range.max <= 5 ? "role_1" : "role_2";

    // Store current selection in localStorage for this mahasiswa
    localStorage.setItem(`mood_settings_${mahasiswaId}`, JSON.stringify(config));

    // Send the request to update the role
    return submitRoleUpdate(mahasiswaId, selectedRole, config);
}

// Submit role update to the server
function submitRoleUpdate(mahasiswaId, selectedRole, config) {
    return fetch(`/dosen/edit-role/${mahasiswaId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
        },
        body: JSON.stringify({
            role: selectedRole,
            config: config
        })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        return {
            success: true,
            message: data.message || "Role berhasil diubah!"
        };
    })
    .catch(error => {
        console.error("Error:", error);
        return {
            success: false,
            message: "Terjadi kesalahan saat mengubah role. Silakan coba lagi."
        };
    });
}

// Handle the result of the modal
function handleMoodConfigResult(result) {
    if (result.isConfirmed) {
        if (result.value && result.value.success) {
            Swal.fire({
                title: "Berhasil!",
                text: result.value.message,
                icon: "success",
                confirmButtonText: "Oke"
            }).then(() => window.location.reload());
        } else if (result.value) {
            Swal.fire({
                icon: "error",
                title: "Gagal",
                text: result.value.message
            });
        }
    }
}


function handlePermissionRequest(mahasiswaId) {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success w-24 mx-2",
            cancelButton: "btn btn-danger w-24 mx-2"
        },
        buttonsStyling: false
    });

    swalWithBootstrapButtons.fire({
        title: "Apa kamu yakin?",
        text: "Ingin mengirim permintaan izin!",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Ya!",
        cancelButtonText: "Tidak!",
        reverseButtons: true,
    }).then((result) => {
        if (result.isConfirmed) {
            axios.post(`/dosen/mahasiswa/${mahasiswaId}/izin`)
                .then(response => {
                    if (response.data.success) {
                        swalWithBootstrapButtons.fire({
                            title: "Berhasil!",
                            text: response.data.message,
                            icon: "success",
                        });
                    } else {
                        swalWithBootstrapButtons.fire({
                            title: "Gagal",
                            text: "Permintaan gagal diproses.",
                            icon: "error",
                        });
                    }
                })
                .catch(error => {
                    swalWithBootstrapButtons.fire({
                        title: "Gagal",
                        text: error.response?.data?.message || "Terjadi kesalahan jaringan atau server!",
                        icon: "error",
                    });
                });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            swalWithBootstrapButtons.fire({
                title: "Dibatalkan",
                text: "Permintaan izin dibatalkan :)",
                icon: "error"
            });
        }
    });
}

