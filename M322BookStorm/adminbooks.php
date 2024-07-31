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
  
  <?php
    session_start();
  ?>
</head>
<body>
  <div class="keiAhnig">
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    try {
    $conn = new PDO("mysql:host=$servername;dbname=book", $username, $password); // Verbindung zur db herstellen
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    }
    ?>
    <?php
    $suche = "";
    $valueFürButton = "0 or verkauft like 1)";   //Erstellen von default Values
    if ($_SERVER['REQUEST_METHOD'] == 'POST' 
    && isset($_POST['Search'])
    && !empty ($_POST['Search'])) {
        $suche = htmlspecialchars(trim($_POST['Search'])); //Such-eingabe validieren und als Wert einer Variabel zuordnen.
    }
    $verkauftUnecht = "2"; //Erstellen von default Values
    $verkauft = $valueFürButton;
    $zustand = "";
    $verfasser = "";
    $sortierenNach = "kurztitle asc";            //Erstellen der Variabeln für den Sql Befehl
    if ($_SERVER['REQUEST_METHOD']== 'POST') {
      if (isset($_POST['istVerkauft'])){
        $verkauftUnecht = $_POST['istVerkauft'];
        if ($_POST['istVerkauft'] !="2"){
          $verkauft = $_POST['istVerkauft'];
        }
        else {
          $verkauft = $valueFürButton;
        }
      }
      if (isset($_POST['S'])) {              //Erstellen der Variabeln für den Sql Befehl
        $zustand = $zustand .$_POST['S'];
      }
      if (isset($_POST['M'])) {
        $zustand = $zustand .$_POST['M'];
      }
      if (isset($_POST['G'])) {
        $zustand = $zustand .$_POST['G'];
      }
      if (isset($_POST['1'])) {
        $verfasser = $verfasser .$_POST['1'];
      }
      if (isset($_POST['2'])) {
        $verfasser = $verfasser .$_POST['2'];
      }
      if (isset($_POST['3'])) {
        $verfasser = $verfasser .$_POST['3'];
      }
      if (isset($_POST['4'])) {
        $verfasser = $verfasser .$_POST['4'];
      }
      if (isset($_POST['5'])) {
        $verfasser = $verfasser .$_POST['5'];
      }
      if (isset($_POST['6'])) {
        $verfasser = $verfasser .$_POST['6'];
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
    <div class="socials">
      <img class="linkedin" src="Icons/linkedin-svgrepo-com.svg" alt="linkedin">
      <img src="Icons/instagram.svg" alt="instagramm">
      <img src="Icons/facebook.svg" alt="facebook">
      <div class="line"></div>
    </div>
    <div class="wrapper">
      <div class="suchsystem">
        <button class="toggleFilter" onclick="toggleFilter()">Filter</button>
        <button class="toggleFilter" onclick="toggleSortier()">Sortieren</button>
        <form class="suchFilterFormular" action="adminbooks.php" method="post" autocomplete="off">
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
                  <input type="radio" id="verkauft" name="istVerkauft" value="1)" <?php if ($verkauft == "1)") {echo 'checked';} ?>>
                  <label for="verkauft">verkauft</label>
                </p>
                <p>
                  <input type="radio" id="nicht verkauft" name="istVerkauft" value="0)" <?php if ($verkauft == "0)") {echo 'checked';} ?>>
                  <label for="nicht verkauft">nicht verkauft</label>
                </p>
                <p>
                  <input type="radio" id="alle" name="istVerkauft" value="2" <?php if ($verkauftUnecht == "2") {echo 'checked';} ?>>
                  <label for="alle">alle</label>
                </p></br></br>
                <p>Zustand:</p><br>
                <p>
                  <input type="checkbox" id="S" name="S" value="S" <?php if (str_contains($zustand,"S")) {echo 'checked';} ?>>
                  <label for="S">S</label>
                </p>
                <p>
                  <input type="checkbox" id="M" name="M" value="M" <?php if (str_contains($zustand,"M")) {echo 'checked';} ?>>
                  <label for="M">M</label>
                </p>
                <p>
                  <input type="checkbox" id="G" name="G" value="G" <?php if (str_contains($zustand,"G")) {echo 'checked';} ?>>
                  <label for="G">G</label>
                </p>
                <p>
                  <input type="checkbox" id="S" name="1" value="1" <?php if (str_contains($verfasser,"1")) {echo 'checked';} ?>>
                  <label for="1">1</label>
                </p>
                <p>
                  <input type="checkbox" id="2" name="2" value="2" <?php if (str_contains($verfasser,"2")) {echo 'checked';} ?>>
                  <label for="2">2</label>
                </p>
                <p>
                  <input type="checkbox" id="3" name="3" value="3" <?php if (str_contains($verfasser,"3")) {echo 'checked';} ?>>
                  <label for="3">3</label>
                </p>
                <p>
                  <input type="checkbox" id="4" name="4" value="4" <?php if (str_contains($verfasser,"4")) {echo 'checked';} ?>>
                  <label for="4">4</label>
                </p>
                <p>
                  <input type="checkbox" id="5" name="5" value="5" <?php if (str_contains($verfasser,"5")) {echo 'checked';} ?>>
                  <label for="5">5</label>
                </p>
                <p>
                  <input type="checkbox" id="6" name="6" value="6" <?php if (str_contains($verfasser,"6")) {echo 'checked';} ?>>
                  <label for="6">6</label>
                </p>
                <script>
                  var x = document.getElementById("FilterDiv"); //JS, welches macht, dass sich Der Filter- (und Sortier-) Div auf knopfdruck erscheint und wieder Verschwindet.
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
                    <input type="radio" id="autora-z" name="wieSortieren" value="autor asc" <?php if ($sortierenNach == "autor asc") {echo 'checked';} //Das sorgt dafür, dass die Values nach dem absenden Des Formulars immernoch standard mässig gespeichert sind. (alle gleichen unteren php tags tuhn das gleiche.)?>>
                    <label for="autora-z">Autor (a-z)</label>
                  </p></br>
                  <p>
                    <input type="radio" id="autorz-a" name="wieSortieren" value="autor desc" <?php if ($sortierenNach == "autor desc") {echo 'checked';} ?>>
                    <label for="autorz-a">Autor (z-a)</label>
                  </p></br>
                  <p>
                    <input type="radio" id="titela-z" name="wieSortieren" value="kurztitle asc" <?php if ($sortierenNach == "kurztitle asc") {echo 'checked';} ?>>
                    <label for="titela-z">titel (a-z)</label>
                  </p></br>
                  <p>
                    <input type="radio" id="titelz-a" name="wieSortieren" value="kurztitle desc" <?php if ($sortierenNach == "kurztitle desc") {echo 'checked';} ?>>
                    <label for="titelz-a">titel (z-a)</label>
                  </p></br>
                  <p>
                    <input type="radio" id="kategoriea-z" name="wieSortieren" value="kategorie asc" <?php if ($sortierenNach == "kategorie asc") {echo 'checked';} ?>>
                    <label for="kategoriea-z">Kategorie (a-z)</label>
                  </p></br>
                  <p>
                    <input type="radio" id="kategoriez-a" name="wieSortieren" value="kategorie desc" <?php if ($sortierenNach == "kategorie desc") {echo 'checked';} ?>>
                    <label for="kategoriea-z">Kategorie (z-a)</label>
                  </p></br>
                  <p>
                    <input type="radio" id="kataloga-z" name="wieSortieren" value="katalog asc" <?php if ($sortierenNach == "katalog asc") {echo 'checked';} ?>>
                    <label for="katalora-z">Katalog (a-z)</label>
                  </p></br>
                  <p>
                    <input type="radio" id="katalogz-a" name="wieSortieren" value="katalog desc" <?php if ($sortierenNach == "katalog desc") {echo 'checked';} ?>>
                    <label for="katalorz-a">katalog (z-a)</label>
                  </p></br>
                  <p>
                    <input type="radio" id="nummera-z" name="wieSortieren" value="nummer asc" <?php if ($sortierenNach == "nummer asc") {echo 'checked';} ?>>
                    <label for="nummera-z">nummer (a-z)</label>
                  </p></br>
                  <p>
                    <input type="radio" id="nummerz-a" name="wieSortieren" value="nummer desc" <?php if ($sortierenNach == "nummer desc") {echo 'checked';} ?>>
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
      <div class="booksAdmin">
        <input type="submit" class="blaetterButton" name="click_button" value="<">
        <input type="submit" class="blaetterButton" name="click_button_back" value=">">
        <?php
        $sql = "SELECT * FROM buecher WHERE (katalog LIKE '%". $suche."%' OR nummer LIKE '%". $suche."%' OR autor LIKE '%". $suche."%' OR kurztitle LIKE '%". trim($suche)."%')";
          $append1 = " AND (verkauft LIKE " . $verkauft;
          $sql = $sql .$append1; //Sql Befehl ergänzen mit $append1 variabel
          $warInForLoop = false;
          for ($j = 0; $j < strlen($zustand); $j++) { //Jedes der verschiedenen Zustände wird zum suchkriterium hinzugefügt
            if ($j == 0) {
              $append2 = " AND (zustand LIKE '" . $zustand[$j] . "'";
            }
            else {
              $append2 = " OR zustand LIKE '" . $zustand[$j] . "'";
            }
            $sql = $sql . $append2;
            $warInForLoop = true;
          }
          if ($warInForLoop == true){ //die Klammer wird nur geschlossen, wenn der for-loop mind. 1 mal durchgeführt wurde, also nur dann, wenn sie auch geöffnet wurde.
            $sql = $sql . ")";
          }
          $warInForLoop2 = false;
          for ($j = 0; $j < strlen($verfasser); $j++) { //das gleiche mit einem anderen Kriterium
            if ($j == 0) {
              $append4 = " AND (verfasser LIKE '" . $verfasser[$j] . "'";
            }
            else {
              $append4 = " OR verfasser LIKE '" . $verfasser[$j] . "'";
            }
            $sql = $sql . $append4;
            $warInForLoop2 = true;
          }
          if ($warInForLoop2 == true){
            $sql = $sql . ")";
          }
          $sql = $sql . " ORDER BY " . $sortierenNach; //das such-kriterium einfügen
          $counterInvis = 0;
        foreach ($conn->query($sql) as $row) { //jede zeile der sql-ausgabe zählen für das Seiten-System
          $counterInvis++;
        }
        if ($counterInvis != 0) { // error prevention (gehöhrt zu unten stehendem Kommentar)
          $rest = $counterInvis % 12; 
        }
        else { //error prevention (eine lehre zeilen-Anzahl würde zu einem Negativen restwert Führen ==> error)
          $rest = 15;
        }
        $seiten = ($counterInvis - $rest)/12; //error prävention
        if ($rest != 0) {
          $seiten++;
        }
        if ($rest > 14) { //error prävention
          $seiten = 12;
        }
        if (!isset($_SESSION['clicks'])){
          $_SESSION['clicks'] = 1; //error prävention
        }
        if (isset($_POST['click_button']) && $_SESSION['clicks'] > 1) {
            $_SESSION['clicks'] -= 1 ; // bei drücken von zurück blätter-button wird die "$_SESSION['clicks']"-Variabel -1 gerechnet.
        }
        if ($seiten < $_SESSION['clicks']) {
          $_SESSION['clicks'] = $seiten; // dies verhindert, dass wenn man beispielsweise auf Seite 3 ist und ein suchkriterium eingibt, bei dem nur 2 seiten ausgegeben werden, dass man deshalb mehrere lehre seiten hat.
        }
        if (isset($_POST['click_button_back']) && $_SESSION['clicks'] < $seiten) {
          $_SESSION['clicks'] += 1 ; // bei drücken von zurück blätter-button wird die "$_SESSION['clicks']"-Variabel +1 gerechnet.
        }
        if ($rest > 14) {
          $_SESSION['clicks'] = 1; // error prävention
        }
        echo '<p class="seitenZahl"> Seite ' . $_SESSION['clicks'] . '</p>'; // Seiten anzeigen
        $i = 1;
        $counter = 0;
        $skip = $_SESSION['clicks'] * 12 - 12; // Skip und limit values für die Auflistung auf den Seiten berechnen
        $limit = $_SESSION['clicks'] * 12;
        $append3 = " LIMIT " . $skip . ", 12;";
        $sql = $sql . $append3;
        echo '<p class="BarriereAdmin"></p>'; // Unsichtbarer div zur Hilfe bei Formatierung
        foreach ($conn->query($sql) as $row) {// Ausgabe der buecher

          echo
          '<div class="bookAdmin">'
          // Löschen Button
         .' <form action="delete_book.php" method="post">
            <input type="hidden" name="book_id" value="'. $row['id'] .'">
            <button type="submit" class="buttondelete">Buch löschen</button>
          </form> '
          // Bearbeiten Button
          .' <form action="edit_book.php" method="post">
            <input type="hidden" name="book_id" value="<?php echo $id; ?>">
            <button type="submit" class="buttonedit">Bearbeiten</button>
          </form> '

          .'<div class="bookimageAdmin">';
          if ($i % 3 == 0) {
            echo '<img src="Icons/Book3.png" alt="Bookcover">'; // Auflistung der drei verschiedenen bilder mit jeveiligen Values der Bücher (Kurztitle und Autor)
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
          . '<h2><a href="buecher_details_admin.php?id=' . $row["id"] . '">' . $row["kurztitle"] . '</a></h2>'
          . '<p>Von: ' . $row["autor"] . '</p>'
          . '</div>';
          $i++;
          $counter++;
        }
        if ($counter == 0) {
          echo '<h1>Keine Suchergebnisse</h1>'; // Ausggabe, für den Fall, dass kein Buch die angegebenen Kriterien erfüllt
        }
        ?>
        </form>
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