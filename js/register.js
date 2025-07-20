// Registrierung: Clientseitige Validierung und AJAX-Formularübermittlung
document
  .getElementById("registerForm")
  .addEventListener("submit", async function (e) {
    e.preventDefault(); // Verhindert die Standardaktion des Browsers (Formular-Weiterleitung)

    const email = document.getElementById("regEmail");
    const pw1 = document.getElementById("passwort");
    const pw2 = document.getElementById("passwort_wiederholen");
    const errorBox = document.getElementById("regError"); // Fehleranzeige für das Registrierungsformular in Fehleranzeige-Container

    // E-Mail auf Server-Seite prüfen (ob bereits registriert)
    // ➤ Sende eine HTTP-Anfrage an das PHP-Skript
    //     → Das PHP-Skript fragt in der Datenbank nach, ob die E-Mail bereits existiert
    //     → encodeURIComponent() stellt sicher, dass Sonderzeichen korrekt übertragen werden
    const check = await fetch(
      "php/check_email.php?email=" + encodeURIComponent(email.value)
    );
    const checkResult = await check.json();
    if (checkResult.exists) {
      email.classList.add("is-invalid");
      errorBox.innerText =
        "Diese E-Mail ist bereits registriert. Bitte einloggen.";
      errorBox.classList.remove("d-none");
      return;
    } else {
      email.classList.remove("is-invalid");
      errorBox.classList.add("d-none");
    }

    //  Passwort-Abgleich prüfen
    if (pw1.value !== pw2.value) {
      // ➤ 1. Fehlerhafte Eingabe hervorheben (roter Rahmen)
      pw2.classList.add("is-invalid");
      // ➤ 2. Fehlermeldung in errorBox anzeigen
      errorBox.innerText = "Die Passwörter stimmen nicht überein.";
      // ➤ 3. Fehlermeldung sichtbar machen
      errorBox.classList.remove("d-none");
      // ➤ 4. Formularübermittlung abbrechen
      return;
    } else {
      pw2.classList.remove("is-invalid");
      errorBox.classList.add("d-none");
    }

    // Registrierung an register.php absenden (AJAX)
    const formData = new FormData(this);
    const res = await fetch("php/register.php", {
      method: "POST",
      body: formData,
    });

    // Überprüfen, ob die Antwort des Servers erfolgreich war
    const data = await res.json();

    // Bei Erfolg: Tab auf Login wechseln und Erfolgsmeldung anzeigen
    // Wenn die Serverantwort erfolgreich ist und die Registrierung geklappt hat
    if (res.ok && data.success) {
      // Erfolgreiche Registrierung: Erfolgsnachricht anzeigen
      document.getElementById("successMessage").classList.remove("d-none");
      new bootstrap.Tab(document.getElementById("login-tab")).show(); // Tab-Wechsel auf "Einloggen"
      this.reset(); // Registrierungsformular zurücksetzen
    } else {
      // Fehlermeldung anzeigen (vom Server oder Standardtext)
      errorBox.innerText = data.error || "Ein Fehler ist aufgetreten.";
      errorBox.classList.remove("d-none");
    }
  });

document
  .querySelector("#login form")
  .addEventListener("submit", async function (e) {
    e.preventDefault();

    const formData = new FormData(this);
    const res = await fetch("php/login.php", {
      method: "POST",
      body: formData,
    });
    const data = await res.json();
    const errorBox = document.getElementById("loginError");

    if (data.success) {
      window.location.href = "gehaeuse.html"; // ✅ Weiterleitung bei erfolgreichem Login
    } else {
      errorBox.innerText = data.error || "Ein Fehler ist aufgetreten.";
      errorBox.classList.remove("d-none");
    }
  });
