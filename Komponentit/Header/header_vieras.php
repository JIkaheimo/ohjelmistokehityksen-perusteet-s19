<?php function HeaderVieras($otsikko) { ?>

<header>
  <nav class='kapea'>
    <a href='index.php'>REENIKIRJA</a>

    <!-- KIRJAUTUMISLOMAKE -->
    <form id='kir-lomake' class='oikealle flex'>
      
      <!-- Käyttäjötunnus -->
      <div>
        <label for='kir-kayttajatunnus'>Käyttäjätunnus:</label>
        <input
          type='text'
          name='kayttajatunnus'
          id='kir-kayttajatunnus'
          required
        />
      </div>

      <!-- Salasana -->
      <div>
        <label for='kir-salasana'>Salasana:</label>
        <input type='password' name='salasana' id='kir-salasana' required />
      </div>

      <button class='nappi-p' type='submit'>Kirjaudu</button>
    </form>
  </nav>
</header>

<main class='kapea'>

<script src='./Scripts/header_vieras.js'></script>

<?php } ?>

