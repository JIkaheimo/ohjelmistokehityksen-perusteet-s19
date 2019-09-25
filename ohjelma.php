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
    <input type="hidden" name="ohjelma-id" id="ohjelma-id" value="12" />
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
      <tr class="vaihe-tr">
        <th>Vatsalihaskone</th>
        <td>
          Sed vitae purus nec nulla volutpat gravida vestibulum a purus.
        </td>
        <td></td>
      </tr>

      <!-- TODO: Syötä erillisten parametrien sijasta koko vaihe... -->

      <tr class="vaihe-tr">
        <th>Vino vatsalihaspenkki</th>
        <td>
          Nulla nec quam et mi rhoncus gravida. Quisque ac consectetur
          ligula, in hendrerit est.
        </td>
        <td>
          <a href="https://www.google.fi">Linkki</a>
        </td>
      </tr>

      <!-- TODO: Syötä erillisten parametrien sijasta koko vaihe... -->

      <tr class="vaihe-tr">
        <th>Ilmapyörä</th>
        <td>
          Nulla nec quam et mi rhoncus gravida. Sed vitae purus nec nulla
          volutpat gravida vestibulum a purus. Quisque ac consectetur
          ligula, in hendrerit est.
        </td>
        <td></td>
      </tr>

      <!-- TODO: Syötä erillisten parametrien sijasta koko vaihe... -->

      <tr class="vaihe-tr">
        <th>Jalannosto</th>
        <td>
          Nulla nec quam et mi rhoncus gravida. Sed vitae purus nec nulla
          volutpat gravida vestibulum a purus. Quisque ac consectetur
          ligula, in hendrerit est.
        </td>
        <td></td>
      </tr>

      <!-- TODO: Syötä erillisten parametrien sijasta koko vaihe... -->

      <tr class="vaihe-tr">
        <th>Juoksu</th>
        <td>
          Nulla nec quam et mi rhoncus gravida. Quisque ac consectetur
          ligula, in hendrerit est.
        </td>
        <td></td>
      </tr>
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
      <!-- TODO: Syötä erillisten parametrien sijasta koko vaihe... -->

      <tr class="vaihe-tr">
        <th>Vatsalihaskone</th>
        <td>
          Sed vitae purus nec nulla volutpat gravida vestibulum a purus.
        </td>
        <td></td>
      </tr>

      <!-- TODO: Syötä erillisten parametrien sijasta koko vaihe... -->

      <tr class="vaihe-tr">
        <th>Vino vatsalihaspenkki</th>
        <td>
          Nulla nec quam et mi rhoncus gravida. Quisque ac consectetur
          ligula, in hendrerit est.
        </td>
        <td>
          <a href="https://www.google.fi">Linkki</a>
        </td>
      </tr>

      <!-- TODO: Syötä erillisten parametrien sijasta koko vaihe... -->

      <tr class="vaihe-tr">
        <th>Ilmapyörä</th>
        <td>
          Nulla nec quam et mi rhoncus gravida. Sed vitae purus nec nulla
          volutpat gravida vestibulum a purus. Quisque ac consectetur
          ligula, in hendrerit est.
        </td>
        <td></td>
      </tr>

      <!-- TODO: Syötä erillisten parametrien sijasta koko vaihe... -->

      <tr class="vaihe-tr">
        <th>Jalannosto</th>
        <td>
          Nulla nec quam et mi rhoncus gravida. Sed vitae purus nec nulla
          volutpat gravida vestibulum a purus. Quisque ac consectetur
          ligula, in hendrerit est.
        </td>
        <td></td>
      </tr>

      <!-- TODO: Syötä erillisten parametrien sijasta koko vaihe... -->

      <tr class="vaihe-tr">
        <th>Juoksu</th>
        <td>
          Nulla nec quam et mi rhoncus gravida. Quisque ac consectetur
          ligula, in hendrerit est.
        </td>
        <td></td>
      </tr>
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
      <!-- TODO: Syötä erillisten parametrien sijasta koko vaihe... -->

      <tr class="vaihe-tr">
        <th>Vatsalihaskone</th>
        <td>
          Sed vitae purus nec nulla volutpat gravida vestibulum a purus.
        </td>
        <td></td>
      </tr>

      <!-- TODO: Syötä erillisten parametrien sijasta koko vaihe... -->

      <tr class="vaihe-tr">
        <th>Vino vatsalihaspenkki</th>
        <td>
          Nulla nec quam et mi rhoncus gravida. Quisque ac consectetur
          ligula, in hendrerit est.
        </td>
        <td>
          <a href="https://www.google.fi">Linkki</a>
        </td>
      </tr>

      <!-- TODO: Syötä erillisten parametrien sijasta koko vaihe... -->

      <tr class="vaihe-tr">
        <th>Ilmapyörä</th>
        <td>
          Nulla nec quam et mi rhoncus gravida. Sed vitae purus nec nulla
          volutpat gravida vestibulum a purus. Quisque ac consectetur
          ligula, in hendrerit est.
        </td>
        <td></td>
      </tr>

      <!-- TODO: Syötä erillisten parametrien sijasta koko vaihe... -->

      <tr class="vaihe-tr">
        <th>Jalannosto</th>
        <td>
          Nulla nec quam et mi rhoncus gravida. Sed vitae purus nec nulla
          volutpat gravida vestibulum a purus. Quisque ac consectetur
          ligula, in hendrerit est.
        </td>
        <td></td>
      </tr>

      <!-- TODO: Syötä erillisten parametrien sijasta koko vaihe... -->

      <tr class="vaihe-tr">
        <th>Juoksu</th>
        <td>
          Nulla nec quam et mi rhoncus gravida. Quisque ac consectetur
          ligula, in hendrerit est.
        </td>
        <td></td>
      </tr>
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
      <!-- TODO: Syötä erillisten parametrien sijasta koko vaihe... -->

      <tr class="vaihe-tr">
        <th>Vatsalihaskone</th>
        <td>
          Sed vitae purus nec nulla volutpat gravida vestibulum a purus.
        </td>
        <td></td>
      </tr>

      <!-- TODO: Syötä erillisten parametrien sijasta koko vaihe... -->

      <tr class="vaihe-tr">
        <th>Vino vatsalihaspenkki</th>
        <td>
          Nulla nec quam et mi rhoncus gravida. Quisque ac consectetur
          ligula, in hendrerit est.
        </td>
        <td>
          <a href="https://www.google.fi">Linkki</a>
        </td>
      </tr>

      <!-- TODO: Syötä erillisten parametrien sijasta koko vaihe... -->

      <tr class="vaihe-tr">
        <th>Ilmapyörä</th>
        <td>
          Nulla nec quam et mi rhoncus gravida. Sed vitae purus nec nulla
          volutpat gravida vestibulum a purus. Quisque ac consectetur
          ligula, in hendrerit est.
        </td>
        <td></td>
      </tr>

      <!-- TODO: Syötä erillisten parametrien sijasta koko vaihe... -->

      <tr class="vaihe-tr">
        <th>Jalannosto</th>
        <td>
          Nulla nec quam et mi rhoncus gravida. Sed vitae purus nec nulla
          volutpat gravida vestibulum a purus. Quisque ac consectetur
          ligula, in hendrerit est.
        </td>
        <td></td>
      </tr>

      <!-- TODO: Syötä erillisten parametrien sijasta koko vaihe... -->

      <tr class="vaihe-tr">
        <th>Juoksu</th>
        <td>
          Nulla nec quam et mi rhoncus gravida. Quisque ac consectetur
          ligula, in hendrerit est.
        </td>
        <td></td>
      </tr>
    </tbody>
  </table>
</section>

<?php 
  require_once(__DIR__.'/Komponentit/footer.php');
  Footer();
?>