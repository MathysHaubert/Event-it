document.addEventListener('DOMContentLoaded', function() {
    const registerForm = document.querySelector('#registerForm');

    registerForm.addEventListener('submit', function(event) {
        event.preventDefault();

        const username = document.querySelector('#username').value;
        const password = document.querySelector('#password').value;
        const confirmPassword = document.querySelector('#confirmPassword').value;
        const email = document.querySelector('#email').value
        const terms = document.querySelector('#terms').checked;

      if (username === '' || password === '' || confirmPassword === '' || email === '' || !terms) {
            alert('All fields are required!');
            return;
        }

        if (password !== confirmPassword) {
            alert('Passwords do not match!');
            return;
        }

        // Simulate a registration request
        setTimeout(function() {
            alert('Registration successful!');
            window.location.href = 'login.html';
        }, 2000);

    });
});
