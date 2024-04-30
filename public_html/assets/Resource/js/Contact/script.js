// script.js
document.addEventListener('DOMContentLoaded', (event) => {
    document.getElementById('formButton').addEventListener('click', function() {
        document.getElementById('formSection').scrollIntoView({ behavior: 'smooth' });
 
        alert('Le formulaire sera bientôt disponible!');
    });
});
