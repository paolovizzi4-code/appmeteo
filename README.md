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
