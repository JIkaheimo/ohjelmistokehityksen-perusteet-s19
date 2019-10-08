<?php

abstract class Kayttajat
{
  // QUERYT ================================================================
  const HAE_KAIKKI = '
  SELECT 
    * 
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
  static function hae(PDO $db) 
  { 
    $stmt = $db->query(Kayttajat::HAE_KAIKKI);
    if ($stmt->execute()) return $stmt->fetchAll(PDO::FETCH_OBJ);
    return false;
  } // HAE_END

  
  // KAYTTAJA_SALASANALLA ==================================================
  static function kayttajaSalasanalla(
    PDO $db,
    string $kayttajatunnus
  )
  {
    $stmt = $db->prepare('SELECT * FROM Kayttajat WHERE kayttajatunnus = :kayttajatunnus');
    $stmt->bindValue(':kayttajatunnus', $kayttajatunnus);
    if ($stmt->execute()) return $stmt->fetch(PDO::FETCH_OBJ);
    return false;
  } // KAYTTAJA_SALASANALLA_END


  // KAYTTAJA =============================================================
  static function kayttaja(
    PDO $db,
    string $kayttajatunnus
  )
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
    PDO $db,
    string $kayttajatunnus,
    string $salasanaHash
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
    PDO $db,
    string $kayttajatunnus, 
    string $etunimi, 
    string $sukunimi, 
    string $kuva, 
    string $kuvaus
  ) 
  {
    $stmt = $db->prepare(Kayttajat::PAIVITA_P);
    $stmt->bindValue(':kayttajatunnus', puhdistaTagit($kayttajatunnus));
    $stmt->bindValue(':etunimi', puhdistaTagit($etunimi));
    $stmt->bindValue(':sukunimi', puhdistaTagit($sukunimi));
    $stmt->bindValue(':kuva', $kuva);
    $stmt->bindValue(':kuvaus', puhdistaTagit($kuvaus));

    return $stmt->execute();
  } // PAIVITA_END


  // ONKO_SEURATTU ======================================================
  static function onkoSeurattu(
    PDO $db,
    string $seuraaja,
    string $seurattava
  )
  {

  }

}


?>