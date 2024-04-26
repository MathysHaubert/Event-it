document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.querySelector('#loginForm');

    loginForm.addEventListener('submit', function(event) {
        event.preventDefault();

        const username = document.querySelector('#username').value;
        const password = document.querySelector('#password').value;

        if (username === '' || password === '') {
            alert('Both fields are required!');
            return;
        }

        // Simulate a login request
        console.log(`Logging in with username: ${username} and password: ${password}`);
    });
});
