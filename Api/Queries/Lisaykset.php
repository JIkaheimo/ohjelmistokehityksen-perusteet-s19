<?php

abstract class Lisaykset 
{
  // QUERYT ============================================================
  const HAE_KAIKKI = '
  SELECT * FROM
    Lisaykset';

  const LISAA_UUSI = '
  INSERT INTO 
    Lisaykset (kayttajatunnus, ohjelmaId)
  VALUES 
    (:kayttajatunnus, :ohjelmaId)';

  const POISTA = '
  DELETE FROM 
    Lisaykset
  WHERE 
    kayttajatunnus = :kayttajatunnus
  AND 
    ohjelmaId = :ohjelmaId';


  // HAE =============================================================
  static function hae($db) 
  {
    return $db->query(Lisaykset::HAE_KAIKKI)->fetchAll(PDO::FETCH_OBJ);
  } // HAE_END


  // LISAA ============================================================
  static function lisaa(
    $db,
    $kayttajatunnus,
    $ohjelmaId
  )
  {
    $stmt = $db->prepare(Lisaykset::LISAA_UUSI);
    $stmt->bindValue(':kayttajatunnus', $kayttajatunnus);
    $stmt->bindValue(':ohjelmaId', $ohjelmaId);
    return $stmt->execute();
  } // LISAA_END


  // UUSI =============================================================
  static function uusi(
    $db,
    $kayttajatunnus,
    $ohjelmaId
  )
  {
    return Lisaykset::lisaa($db, $kayttajatunnus, $ohjelmaId);
  } // UUSI_END


  // POISTA =============================================================
  static function poista(
    $db,
    $kayttajatunnus,
    $ohjelmaId
  )
  {
    $stmt = $db->prepare(Lisaykset::POISTA);
    $stmt->bindValue(':kayttajatunnus', $kayttajatunnus);
    $stmt->bindValue(':ohjelmaId', $ohjelmaId);
    return $stmt->execute();
  }
}