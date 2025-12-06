// world.js

window.onload = function () {

    // Get DOM elements
    let lookupBtn = document.getElementById("lookup");
    let lookupCitiesBtn = document.getElementById("lookup-cities");
    let countryInput = document.getElementById("country");
    let resultDiv = document.getElementById("result");

    // --- Lookup Country ---
    lookupBtn.addEventListener("click", function () {
        let country = countryInput.value.trim();
        let url = "world.php?country=" + encodeURIComponent(country);
        fetchData(url);
    });

    // --- Lookup Cities ---
    lookupCitiesBtn.addEventListener("click", function () {
        let country = countryInput.value.trim();
        let url = "world.php?country=" + encodeURIComponent(country) + "&lookup=cities";
        fetchData(url);
    });

    // --- Common AJAX function ---
    function fetchData(url) {
        let request = new XMLHttpRequest();
        request.open("GET", url, true);

        request.onreadystatechange = function () {
            if (request.readyState === XMLHttpRequest.DONE) {
                if (request.status === 200) {
                    resultDiv.innerHTML = request.responseText;
                } else {
                    resultDiv.innerHTML = "<p>Error fetching data.</p>";
                }
            }
        };

        request.send();
    }
};
