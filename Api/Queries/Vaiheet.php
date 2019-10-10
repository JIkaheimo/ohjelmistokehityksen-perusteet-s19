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
}

?>