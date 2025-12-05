// world.js

window.onload = function () {

    // Get DOM elements
    let lookupBtn = document.getElementById("lookup");
    let countryInput = document.getElementById("country");
    let resultDiv = document.getElementById("result");

    // Listen for button click
    lookupBtn.addEventListener("click", function () {

        let country = countryInput.value.trim(); // get text input

        // Create AJAX request
        let request = new XMLHttpRequest();

        // Builds the URL with the GET parameter
        let url = "world.php?country=" + encodeURIComponent(country);

        // Sets up the request
        request.open("GET", url, true);

        // This handles the response
        request.onreadystatechange = function () {
            if (request.readyState === XMLHttpRequest.DONE) {
                if (request.status === 200) {
                    // Insert the returned HTML into the page
                    resultDiv.innerHTML = request.responseText;
                } else {
                    resultDiv.innerHTML = "<p>Error fetching data.</p>";
                }
            }
        };

        // Sends the AJAX request
        request.send();
    });
};
