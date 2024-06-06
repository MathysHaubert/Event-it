
    const registerForm = document.querySelector('#registerForm');

    registerForm.addEventListener('submit',  async (event) => {
      event.preventDefault();
      const input = document.querySelector("#password[name='password']");
      const hashedPassword = await strHash(input.value);
      const confirminput = document.querySelector("#confirmPassword[name='confirmPassword']");
      const hashedconfirmPassword = await strHash(confirminput.value);
      input.value = hashedPassword;
      confirminput.value = hashedconfirmPassword;
      console.log(hashedPassword);

      const email = document.querySelector('#email')
      const terms = document.querySelector('#CGU');

      if (input.value === '' || confirminput.value === '' || email.value === '' || !terms.checked) {
        alert('All fields are required!');
        return;
      }

      if (input.value !== confirminput.value) {
        alert('Passwords do not match!');
      }

      event.target.submit();
});
async function strHash(a) {
  const encoder = new TextEncoder();
  const data = encoder.encode(a);
  const hash = await window.crypto.subtle.digest("SHA-256", data);

  // Convert the result to hexadecimal
  let hashArray = Array.from(new Uint8Array(hash));
  let hashHex = hashArray.map((b) => b.toString(16).padStart(2, "0")).join("");

  return hashHex;
}
