document.addEventListener('DOMContentLoaded', () => {
  var submitButton = document.getElementById('update_profile');

  submitButton.addEventListener('click', async (event) => {
      event.preventDefault();

      const passwordInput = document.querySelector("#password[name='password']");
      const confirmPasswordInput = document.querySelector("#confirm_password[name='confirm_password']");
      const emailInput = document.querySelector('#email');

      console.log(passwordInput.value);

      if (passwordInput.value === '' || confirmPasswordInput.value === '' || emailInput.value === '') {
          alert('All fields are required!');
          return;
      }

      if (passwordInput.value !== confirmPasswordInput.value) {
          alert('Passwords do not match!');
          passwordInput.value = '';
          confirmPasswordInput.value = '';
          return;
      }

      const hashedPassword = await strHash(passwordInput.value);
      const hashedConfirmPassword = await strHash(confirmPasswordInput.value);

      console.log(hashedPassword);

      passwordInput.value = hashedPassword;
      confirmPasswordInput.value = hashedConfirmPassword;

      profileForm.submit();
  });

  async function strHash(string) {
      const encoder = new TextEncoder();
      const data = encoder.encode(string);
      const hash = await window.crypto.subtle.digest("SHA-256", data);

      // Convert the result to hexadecimal
      const hashArray = Array.from(new Uint8Array(hash));
      const hashHex = hashArray.map(b => b.toString(16).padStart(2, '0')).join('');

      return hashHex;
  }
});

document.addEventListener('DOMContentLoaded', function() {
  var logoutButton = document.getElementById('logout-button');
  var form = document.getElementById('profile-form');
  logoutButton.addEventListener('click', function() {
    var input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'logout';
    input.value = '1';
    form.appendChild(input);
    form.submit();
  });
});
