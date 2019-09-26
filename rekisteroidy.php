<?php 
  require_once(__DIR__.'/Komponentit/Header/header_vieras.php'); 
  HeaderVieras('Rekisteröidy');
?>

<header>
  <h1 class="keskella">Rekisteröityminen</h1>
</header>

<form class="keskita" action="./Api/rekisteroidy.php">
  <div>
    <label for="rek-kayttajatunnus">Käyttäjätunnus</label>
    <input
      type="text"
      name="rek-kayttajatunnus"
      id="rek-kayttajatunnus"
      required=""
    />
  </div>
  <div>
    <label for="rek-salasana-1">Salasana</label>
    <input
      type="password"
      name="rek-salasana-1"
      id="rek-salasana-1"
      required=""
    />
  </div>
  <div>
    <label for="rek-salasana-2">Vahvista salasana</label>
    <input
      type="password"
      name="rek-salasana-2"
      id="rek-salasana-2"
      required=""
    />
  </div>

  <div>
    <button class="nappi-p" type="submit">Rekisteröidy</button>
    <a class="nappi nappi-s" href="index.php">Takaisin</a>
  </div>
</form>
   
<?php 
  require_once(__DIR__.'/Komponentit/footer.php');
  Footer();
?>