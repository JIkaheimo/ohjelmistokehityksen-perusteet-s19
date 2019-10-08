<?php

abstract class Harjoitukset
{
  // QUERYT ========================================================
  const HAE_KAIKKI = 'SELECT * FROM Harjoitukset';
  const HAE_YKSI = Harjoitukset::HAE_KAIKKI . ' WHERE harjoitusId = :harjoitusId';
  const HAE_OHJELMAN = Harjoitukset::HAE_KAIKKI . ' WHERE ohjelmaId = :ohjelmaId';

  const LISAA_UUSI = '
  INSERT INTO 
    Harjoitukset (nimi, ohjelmaId)
  VALUES
    (:nimi, :ohjelmaId)';

  const POISTA = '
  DELETE FROM
    Harjoitukset
  WHERE 
    harjoitusId = :harjoitusId';


  // HAE =========================================================
  static function hae(
    PDO $db,
    int $harjoitusId = NULL
  ) 
  /**
   * Hakee kaikki tai yhden harjoituksen tietokannasta.
   * 
   * PARAMS:
   * - $db (PDO)
   * - $harjoitusId (int) haettavan harjoituksen id
   */
  {
    if ($harjoitusId == NULL) {
      return $db->query(Harjoitukset::HAE_KAIKKI)->fetchAll(PDO::FETCH_OBJ);
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
    PDO $db, 
    int $ohjelmaId
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


  // UUSI =========================================================
  static function uusi(
    PDO $db,
    string $nimi,
    int $ohjelmaId
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
    
    if ($stmt->execute())
    {
      return $db->lastInsertId();
    }
    return false;
  } // UUSI END


  // LISAA =======================================================
  static function lisaa(
    PDO $db,
    string $nimi,
    int $ohjelmaId
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
    return Harjoitukset::uusi($db, $nimi, $ohjelmaId);
  } // LISAA END


  // POISTA ======================================================
  static function poista(
    PDO $db,
    int $harjoitusId
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