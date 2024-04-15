document.addEventListener('DOMContentLoaded', function() {
    const registerForm = document.querySelector('#registerForm');

    registerForm.addEventListener('submit', function(event) {
        event.preventDefault();

        const username = document.querySelector('#username').value;
        const password = document.querySelector('#password').value;
        const confirmPassword = document.querySelector('#confirmPassword').value;

        if (username === '' || password === '' || confirmPassword === '') {
            alert('All fields are required!');
            return;
        }

        if (password !== confirmPassword) {
            alert('Passwords do not match!');
            return;
        }

        // Simulate a registration request
        console.log(`Registering with username: ${username} and password: ${password}`);
    });
});
