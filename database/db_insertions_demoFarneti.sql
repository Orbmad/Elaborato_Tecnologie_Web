INSERT INTO
    Categorie (nome_categoria)
VALUES
    ('Piante da esterno'),
    -- ID = 1
    ('Piante da interno'),
    -- ID = 2
    ('Piante da cucina'),
    -- ID = 3
    ('Bulbi e sementi'),
    -- ID = 4
    ('Vasi e arredo');
    -- ID = 5

-- Inserimento sottocategorie
INSERT INTO
    SottoCategorie (id_categoria, nome_sottocategoria)
VALUES
    ('Piante da esterno', 'Alberi e cespugli'), -- ID_sc = 1,
    ('Piante da esterno', 'Piante perenni e Graminacee'), -- ID_sc = 2,
    ('Piante da esterno', 'Piante acquatiche'), -- ID_sc = 3,
    ('Piante da esterno', 'Fiori annuali'); -- ID_sc = 4;

INSERT INTO
    SottoCategorie (id_categoria, nome_sottocategoria)
VALUES
    ('Piante da cucina', 'Piante da frutto'), -- ID_sc = 5,
    ('Piante da cucina', 'Piante da orto'), -- ID_sc = 6,
    ('Piante da cucina', 'Piante aromatiche'); -- ID_sc = 7;

INSERT INTO
    SottoCategorie (id_categoria, nome_sottocategoria)
VALUES
    ('Bulbi e sementi', 'Sementi'), -- ID_sc = 8,
    ('Bulbi e sementi', 'Bulbi'); -- ID_sc = 9;

INSERT INTO
    SottoCategorie (id_categoria, nome_sottocategoria)
VALUES
    ('Vasi e arredo', 'Vasi e fioriere'), -- ID_sc = 10,
    ('Vasi e arredo', 'Supporti di coltivazione'), -- ID_sc = 11,
    ('Vasi e arredo', 'Arredo giardino'); -- ID_sc = 12;

INSERT INTO
    SottoCategorie (id_categoria, nome_sottocategoria)
VALUES
    ('Piante da interno', 'Piante Pet Friendly'), -- ID_sc = 13,
    ('Piante da interno', 'Piante non Pet Friendly'); -- ID_sc = 14;


-- Inserimento prodotti

INSERT INTO -- Piante da interno pet friendly
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
    ('Piante Pet Friendly', 'Adiantum hispidulum', 8.80, 30, 'Felce capelvenere ruvida', '', 'Pteridaceae', 'Adiantum', 'A. hispidulum', '12 x 12 x 20 cm', 'Non profumata', 'Semipersistente', 'Bronzo, Rosa, Verde', "La pianta di Adiantum hispidulum è una felce d’appartamento proveniente dalle zone tropicali dell’Africa, Australia, Polinesia, Malesia, Nuova Zelanda ed altre isole del Pacifico. Una felce sempreverde dalle fronde striscianti rosa, poi verde scuro bronzato, gli steli sono neri e lucidi. Predilige la luce moderata ma diffusa, schermata nei mesi/ore di forte insolazione. In primavera-estate è da annaffiare abbondantemente e tenere alta l’umidità ambientale vaporizzando le sue fronde. Per pulire le sue foglie usare solamente un panno umido."),
    ('Piante Pet Friendly', 'Beaucarnea recurvata', 30.90, 16, 'Pianta mangiauomo', 'Nolina recurvata', 'Asparagaceae', 'Beaucarnea', 'B. Recurvata', '14 x 14 x 40 cm', 'Non profumata', 'Sempreverde', 'Verde', "La pianta di Beaucarnea recurvata è una pianta perenne sempreverde coltivata come pianta d’appartamento, straordinaria e molto decorativa, apprezzata per la sua estetica unica e la facilità di coltivazione. È originaria del Messico, dove cresce in ambienti semi-aridi, immagazzinando l’acqua nel suo caratteristico tronco rigonfio (da qui il nome “pianta piede d’elefante”). Questo adattamento la rende estremamente resistente alla siccità e ideale per chi desidera una pianta bella ma poco esigente. Il suo aspetto è immediatamente riconoscibile: il tronco, spesso e bulboso alla base, funge da serbatoio d’acqua e si slancia verso l’alto con ciuffi di foglie sottili e arcuate, che ricadono elegantemente come una cascata verde, lunghe fino ad 1 metro. Raramente sviluppa pannocchie di piccoli fiori bianchi in estate. La Beaucarnea recurvata, nota anche come “pianta mangiafumo”, riceve questo nome popolare principalmente grazie alla sua capacità di purificare l’aria. Si crede che questa pianta possa assorbire e neutralizzare le sostanze nocive presenti nell’ambiente, inclusi i composti volatili che derivano dal fumo di sigaretta, rendendo l’aria più pulita. La sua resistenza e capacità di adattarsi a condizioni difficili contribuiscono ulteriormente alla sua fama come “mangiafumo”, anche se è più un nome simbolico che scientifico. Non esiste una prova diretta che questa pianta elimini il fumo in maniera effettiva, ma è apprezzata come purificatrice naturale dell’aria. Questa pianta predilige una posizione luminosa."),
    ('Piante acquatiche', 'Iris pseudacorus', 9.40 ,6, 'Giaggiolo acquatico', 'Iris pseudacorus', 'Iridaceae', 'Iris', 'I. pseudacorus', '20 x 20 x 150 cm', 'Non profumata', 'Fiore', 'Giallo', 'È una pianta erbacea perenne, alta 1-1,5 m (o raramente 2 m), con foglie erette lunghe fino a 90 cm e larghe 3 cm. I fiori, raccolti in un infiorescenza che termina con un fiore apicale, sono di un giallo brillante, con la tipica forma da Iris ma con lacinie esterne non barbate. Il frutto è una capsula lunga 4–7 cm, contenente semi marrone chiaro.'),
    ('Alberi e cespugli', 'Ginkgo biloba', 31.70 ,2, 'ALbero dei 40 scudi', 'Ginkgo biloba', 'Ginkgoaceae', 'Ginkgo', '	G. biloba', '120-140 cm', 'Non profumata', 'Caducifoglia', 'Verde', 'Ginkgo biloba L., 1771 è una pianta gimnosperma, unica specie ancora sopravvissuta della famiglia Ginkgoaceae, dell intero ordine Ginkgoales Engler, 1898 e della divisione delle Ginkgophyta. È un albero antichissimo le cui origini risalgono a 250 milioni di anni fa nel Permiano e per questo è considerato un fossile vivente. È una specie relitta, deve la sua resilienza all elevata resistenza alla siccità e al freddo (−34 °C) e all’inquinamento atmosferico. Il Ginkgo biloba è il simbolo della città di Tokyo.'),
    ('Piante perenni e Graminacee', 'Dicksonia antarctica', 25.30 ,6, 'Felce arborea morbida', 'Dicksonia antarctica', 'Dicksoniaceae', 'Dicksonia', 'D. antarctica', 'Ø24cm: 60 – 80 cm', 'Non profumata', 'Sempreverde', 'Verde', 'Può raggiungere i 15 metri di altezza, il tronco consiste di un rizoma eretto con fitta peluria alla base. Le fronde possono estendersi per un diametro di 2-8 metri. La riproduzione avviene principalmente tramite spore però anche polloni basali. La crescita è tra i 3,5 e i 5 cm all anno e la produzione di spore inizia intorno ai 20 anni'),
    ('Sementi', 'Asparago argenteuil (Semi)', 1.90 , 200, 'non specificato', 'non specificato', 'non specificato', 'non specificato', 'non specificato', 'non specificato', 'non specificato', 'non specificato', 'non specificato', 'Varietà molto apprezzata per i turioni di colore verde-rosato, teneri gustosi e saporiti . Tenere i semi in acqua tiepida per 2 giorni prima di seminare a 1/2 cm di profondità; trapiantare le zampe anno successivo.'),
    ('Bulbi', 'Freesia Single Pink', 9.40 ,6, 'non specificato', 'non specificato', 'non specificato', 'non specificato', 'non specificato', 'non specificato', 'Profumata', 'Fiore', 'Viola', '(10 bulbi) Stupende, colorate e facili da coltivare'),
    ('Piante aromatiche', 'Maggiorana', 6.90 ,30, 'Maggiorana', 'Origanum majorana', 'Lamiaceae', 'Origanum', 'O. majorana', '10 x 10 x 30 cm', 'Profumata', 'Semipersistente', 'Argento, Grigio, Verde', 'La pianta aromatica di Maggiorana (Origanum majorana) è una officinale erbacea perenne originaria dell’Europa sudoccidentale e della Turchia. Sviluppa steli ramificati, con foglie verde-grigio, ovate o ellittiche, con soffice peluria, lunghe 0,3-3 cm. Genera pannocchie di fiori bianchi, tubulari, lunghi 8 mm, con brattee verde-grigio, lunghe fino a 4 mm, che sbocciano dall’inizio a fine estate. La Maggiorana ha un aroma simile a quello dell’Origano ma molto più dolce. In cucina è utilizzata cruda o quasi al termine della cottura, per insaporire carni in umido, pesce, pizza, verdure stufate e minestre, funghi, legumi e lenticchie. Le foglie vengono raccolte in ogni periodo dell’anno per essere essiccate, congelate o poste a macerare in olio e aceto. Molto spesso è usata al posto dell’Oigano o assieme ad esso. Da utilizzare con parsimonia dato il suo intenso sapore dolce. Le infiorescenze molto aromatiche, possono essere usate su zuppe, stufati e frittate. Le piante erbacee perenni vivono tutto l’anno e sopportano le temperature più rigide. Possono incorrere in una fase di riposo vegetativo durante la stagione avversa, riprendono poi la fase di vegetazione quando le condizioni torneranno favorevoli.'),
    ('Piante da frutto', 'Goji rosso', 31.70 ,30, 'Bacche di Goji','Lycium barbarum' ,'Solanaceae', 'Lycium', 'L. barbarum', '60 - 80 cm', 'Non profumata', 'Caducifoglia', 'Verde', 'Pianta perenne sempreverde, che cresce in forma arbustiva e produce fiori color lavanda da Giugno a Settembre, che poi si trasformano in piccole bacche rosse dal gusto zuccherino o amarognolo, a seconda della varietà. La maturazione dei frutti avviene alla fine dell’estate (circa da Luglio ad Ottobre). Le bacche possono essere consumate fresche o essiccate, per averle a disposizione oltre il periodo di maturazione. La pianta può raggiungere 3 metri di altezza e può essere coltivata in giardino lungo siepi o prati o anche su terrazzi in vasi e fioriere, con una buona esposizione al sole. Necessita di un terreno soffice e ben drenato, va irrigata abbastanza frequentemente durante l’estate e in periodi caldi. Per uno sviluppo rigoglioso della pianta, concimare periodicamente con fertilizzanti organici. Non soffre il gelo, però è consigliabile riparare le piante piccole dal freddo eccessivo dell’inverno.'),
    ('Piante da orto', 'Smallanthus sonchifolius', 24.10 ,6, 'Patata dei diabetici', 'Polymnia sonchifolia', 'Asteraceae', 'Smallanthus', 'S. sonchifolius', 'Ø 15 cm', 'Non profumata', 'Caducifoglia', 'Verde', 'La pianta di Smallanthus sonchifolius (Yacón) è una erbacea perenne di origini antichissime, che appartiene alla famiglia delle Asteraceae e proviene dalle regioni andine dell’America Latina. All’inizio dell’estate sviluppa grandi fiori di colore giallo ocra, su grandi foglie di colore verde chiaro. Può raggiungere l’altezza di circa 100-150 cm. Genera grosse radici tuberizzate commestibili, dal sapore dolciastro e dall’alto contenuto di acqua.'),
    ('Piante non Pet Friendly', 'Codonanthe crassifolia', 34.20 ,6, 'non specificato', 'Codonanthe crassifolia', 'Gesneriaceae', 'Codonanthe', ' C. crassifolia', '10 - 20 cm', 'Non profumata', 'Sempreverde', 'Verde', 'La pianta di Codonanthe crassifolia è una pianta d’appartamento che appartiene alla famiglia delle Gesneriaceae e che genera fusti prostrati e radicanti nei nodi, oppure penduli. Sviluppa foglie da ellittiche a ovate, cerose, di colore verde da medio a cupo, lunghe 5 cm o più, con ghiandole rosse sulla pagina inferiore. Dalla primavera all’estate produce cime ascellari di 1-4 fiori bianchi, lunghi 2-2,5 cm, con gola gialla. Predilige un’esposizione luminosa, schermata nei mesi/ore di forte insolazione. '),
    ('Vasi e fioriere', 'Vaso VIBES FOLD COUPE', 10.80 ,6, 'non specificato', 'non specificato', 'non specificato', 'non specificato', 'non specificato', 'Ø 14', 'non specificato', 'non specificato', 'non specificato', 'Adatto per interni dal moderno motivo decorativo si inserisce perfettamente negli ambienti accoglienti, alla moda e simpatici. Vibes Fold Coupe è una nuova famiglia di vasi per interni, che aumentano le vibrazioni positive di un ambiente accogliente, armonioso, alla moda e simpatico. Ha forma rotonda e organica e i suoi colori tenui e il motivo decorativo mettono in massima evidenza la bellezza delle tue piante d’appartamento. Prodotto con plastica riciclata, prodotto grazie alla nostra turbina eolica, 100% riciclabile. Disponibile in diversi colori di tendenza. Non scolorisce, è facile da pulire e a prova d’urto.');



-- Inserimento gruppi --
INSERT INTO Gruppi (nomeGruppo, descrizioneGruppo)
VALUES
('Foresta Urbana', 'Amanti delle piante da interno? Questo è il posto giusto per esplorare come creare una foresta urbana nella propria casa.'),
('Piante Acquatiche', 'Esplora il mondo delle piante acquatiche, ideali per acquari, laghetti e giardini d’acqua. Scopri quali specie scegliere e come prendersene cura.'),
('Piante da Cucina', 'Scopri le piante utili in cucina: erbe aromatiche, piante officinali e ortaggi per coltivare sapore e salute direttamente a casa tua.'),
('Decorazioni', 'Idee per utilizzare vasi e piante come elementi decorativi per arricchire l’estetica degli interni ed esterni della tua casa.'),
('Fiori Ornamentali', 'Una guida sui fiori ornamentali più belli e profumati per il giardino e gli spazi interni, con suggerimenti su cura e design.');

-- Inserimento utenti --
INSERT INTO Utenti (email, nome, cognome, password_hash, admin_flag)
VALUES
('mariorossi@gmail.com', 'Mario', 'Rossi', SHA2('Mar1oRoss!', 256), 0),
('giannimorandi@libero.it', 'Gianni', 'Morandi', SHA2('Gianni', 256), 0),
('admin', 'admin', 'admin', SHA2('admin', 256), 1),
('michele.farneti23@gmail.com', 'Michele', 'Farneti', SHA2('1', 256), 0),
('gino.pino@gmail.com', 'Gino', 'Pino', SHA2('1', 256), 0);

INSERT INTO Carrello (id_utente,id_prodotto,quantita) 
VALUES 
('michele.farneti23@gmail.com','Adiantum hispidulum',2), 
('michele.farneti23@gmail.com','Beaucarnea recurvata',2);

-- inserimento delle recensioni --
INSERT INTO Recensioni (id_utente, id_prodotto, voto, commento, data_recensione)
VALUES
('mariorossi@gmail.com', 'Adiantum hispidulum', 4, 'Sono molto soddisfatto della pianta che ho acquistato. È stata imballata bene ed è arrivata intatta e, nonostante il riposo vegetativo, si vedeva che era in salute. Azienda seria e disponibile, mi è arrivata una piccola pianta in regalo che ho gradito molto. Grazie!', '2024-01-06'),
('giannimorandi@libero.it', 'Adiantum hispidulum', 5, 'Devo dire che mi sono trovato molto bene come mia prima esperienza. Conservervati e confezionati in modo eccellente grazie', '2024-08-26');


-- insermento delle notifiche --
INSERT INTO Notifiche (id_utente, data_notifica, messaggio)
VALUES
('gino.pino@gmail.com', '2025-01-11', 'Il pacco è in consegna, ci scusiamo per il ritardo'),
('gino.pino@gmail.com', '2025-01-11', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.');

-- insermento appartenenze ai gruppi --
INSERT INTO Appartenenze (id_gruppo, id_prodotto)
VALUES
('Foresta Urbana','Adiantum hispidulum'),
('Foresta Urbana','Vaso VIBES FOLD COUPE'),
('Foresta Urbana','Beaucarnea recurvata'),
('Piante da Cucina','Maggiorana'),
('Piante da Cucina','Goji rosso'),
('Piante da Cucina','Smallanthus sonchifolius'),
('Decorazioni','Vaso VIBES FOLD COUPE'),
('Fiori Ornamentali','Adiantum hispidulum'),
('Fiori Ornamentali','Goji rosso'),
('Piante Acquatiche','Iris pseudacorus');