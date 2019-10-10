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


  // LISAA ================================================
  static function lisaa(
    $db, 
    $seuraaja,
    $seurattava 
  ) 
  {
    $stmt = $db->prepare(Suoritukse::LISAA_UUSI);
    $stmt->bindValue(':seuraaja', $seuraaja);
    $stmt->bindValue(':seurattava', $seurattava);

    return $stmt->execute();
  } // LISAA_END


  // POISTA ==================================================
  static function poista(
    $db,
    $seuraaja,
    $seurattava
  ) 
  {
    $stmt = $db->prepare(Seuraukset::POISTA);
    $stnt->bindValue(':seuraaja', $seuraaja);
    $stmt->bindValue(':seurattava', $seurattava); 
  } // POISTA_END

}