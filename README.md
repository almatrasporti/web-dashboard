# Almatrasporti Web Dashboard 

La dashboard di Almatrasporti è una _Proof of Concept_ di un applicativo web che realizza le seguenti funzioni:

- **Visualizzazione _real time_ dei dati trasmessi dai veicoli** e successivamente elaborati dai microservizi. 
  Tale visualizzazione è realizzata mediante la rappresentazione su mappa dei percorsi tracciati dai veicoli della 
  flotta durante il loro tragitto.
- **Invocazione del servizio di predizione** basato su modello di Intelligenza Artificiale  
- **Controllo dello stato di attività dei servizi/moduli** del sistema Almatrasporti, permettendone inoltre la 
  attivazione/disattivazione mediante interfaccia grafica.
  

## Tecnologie utilizzate

L'applicativo è realizzato in due parti:

- Modulo Backend
- Modulo Frontend

### Modulo backend
Il modulo di backend è scritto in linguaggio PHP mediante framework **Laravel**, e implementa le seguenti API REST:

- `GET /data`: recupero da db Redis dei dati dei veicoli e delle relative posizioni, esportati in formato Json.
- `DELETE /data`: Cancella tutti i dati da Redis/MongoDB.
  

- `GET /status`: recupero stato dei servizi (Kafka, Zookeeper, Microservizi Injector/ETL_[1-3], MongoDB, Redis)
- `POST /service`: Attiva un servizio
- `DELETE /service`: Disattiva un servizio

### Modulo frontend
Il modulo di frontend è scritto in HTML/JavaScript e sfrutta il progressive framework **Vue** per realizzare componenti 
reattivi. Di seguito si riportano i componenti principali:

- **Mappa percorsi**: mappa che mostra in tempo reale la posizione di tutti i veicoli ed il percorso di un veicolo 
  selezionato.
- **Elenco posizioni**: tabella che mostra il numero di posizioni presenti sul DB Redis.
- **Dashboard servizi**: widgets che mostrano lo stato dei servizi sul server. permettendone l'attivazione/disattivazione
- **Predizione consumi**: form per l'inserimento dati finalizzato alla predizione dei consumi.
