--------------------------CREAZIONE UTENTI--------------------------------
-- Inserimento utenti
INSERT INTO
    Utenti (nome, cognome, email, password_hash, admin)
VALUES
    (
        'Mario',
        'Rossi',
        'mario.rossi@example.com',
        SHA2('password123', 256),
        FALSE
    ),
    (
        'Luca',
        'Bianchi',
        'luca.bianchi@example.com',
        SHA2('securepass456', 256),
        FALSE
    ),
    (
        'Admin',
        'Admin',
        'venditore@example.com',
        SHA2('admin', 256),
        TRUE
    ),
    (
        'Giulia',
        'Neri',
        'giulia.neri@example.com',
        SHA2('pass321', 256),
        FALSE
    );

-- Inserimento indirizzi
INSERT INTO
    Indirizzi (id_utente, via, citta, provincia, cap, nazione)
VALUES
    (
        1,
        'Via Roma 10',
        'Milano',
        'MI',
        '20100',
        'Italia'
    ),
    (
        2,
        'Corso Venezia 5',
        'Torino',
        'TO',
        '10121',
        'Italia'
    ),
    (
        2,
        'Piazza Navona 20',
        'Roma',
        'RM',
        '00186',
        'Italia'
    ),
    (
        4,
        'Via Toledo 15',
        'Napoli',
        'NA',
        '80100',
        'Italia'
    );

-- Inserimento metodi di pagamento
INSERT INTO
    MetodiPagamento (id_utente, tipo_metodo, dettagli_metodo)
VALUES
    (1, 'Carta di credito', '4111111111111111'),
    (2, 'PayPal', 'luca.bianchi@paypal.com'),
    (2, 'Carta di credito', '5500000000000004'),
    (4, 'Paypal', 'giulia.neri@example.com');

---------------------CREAZIONE NEGOZIO------------------------------------
--Inserimento Categorie
INSERT INTO
    Categorie (nome_categoria)
VALUES
    ('Piante da esterno'),
    --ID = 1
    ('Piante da interno'),
    --ID = 2
    ('Piante da orto, frutteto e cucina'),
    --ID = 3
    ('Bulbi e sementi'),
    --ID = 4
    ('Vasi e arredo');
    --ID = 5

--Inserimento sottocategorie
INSERT INTO
    SottoCategorie (id_categoria, nome_sottocategoria)
VALUES
    (1, 'Alberi e cespugli'), --ID_sc = 1,
    (1, 'Piante perenni e Graminacee'), --ID_sc = 2,
    (1, 'Piante acquatiche'), --ID_sc = 3,
    (1, 'Fiori annuali'); --ID_sc = 4;

INSERT INTO
    SottoCategorie (id_categoria, nome_sottocategoria)
VALUES
    (3, 'Piante da frutto'), --ID_sc = 5,
    (3, 'Piante da orto'), --ID_sc = 6,
    (3, 'Piante aromatiche'); --ID_sc = 7;

INSERT INTO
    SottoCategorie (id_categoria, nome_sottocategoria)
VALUES
    (4, 'Sementi'), --ID_sc = 8,
    (4, 'Bulbi'); --ID_sc = 9;

INSERT INTO
    SottoCategorie (id_categoria, nome_sottocategoria)
VALUES
    (5, 'Vasi e fioriere'), --ID_sc = 10,
    (5, 'Supporti di coltivazione'), --ID_sc = 11,
    (5, 'Arredo giardino'); --ID_sc = 12;

INSERT INTO
    SottoCategorie (id_categoria, nome_sottocategoria)
VALUES
    (2, 'Piante Pet Friendly'), --ID_sc = 13,
    (2, 'Piante non Pet Friendly'); --ID_sc = 14;


--Inserimento prodotti

INSERT INTO --Piante da interno pet friendly
    Prodotti (
        id_sottocategoria,
        nome_prodotto,
        prezzo,
        stock,
        nome_volgare,
        nome_scientifico,
        famiglia,
        genere,
        specie,
        dimensioni,
        profumo,
        tipologia_foglia,
        colore_foglia,
        descrizione
    )
VALUES
    (13, 'Adiantum hispidulum', 8.80, 30, 'Felce capelvenere ruvida', '', 'Pteridaceae', 'Adiantum', 'A. hispidulum', '12 x 12 x 20 cm', 'Non profumata', 'Semipersistente', 'Bronzo, Rosa, Verde', "La pianta di Adiantum hispidulum è una felce d’appartamento proveniente dalle zone tropicali dell’Africa, Australia, Polinesia, Malesia, Nuova Zelanda ed altre isole del Pacifico. Una felce sempreverde dalle fronde striscianti rosa, poi verde scuro bronzato, gli steli sono neri e lucidi. Predilige la luce moderata ma diffusa, schermata nei mesi/ore di forte insolazione. In primavera-estate è da annaffiare abbondantemente e tenere alta l’umidità ambientale vaporizzando le sue fronde. Per pulire le sue foglie usare solamente un panno umido."),
    (13, 'Beaucarnea recurvata', 30.90, 16, 'Pianta mangiauomo', 'Nolina recurvata', 'Asparagaceae', 'Beaucarnea', 'B. Recurvata', '14 x 14 x 40 cm', 'Non profumata', 'Sempreverde', 'Verde', "La pianta di Beaucarnea recurvata è una pianta perenne sempreverde coltivata come pianta d’appartamento, straordinaria e molto decorativa, apprezzata per la sua estetica unica e la facilità di coltivazione. È originaria del Messico, dove cresce in ambienti semi-aridi, immagazzinando l’acqua nel suo caratteristico tronco rigonfio (da qui il nome “pianta piede d’elefante”). Questo adattamento la rende estremamente resistente alla siccità e ideale per chi desidera una pianta bella ma poco esigente. Il suo aspetto è immediatamente riconoscibile: il tronco, spesso e bulboso alla base, funge da serbatoio d’acqua e si slancia verso l’alto con ciuffi di foglie sottili e arcuate, che ricadono elegantemente come una cascata verde, lunghe fino ad 1 metro. Raramente sviluppa pannocchie di piccoli fiori bianchi in estate. La Beaucarnea recurvata, nota anche come “pianta mangiafumo”, riceve questo nome popolare principalmente grazie alla sua capacità di purificare l’aria. Si crede che questa pianta possa assorbire e neutralizzare le sostanze nocive presenti nell’ambiente, inclusi i composti volatili che derivano dal fumo di sigaretta, rendendo l’aria più pulita. La sua resistenza e capacità di adattarsi a condizioni difficili contribuiscono ulteriormente alla sua fama come “mangiafumo”, anche se è più un nome simbolico che scientifico. Non esiste una prova diretta che questa pianta elimini il fumo in maniera effettiva, ma è apprezzata come purificatrice naturale dell’aria. Questa pianta predilige una posizione luminosa.");

--Inserimento gruppi---
INSERT INTO Gruppi (nomeGruppo, descrizioneGruppo)
VALUES
('Cactus Lovers', 'Un gruppo dedicato agli amanti dei cactus e delle piante grasse. Condividiamo consigli su cura, propagazione e specie rare.'),
('Orchidee Passione', 'Per chi è appassionato di orchidee! Qui discutiamo di varietà, fertilizzazione e tecniche di coltivazione per fiori spettacolari.'),
('Erbe Aromatiche', 'Unisciti a noi per scoprire il magico mondo delle erbe aromatiche, dalla coltivazione alla loro trasformazione in cucina.'),
('Foresta Urbana', 'Amanti delle piante da interno? Questo è il posto giusto per esplorare come creare una foresta urbana nella propria casa.'),
('Piante Acquatiche', 'Uno spazio per gli appassionati di piante acquatiche. Condividiamo informazioni su acquari, stagni e sistemi idroponici.');