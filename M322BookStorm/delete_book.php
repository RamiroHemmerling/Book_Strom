<?php
// Datenbankverbindung herstellen
$servername = "localhost";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$servername;dbname=book", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit();
}

// Prüfen, ob eine POST-Anfrage vorliegt und die Buch-ID gesetzt ist
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['book_id'])) {
    // Buch-ID aus dem Formular erhalten
    $book_id = $_POST['book_id'];

    // SQL-Statement zum Löschen des Buches
    $sql = "DELETE FROM buecher WHERE id = :book_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':book_id', $book_id, PDO::PARAM_INT);

    try {
        // Ausführen des Löschbefehls
        if ($stmt->execute()) {
            echo "<script>alert('Das Buch wurde erfolgreich gelöscht.'); window.location.href='adminbooks.php';</script>";
        } else {
            echo "<script>alert('Fehler beim Löschen des Buches.'); window.location.href='adminbooks.php';</script>";
        }
    } catch(PDOException $e) {
        echo "SQL-Fehler: " . $e->getMessage();
        echo "<script>alert('Fehler beim Löschen des Buches.'); window.location.href='adminbooks.php';</script>";
    }
} else {
    // Falls keine POST-Anfrage vorliegt oder keine Buch-ID übergeben wurde, leite zurück zu adminbooks.php
    echo "<script>alert('Ungültige Anfrage.'); window.location.href='adminbooks.php';</script>";
}
?>
