document.getElementById("registerForm").addEventListener("submit", async (e) => {
    e.preventDefault();

    const username = document.getElementById("username").value.trim();
    const password = document.getElementById("password").value;
    const message = document.getElementById("message");

    const response = await fetch("../backend/login/register.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ username, password })
    });

    const data = await response.json();
    message.innerText = data.message;

    if (data.success) {
        setTimeout(() => {
            window.location.href = "login.html";
        }, 2000);
    }

});