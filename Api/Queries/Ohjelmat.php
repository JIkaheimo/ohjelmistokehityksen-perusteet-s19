<?php

abstract class Ohjelmat {

  // QUERYT ====================================================================================
  const HAE_KAIKKI = '
  SELECT 
    * 
  FROM 
    OhjelmatPitka';

  const HAE_YKSI = Ohjelmat::HAE_KAIKKI . '
  WHERE 
    ohjelmaId = :ohjelmaId';

  const HAE_KAYTTAJAN = Ohjelmat::HAE_KAIKKI . '
  WHERE
    kayttajatunnus = :kayttajatunnus';

  const HAE_UUSIMMAT = Ohjelmat::HAE_KAIKKI . '
  ORDER BY 
    luotu DESC
  LIMIT
    4';

  const HAE_KAYTTAJAN_LISAAMAT = '
  SELECT
    OhjelmatPitka.*
  FROM 
    OhjelmatPitka
  JOIN
    Lisaykset
  ON
    OhjelmatPitka.ohjelmaId = Lisaykset.ohjelmaId
  WHERE 
    Lisaykset.kayttajatunnus = :kayttajatunnus';

  const HAE_SUOSITUIMMAT = '
  SELECT 
    OhjelmatPitka.*, COUNT(Lisaykset.ohjelmaId) AS Lisayksia 
  FROM 
    OhjelmatPitka
  JOIN 
    Lisaykset
  ON
    OhjelmatPitka.ohjelmaId = Lisaykset.ohjelmaId
  GROUP BY 
    Lisaykset.ohjelmaId
  ORDER BY 
    Lisayksia DESC
  LIMIT
    4';

  const LISAA_UUSI = '
  INSERT INTO 
    Ohjelmat (kayttajatunnus, nimi, vaikeustasoId, luotu, kuva) 
  VALUES
    (:kayttajatunnus, :nimi, :vaikeustasoId, NOW(), :kuva)';
    
  const PAIVITA = '
  UPDATE Ohjelmat 
  SET 
    kayttajatunnus = :kayttajatunnus, 
    nimi = :nimi, 
    vaikeustasoId = :vaikeustasoId,
  WHERE 
    ohjelmaId = :ohjelmaId';

  const POISTA = '
  DELETE FROM 
    Ohjelmat 
  WHERE 
    ohjelmaId = :ohjelmaId';
  
  // PROSEDUURIT =========================================================================
  const HAE_KAYTTAJAN_P = '
  CALL HaeKayttajanOhjelmat(
    :kayttajatunnus
  )';


  // HAE ==================================================================================
  static function hae(
    PDO $db,
    int $ohjelmaId = 0
  )
  {
    if ($ohjelmaId == 0)
    {
      return $db->query(Ohjelmat::HAE_KAIKKI)->fetchAll(PDO::FETCH_OBJ);
    }
    
    $stmt = $db->prepare(Ohjelmat::HAE_YKSI);
    $stmt->bindValue(':ohjelmaId', $ohjelmaId);

    if (!$stmt->execute()) return false;

    // Haetaan ohjelman suoritukset ja vaiheet.
    $ohjelma = $stmt->fetch(PDO::FETCH_OBJ);

    $ohjelma->harjoitukset = Harjoitukset::haeOhjelman($db, $ohjelma->ohjelmaId);
    
    foreach ($ohjelma->harjoitukset as $harjoitus) {
      $harjoitus->vaiheet = Vaiheet::haeHarjoituksen($db, $harjoitus->harjoitusId);
    }

    return $ohjelma;
  } // HAE_END


  // HAE_KAYTTAJAN ========================================================================
  static function haeKayttajan(
    PDO $db, 
    string $kayttajatunnus
  )
  {
    $stmt = $db->prepare(Ohjelmat::HAE_KAYTTAJAN_P);
    $stmt->bindValue(':kayttajatunnus', $kayttajatunnus);
    
    if ($stmt->execute()) return $stmt->fetchAll(PDO::FETCH_OBJ);
    return false;
  } // HAE_KAYTTAJAN_END


  // HAE_KAYTTAJAN_HARJOITUKSELLISET ======================================================
  static function haeKayttajanHarjoitukselliset(
    PDO $db, 
    string $kayttajatunnus
  ) : Array
  {
    $ohjelmat = Ohjelmat::haeKayttajan($db, $kayttajatunnus);
    return array_filter($ohjelmat, function ($ohjelma) {
      return $ohjelma->harjoituksia > 0;
    });
  } // HAE_KAYTTAJAN_HARJOITUKSELLISET_END


  // HAE_KAYTTAJAN_LISAAMAT ==============================================================
  static function haeKayttajanLisaamat(
    PDO $db,
    string $kayttajatunnus
  ) : Array
  {
    $stmt = $db->prepare(Ohjelmat::HAE_KAYTTAJAN_LISAAMAT);
    $stmt->bindValue(':kayttajatunnus', $kayttajatunnus);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_OBJ);
  } // HAE_KAYTTAJAN_LISAAMAT_END


  // HAE_UUSIMMAT ========================================================================
  static function haeUusimmat(
    PDO $db
  ) : Array
  /**
   * Hakee uusimmat ohjelmat tietokannasta (4kpl).
   * 
   * PARAMS:
   * - $db (PDO)
   * 
   * RETURNS:
   * - uusimmat ohjelmat (Array)
   */
  {
    return $db
      ->query(Ohjelmat::HAE_UUSIMMAT)
      ->fetchAll(PDO::FETCH_OBJ);
  } // HAE_UUSIMMAT_END


  // HAE_SUOSITUIMMAT ===================================================================
  static function haeSuosituimmat(
    PDO $db
  ) : Array
  {
    return $db->query(Ohjelmat::HAE_SUOSITUIMMAT)->fetchAll(PDO::FETCH_OBJ);
  } // HAE_SUOSITUIMMAT_END


  // LISAA ===============================================================================
  static function lisaa(
    PDO $db,
    string $kayttajatunnus,
    string $nimi,
    int $vaikeustasoId,
    string $kuva
  ) : int
  /**
   * Lisää annetun ohjelman tietokantaan.
   * 
   * PARAMS:
   * - $db (PDO)
   * - $kayttajatunnus (string) käyttäjä, joka on lisäämässä ohjelmaa
   * - $nimi (string) lisättävän ohjelman nimi
   * - $vaikeustasoId (int) lisättävän ohjelman vaikeusstason id
   * - $kuva (string) lisättävän ohjelman kuvan nimi
   * 
   * RETURNS:
   * - 0 jos lisäys epäonnistuu, muuten palauttaa lisätyn tietueen id:n (int)
   */
  {
    $stmt = $db->prepare(Ohjelmat::LISAA_UUSI);
    $stmt->bindValue(':kayttajatunnus', $kayttajatunnus);
    $stmt->bindValue(':nimi', $nimi);
    $stmt->bindValue(':vaikeustasoId', $vaikeustasoId);
    $stmt->bindValue(':kuva', $kuva);

    if ($stmt->execute()) return $db->lastInsertId();
    return 0;
  } // LISAA_END


  // PAIVITA ==============================================================================
  static function paivita(
    PDO $db, 
    int $ohjelmaId,
    string $kayttajatunnus,
    string $nimi,
    int $vaikeustasoId
  ) 
  /**
   * Päivittää annetun ohjelman tiedot tietokantaan.
   * 
   * PARAMS:
   * - $db (PDO),
   * - $ohjelmaId (int) päivitettävän ohjelman id
   * - $kayttajatunnus (string) ohjelman luonut käyttäjä
   * - $nimi (string) ohjelman nimi
   * - $vaikeustasoId (int) ohjelman vaikeustason id
   * 
   * RETURNS:
   * - onnistuiko päivitys (boolean)
   */
  { 
    $stmt = $db->prepare(Ohjelmat::PAIVITA);
    $stmt->bindValue(':kayttajatunnus', $kayttajatunnus);
    $stmt->bindValue(':nimi', $nimi);
    $stmt->bindValue(':vaikeustasoId', $vaikeustasoId);
    $stmt->bindValue(':ohjelmaId', $ohjelmaId);

    return $stmt->execute();
  } // PAIVITA_END


  // POISTA =================================================================================
  static function poista(
    PDO $db,
    int $ohjelmaId
  ) 
  /**
   * Poistaa annetun ohjelman tietokannasta.
   * 
   * PARAMS:
   * - $db (PDO)
   * - $ohjelmaId (int) poistettavan ohjelman id
   * 
   * RETURNS:
   * - onnistuiko poisto (boolean)
   */
  {
    $stmt = $db->prepare(Ohjelmat::POISTA);
    $stmt->bindValue(':ohjelmaId', $ohjelmaId);
    
    return $stmt->execute();
  } // POISTA_END


  // ONKO_LISATTY ==========================================================================
  static function onkoLisatty(
    PDO $db,
    string $kayttajatunnus,
    int $ohjelmaId
  )
  /**
   * Tarkistaa tietokannasta onko käyttäjä lisännyt ohjelman.
   * 
   * PARAMS:
   * - $db (PDO)
   * - $kayttajatunnus ohjelman lisänneen(?) käyttäjän tunnus
   * 
   * RETURNS:
   * - onko käyttäjä lisännyt ohjelman (int)
   */
  {
    $stmt = $db->prepare('SELECT * FROM Lisaykset WHERE kayttajatunnus = :kayttajatunnus AND ohjelmaId = :ohjelmaId');
    $stmt->bindValue(':kayttajatunnus', $kayttajatunnus);
    $stmt->bindValue(':ohjelmaId', $ohjelmaId);

    // Tarkistetaan että rivi eli lisäys löytyy
    if ($stmt->execute()) return $stmt->rowCount() > 0;
    return false;

  } // ONKO_LISATTY_END
}

?>