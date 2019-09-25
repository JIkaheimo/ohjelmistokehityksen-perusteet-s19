<?php 
  function HeaderVieras($otsikko) { 
    require_once(__DIR__.'/header.php');
    Header_($otsikko);
?>

<header>
  <nav class="kapea">
    <a href="index.php">REENIKIRJA</a>
    <form class="oikealle flex" action="./Api/kirjaudu.php" method="POST">
      <div>
        <label for="kayttajatunnus">Käyttäjätunnus:</label>
        <input
          type="text"
          name="kayttajatunnus"
          id="kayttajatunnus"
          required
        />
      </div>

      <div>
        <label for="salasana">Salasana:</label>
        <input type="password" name="salasana" id="salasana" required />
      </div>

      <button class="nappi-p" type="submit">Kirjaudu</button>
    </form>
  </nav>
</header>

<main class="kapea">

<?php } ?>

