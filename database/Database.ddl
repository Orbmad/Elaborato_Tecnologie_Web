CREATE DATABASE IF NOT EXISTS Plantatio;
USE Plantatio;

-- Tabella utenti
CREATE TABLE Utenti (
    id_utente INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    cognome VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    data_registrazione TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    admin BOOLEAN NOT NULL
);

-- Tabella indirizzi
CREATE TABLE Indirizzi (
    id_indirizzo INT AUTO_INCREMENT PRIMARY KEY,
    id_utente INT NOT NULL,
    via VARCHAR(255) NOT NULL,
    citta VARCHAR(100) NOT NULL,
    provincia VARCHAR(100) NOT NULL,
    cap VARCHAR(10) NOT NULL,
    nazione VARCHAR(100) NOT NULL,
    FOREIGN KEY (id_utente) REFERENCES Utenti(id_utente) ON DELETE CASCADE
);

-- Tabella metodi di pagamento
CREATE TABLE MetodiPagamento (
    id_metodo INT AUTO_INCREMENT PRIMARY KEY,
    id_utente INT NOT NULL,
    tipo_metodo VARCHAR(50) NOT NULL, -- es. "Carta di credito", "PayPal"
    dettagli_metodo VARCHAR(255) NOT NULL, -- es. numero carta
    FOREIGN KEY (id_utente) REFERENCES Utenti(id_utente) ON DELETE CASCADE
);

-- Tabella categorie
CREATE TABLE Categorie (
    id_categoria INT AUTO_INCREMENT PRIMARY KEY,
    nome_categoria VARCHAR(100) UNIQUE NOT NULL,
    descrizione TEXT
);

-- Tabella sottocategorie
CREATE TABLE SottoCategorie (
    id_sottocategoria INT AUTO_INCREMENT PRIMARY KEY,
    id_categoria INT NOT NULL,
    nome_sottocategoria VARCHAR(100) UNIQUE NOT NULL,
    FOREIGN KEY (id_categoria) REFERENCES Categorie(id_categoria) ON DELETE CASCADE
);

-- Tabella prodotti
CREATE TABLE Prodotti (
    id_prodotto INT AUTO_INCREMENT PRIMARY KEY,
    nome_prodotto VARCHAR(150) NOT NULL,
    descrizione TEXT,
    prezzo DECIMAL(10, 2) NOT NULL,
    id_sottocategoria INT NOT NULL,
    stock INT NOT NULL,
    FOREIGN KEY (id_sottocategoria) REFERENCES SottoCategorie(id_sottocategoria)
);

-- Tabella carrello
CREATE TABLE Carrello (
    id_carrello INT AUTO_INCREMENT PRIMARY KEY,
    id_utente INT NOT NULL,
    id_prodotto INT NOT NULL,
    quantita INT NOT NULL,
    FOREIGN KEY (id_utente) REFERENCES Utenti(id_utente) ON DELETE CASCADE,
    FOREIGN KEY (id_prodotto) REFERENCES Prodotti(id_prodotto) ON DELETE CASCADE
);

--Tabella gruppi di prodotti
CREATE TABLE Gruppi (
    id_gruppo INT AUTO_INCREMENT PRIMARY KEY,
    nomeGruppo VARCHAR(50) NOT NULL,
    descrizioneGruppo TEXT,
)

--Tabella appartenenza gruppo
CREATE TABLE Appartenenze (
    id_gruppo INT NOT NULL,
    id_prodotto INT NOT NULL,
    PRIMARY KEY (id_gruppo, id_prodotto),
    FOREIGN KEY (id_gruppo) REFERENCES Gruppi(id_gruppo) ON DELETE CASCADE,
    FOREIGN KEY (id_prodotto) REFERENCES Prodotti(id_prodotto) ON DELETE CASCADE
)


-- Tabella ordini
CREATE TABLE Ordini (
    id_ordine INT AUTO_INCREMENT PRIMARY KEY,
    id_utente INT NOT NULL,
    data_ordine TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    totale DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (id_utente) REFERENCES Utenti(id_utente) ON DELETE CASCADE
);

-- Tabella dettagli ordini
CREATE TABLE DettagliOrdini (
    id_dettaglio INT AUTO_INCREMENT PRIMARY KEY,
    id_ordine INT NOT NULL,
    id_prodotto INT NOT NULL,
    quantita INT NOT NULL,
    prezzo_unitario DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (id_ordine) REFERENCES Ordini(id_ordine) ON DELETE CASCADE,
    FOREIGN KEY (id_prodotto) REFERENCES Prodotti(id_prodotto)
);

-- Tabella notifiche
CREATE TABLE Notifiche (
    id_notifica INT AUTO_INCREMENT PRIMARY KEY,
    id_utente INT NOT NULL,
    messaggio TEXT NOT NULL,
    letto BOOLEAN DEFAULT FALSE,
    data_notifica TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_utente) REFERENCES Utenti(id_utente) ON DELETE CASCADE
);

-- Tabella recensioni
CREATE TABLE Recensioni (
    id_recensione INT AUTO_INCREMENT PRIMARY KEY,
    id_utente INT NOT NULL,
    id_prodotto INT NOT NULL,
    voto INT CHECK (voto BETWEEN 1 AND 5), -- voto da 1 a 5
    commento TEXT,
    data_recensione TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_utente) REFERENCES Utenti(id_utente) ON DELETE CASCADE,
    FOREIGN KEY (id_prodotto) REFERENCES Prodotti(id_prodotto) ON DELETE CASCADE
);
