document.addEventListener('DOMContentLoaded', () => {
  const profileForm = document.querySelector('form');

  profileForm.addEventListener('submit', async (event) => {
      event.preventDefault();

      const passwordInput = document.querySelector("#password[name='password']");
      const confirmPasswordInput = document.querySelector("#confirm_password[name='confirm_password']");
      const emailInput = document.querySelector('#email');

      const hashedPassword = await strHash(passwordInput.value);
      const hashedConfirmPassword = await strHash(confirmPasswordInput.value);

      passwordInput.value = hashedPassword;
      confirmPasswordInput.value = hashedConfirmPassword;

      if (passwordInput.value === '' || confirmPasswordInput.value === '' || emailInput.value === '') {
          alert('All fields are required!');
          return;
      }

      if (passwordInput.value !== confirmPasswordInput.value) {
          alert('Passwords do not match!');
          document.querySelector("#password[name='password']").value = '';
          document.querySelector("#confirm_password[name='confirm_password']").value = '';
          return;
      }

      event.target.submit();
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
