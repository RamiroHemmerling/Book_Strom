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
    if ($_SERVER['REQUEST_METHOD']== 'POST' 
    && isset($_POST['Search'])
    && !empty ($_POST['Search'])) {
        $suche = $_POST['Search'];
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
        <form action="buecher.php" method="post">
          <input type="text" name="Search" id="Search">
          <select name="sortieren" id="sortieren">
            <option value="Titel">Nach Titel sortieren</option>
            <option value="Autor*in">Nach Autor*in sortieren</option>
            <option value="Datum">Nach Datum sortieren</option>
          </select>
          <select name="sortieren" id="sortieren">
            <option value="Titel">Nach Titel sortieren</option>
            <option value="Autor*in">Nach Autor*in sortieren</option>
            <option value="Datum">Nach Datum sortieren</option>
          </select>
          <input type="submit" name="submit" value="Suchen" class="submit">
        </form>
      </div>
      <div class="books">
        <?php
        $sql = "SELECT * FROM buecher WHERE kurztitle LIKE '%". $suche."%';";
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
          .'<p>'. $row["kurztitle"]. '</p>'.
          $row["autor"]. '</p>'
          .'</div>';
          $i++;
        }
        ?>
      </div>
      <div class="books">
        <?php
        $sql = "SELECT * FROM buecher WHERE autor LIKE '%". $suche."%';";
        foreach ($conn->query($sql) as $row) {
          echo
          '<div class="book">'
          .'<div class="bookimage">'
          .'</div>'
          .'<p>'. $row["kurztitle"]. '</p>'.
          $row["autor"]. '</p>'
          .'</div>';
        }
        ?>
      </div>
    </div>
    <div class="footer">
      <p>Impressum</p>
      <p>Datenschutz</p>
      <p>Nutzungsbedingungen</p>
      <p>bookstorm© 2024</p>
    </div>
</body>
</html>