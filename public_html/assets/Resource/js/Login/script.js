document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.querySelector('form');

    if (loginForm) {
        loginForm.addEventListener('submit', function(event) {
            event.preventDefault();

            const username = document.querySelector('#username').value;
            const password = document.querySelector('#password').value;

            // Send the form data to the server using AJAX
            fetch('http://176.147.224.139:8088/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    username: username,
                    password: password,
                }),
            })
            .then(response =>  {
                console.log('Response:', JSON.stringify(response));
                return response.json();
            })
            .then(data => {
                // Handle the response from the server
                console.log('Response:', data);
            })
            .catch(error => {
                // Handle any errors
                console.error('Error:', error);
            });
        });
    }
});
