<?php
  // Haetaan tietokannam tiedot
  require_once('./config.php');

  try {
    $conn = "mysql:host=$hostname;dbname=$dbname";
    $db = new PDO($conn, $kayttaja, $salasana);
  } catch (PDOException $e) {
    print ("Tietokantaan ei voitu muodostaa yhteyttä...\n");
    print ("Virhe ".$e->getCode ()."\n");
    print ("Viesti: ".$e->getMessage ()."\n");
  }

?>