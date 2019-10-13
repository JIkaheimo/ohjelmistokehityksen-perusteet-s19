<?php 
  require_once(__DIR__.'/Komponentit/Header/header.php'); 
  Headeri('Rekisteröidy');

  if ($kayttaja) {
     header('Location: index.php');
  }
?>

<header>
  <h1 class='keskella'>Rekisteröityminen</h1>
</header>

<form id='rek-lomake' class='keskita' action='./Api/rekisteroidy.php' method='POST'>
  <div>
    <label for='rek-kayttajatunnus'>Käyttäjätunnus</label>
    <input
      type='text'
      name='rek-kayttajatunnus'
      id='rek-kayttajatunnus'
      required=''
    />
  </div>
  <div>
    <label for='rek-salasana'>Salasana</label>
    <input
      type='password'
      name='rek-salasana'
      id='rek-salasana'
      required=''
    />
  </div>
  <div>
    <label for='rek-salasana-2'>Vahvista salasana</label>
    <input
      type='password'
      name='rek-salasana-2'
      id='rek-salasana-2'
      required=''
    />
  </div>

  <div>
    <button id='rek-nappi' class='nappi-p' type='submit'>Rekisteröidy</button>
    <a class='nappi nappi-s' href='index.php'>Takaisin</a>
  </div>
</form>

<script src='./Scripts/rekisteroidy.js'></script>
   
<?php 
  require_once(__DIR__.'/Komponentit/footer.php');
  Footer();
?>