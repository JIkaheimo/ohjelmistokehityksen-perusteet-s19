<?php 
  if (!isset($_GET['id'])) {
    http_response_code(404);
    header('Location: 404.php');
    exit;
  }
  // TODO: Tähän kirjautumisen varmistus.

  $ohjelmaID = $_GET['id'];

  // TODO: Tähän ohjelman, harjoitusten ja vaiheiden haku tietokannasta.

  require_once(__DIR__.'/Komponentit/Header/header_kirjautunut.php'); 
  HeaderKirjautunut('Ohjelmat');
?>
      
<header>
  <h1>4-jakoinen kuntosaliohjelma aloittelijoille</h1>
  <form action="./Api/lisaa_ohjelma.php" method="POST">
    <input type="hidden" name="ohjelma-id" id="ohjelma-id" value=<?=$ohjelmaID?>>
    <button type="submit" class="nappi-p">Lisää+</button>
  </form>
</header>

<p>Tekijä: <a href="kayttaja.php?id=123">Testaaja123</a></p>

<section>
  <header>
    <h2>Vatsa</h2>
  </header>  
  <table>
    <thead>
      <tr>
        <th>Vaihe</th>
        <th>Kuvaus</th>
        <th>Ohjelinkki</th>
      </tr>
    </thead>
    <tbody>
      <?php
        require_once(__DIR__.'/Komponentit/Vaiheet/vaihe_tr.php');

        VaiheTR('Vatsalihaskone', 'Sed vitae purus nec nulla volutpat gravida vestibulum a purus.', null, 1, false);
        VaiheTR('Vino vatsalihaspenkki', 'Nulla nec quam et mi rhoncus gravida. Quisque ac consectetur ligula, in hendrerit est.', 'https://www.google.fi', 2,  false);
        VaiheTR('Ilmapyörä', 'Nulla nec quam et mi rhoncus gravida. Sed vitae purus nec nulla volutpat gravida vestibulum a purus. Quisque ac consectetur ligula, in hendrerit est.', null, 3, false);
        VaiheTR('Jalannosto', 'Nulla nec quam et mi rhoncus gravida. Sed vitae purus nec nulla volutpat gravida vestibulum a purus. Quisque ac consectetur ligula, in hendrerit est.', null, 4, false);
        VaiheTR('Juoksu', 'Nulla nec quam et mi rhoncus gravida.  Quisque ac consectetur ligula, in hendrerit est.', null, 5, false);
      ?>
    </tbody>
  </table>
</section>

<section>
  <header>
    <h2>Rinta/Ojentajat</h2>
  </header>   
  <table>
    <thead>
      <tr>
        <th>Vaihe</th>
        <th>Kuvaus</th>
        <th>Ohjelinkki</th>
      </tr>
    </thead>
    <tbody>
      <?php
        require_once(__DIR__.'/Komponentit/Vaiheet/vaihe_tr.php');

        VaiheTR('Vatsalihaskone', 'Sed vitae purus nec nulla volutpat gravida vestibulum a purus.', null, 1, false);
        VaiheTR('Vino vatsalihaspenkki', 'Nulla nec quam et mi rhoncus gravida. Quisque ac consectetur ligula, in hendrerit est.', 'https://www.google.fi', 2,  false);
        VaiheTR('Ilmapyörä', 'Nulla nec quam et mi rhoncus gravida. Sed vitae purus nec nulla volutpat gravida vestibulum a purus. Quisque ac consectetur ligula, in hendrerit est.', null, 3, false);
        VaiheTR('Jalannosto', 'Nulla nec quam et mi rhoncus gravida. Sed vitae purus nec nulla volutpat gravida vestibulum a purus. Quisque ac consectetur ligula, in hendrerit est.', null, 4, false);
        VaiheTR('Juoksu', 'Nulla nec quam et mi rhoncus gravida.  Quisque ac consectetur ligula, in hendrerit est.', null, 5, false);
      ?>
    </tbody>
  </table>
</section>

<section>
  <header>
    <h2>Selkä/Hauis</h2>
  </header>  
  <table>
    <thead>
      <tr>
        <th>Vaihe</th>
        <th>Kuvaus</th>
        <th>Ohjelinkki</th>
      </tr>
    </thead>
    <tbody>
      <?php
        require_once(__DIR__.'/Komponentit/Vaiheet/vaihe_tr.php');

        VaiheTR('Vatsalihaskone', 'Sed vitae purus nec nulla volutpat gravida vestibulum a purus.', null, 1, false);
        VaiheTR('Vino vatsalihaspenkki', 'Nulla nec quam et mi rhoncus gravida. Quisque ac consectetur ligula, in hendrerit est.', 'https://www.google.fi', 2,  false);
        VaiheTR('Ilmapyörä', 'Nulla nec quam et mi rhoncus gravida. Sed vitae purus nec nulla volutpat gravida vestibulum a purus. Quisque ac consectetur ligula, in hendrerit est.', null, 3, false);
        VaiheTR('Jalannosto', 'Nulla nec quam et mi rhoncus gravida. Sed vitae purus nec nulla volutpat gravida vestibulum a purus. Quisque ac consectetur ligula, in hendrerit est.', null, 4, false);
        VaiheTR('Juoksu', 'Nulla nec quam et mi rhoncus gravida.  Quisque ac consectetur ligula, in hendrerit est.', null, 5, false);
      ?>
    </tbody>
  </table>
</section>

<section>
  <header>
    <h2>Jalat/Olkapäät</h2>
  </header>  
  <table>
    <thead>
      <tr>
        <th>Vaihe</th>
        <th>Kuvaus</th>
        <th>Ohjelinkki</th>
      </tr>
    </thead>
    <tbody>
      <?php
        require_once(__DIR__.'/Komponentit/Vaiheet/vaihe_tr.php');

        VaiheTR('Vatsalihaskone', 'Sed vitae purus nec nulla volutpat gravida vestibulum a purus.', null, 1, false);
        VaiheTR('Vino vatsalihaspenkki', 'Nulla nec quam et mi rhoncus gravida. Quisque ac consectetur ligula, in hendrerit est.', 'https://www.google.fi', 2,  false);
        VaiheTR('Ilmapyörä', 'Nulla nec quam et mi rhoncus gravida. Sed vitae purus nec nulla volutpat gravida vestibulum a purus. Quisque ac consectetur ligula, in hendrerit est.', null, 3, false);
        VaiheTR('Jalannosto', 'Nulla nec quam et mi rhoncus gravida. Sed vitae purus nec nulla volutpat gravida vestibulum a purus. Quisque ac consectetur ligula, in hendrerit est.', null, 4, false);
        VaiheTR('Juoksu', 'Nulla nec quam et mi rhoncus gravida.  Quisque ac consectetur ligula, in hendrerit est.', null, 5, false);
      ?>
    </tbody>
  </table>
</section>

<?php 
  require_once(__DIR__.'/Komponentit/footer.php');
  Footer();
?>