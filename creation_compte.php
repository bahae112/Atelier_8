<?php 
$user = $_POST['username'];
$mail = $_POST['email'];
$pass = $_POST['password'];

// Connexion à la première base de données
$con = new mysqli("localhost", "root", "", "creationcompte");
if ($con->connect_error) {
    die('Erreur de connexion à creationcompte : ' . $con->connect_error);
}

// Connexion à la deuxième base de données
$con2 = new mysqli("localhost", "root", "", "ma_base_de_donnee2");
if ($con2->connect_error) {
    die('Erreur de connexion à ma_base_de_donnee2 : ' . $con2->connect_error);
}
// Vérifier si l'utilisateur ou l'email existent déjà
$checkUser = $con->prepare("SELECT username FROM creationinterface WHERE username = ? OR email = ?");
$checkUser->bind_param("ss", $user, $mail);
$checkUser->execute();
$resultCheck = $checkUser->get_result();
if ($resultCheck->num_rows > 0) {
    header("Location: creation_compte.html");
    echo 'Un utilisateur avec ce nom d\'utilisateur ou cet email existe déjà';
} else {
// Préparation des requêtes pour éviter les injections SQL
$stmt = $con->prepare("INSERT INTO creationinterface (username, email, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $user, $mail, $pass);
$result = $stmt->execute();

$stmt2 = $con2->prepare("INSERT INTO logininterface (username, password) VALUES (?, ?)");
$stmt2->bind_param("ss", $user, $pass);
$result2 = $stmt2->execute();

if ($result && $result2) {
    header("Location: interface_login.html");
    exit;
} else {
    echo 'Echec';
}

$con->close();
$con2->close(); }
?>
