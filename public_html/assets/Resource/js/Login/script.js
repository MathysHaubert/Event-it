document.querySelector("form").addEventListener("submit", async (event) => {
  event.preventDefault();

  const input = document.querySelector("#password[name='_password']");
  const hashedPassword = await strHash(input.value);
  input.value = hashedPassword;
  console.log(hashedPassword);

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
