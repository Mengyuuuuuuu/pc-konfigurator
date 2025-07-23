# PC-Konfigurator – Webprojekt

## 📁 Projektübersicht

Dieses Projekt ist ein mehrstufiger PC-Konfigurator für die fiktive Firma *IT-Mustermann*. Es ermöglicht Benutzerregistrierung, Login sowie die schrittweise Auswahl von Komponenten wie Gehäuse, CPU, RAM, Zubehör, Software und Monitor. Die Auswahl wird in einer MySQL-Datenbank gespeichert.

## 🛠️ Voraussetzungen

- Lokaler Webserver (z. B. **XAMPP**, **MAMP** oder **Laragon**)
- PHP (Version ≥ 7.4 empfohlen)
- MySQL oder MariaDB
- Webbrowser (z. B. Chrome, Firefox)

## 🔧 Installation & Start

1. **Projekt entpacken** und in den lokalen Webserver-Ordner legen:  
   z. B. `C:\xampp\htdocs\pc-konfigurator\`

2. **Datenbank importieren**:  
   - Öffne `phpMyAdmin` oder ein anderes MySQL-Tool  
   - Erstelle eine neue Datenbank, z. B. `mustermann`  
   - Importiere die Datei `mustermann.sql`

3. **Zugangsdaten anpassen (falls nötig)**:  
   In `php/db_connect.php` ggf. `user`, `password` und `dbname` anpassen:

   ```php
   $conn = new mysqli("localhost", "root", "", "mustermann");
   
4. **Projekt starten**:
   Rufe im Browser auf:
   http://localhost/pc-konfigurator/index.html

   📁 bootstrap5.3        → Bootstrap CSS/JS  
   📁 img                 → Bilder und Icons  
   📁 js                  → Eigene JavaScript-Dateien  
   📁 php                 → PHP-Skripte für Login, Registrierung, Konfiguration  
   📁 sql                 → (optional) weitere SQL-Skripte  
   📄 mustermann.sql      → Datenbankstruktur und Beispieldaten  
   📄 index.html          → Startseite  
   📄 vorlage.html        → Beispielseite  
   📄 zusammenfassung.php → Abschlussübersicht  

## 🧪 Funktionalitäten
✅ Benutzerregistrierung mit E-Mail-Prüfung

✅ Login mit Sessions

✅ Schrittweiser PC-Konfigurator (Gehäuse → CPU → RAM → Extras → Software → Monitor)

✅ Gesamtsumme & Zusammenfassung am Ende

✅ Bootstrap für responsives Design

## 👩‍💻 Autorin 
Mengyu Wang  
Fachbereich: Wirtschaftsinformatik   
Abgabedatum: Juli 2025  


