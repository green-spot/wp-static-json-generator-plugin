jQuery(() => {
  const button = document.querySelector(".sjg-update-all-json-button");

  button.addEventListener("click", async () => {
    const res = await fetch("/wp/wp-json/static-json-generator/v1/save-all", {method: "POST"});
    console.log(await res.json());
  });
});
