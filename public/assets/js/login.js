document.addEventListener("DOMContentLoaded", () => {
  const togglePasswordBtn = document.getElementById("togglePassword");
  const passwordInput = document.getElementById("password");
  const visibilityIcon = document.getElementById("visibilityIcon");
  const messageArea = document.getElementById("messageArea");
  const messageText = document.getElementById("messageText");
  const messageIcon = document.getElementById("messageIcon");
  const loginForm = document.getElementById("loginForm");

  if (
    !togglePasswordBtn ||
    !passwordInput ||
    !visibilityIcon ||
    !messageArea ||
    !messageText ||
    !messageIcon ||
    !loginForm
  ) {
    return;
  }

  togglePasswordBtn.addEventListener("click", () => {
    const type =
      passwordInput.getAttribute("type") === "password" ? "text" : "password";
    passwordInput.setAttribute("type", type);
    visibilityIcon.textContent =
      type === "password" ? "visibility_off" : "visibility";
  });

  loginForm.addEventListener("submit", async (event) => {
    event.preventDefault();
    messageArea.className = "rounded-3 p-3 d-flex align-items-center gap-2";

    const submitBtn = loginForm.querySelector('button[type="submit"]');
    submitBtn.disabled = true;

    try {
      const response = await fetch(loginForm.action, {
        method: "POST",
        body: new FormData(loginForm),
      });

      const data = await response.json();

      if (data.ok) {
        messageArea.classList.add("bg-success-subtle", "text-success");
        messageIcon.textContent = "check_circle";
        messageText.textContent =
          data.message || "Inicio de sesión exitoso. Redirigiendo...";
        setTimeout(() => (window.location.href = data.redirect), 300);
      } else {
        messageArea.classList.add("bg-danger-subtle", "text-danger");
        messageIcon.textContent = "error";
        messageText.textContent =
          data.message ||
          "Las credenciales ingresadas son incorrectas. Inténtalo de nuevo.";
      }
    } catch (error) {
      messageArea.classList.add("bg-danger-subtle", "text-danger");
      messageIcon.textContent = "error";
      messageText.textContent =
        "No se pudo conectar con el servidor. Inténtalo de nuevo.";
    } finally {
      submitBtn.disabled = false;
    }
  });
});
