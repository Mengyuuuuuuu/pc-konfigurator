// Login: Übermittlung der Anmeldedaten und Fehleranzeige
document
  .querySelector("#login form")
  .addEventListener("submit", async function (e) {
    e.preventDefault(); // ➤ Standard-Formularverhalten verhindern

    const formData = new FormData(this);
    const res = await fetch("php/login.php", {
      method: "POST",
      body: formData,
    });

    const data = await res.json();
    const errorBox = document.getElementById("loginError"); // ➤ Fehleranzeige für Login-Fehler

    if (data.success) {
      // ➤ Erfolgreiche Anmeldung: Weiterleitung zur Konfigurator-Seite
      window.location.href = "gehaeuse.html";
    } else {
      // ➤ Fehlermeldung bei ungültigen Login-Daten
      errorBox.innerText = data.error || "Ein Fehler ist aufgetreten.";
      errorBox.classList.remove("d-none");
    }
  });
