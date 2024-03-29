<?php

abstract class Harjoitukset
{
  // QUERYT ========================================================
  const HAE_KAIKKI = 'SELECT * FROM Harjoitukset';
  const HAE_YKSI = Harjoitukset::HAE_KAIKKI . ' WHERE harjoitusId = :harjoitusId';
  const HAE_OHJELMAN = Harjoitukset::HAE_KAIKKI . ' WHERE ohjelmaId = :ohjelmaId';

  const HAE_KAYTTAJA = '
  SELECT
    Ohjelmat.kayttajatunnus
  FROM
    Harjoitukset
  LEFT JOIN
    Ohjelmat 
  ON
    Harjoitukset.ohjelmaId = Ohjelmat.ohjelmaId
  WHERE
    Harjoitukset.harjoitusId = :harjoitusId';

  const LISAA_UUSI = '
  INSERT INTO 
    Harjoitukset (nimi, ohjelmaId)
  VALUES
    (:nimi, :ohjelmaId)';

  const PAIVITA = '
  UPDATE 
    Harjoitukset
  SET
    nimi = :nimi,
    ohjelmaId = :ohjelmaId
  WHERE
    harjoitusId = :harjoitusId';

  const POISTA = '
  DELETE FROM
    Harjoitukset
  WHERE 
    harjoitusId = :harjoitusId';


  // PROSEDUURIT ================================================
  const LISAA_UUSI_P = '
  CALL UusiHarjoitus(:nimi, :ohjelmaId)';


  // HAE =========================================================
  static function hae(
    $db,
    $harjoitusId = NULL
  ) 
  /**
   * Hakee kaikki tai yhden harjoituksen tietokannasta.
   * 
   * PARAMS:
   * - $db (PDO)
   * - $harjoitusId (int) haettavan harjoituksen id
   */
  {
    // Haetaan kaikki jos harjoituksen id:tä ei anneta.
    if ($harjoitusId == NULL) {
      $stmt = $db->prepare(Harjoitukset::HAE_KAIKKI);
      
      if ($stmt->execute()) return $stmt->fetchAll(PDO::FETCH_OBJ);
      return false;
    }

    $stmt = $db->prepare(Harjoitukset::HAE_YKSI);
    $stmt->bindValue(':harjoitusId', $harjoitusId);
    $stmt->execute();

    $harjoitus = $stmt->fetch(PDO::FETCH_OBJ);

    // Varmistetaan että harjoitus löytyy.
    if ($harjoitus == null) return false;
    $harjoitus->vaiheet = Vaiheet::haeHarjoituksen($db, $harjoitus->harjoitusId);

    return $harjoitus;
  } // HAE_END


  // HAE_OHJELMAN ==================================================
  static function haeOhjelman(
    $db, 
    $ohjelmaId
  ) 
  /**
   * Hakee kaikki ohjelman harjoitukset.
   * 
   * PARAMS:
   * - $db (PDO)
   * - $ohjelmaId (int) ohjelma, minkä harjoitukset haetaan
   */
  {
    $stmt = $db->prepare(Harjoitukset::HAE_OHJELMAN);
    $stmt->bindValue(':ohjelmaId', $ohjelmaId);
    if ($stmt->execute()) return $stmt->fetchAll(PDO::FETCH_OBJ);
    return false;
  } // HAE_OHJELMAN_END


  // HAE_KAYTTAJA =================================================
  static function haeKayttaja(
    $db,
    $harjoitusId
  )
  /**
   * Hakee harjoituksen ohjelman luoneen käyttäjän.
   * 
   * PARAMS:
   * - $db (PDO)
   * - $harjoitusId (int)
   */
  {
    $stmt = $db->prepare(Harjoitukset::HAE_KAYTTAJA);
    $stmt->bindValue(':harjoitusId', $harjoitusId);

    if ($stmt->execute()) return $stmt->fetch(PDO::FETCH_OBJ);
    return false;
  } // HAE_KAYTTAJA_END


  // UUSI =========================================================
  static function uusi(
    $db,
    $nimi,
    $ohjelmaId
  ) 
   /**
   * Lisää harjoituksen tiedot tietokantaan.
   * 
   * PARAMS:
   * - $db (PDO)
   * - $nimi (string) harjoituksen nimi
   * - $ohjelmaId (int) harjoituksen ohjelman id
   */
  {
    $stmt = $db->prepare(Harjoitukset::LISAA_UUSI);
    $stmt->bindValue(':nimi', $nimi);
    $stmt->bindValue(':ohjelmaId', $ohjelmaId);

    if ($stmt->execute()) return $db->lastInsertId();
    return false;
  } // UUSI END


  // LISAA =======================================================
  static function lisaa(
    $db,
    $nimi,
    $ohjelmaId
  ) 
  /**
   * Lisää harjoituksen tiedot tietokantaan.
   * 
   * PARAMS:
   * - $db (PDO)
   * - $nimi (string) harjoituksen nimi
   * - $ohjelmaId (int) harjoituksen ohjelman id
   * 
   * RETURNS:
   * - onnistuessa lisätyn harjoituksen id, epäoonnistuessa false
   */
  {
    return Harjoitukset::uusi($db, $nimi, $ohjelmaId);
  } // LISAA END

  
  // PAIVITA =====================================================
  static function paivita(
    $db, // (PDO)
    $harjoitusId, // (int)
    $nimi, // (string)
    $ohjelmaId // (int)
  )
  /**
   * Päivittää harjoituksen tiedot tietokannassa.
   * 
   * PARAMS:
   * - $db (PDO)
   * - $harjoitusId (int) päivitettävän harjoituksen id
   * - $nimi (string) harjoituksen nimi
   * - $ohjelmaId (int) harjoituksen ohjelman id
   */
  {
    $stmt = $db->prepare(Harjoitukset::PAIVITA);
    $stmt->bindValue(':nimi', $nimi);
    $stmt->bindValue(':ohjelmaId', $ohjelmaId);
    $stmt->bindValue(':harjoitusId', $harjoitusId);

    return $stmt->execute();
  } // PAIVITA_END


  // POISTA ======================================================
  static function poista(
    $db,
    $harjoitusId
  ) 
  /**
   * Poistaa harjoituksen tietokannasta annetun id:n perusteella.
   * 
   * PARAMS:
   * - $db (PDO)
   * - $harjoitusId (int) poistettavan harjoituksen id
   */
  {
    $stmt = $db->prepare(Harjoitukset::POISTA);
    $stmt->bindValue(':harjoitusId', $harjoitusId);

    return $stmt->execute();
  } // POISTA_END
}

?>