// Advanced Filter Builder - Notion Style
let filterOptions = {
    fields: [],
    operators: {},
    roles: []
};

let filterState = {
    logic: 'and',
    rules: [],
    groups: []
};

// Initialize on page load
document.addEventListener('DOMContentLoaded', async function() {
    await loadFilterOptions();
    renderFilterBuilder();
    
    // Load example filter if needed
    // loadExampleFilter();
});

// Load filter options from server
async function loadFilterOptions() {
    try {
        const response = await axios.get('/dosen/advanced-filter/options');
        filterOptions = response.data;
    } catch (error) {
        console.error('Error loading filter options:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Gagal memuat opsi filter'
        });
    }
}

// Render the entire filter builder
function renderFilterBuilder() {
    const container = document.getElementById('filterBuilder');
    container.innerHTML = renderGroup(filterState, 0);
}

// Render a filter group
function renderGroup(group, level, path = []) {
    const groupPath = path.join('.');
    const indent = level * 20;
    
    let html = `
        <div class="filter-group" style="margin-left: ${indent}px;" data-path="${groupPath}">
            <div class="filter-header">
                <span class="filter-label">Kondisi:</span>
                <button class="logic-badge ${group.logic}" onclick="toggleLogic('${groupPath}')">
                    ${group.logic.toUpperCase()}
                </button>
                ${level > 0 ? `<button class="btn-remove ml-auto" onclick="removeGroup('${groupPath}')">✕ Hapus Grup</button>` : ''}
            </div>
            
            <div class="filter-rules">
    `;
    
    // Render rules
    group.rules.forEach((rule, index) => {
        html += renderRule(rule, index, path);
    });
    
    html += `
            </div>
            
            <div class="mt-3 flex gap-2 flex-wrap">
                <button class="btn-add" onclick="addRule('${groupPath}')">
                    + Add filter rule
                </button>
                <button class="btn-add" onclick="addGroup('${groupPath}')">
                    + Add filter group
                </button>
            </div>
    `;
    
    // Render nested groups
    group.groups.forEach((subGroup, index) => {
        const subPath = [...path, 'groups', index];
        html += renderGroup(subGroup, level + 1, subPath);
    });
    
    html += `</div>`;
    
    return html;
}

// Render a single filter rule
function renderRule(rule, index, parentPath) {
    const rulePath = [...parentPath, 'rules', index].join('.');
    const field = rule.field || '';
    const operator = rule.operator || '';
    const value = rule.value || '';
    
    const fieldType = getFieldType(field);
    const operators = filterOptions.operators[fieldType] || filterOptions.operators.text;
    
    let html = `
        <div class="filter-rule" data-path="${rulePath}">
            <select class="filter-select" onchange="updateRule('${rulePath}', 'field', this.value)">
                <option value="">Pilih field...</option>
    `;
    
    filterOptions.fields.forEach(f => {
        html += `<option value="${f.value}" ${field === f.value ? 'selected' : ''}>${f.label}</option>`;
    });
    
    html += `
            </select>
            
            <select class="filter-select" onchange="updateRule('${rulePath}', 'operator', this.value)">
                <option value="">Pilih operator...</option>
    `;
    
    operators.forEach(op => {
        html += `<option value="${op.value}" ${operator === op.value ? 'selected' : ''}>${op.label}</option>`;
    });
    
    html += `</select>`;
    
    // Render value input based on field type and operator
    html += renderValueInput(field, operator, value, rulePath);
    
    html += `
            <button class="btn-remove" onclick="removeRule('${rulePath}')">✕</button>
        </div>
    `;
    
    return html;
}

// Render value input based on field type and operator
function renderValueInput(field, operator, value, rulePath) {
    if (operator === 'is_empty' || operator === 'is_not_empty') {
        return ''; // No value input needed
    }
    
    if (operator === 'between') {
        const values = Array.isArray(value) ? value : ['', ''];
        return `
            <div class="date-inputs">
                <input type="date" class="filter-input" value="${values[0] || ''}" 
                    onchange="updateRuleBetween('${rulePath}', 0, this.value)">
                <span class="date-separator">—</span>
                <input type="date" class="filter-input" value="${values[1] || ''}" 
                    onchange="updateRuleBetween('${rulePath}', 1, this.value)">
            </div>
        `;
    }
    
    if (field === 'role_id') {
        let html = `<select class="filter-select" onchange="updateRule('${rulePath}', 'value', this.value)">
            <option value="">Pilih role...</option>`;
        
        filterOptions.roles.forEach(role => {
            html += `<option value="${role.value}" ${value == role.value ? 'selected' : ''}>${role.label}</option>`;
        });
        
        html += `</select>`;
        return html;
    }
    
    const fieldType = getFieldType(field);
    
    if (fieldType === 'date') {
        return `<input type="date" class="filter-input" value="${value}" 
            onchange="updateRule('${rulePath}', 'value', this.value)">`;
    }
    
    if (fieldType === 'number') {
        return `<input type="number" class="filter-input" value="${value}" 
            onchange="updateRule('${rulePath}', 'value', this.value)" 
            placeholder="Masukkan angka...">`;
    }
    
    return `<input type="text" class="filter-input" value="${value}" 
        onchange="updateRule('${rulePath}', 'value', this.value)" 
        placeholder="Masukkan nilai...">`;
}

// Get field type
function getFieldType(field) {
    const dateFields = ['tanggal_lahir', 'created_at'];
    const numberFields = ['role_id'];
    
    if (dateFields.includes(field)) return 'date';
    if (numberFields.includes(field)) return 'number';
    return 'text';
}

// Get object by path
function getByPath(obj, path) {
    if (!path) return obj;
    const keys = path.split('.');
    let current = obj;
    for (let key of keys) {
        if (current[key] === undefined) return null;
        current = current[key];
    }
    return current;
}

// Set value by path
function setByPath(obj, path, value) {
    if (!path) return;
    const keys = path.split('.');
    let current = obj;
    for (let i = 0; i < keys.length - 1; i++) {
        if (current[keys[i]] === undefined) return;
        current = current[keys[i]];
    }
    current[keys[keys.length - 1]] = value;
}

// Toggle logic (AND/OR)
function toggleLogic(path) {
    const group = getByPath(filterState, path);
    if (group) {
        group.logic = group.logic === 'and' ? 'or' : 'and';
        renderFilterBuilder();
    }
}

// Add new rule
function addRule(path) {
    const group = getByPath(filterState, path);
    if (group) {
        group.rules.push({
            field: '',
            operator: '',
            value: ''
        });
        renderFilterBuilder();
    }
}

// Add new group
function addGroup(path) {
    const group = getByPath(filterState, path);
    if (group) {
        group.groups.push({
            logic: 'and',
            rules: [],
            groups: []
        });
        renderFilterBuilder();
    }
}

// Remove rule
function removeRule(path) {
    const parts = path.split('.');
    const index = parseInt(parts.pop());
    parts.pop(); // Remove 'rules'
    const parentPath = parts.join('.');
    
    const parent = getByPath(filterState, parentPath);
    if (parent && parent.rules) {
        parent.rules.splice(index, 1);
        renderFilterBuilder();
    }
}

// Remove group
function removeGroup(path) {
    const parts = path.split('.');
    const index = parseInt(parts.pop());
    parts.pop(); // Remove 'groups'
    const parentPath = parts.join('.');
    
    const parent = getByPath(filterState, parentPath);
    if (parent && parent.groups) {
        parent.groups.splice(index, 1);
        renderFilterBuilder();
    }
}

// Update rule field/operator/value
function updateRule(path, field, value) {
    const parts = path.split('.');
    const index = parseInt(parts.pop());
    parts.pop(); // Remove 'rules'
    const parentPath = parts.join('.');
    
    const parent = getByPath(filterState, parentPath);
    if (parent && parent.rules && parent.rules[index]) {
        parent.rules[index][field] = value;
        
        // If field changed, reset operator and value
        if (field === 'field') {
            parent.rules[index].operator = '';
            parent.rules[index].value = '';
        }
        
        // If operator changed to between, initialize value as array
        if (field === 'operator' && value === 'between') {
            parent.rules[index].value = ['', ''];
        }
        
        renderFilterBuilder();
    }
}

// Update rule value for between operator
function updateRuleBetween(path, index, value) {
    const parts = path.split('.');
    const ruleIndex = parseInt(parts.pop());
    parts.pop(); // Remove 'rules'
    const parentPath = parts.join('.');
    
    const parent = getByPath(filterState, parentPath);
    if (parent && parent.rules && parent.rules[ruleIndex]) {
        if (!Array.isArray(parent.rules[ruleIndex].value)) {
            parent.rules[ruleIndex].value = ['', ''];
        }
        parent.rules[ruleIndex].value[index] = value;
    }
}

// Apply filters
async function applyFilters() {
    // Validate filters
    if (!validateFilters(filterState)) {
        Swal.fire({
            icon: 'warning',
            title: 'Validasi Gagal',
            text: 'Pastikan semua field, operator, dan nilai telah diisi dengan benar'
        });
        return;
    }
    
    try {
        const response = await axios.post('/dosen/advanced-filter/apply', {
            filters: filterState
        }, {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        });
        
        document.getElementById('resultsTable').innerHTML = response.data;
        document.getElementById('resultsSection').style.display = 'block';
        
        // Scroll to results
        document.getElementById('resultsSection').scrollIntoView({ behavior: 'smooth' });
        
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: 'Filter berhasil diterapkan',
            timer: 2000,
            showConfirmButton: false
        });
        
    } catch (error) {
        console.error('Error applying filters:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Gagal menerapkan filter'
        });
    }
}

// Validate filters recursively
function validateFilters(group) {
    // Check all rules
    for (let rule of group.rules) {
        if (!rule.field || !rule.operator) {
            return false;
        }
        
        // Skip value validation for operators that don't need value
        if (rule.operator === 'is_empty' || rule.operator === 'is_not_empty') {
            continue;
        }
        
        // Validate between operator
        if (rule.operator === 'between') {
            if (!Array.isArray(rule.value) || !rule.value[0] || !rule.value[1]) {
                return false;
            }
        } else if (!rule.value && rule.value !== 0) {
            return false;
        }
    }
    
    // Check nested groups
    for (let subGroup of group.groups) {
        if (!validateFilters(subGroup)) {
            return false;
        }
    }
    
    return true;
}

// Reset filters
function resetFilters() {
    filterState = {
        logic: 'and',
        rules: [],
        groups: []
    };
    renderFilterBuilder();
    document.getElementById('resultsSection').style.display = 'none';
    
    Swal.fire({
        icon: 'info',
        title: 'Reset',
        text: 'Filter telah direset',
        timer: 1500,
        showConfirmButton: false
    });
}

// Load example filter (optional)
function loadExampleFilter() {
    filterState = {
        logic: 'or',
        rules: [],
        groups: [
            {
                logic: 'and',
                rules: [
                    {
                        field: 'tanggal_lahir',
                        operator: 'between',
                        value: ['2001-01-01', '2001-01-31']
                    },
                    {
                        field: 'role_id',
                        operator: 'equals',
                        value: '3'
                    }
                ],
                groups: []
            },
            {
                logic: 'and',
                rules: [
                    {
                        field: 'tanggal_lahir',
                        operator: 'before',
                        value: '2020-02-28'
                    },
                    {
                        field: 'nama',
                        operator: 'contains',
                        value: 'Agung'
                    },
                    {
                        field: 'created_at',
                        operator: 'after',
                        value: '2024-03-28'
                    }
                ],
                groups: []
            }
        ]
    };
    renderFilterBuilder();
}
