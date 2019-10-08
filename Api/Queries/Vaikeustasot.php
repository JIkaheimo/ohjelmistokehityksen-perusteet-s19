<?php

abstract class Vaikeustasot
{
  const HAE_KAIKKI = 'SELECT * FROM Vaikeustasot';

  // HAE ===================================================================
  static function hae(PDO $db)
  {
    return $db->query(Vaikeustasot::HAE_KAIKKI)
      ->fetchAll(PDO::FETCH_OBJ);
  } // HAE_END
}

?>