document.querySelector("form").addEventListener("confirmChanges", async (event) => {
  event.preventDefault();

  event.target.submit();
});
