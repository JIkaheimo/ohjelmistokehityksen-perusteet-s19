<?php

abstract class Vaiheet
{

  // QUERYT =======================================================
  const HAE_KAIKKI = '
  SELECT * FROM
    Vaiheet';

  const HAE_YKSI = Vaiheet::HAE_KAIKKI . '
  WHERE
    vaiheId = :vaiheId';

  const HAE_HARJOITUKSEN = Vaiheet::HAE_KAIKKI . '
  WHERE 
    harjoitusId = :harjoitusId';

  const LISAA_UUSI = '
  INSERT INTO Vaiheet
    (harjoitusId, nimi, ohjelinkki, kuvaus)
  VALUES
    (:harjoitusId, :nimi, :ohjelinkki, :kuvaus)';

  const PAIVITA = '
  UPDATE Vaiheet
  SET
    harjoitusId = :harjoitusId,
    nimi = :nimi,
    ohjelinkki = :ohjelinkki,
    kuvaus = :kuvaus
  WHERE
    vaiheId = :vaiheId';

  const POISTA = '
  DELETE FROM 
    Vaiheet
  WHERE 
    vaiheId = :vaiheId';


  // HAE ============================================================
  static function hae(
    $db,
    $vaiheId = NULL
  )
  /**
   * Hakee käyttäjät tai käyttäjän tietokannasta.
   */
  {
    // Haetaan oletuksena kaikki vaiheet.
    if ($vaiheId == NULL) 
    {
      return 
        $db
          ->query(Vaiheet::HAE_KAIKKI)
          ->fetchAll(PDO::FETCH_OBJ);
    }
    
    // Muuten haetaan vaihe id:n perusteella.
    $stmt = $db->prepare(Vaiheet::HAE_YKSI);
    $stmt->bindValue(':vaiheId', $vaiheId);

    // Tarkistetaan että kysely onnistui.
    if ($stmt->execute()) return $stmt->fetch(PDO::FETCH_OBJ);
    return false;
  } // HAE_END


  // HAE_HARJOITUKSEN =================================================
  static function haeHarjoituksen(
    $db, 
    $harjoitusId
  ) 
  {
    $stmt = $db->prepare(Vaiheet::HAE_HARJOITUKSEN);
    $stmt->bindValue(':harjoitusId', $harjoitusId);
    
    // Tarkistetaan että kysely onnistui
    if ($stmt->execute()) return $stmt->fetchAll(PDO::FETCH_OBJ);
    return false;
  } // HAE_HARJOITUKSEN_END


  // LISAA ===========================================================
  static function lisaa(
    $db,
    $harjoitusId,
    $nimi,
    $ohjelinkki,
    $kuvaus
  ) 
  {
    $stmt = $db->prepare(Vaiheet::LISAA_UUSI);
    $stmt->bindValue(':harjoitusId', $harjoitusId);
    $stmt->bindValue(':nimi', $nimi);
    $stmt->bindValue(':ohjelinkki', $ohjelinkki);
    $stmt->bindValue(':kuvaus', $kuvaus);

    if ($stmt->execute()) return $db->lastInsertId();
    return 0;
  } // LISAA_END


  // PAIVITA =========================================================
  static function paivita(
    $db,
    $vaiheId,
    $harjoitusId,
    $nimi,
    $ohjelinkki,
    $kuvaus
  )
  {
    $stmt = $db->prepare(Vaiheet::PAIVITA);
    $stmt->bindValue(':harjoitusId', $harjoitusId);
    $stmt->bindValue(':nimi', $nimi);
    $stmt->bindValue(':ohjelinkki', $ohjelinkki);
    $stmt->bindValue(':kuvaus', $kuvaus);
    $stmt->bindValue(':vaiheId', $vaiheId);

    return $stmt->execute();
  }


  // UUSI =============================================================
  static function uusi(
    $db,
    $harjoitusId,
    $nimi,
    $ohjelinkki,
    $kuvaus
  ) 
  {
    return Vaiheet::lisaa($db, $harjoitusId, $nimi, $ohjelinkki, $kuvaus);
  }// UUSI END 


  // POISTA =================================================================================
  static function poista(
    $db,
    $vaiheId
  ) 
  /**
   * Poistaa annetun vaiheen tietokannasta.
   * 
   * PARAMS:
   * - $db (PDO)
   * - $ohjelmaId (int) poistettavan vaiheen id
   * 
   * RETURNS:
   * - onnistuiko poisto (boolean)
   */
  {
    $stmt = $db->prepare(Vaiheet::POISTA);
    $stmt->bindValue(':vaiheId', $vaiheId);
    
    return $stmt->execute();
  } // POISTA_END
}

?>