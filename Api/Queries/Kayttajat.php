<?php

abstract class Kayttajat
{
  // QUERYT ================================================================
  const HAE_KAIKKI_JULKINEN = '
  SELECT 
    Kayttajat.kayttajatunnus,
    Kayttajat.kuvaus,
    Kayttajat.kuva,
    COUNT(Seuraukset.seurattava) AS seurauksia
  FROM 
    Kayttajat
  LEFT JOIN
    Seuraukset
  ON
    Kayttajat.kayttajatunnus = Seuraukset.seurattava
  GROUP BY
    Kayttajat.kayttajatunnus';

  const HAE_SUOSITUIMMAT = Kayttajat::HAE_KAIKKI_JULKINEN . '
  ORDER BY 
    seurauksia DESC
  LIMIT 
    4';


  // PROSEDUURIT ==========================================================
  const HAE_YKSI_P = '
  CALL HaeKayttaja(
    :kayttajatunnus
  )';

  const HAE_SEURATUT_P = '
  CALL HaeSeuratut(
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
  /**
   * Suorittaa käyttäjien haun tietokannasta.
   */
  { 
    $stmt = $db->query(Kayttajat::HAE_KAIKKI_JULKINEN);

    if ($stmt->execute()) return $stmt->fetchAll(PDO::FETCH_OBJ);
    return false;
  } // HAE_END


  // SUOSITUIMMAT =========================================================
  static function suosituimmat($db)
  /**
   * Suorittaa suosituimpien käyttäjien haun tietokannasta.
   */
  {
    $stmt = $db->query(Kayttajat::HAE_SUOSITUIMMAT);

    if ($stmt->execute()) return $stmt->fetchAll(PDO::FETCH_OBJ);
    return false;
  } // SUOSITUIMMAT_END


  // SEURATUT =============================================================
  static function seuratut($db, $kayttajatunnus)
  {
    $stmt = $db->prepare(Kayttajat::HAE_SEURATUT_P);
    $stmt->bindValue(':kayttajatunnus', $kayttajatunnus);
    
    if ($stmt->execute()) return $stmt->fetchAll(PDO::FETCH_OBJ);
  } // SEURATUT_END
  

  // KAYTTAJA_SALASANALLA ==================================================
  static function kayttajaSalasanalla(
    $db,
    $kayttajatunnus
  )
  /**
   * Hakee käyttäjän tiedot tietokannasta salasanan kera.
   */
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
   * - $kayttaja - Tietokannasta haettu käyttäjä tai null, jos käyttäjää ei löydy.
   */
  {
    $stmt = $db->prepare(Kayttajat::HAE_YKSI_P);
    $stmt->bindValue(':kayttajatunnus', $kayttajatunnus);

    if (!$stmt->execute()) return false;
    
    $kayttaja = $stmt->fetch(PDO::FETCH_OBJ);

    // Palautetaan null jos käyttäjää ei ole olemassa.
    if (!isset($kayttaja->kayttajatunnus)) return null;

    return $kayttaja;

  } // KAYTTAJA_END


  // UUSI_KAYTTAJA ========================================================
  static function uusiKayttaja(
    $db, // (PDO)
    $kayttajatunnus, // (string)
    $salasanaHash // (string)
  ) 
  /**
   * Lisää uuden käyttäjän tietokantaan.
   * 
   * PARAMS:
   * - $db (PDO)
   * - $kayttajatunnus (string) lisättävä käyttäjätunnus
   * - $salasanahash (string) käyttäjän hashattu (bcrypt) salasana
   */
  {
    $stmt = $db->prepare(Kayttajat::LISAA_UUSI_P);
    $stmt->bindValue(':kayttajatunnus', puhdistaTagit($kayttajatunnus));
    $stmt->bindValue(':salasanaHash', $salasanaHash);

    return $stmt->execute();
  } // UUSI_END


  // PAIVITA ==========================================================
  static function paivita(
    $db, // (PDO)
    $kayttajatunnus, // (string) 
    $etunimi, // (string)
    $sukunimi, // (string)
    $kuva, // (string)
    $kuvaus // (string)
  ) 
  /**
   * Päivittää annetun käyttäjän tiedot tietokantaan.
   * 
   * PARAMS:
   * - $db (PDO)
   * - $kayttajatunnus (string) päivitettävä käyttäjätunnus
   * - $etunimi (string) käyttäjän etunimi
   * - $sukunimi (string) käyttäjän sukunimi
   * - $kuva (string) käyttäjän kuvan nimi
   * - $kuvaus (string) kuvaus käyttäjästä
   */
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
    return !empty(Seuraukset::hae($db, $seuraaja, $seurattava));
  }

}


?>