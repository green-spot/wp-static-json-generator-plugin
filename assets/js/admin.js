jQuery(() => {
  const button = document.querySelector(".sjg-update-all-json-button");

  button.addEventListener("click", async () => {
    const res = await fetch(`${myRestApi.root}static-json-generator/v1/save-all`, {
      method: "POST",
      headers: {'X-WP-Nonce': myRestApi.nonce,}
    });
    console.log(await res.json());
  });
});
