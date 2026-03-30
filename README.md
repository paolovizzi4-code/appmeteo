Questa web app permette di inserire una città supportata (Torino, Roma, Milano) e visualizzare le temperature massime degli ultimi 7 giorni, ordinate dal più basso al più alto. L’app usa frontend HTML/JS, un backend PHP e l’API Open-Meteo. È semplice, sicura e modulare, ideale per imparare a collegare frontend, backend e API esterne.
Funzionamento
L’utente scrive il nome della città e clicca “Cerca”.
Il frontend (index.html) chiama il backend (weather.php) con fetch.
Il backend PHP verifica la città, chiama Open-Meteo, filtra e ordina le temperature.
Il backend restituisce un JSON al frontend.
Il frontend mostra le temperature in una tabella.
Se ci sono errori (città non valida, problema API), viene mostrato un messaggio chiaro.

STRUTTURA
meteo-app/
│
├─ index.html      ← Interfaccia utente
├─ weather.php     ← Backend PHP che chiama l’API
└─ (opzionale) DB  ← MySQL per salvare storico temperature

Istruzioni per l’uso
Installa XAMPP o MAMP e avvia Apache.
Metti index.html e weather.php nella cartella htdocs/meteo-app.
Apri il browser e vai su:
http://localhost/meteo-app/index.html
Inserisci una città supportata e clicca “Cerca”.
La tabella si popolerà con le temperature ordinate.
