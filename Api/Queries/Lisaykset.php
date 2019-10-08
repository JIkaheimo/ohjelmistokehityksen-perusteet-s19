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
  static function hae(PDO $db) : Array
  {
    return $db->query(Lisaykset::HAE_KAIKKI)->fetchAll(PDO::FETCH_OBJ);
  } // HAE_END


  // LISAA ============================================================
  static function lisaa(
    PDO $db,
    string $kayttajatunnus,
    int $ohjelmaId
  )
  {
    $stmt = $db->prepare(Lisaykset::LISAA_UUSI);
    $stmt->bindValue(':kayttajatunnus', $kayttajatunnus);
    $stmt->bindValue(':ohjelmaId', $ohjelmaId);
    return $stmt->execute();
  } // LISAA_END


  // UUSI =============================================================
  static function uusi(
    PDO $db,
    string $kayttajatunnus,
    int $ohjelmaId
  )
  {
    return Lisaykset::lisaa($db, $kayttajatunnus, $ohjelmaId);
  } // UUSI_END


  // POISTA =============================================================
  static function poista(
    PDO $db,
    string $kayttajatunnus,
    int $ohjelmaId
  )
  {
    $stmt = $db->prepare(Lisaykset::POISTA);
    $stmt->bindValue(':kayttajatunnus', $kayttajatunnus);
    $stmt->bindValue(':ohjelmaId', $ohjelmaId);
    return $stmt->execute();
  }
}