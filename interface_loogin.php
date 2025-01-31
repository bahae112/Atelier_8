<?php 
session_start();

$user = $_POST['username'];
$pass = $_POST['password'];  // Utilisé tel quel, sans hachage

// Connexion à la base de données
$con = new mysqli("localhost", "root", "", "ma_base_de_donnee2");
if ($con->connect_error) {
    die('Erreur de connexion : ' . $con->connect_error);
}

// Sécuriser la variable username pour éviter les injections SQL
$user = $con->real_escape_string($user);

// Requête pour vérifier l'utilisateur
$sql = "SELECT password FROM logininterface WHERE username = '$user'";
$result = $con->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if ($pass === $row['password']) {
        // Connexion réussie, redirection vers index.html
        header("Location: index.html");
        exit;
    } else {
        // Le mot de passe est incorrect
        //echo 'Nom d’utilisateur ou mot de passe incorrect';
        header("Location: interface_login.html");
        //$_SESSION['error'] = 'Nom d’utilisateur ou mot de passe incorrect';
    }
} else {
    // L’utilisateur n'existe pas
    //echo 'Nom d’utilisateur ou mot de passe incorrect';
    header("Location: interface_login.html");
    //$_SESSION['error'] = 'Nom d’utilisateur ou mot de passe incorrect';
}

$con->close();
?>
