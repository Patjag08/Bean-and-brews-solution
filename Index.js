
document.getElementById("userForm").addEventListener("submit", function(e) {
    e.preventDefault();

    const formData = new FormData(this);

    fetch("server.php", {
    method: "POST",
    body: formData })
    .catch(err => console.error(err));
});

