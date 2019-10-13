<!--
  Näkymä serverissä tapahtuneelle virheelle (ei käytetty)
-->

<?php 
  require_once(__DIR__.'/Komponentit/Header/header.php'); 
  Headeri('Error 400');
?>

<h1>Virhe 400</h1>
<p>Palvelin ei valitettavasti pystynyt tunnistamaan pyyntöäsi... :/</p>


<?php 
  require_once(__DIR__.'/Komponentit/footer.php');
  Footer();
?>
