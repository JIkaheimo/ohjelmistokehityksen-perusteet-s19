<?php

abstract class Suoritukset
{
  // QUERYT ======================================================================
  const HAE_KAIKKI = '
  SELECT * FROM 
    Suoritukset ';

  const HAE_KAIKKI_PITKA = '
  SELECT 
    Suoritukset.suoritusId AS suoritusId,
    Suoritukset.kayttajatunnus AS kayttajatunnus,
    Suoritukset.suoritusPvm AS suoritusPvm,
    Suoritukset.kesto AS kesto,
    Suoritukset.harjoitusId AS harjoitusId,
    Ohjelmat.ohjelmaId AS ohjelmaId,
    Ohjelmat.nimi AS ohjelma,
    Harjoitukset.nimi AS harjoitus
  FROM
    Suoritukset
  LEFT JOIN 
    Harjoitukset 
  ON 
    Harjoitukset.harjoitusId = Suoritukset.harjoitusId
  LEFT JOIN 
    Ohjelmat 
  ON 
    Harjoitukset.ohjelmaId = Ohjelmat.ohjelmaId';

  const HAE_YKSI = Suoritukset::HAE_KAIKKI . ' 
  WHERE 
    suoritusId = :suoritusId';

  const HAE_YKSI_PITKA = Suoritukset::HAE_KAIKKI_PITKA . '
  WHERE 
    suoritusId = :suoritusId';

  const LISAA_UUSI = '
  INSERT INTO Suoritukset
    (kayttajatunnus, suoritusPvm, kesto, harjoitusId)
  VALUES
    (:kayttajatunnus, :suoritusPvm, :kesto, :harjoitusId)';
  
  const POISTA = '
  DELETE FROM 
    Suoritukset 
  WHERE 
    suoritusId = :suoritusId';

  // PROSEDUURIT ==================================================================
  const HAE_KAYTTAJAN_P = '
  CALL HaeKayttajanSuorituksetPitka(
    :kayttajatunnus
  )';

  const HAE_KAYTTAJAN_VIIMEISIMMAT_P = '
  CALL HaeKayttajanViimeisimmatSuoritukset(
    :kayttajatunnus 
  )';

  const LISAA_UUSI_P = '
  CALL UusiSuoritus(
    :kayttajatunnus,
    :suoritusPvm,
    :kesto,
    :harjoitusId,
    @id
  )';
  
  const PAIVITA_P = '
  CALL PaivitaSuoritus(
    :suoritusId,
    :kayttajatunnus,
    :suoritusPvm,
    :kesto,
    :harjoitusId
  )';
  

  // HAE ===========================================================================
  static function hae(
    $db,
    $suoritusId = NULL
  )
  /**
   * Hakee tietokannassa olevat suoritukset tai suoritukset.
   * 
   * PARAMS:
   * - $db (PDO)
   * - $suoritusId (int) haettavan suorituksen id. Jos $suoritusId == NULL, haetaan kaikki suoritukset.
   * 
   * RETURNS:
   * - haetut suoritukset tai suoritus (Array/stdCkass)
   */
  {
    if ($suoritusId == NULL)
    {
      return $db->query(Suoritukset::HAE_KAIKKI)->fetchAll(PDO::FETCH_OBJ);
    }

    $stmt = $db->prepare(Suoritukset::HAE_YKSI_PITKA);
    $stmt->bindValue(':suoritusId', $suoritusId);

    if ($stmt->execute()) return $stmt->fetch(PDO::FETCH_OBJ);
    return false;
  } // HAE_END


  // HAE_KAYTTAJAN =================================================================
  static function haeKayttajan(
    $db,
    $kayttajatunnus
  ) 
  {
    $stmt = $db->prepare(Suoritukset::HAE_KAYTTAJAN_P);
    $stmt->bindValue(':kayttajatunnus', $kayttajatunnus);
    if ($stmt->execute()) return $stmt->fetchAll(PDO::FETCH_OBJ);
    return false;
  } // HAE_KAYTTAJAN_END


  // HAE_KAYTTAJAN_VIIMEISIMMAT ===================================================
  static function haeKayttajanViimeisimmat(
    $db,
    $kayttajatunnus
  ) 
  {
    $stmt = $db->prepare(Suoritukset::HAE_KAYTTAJAN_VIIMEISIMMAT_P);
    $stmt->bindValue(':kayttajatunnus', $kayttajatunnus);

    if ($stmt->execute()) return $stmt->fetchAll(PDO::FETCH_OBJ);
    return false;
  } // HAE_KAYTTAJAN_VIIMEISIMMAT_END


  // UUSI ==========================================================================
  static function uusi(
    $db,
    $kayttajatunnus,
    $suoritusPvm,
    $kesto,
    $harjoitusId
  ) 
  {
    // Lisätään suoritus tietokantaan.
    $stmt = $db->prepare(Suoritukset::LISAA_UUSI_P);
    $stmt->bindValue(':kayttajatunnus', $kayttajatunnus);
    $stmt->bindValue(':suoritusPvm', $suoritusPvm);
    $stmt->bindValue(':kesto', $kesto);
    $stmt->bindValue(':harjoitusId', $harjoitusId);
    $stmt->execute();

    $stmt->closeCursor();

    // Palautetaan lisätyn suorituksen ID.
    $rivi = $db->query('SELECT @id AS id')->fetch(PDO::FETCH_ASSOC);

    if ($rivi)
    {
      return $rivi['id'];
    }
    return false;
  } // UUSI_END


  // PAIVITA ======================================================================
  static function paivita(
    $db,
    $suoritusId,
    $kayttajatunnus,
    $suoritusPvm,
    $kesto,
    $harjoitusId
  ) 
  /**
   * Päivittää annetun suorituksen tiedot tietokantaan.
   * 
   * PARAMS:
   * - $db (PDO)
   * - $suoritusId (int) päivitettävän suorituksen id
   * 
   * RETURNS:
   * - onnistuiko päivitys (boolean)
   */
  {
    $stmt = $db->prepare(Suoritukset::PAIVITA_P);
    $stmt->bindValue(':suoritusId', $suoritusId);
    $stmt->bindValue(':kayttajatunnus', $kayttajatunnus);
    $stmt->bindValue(':suoritusPvm', $suoritusPvm);
    $stmt->bindValue(':kesto', $kesto);
    $stmt->bindValue(':harjoitusId', $harjoitusId);
    
    return $stmt->execute();
  } // PAIVITA_END


  // POISTA ========================================================================
  static function poista(
    $db,
    $suoritusId
  ) 
  /**
   * Poistaa annetun suorituksen tiedot tietokannasta.
   * 
   * PARAMS:
   * - $db (PDO)
   * - $suoritusId (int) poistettavan suorituksen id
   */
  {
    $stmt = $db->prepare(Suoritukset::POISTA);
    $stmt->bindValue(':suoritusId', $suoritusId);

    return $stmt->execute();
  } // POISTA_END
}

?>