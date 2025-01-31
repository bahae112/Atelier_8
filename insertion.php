<?php 
  $visible = $_POST['visibility'];
  $pseudo = $_POST['pseudo'];
  $site = $_POST['site'];
  $tel = $_POST['telephone'];
  $email = $_POST['email'];
  $psw = $_POST['password'];
  $birth = $_POST['birthdate'];
  $desc = $_POST['description'];
  $con = new mysqli("localhost","root","","ma_base_de_donnee");
  if (!$con) {
    die('erreur : '.mysqli_error($con));
  }
  $sql = "INSERT into utilisateurs values('$email','$psw','$pseudo','$birth','$tel','$visible', '$site' ,'$desc')" ;
  $result=$con->query($sql);
  if ($result == True) {
    echo 'succes';
  }
  else {
    echo 'echec' ;
  }

?>
  
