<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="Style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
</head>
<body>
  <div class="keiAhnig">
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    try {
    $conn = new PDO("mysql:host=$servername;dbname=book", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    }
    ?>
    <?php
    $suche = "";
    $valueFürButton = "0 or verkauft like 1)";
    if ($_SERVER['REQUEST_METHOD']== 'POST' 
    && isset($_POST['Search'])
    && !empty ($_POST['Search'])) {
        $suche = $_POST['Search'];
    }
    $verkauft = $valueFürButton;
    $zustand = "";
    $sortierenNach = "kurztitle asc";
    if ($_SERVER['REQUEST_METHOD']== 'POST') {
      if (isset($_POST['istVerkauft'])){
        if ($_POST['istVerkauft'] !="2"){
          $verkauft = $_POST['istVerkauft'];
        }
        else {
          $verkauft = $valueFürButton;
        }
      }
      if (isset($_POST['S'])) {
        $zustand = $zustand .$_POST['S'];
      }
      if (isset($_POST['M'])) {
        $zustand = $zustand .$_POST['M'];
      }
      if (isset($_POST['G'])) {
        $zustand = $zustand .$_POST['G'];
      }
      if (isset($_POST['wieSortieren'])) {
        $sortierenNach = $_POST['wieSortieren'];
      }
    }
    ?>
    <div class="header">
      <img src="Icons/Bookstorm.svg" alt="Bookstorm logo">
      <div class="nav">
        <a href="index.php">Startseite</a>
        <a href="buecher.php">Bücher</a>
        <a href="ueber_uns.php">Über uns</a>
        <a href="admin.php">Admin</a>
      </div>
    </div>
    <div class="sotials">
      <img class="linkedin" src="Icons/linkedin-svgrepo-com.svg" alt="linkedin">
      <img src="Icons/instagram.svg" alt="instagramm">
      <img src="Icons/facebook.svg" alt="facebook">
      <div class="line"></div>
    </div>
    <div class="wrapper">
      <div class="suchsystem">
        <button class="toggleFilter" onclick="toggleFilter()">Filter</button>
        <button class="toggleFilter" onclick="toggleSortier()">Sortieren</button>
        <form class="suchFilterFormular" action="buecher.php" method="post" autocomplete="off">
          <input type="text" name="Search" id="Search" value="<?php echo $suche; ?>">
          <input type="submit" name="submit" value="Suchen" class="submit">
      </div>
          <div id="FilterDiv">
            <div class="inFilterDiv">
              <div class="inInFilterDiv">
                <h3>Filter:</h3>
                </br></br>
                <p>Verfügbarkeit:</p><br>
                <p>
                  <input type="radio" id="verkauft" name="istVerkauft" value="1)">
                  <label for="verkauft">verkauft</label>
                </p>
                <p>
                  <input type="radio" id="nicht verkauft" name="istVerkauft" value="0)">
                  <label for="nicht verkauft">nicht verkauft</label>
                </p>
                <p>
                  <input type="radio" id="alle" name="istVerkauft" value=2 checked>
                  <label for="alle">alle</label>
                </p></br></br>
                <p>Zustand:</p><br>
                <p>
                  <input type="checkbox" id="S" name="S" value="S">
                  <label for="S">S</label>
                </p>
                <p>
                  <input type="checkbox" id="M" name="M" value="M">
                  <label for="M">M</label>
                </p>
                <p>
                  <input type="checkbox" id="G" name="G" value="G">
                  <label for="G">G</label>
                </p>
                <script>
                  var x = document.getElementById("FilterDiv");
                  x.style.display = "none";
                function toggleFilter() {
                  var x = document.getElementById("FilterDiv");
                  if (x.style.display === "none") {
                    x.style.display = "flex";
                  } else {
                    x.style.display = "none";
                  }
                }
                </script>
              </div>
            </div>
          </div>
          <div id="SortierDiv">
            <div class="SortierDiv">
              <div class="inSortierDiv">
              <div class="inInFilterDiv">
                  <h3>Sortieren:</h3>
                  </br></br>
                    <input type="radio" id="autora-z" name="wieSortieren" value="autor asc">
                    <label for="autora-z">Autor (a-z)</label>
                  </p></br>
                  <p>
                    <input type="radio" id="autorz-a" name="wieSortieren" value="autor desc">
                    <label for="autorz-a">Autor (z-a)</label>
                  </p></br>
                  <p>
                    <input type="radio" id="titela-z" name="wieSortieren" value="kurztitle asc" checked>
                    <label for="titela-z">titel (a-z)</label>
                  </p></br>
                  <p>
                    <input type="radio" id="titelz-a" name="wieSortieren" value="kurztitle desc">
                    <label for="titelz-a">titel (z-a)</label>
                  </p></br>
                  <p>
                    <input type="radio" id="kategoriea-z" name="wieSortieren" value="kategorie asc">
                    <label for="kategoriea-z">Kategorie (a-z)</label>
                  </p></br>
                  <p>
                    <input type="radio" id="kategoriez-a" name="wieSortieren" value="kategorie desc">
                    <label for="kategoriea-z">Kategorie (z-a)</label>
                  </p></br>
                  <p>
                    <input type="radio" id="kataloga-z" name="wieSortieren" value="katalog asc">
                    <label for="katalora-z">Katalog (a-z)</label>
                  </p></br>
                  <p>
                    <input type="radio" id="katalogz-a" name="wieSortieren" value="katalog desc">
                    <label for="katalorz-a">katalog (z-a)</label>
                  </p></br>
                  <p>
                    <input type="radio" id="nummera-z" name="wieSortieren" value="nummer asc">
                    <label for="nummera-z">nummer (a-z)</label>
                  </p></br>
                  <p>
                    <input type="radio" id="nummerz-a" name="wieSortieren" value="nummer desc">
                    <label for="nummerz-a">nummer (z-a)</label>
                  </p>
                  <script>
                    var x = document.getElementById("SortierDiv");
                    x.style.display = "none";
                  function toggleSortier() {
                    var x = document.getElementById("SortierDiv");
                    if (x.style.display === "none") {
                      x.style.display = "flex";
                    } else {
                      x.style.display = "none";
                    }
                  }
                  </script>
                </div>
              </div>
            </div>
          </div>
        </form>
      <div class="books">
        <?php
        $sql = "SELECT * FROM buecher WHERE (katalog LIKE '%". $suche."%' OR nummer LIKE '%". $suche."%' OR autor LIKE '%". $suche."%' OR kurztitle LIKE '%". trim($suche)."%')";
          $append1 = " AND (verkauft LIKE " . $verkauft;
          $sql = $sql .$append1;
          $warInForLoop = false;
          for ($j = 0; $j < strlen($zustand); $j++) {
            if ($j == 0) {
              $append2 = " AND (zustand LIKE '" . $zustand[$j] . "'";
            }
            else {
              $append2 = " OR zustand LIKE '" . $zustand[$j] . "'";
            }
            $sql = $sql . $append2;
            $warInForLoop = true;
          }
          if ($warInForLoop == true){
            $sql = $sql . ")";
          }
          $sql = $sql . " ORDER BY " . $sortierenNach . ";";
        $i = 1;
        foreach ($conn->query($sql) as $row) {
          echo
          '<div class="book">'
          .'<div class="bookimage">';
          if ($i % 3 == 0) {
            echo '<img src="Icons/Book3.png" alt="Bookcover">';
            $i = 0;
          }
          else if ($i % 2 == 0) {
            echo '<img src="Icons/Book2.png" alt="Bookcover">';
          }
          else {
            echo '<img src="Icons/Book1.png" alt="Bookcover">';
          }
          echo
          '</div>'
          .'<p>'. $row["kurztitle"]. '</p>'
          .'<p>'."Von: ".$row["autor"]. '</p>'
          .'</div>';
          $i++;
        }
        if ($i == 1) {
          echo '<h1>Keine Suchergebnisse</h1>';
        }
        ?>
      </div>
      <div class="blätter">

      </div>
      </div>
      
      </div>
      <div class="footer">
        <p>Impressum</p>
        <p>Datenschutz</p>
        <p>Nutzungsbedingungen</p>
        <p>bookstorm© 2024</p>
      </div>
  </div>
</body>
</html>