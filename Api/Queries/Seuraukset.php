<?php

abstract class Seuraukset
{
  // QUERYT ============================================
  const HAE_KAIKKI = '
  SELECT * FROM Seuraukset';

  const HAE_YKSI = Seuraukset::HAE_KAIKKI . '
  WHERE seuraaja = :seuraaja AND seurattava = :seurattava';

  const LISAA_UUSI = '
  INSERT INTO 
    Seuraukset (seuraaja, seurattava)
  VALUES
    (:seuraaja, :seurattava)';

  const POISTA = '
  DELETE FROM
    Seuraukset
  WHERE
    seuraaja = :seuraaja
  AND 
    seurattava = :seurattava';

  
  // HAE ==================================================
  static function hae(
    $db,
    $seuraaja = null,
    $seurattava = null
  )
  {
    if ($seuraaja == null || $seurattava == null) return $db->query(Seuraukset::HAE_KAIKKI)->fetchAll(PDO::FETCH_OBJ);

    $stmt = $db->prepare(Seuraukset::HAE_YKSI);
    $stmt->bindValue(':seuraaja', $seuraaja);
    $stmt->bindValue(':seurattava', $seurattava);
    if ($stmt->execute()) return $stmt->fetch(PDO::FETCH_OBJ);
    return false;
  } // HAE_END 


  // LISAA ================================================
  static function lisaa(
    $db, 
    $seuraaja,
    $seurattava 
  ) 
  {
    $stmt = $db->prepare(Seuraukset::LISAA_UUSI);
    $stmt->bindValue(':seuraaja', $seuraaja);
    $stmt->bindValue(':seurattava', $seurattava);

    return $stmt->execute();
  } // LISAA_END


  // UUSI ===================================================
  static function uusi(
    $db,
    $seuraaja,
    $seurattava
  )
  {
    return Seuraukset::lisaa($db, $seuraaja, $seurattava);
  } // UUSI_END


  // POISTA ==================================================
  static function poista(
    $db,
    $seuraaja,
    $seurattava
  ) 
  {
    $stmt = $db->prepare(Seuraukset::POISTA);
    $stmt->bindValue(':seuraaja', $seuraaja);
    $stmt->bindValue(':seurattava', $seurattava); 
    return $stmt->execute();
  } // POISTA_END

}