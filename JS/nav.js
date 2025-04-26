// Get the header tag as the container
const container = document.querySelector('header');

// Fetch the content from navbar.php
fetch('../backend/navbar.php')
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok ' + response.statusText);
        }
        return response.text();
    })
    .then(data => {
        // Add the fetched content to the container
        container.innerHTML += data;
    })
    .catch(error => {
        console.error('There was a problem with the fetch operation:', error);
    });