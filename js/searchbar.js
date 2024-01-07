document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("searchInput");
    const suggestionsList = document.getElementById("suggestionsList");

    searchInput.addEventListener("input", function () {
        const inputValue = searchInput.value.toLowerCase();

        // Simulated data, replace with your data source
        const suggestions = ["Test 1", "Test 2", "Test 3", "Test 4", "Test 5", "Test 6"];

        // Clear previous suggestions
        suggestionsList.innerHTML = "";

        // Filter and display matching suggestions
        const filteredSuggestions = suggestions.filter(function (suggestion) {
            return suggestion.toLowerCase().includes(inputValue);
        });

        filteredSuggestions.forEach(function (suggestion) {
            const li = document.createElement("li");
            li.textContent = suggestion;
            suggestionsList.appendChild(li);
        });

        // Show/hide suggestions list based on input
        if (inputValue.length > 0) {
            suggestionsList.style.display = "block";
        } else {
            suggestionsList.style.display = "none";
        }
    });

    // Handle click on suggestion
    suggestionsList.addEventListener("click", function (event) {
        if (event.target.tagName === "LI") {
            searchInput.value = event.target.textContent;
            suggestionsList.style.display = "none";
        }
    });

    // Close suggestions when clicking outside the search container
    document.addEventListener("click", function (event) {
        if (!event.target.closest(".search-container")) {
            suggestionsList.style.display = "none";
        }
    });
});
