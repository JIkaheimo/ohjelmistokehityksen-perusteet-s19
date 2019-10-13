/* 
== VAIKEUSTASOJEN LISÄÄMINEN == 
Jokaisella vaikeustasolla tulee olla uniikki nimi.
(periaatteessa olisi voinut käyttää tätäkin primary keyna...)
*/
DELETE FROM Vaikeustasot;

INSERT INTO 
	Vaikeustasot (vaikeustasoId, nimi) 
VALUES 
	(1, 'aloittelija'), 
    (2, 'helppo'), 
    (3, 'keskivaikea'), 
    (4, 'vaikea'), 
    (5, 'extreme');

/*
== KÄYTTÄJIEN LISÄÄMINEN ==
Jokaisella käyttäjällä tulee olla uniikki käyttäjätunnus.
(tämä toimii myös primary keyna)

Käyttäjien luomiseksi tarvitaan vain kayttajatunnus ja salasanaHash.

*/
DELETE FROM Kayttajat;

INSERT INTO 
	Kayttajat (kayttajatunnus, salasanaHash, etunimi, sukunimi, kuvaus)
VALUES
	('Aku Ankka', 'AnkkaAku', 'Aku', 'Ankka', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc a mauris non felis molestie varius. Aliquam at pulvinar ipsum. Suspendisse rhoncus diam in lectus dictum facilisis. Phasellus nisl nulla, condimentum sit amet congue at, vulputate at tortor. Praesent id hendrerit libero, id dictum est. Phasellus vitae ornare ex, quis volutpat tortor. Praesent odio nisi, pharetra vel euismod et, pulvinar at nunc. Quisque feugiat, ligula sollicitudin aliquet hendrerit, odio dui congue mauris, vitae malesuada leo nisi sit amet nisi. Etiam porta purus sed nibh aliquam interdum. Mauris tristique imperdiet bibendum. Ut id purus sit amet libero rutrum vulputate. '),
	('Hessu Hopo', 'HessuHopo', 'Hessu', 'Hopo', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc a mauris non felis molestie varius. Aliquam at pulvinar ipsum. Suspendisse rhoncus diam in lectus dictum facilisis. Phasellus nisl nulla, condimentum sit amet congue at, vulputate at tortor. Praesent id hendrerit libero, id dictum est. Phasellus vitae ornare ex, quis volutpat tortor. Praesent odio nisi, pharetra vel euismod et, pulvinar at nunc. Quisque feugiat, ligula sollicitudin aliquet hendrerit, odio dui congue mauris, vitae malesuada leo nisi sit amet nisi. Etiam porta purus sed nibh aliquam interdum. Mauris tristique imperdiet bibendum. Ut id purus sit amet libero rutrum vulputate. '),
	('Roope Ankka', 'AnkkaRoope', 'Roope', 'Ankka', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc a mauris non felis molestie varius. Aliquam at pulvinar ipsum. Suspendisse rhoncus diam in lectus dictum facilisis. Phasellus nisl nulla, condimentum sit amet congue at, vulputate at tortor. Praesent id hendrerit libero, id dictum est. Phasellus vitae ornare ex, quis volutpat tortor. Praesent odio nisi, pharetra vel euismod et, pulvinar at nunc. Quisque feugiat, ligula sollicitudin aliquet hendrerit, odio dui congue mauris, vitae malesuada leo nisi sit amet nisi. Etiam porta purus sed nibh aliquam interdum. Mauris tristique imperdiet bibendum. Ut id purus sit amet libero rutrum vulputate. '),
	('Tupuhupulupu', 'LupuHupuTupu', 'Tupu', 'Ankka', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc a mauris non felis molestie varius. Aliquam at pulvinar ipsum. Suspendisse rhoncus diam in lectus dictum facilisis. Phasellus nisl nulla, condimentum sit amet congue at, vulputate at tortor. Praesent id hendrerit libero, id dictum est. Phasellus vitae ornare ex, quis volutpat tortor. Praesent odio nisi, pharetra vel euismod et, pulvinar at nunc. Quisque feugiat, ligula sollicitudin aliquet hendrerit, odio dui congue mauris, vitae malesuada leo nisi sit amet nisi. Etiam porta purus sed nibh aliquam interdum. Mauris tristique imperdiet bibendum. Ut id purus sit amet libero rutrum vulputate. ');
    
/*
== OHJELMIEN LISÄÄMINEN ==
*/
DELETE FROM Ohjelmat;

INSERT INTO
	Ohjelmat (ohjelmaId, kayttajatunnus, nimi, luotu, vaikeustasoId, kuva)
VALUES 
	(1, 'Aku Ankka', 'Ankkojen kuntosaliohjelma kaikille', NOW(), 1, default),
    (2, 'Aku Ankka', 'Joka-ankan juoksuohjelma', NOW(), 2, default),
    (3, 'Roope Ankka', 'Rahakylpy rikkaille', NOW(), 5, default),
    (4, 'Roope Ankka', 'Pappa-ankan pesäpallotreeni', NOW(), 3, default),
    (5, 'Hessu Hopo', 'Hoopoilua harjoitteleville', NOW(), 2, default),
    (6, 'Hessu Hopo', 'Hessun kuntopiiri', NOW(), 4, default);
    
/*
== HARJOITUSTEN LISÄÄMINEN ==
*/
DELETE FROM Harjoitukset;

INSERT INTO
	Harjoitukset (harjoitusId, ohjelmaId, nimi)
VALUES
	(1, 1, 'Siipi- ja räpyläpäivä'),
    (2, 1, 'Pyrstöpäivä'),
    (3, 1, 'Lepopäivä'),
    (4, 2, 'Kestojuoksu'),
    (5, 2, 'Pikajuoksu'),
    (6, 4, 'Pesäjuoksun harjoittelu'),
    (7, 4, 'Lyöntiharjoituksia'),
    (8, 4, 'Koppaamisen perusteet'),
    (9, 5, 'Kaupungilla hoopoilu'),
    (10, 6, 'Kalastusta Ankkajoella');
    
/*
== VAIHEIDEN LISÄÄMINEN ==
*/
DELETE FROM Vaiheet;

INSERT INTO
	Vaiheet (vaiheId, harjoitusId, nimi, ohjelinkki, kuvaus)
VALUES
	(1, 1, 'Duis eu diam ligula', 'www.google.fi', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc a mauris non felis molestie varius. Aliquam at pulvinar ipsum. Suspendisse rhoncus diam in lectus dictum facilisis.'),
    (2, 1, 'Duis eu diam ligula', 'www.google.fi', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc a mauris non felis molestie varius. Aliquam at pulvinar ipsum. Suspendisse rhoncus diam in lectus dictum facilisis.'),
	(3, 1, 'Duis eu diam ligula', 'www.google.fi', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc a mauris non felis molestie varius. Aliquam at pulvinar ipsum. Suspendisse rhoncus diam in lectus dictum facilisis.'),
    (4, 2, 'Duis eu diam ligula', 'www.google.fi', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc a mauris non felis molestie varius. Aliquam at pulvinar ipsum. Suspendisse rhoncus diam in lectus dictum facilisis.'),
    (5, 2, 'Duis eu diam ligula', 'www.google.fi', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc a mauris non felis molestie varius. Aliquam at pulvinar ipsum. Suspendisse rhoncus diam in lectus dictum facilisis.'),
	(6, 2, 'Duis eu diam ligula', 'www.google.fi', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc a mauris non felis molestie varius. Aliquam at pulvinar ipsum. Suspendisse rhoncus diam in lectus dictum facilisis.'),
    (7, 3, 'Duis eu diam ligula', 'www.google.fi', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc a mauris non felis molestie varius. Aliquam at pulvinar ipsum. Suspendisse rhoncus diam in lectus dictum facilisis.'),
    (8, 3, 'Duis eu diam ligula', 'www.google.fi', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc a mauris non felis molestie varius. Aliquam at pulvinar ipsum. Suspendisse rhoncus diam in lectus dictum facilisis.'),
	(9, 3, 'Duis eu diam ligula', 'www.google.fi', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc a mauris non felis molestie varius. Aliquam at pulvinar ipsum. Suspendisse rhoncus diam in lectus dictum facilisis.'),
    (10, 4, 'Duis eu diam ligula', 'www.google.fi', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc a mauris non felis molestie varius. Aliquam at pulvinar ipsum. Suspendisse rhoncus diam in lectus dictum facilisis.'),
    (11, 4, 'Duis eu diam ligula', 'www.google.fi', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc a mauris non felis molestie varius. Aliquam at pulvinar ipsum. Suspendisse rhoncus diam in lectus dictum facilisis.'),
	(12, 4, 'Duis eu diam ligula', 'www.google.fi', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc a mauris non felis molestie varius. Aliquam at pulvinar ipsum. Suspendisse rhoncus diam in lectus dictum facilisis.'),
    (13, 5, 'Duis eu diam ligula', 'www.google.fi', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc a mauris non felis molestie varius. Aliquam at pulvinar ipsum. Suspendisse rhoncus diam in lectus dictum facilisis.'),
    (14, 5, 'Duis eu diam ligula', 'www.google.fi', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc a mauris non felis molestie varius. Aliquam at pulvinar ipsum. Suspendisse rhoncus diam in lectus dictum facilisis.'),
	(15, 5, 'Duis eu diam ligula', 'www.google.fi', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc a mauris non felis molestie varius. Aliquam at pulvinar ipsum. Suspendisse rhoncus diam in lectus dictum facilisis.'),
    (16, 6, 'Duis eu diam ligula', 'www.google.fi', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc a mauris non felis molestie varius. Aliquam at pulvinar ipsum. Suspendisse rhoncus diam in lectus dictum facilisis.'),
    (17, 6, 'Duis eu diam ligula', 'www.google.fi', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc a mauris non felis molestie varius. Aliquam at pulvinar ipsum. Suspendisse rhoncus diam in lectus dictum facilisis.'),
	(18, 6, 'Duis eu diam ligula', 'www.google.fi', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc a mauris non felis molestie varius. Aliquam at pulvinar ipsum. Suspendisse rhoncus diam in lectus dictum facilisis.'),
    (19, 7, 'Duis eu diam ligula', 'www.google.fi', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc a mauris non felis molestie varius. Aliquam at pulvinar ipsum. Suspendisse rhoncus diam in lectus dictum facilisis.'),
    (20, 7, 'Duis eu diam ligula', 'www.google.fi', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc a mauris non felis molestie varius. Aliquam at pulvinar ipsum. Suspendisse rhoncus diam in lectus dictum facilisis.'),
	(21, 7, 'Duis eu diam ligula', 'www.google.fi', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc a mauris non felis molestie varius. Aliquam at pulvinar ipsum. Suspendisse rhoncus diam in lectus dictum facilisis.'),
    (22, 8, 'Duis eu diam ligula', 'www.google.fi', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc a mauris non felis molestie varius. Aliquam at pulvinar ipsum. Suspendisse rhoncus diam in lectus dictum facilisis.'),
    (23, 8, 'Duis eu diam ligula', 'www.google.fi', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc a mauris non felis molestie varius. Aliquam at pulvinar ipsum. Suspendisse rhoncus diam in lectus dictum facilisis.'),
	(24, 8, 'Duis eu diam ligula', 'www.google.fi', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc a mauris non felis molestie varius. Aliquam at pulvinar ipsum. Suspendisse rhoncus diam in lectus dictum facilisis.'),
    (25, 9, 'Duis eu diam ligula', 'www.google.fi', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc a mauris non felis molestie varius. Aliquam at pulvinar ipsum. Suspendisse rhoncus diam in lectus dictum facilisis.'),
    (26, 9, 'Duis eu diam ligula', 'www.google.fi', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc a mauris non felis molestie varius. Aliquam at pulvinar ipsum. Suspendisse rhoncus diam in lectus dictum facilisis.'),
	(27, 9, 'Duis eu diam ligula', 'www.google.fi', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc a mauris non felis molestie varius. Aliquam at pulvinar ipsum. Suspendisse rhoncus diam in lectus dictum facilisis.'),
    (28, 10, 'Duis eu diam ligula', 'www.google.fi', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc a mauris non felis molestie varius. Aliquam at pulvinar ipsum. Suspendisse rhoncus diam in lectus dictum facilisis.'),
    (29, 10, 'Duis eu diam ligula', 'www.google.fi', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc a mauris non felis molestie varius. Aliquam at pulvinar ipsum. Suspendisse rhoncus diam in lectus dictum facilisis.'),
	(30, 10, 'Duis eu diam ligula', 'www.google.fi', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc a mauris non felis molestie varius. Aliquam at pulvinar ipsum. Suspendisse rhoncus diam in lectus dictum facilisis.');

/*
== LISAYSTEN LISÄÄMINEN ==
*/
DELETE FROM Lisaykset;

INSERT INTO 
	Lisaykset
VALUES 
	(6, 'Aku Ankka'),
    (5, 'Aku Ankka'),
    (3, 'Aku Ankka'),
    (1, 'Roope Ankka'),
    (2, 'Roope Ankka'),
    (1, 'Tupuhupulupu'),
    (4, 'Tupuhupulupu'),
    (2, 'Hessu Hopo');

/*
== SUORITUSTEN LISÄÄMINEN ==
*/
DELETE FROM Suoritukset;

INSERT INTO
	Suoritukset
VALUES
	(1, 'Aku Ankka', date('2017-06-15'), 60, 1),
    (2, 'Roope Ankka', date('2019-05-15'), 40, 3),
    (3, 'Aku Ankka', date('2017-06-13'), 90, 3),
    (5, 'Aku Ankka', date('2018-08-15'), 120, 2),
    (6, 'Roope Ankka', date('2017-06-23'), 25, 4),
    (7, 'Aku Ankka', date('2019-03-09'), 15, 3),
    (8, 'Hessu Hopo', date('2018-06-15'), 60, 6),
    (9, 'Roope Ankka', date('2017-06-15'), 60, 6),
    (10, 'Roope Ankka', date('2016-06-15'), 60, 8),
    (11, 'Hessu Hopo', date('2018-06-15'), 60, 5),
    (12, 'Aku Ankka', date('2017-06-15'), 60, 5),
    (13, 'Aku Ankka', date('2019-06-15'), 30, 2),
    (14, 'Aku Ankka', date('2018-06-15'), 55, 4);

/*
== SEURAUSTEN LISÄÄMINEN ==
*/
DELETE FROM Seuraukset;

INSERT INTO
	Seuraukset
VALUES
	('Aku Ankka', 'Roope Ankka'),
    ('Roope Ankka', 'Aku Ankka'),
    ('Tupuhupulupu', 'Aku Ankka'),
    ('Hessu Hopo', 'Roope Ankka');




