<?php

  class Database 
  {
    private $host;
    private $tietokanta;
    private $kayttaja;
    private $salasana;

    private $yhteys;

    public function __construct($host, $tietokanta, $kayttaja, $salasana) 
    {
      $this->host = $host;
      $this->tietokanta = $tietokanta;
      $this->kayttaja = $kayttaja;
      $this->salasana = $salasana;
    }

    public function yhdista() 
    {
      $this->yhteys = null;

      try 
      {
        $this->yhteys = new PDO("mysql:host={$this->host};dbname={$this->tietokanta}", $this->kayttaja, $this->salasana);
      } 
      catch (PDOException $e) 
      {
        echo("Tapahtui virhe yhdistäessä tietokantaan: {$e->getMessage()}");
        die();
      }

      $this->yhteys->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
      $this->yhteys->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
      $this->yhteys->exec('set names utf8');

      return $this->yhteys;
    }
  }

  // Haetaan tarvittavat tiedot yhteyden muotostamiseen.
  require_once('config.php');
  
  $database = new Database(HOSTNAME, DBNAME, KAYTTAJA, SALASANA);
  $db = $database->yhdista();

?>