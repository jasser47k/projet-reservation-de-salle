<?php
// Paramètres de connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "my_database";
session_start();
if (isset($_SESSION['nom'])) {
    header('location:profile.php');
}

// Connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

// Gestion de la soumission du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données du formulaire
    $user = $_POST['username'];
    $email = $_POST['email'];
    $pass = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hachage du mot de passe

    // Insertion des données dans la base de données
    $sql = "INSERT INTO users (username, email, password) VALUES ('$user', '$email', '$pass')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Inscription réussie !',
                    text: 'Vous avez cliqué sur le bouton !',
                    icon: 'success'
                });
            });
        </script>";
    } else {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Erreur !',
                    text: 'L\'inscription a échoué : " . $conn->error . "',
                    icon: 'error'
                });
            });
        </script>";
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="signup.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.14.5/sweetalert2.css">
    <style>
        /* Votre CSS ici */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f0f0f0;
        }
        .container {
            display: flex;
            max-width: 800px;
            width: 100%;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .left-panel {
            background-color: #000;
            color: #fff;
            padding: 40px;
            width: 40%;
        }
        .left-panel h1 {
            font-size: 32px;
            margin-bottom: 20px;
        }
        .right-panel {
            padding: 40px;
            width: 60%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .right-panel h2 {
            font-size: 24px;
            margin-bottom: 20px;
            text-decoration: underline;
        }
        form {
            width: 100%;
        }
        .input-group {
            position: relative;
            margin-bottom: 20px;
        }
        .input-group label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }
        .input-group input {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            font-weight: bold;
            color: #fff;
            background-color: #000;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="left-panel">
            <h1>REJOIGNEZ-NOUS MAINTENANT !</h1>
            <p></p>
        </div>
        <div class="right-panel">
            <h2>Créer un nouveau compte</h2>
            <form action="signup.php" method="POST">
                <div class="input-group">
                    <label for="username">Nom d'utilisateur</label>
                    <input type="text" name="username" id="username" required>
                </div>
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" required>
                </div>
                <div class="input-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password" id="password" required>
                </div>
                <button type="submit">S'inscrire</button>
                <p>Vous avez déjà un compte ? <a href="login.php">Connexion</a></p>
                <a href="page1.php" class="back-link">Retour</a>
            </form>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.14.5/sweetalert2.all.min.js"></script>
</body>
</html>