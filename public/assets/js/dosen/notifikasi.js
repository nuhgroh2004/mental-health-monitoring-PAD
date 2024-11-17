document.addEventListener('DOMContentLoaded', function() {
    const tabButtons = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');

    function switchTab(tabId) {
        // Hide all tab contents
        tabContents.forEach(content => {
            content.classList.add('hidden');
        });

        // Remove active state from all tabs
        tabButtons.forEach(btn => {
            btn.classList.remove('border-b-2', 'border-black');
            btn.classList.add('opacity-70');
        });

        // Show selected tab content
        const selectedContent = document.getElementById(`${tabId}-content`);
        selectedContent.classList.remove('hidden');

        // Add active state to selected tab
        const selectedTab = document.querySelector(`[data-tab="${tabId}"]`);
        selectedTab.classList.add('border-b-2', 'border-black');
        selectedTab.classList.remove('opacity-70');
    }

    // Add click event listeners to tabs
    tabButtons.forEach(button => {
        button.addEventListener('click', () => {
            const tabId = button.getAttribute('data-tab');
            switchTab(tabId);
        });
    });
});
