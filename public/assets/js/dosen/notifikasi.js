document.addEventListener('DOMContentLoaded', function () {
    const tabButtons = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');

    function switchTab(tabId) {
        // Hide all tab contents and reset tab button states
        tabContents.forEach(content => content.classList.add('hidden'));
        tabButtons.forEach(btn => {
            btn.classList.remove('border-b-2', 'border-black');
            btn.classList.add('opacity-70');
        });

        // Show the selected tab content
        const selectedContent = document.getElementById(`${tabId}-content`);
        if (selectedContent) {
            selectedContent.classList.remove('hidden');
        }

        // Highlight the selected tab button
        const selectedTab = [...tabButtons].find(btn => btn.dataset.tab === tabId);
        if (selectedTab) {
            selectedTab.classList.add('border-b-2', 'border-black');
            selectedTab.classList.remove('opacity-70');
        }
    }

    // Add click event listeners to tab buttons
    tabButtons.forEach(button => {
        button.addEventListener('click', () => switchTab(button.dataset.tab));
    });
});
