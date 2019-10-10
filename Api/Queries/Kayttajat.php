<?php

abstract class Kayttajat
{
  // QUERYT ================================================================
  const HAE_KAIKKI_JULKINEN = '
  SELECT 
    kayttajatunnus,
    kuvaus,
    kuva
  FROM 
    Kayttajat';


  // PROSEDUURIT ==========================================================
  const HAE_YKSI_P = '
  CALL HaeKayttaja(
    :kayttajatunnus
  )';

  const LISAA_UUSI_P = '
  CALL UusiKayttaja(
    :kayttajatunnus,
    :salasanaHash
  )';

  const PAIVITA_P = '
  CALL PaivitaKayttaja(
    :kayttajatunnus,
    :etunimi,
    :sukunimi,
    :kuva,
    :kuvaus
  )';


  // HAE ===================================================================
  static function hae($db) 
  { 
    $stmt = $db->query(Kayttajat::HAE_KAIKKI_JULKINEN);
    if ($stmt->execute()) return $stmt->fetchAll(PDO::FETCH_OBJ);
    return false;
  } // HAE_END

  
  // KAYTTAJA_SALASANALLA ==================================================
  static function kayttajaSalasanalla(
    $db,
    $kayttajatunnus
  )
  {
    $stmt = $db->prepare('SELECT * FROM Kayttajat WHERE kayttajatunnus = :kayttajatunnus');
    $stmt->bindValue(':kayttajatunnus', $kayttajatunnus);
    if ($stmt->execute()) return $stmt->fetch(PDO::FETCH_OBJ);
    return false;
  } // KAYTTAJA_SALASANALLA_END


  // KAYTTAJA =============================================================-
  static function kayttaja(
    $db,
    $kayttajatunnus
  )
  /**
   * Hakee käyttäjän tiedot tietokannasta annetun käyttäjätunnuksen perusteella.
   * 
   * PARAMS:
   * - $db (PDO)
   * - $kayttajatunnus (string) haettavan käyttäjän tunnus
   * 
   * RETURNS:
   * - $kaytta - Tietokannasta haettu käyttäjä tai null, jos käyttäjää ei löydy.
   */
  {
    $stmt = $db->prepare(Kayttajat::HAE_YKSI_P);
    $stmt->bindValue(':kayttajatunnus', $kayttajatunnus);

    if (!$stmt->execute()) return false;
    
    $kayttaja = $stmt->fetch(PDO::FETCH_OBJ);

    // Palautetaan null jos käyttäjää ei ole olemassa.
    if (!isset($kayttaja->kayttajatunnus)) return null;

    $kayttaja->kuva = './Assets/Kayttajat/'.$kayttaja->kuva;
    return $kayttaja;

  } // KAYTTAJA_END


  // UUSI_KAYTTAJA ========================================================
  static function uusiKayttaja(
    $db,
    $kayttajatunnus,
    $salasanaHash
  ) 
  /**
   * Lisää uuden käyttäjän tietokantaan.
   * 
   * PARAMS:
   * - $db (PDO)
   * - $kayttajatunnus (string) lisättävä käyttäjätunnus
   * - $salasanahash (string) käyttäjän kryptattu salasana
   */
  {
    $stmt = $db->prepare(Kayttajat::LISAA_UUSI_P);
    $stmt->bindValue(':kayttajatunnus', puhdistaTagit($kayttajatunnus));
    $stmt->bindValue(':salasanaHash', $salasanaHash);

    return $stmt->execute();
  } // UUSI_END


  // PAIVITA ==========================================================
  static function paivita(
    $db,
    $kayttajatunnus, 
    $etunimi, 
    $sukunimi, 
    $kuva, 
    $kuvaus
  ) 
  {
    $stmt = $db->prepare(Kayttajat::PAIVITA_P);
    $stmt->bindValue(':kayttajatunnus', puhdistaTagit($kayttajatunnus));
    $stmt->bindValue(':etunimi', puhdistaTagit($etunimi));
    $stmt->bindValue(':sukunimi', puhdistaTagit($sukunimi));
    $stmt->bindValue(':kuva', puhdistaTagit($kuva));
    $stmt->bindValue(':kuvaus', puhdistaTagit($kuvaus));

    return $stmt->execute();
  } // PAIVITA_END


  // ONKO_SEURATTU ======================================================
  static function onkoSeurattu(
    $db,
    $seuraaja,
    $seurattava
  )
  {

  }

}


?>