<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ange BEQUET - Formulaire d'inscription</title>

    <style>
        body {
            margin: 0;
            padding: 20px;
            font-family: Arial, sans-serif;
            background: #f4f4f4;
        }

        #container {
            max-width: 520px;
            margin: 150px auto;
            background: #fff;
            padding: 20px;
        }

        h1 {
            margin: 0 0 16px;
            text-align: center;
        }

        form>div {
            margin-bottom: 12px;
        }

        label {
            display: block;
            margin-bottom: 6px;
        }

        input[type="text"],
        input[type="email"],
        input[type="number"] {
            width: 90%;
            padding: 8px 10px;
            border: 1px solid #ccc;
        }

        span {
            display: block;
            color: #dc2626;
            margin-top: 6px;
        }

        #success {
            background: #dcfce7;
            color: #166534;
            padding: 10px;
            margin-bottom: 12px;
        }

        button[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            background: #3b82f6;
            color: #fff;
            cursor: pointer;
        }
    </style>

</head>

<?php
//def des variables
$errors = [];
$success = false;
$nom = '';
$prenom = '';
$email = '';
$age = '';
$conditions = false;

//atribution des valeur
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'] ?? '';
    $prenom = $_POST['prenom'] ?? '';
    $email = $_POST['email'] ?? '';
    $age = $_POST['age'] ?? '';
    $conditions = isset($_POST['conditions']);

    //les condition
    if (empty($nom)) {
        $errors['nom'] = "Le nom est requis";
    } elseif (strlen($nom) < 2) {
        $errors['nom'] = "Le nom ne peut pas être inférieur à 2 caractères";
    } elseif (strlen($nom) > 50) {
        $errors['nom'] = "Le nom ne peut pas dépasser 50 caractères";
    }

    if (empty($prenom)) {
        $errors['prenom'] = "Le prénom est requis";
    } elseif (strlen($prenom) < 2) {
        $errors['prenom'] = "Le prénom ne peut pas être inférieur à 2 caractères";
    } elseif (strlen($prenom) > 50) {
        $errors['prenom'] = "Le prénom ne peut pas dépasser 50 caractères";
    }

    if (empty($email)) {
        $errors['email'] = "L'email est requis";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "L'email est incorrect";
    }

    if (empty($age)) {
        $errors['age'] = "L'age est requis";
    } elseif (!is_numeric($age) || $age < 16) {
        $errors['age'] = "Vous devez avoir au moins 16 ans pour vous inscrire";
    }

    if (!$conditions) {
        $errors['conditions'] = "Vous devez accepter les conditions générales pour vous inscrire";
    }

    //en cas de réussite
    if (empty($errors)) {
        $success = true;
        $successMessage = "Inscription réussie ! Bienvenue $prenom $nom";
        $nom = '';
        $prenom = '';
        $email = '';
        $age = '';
        $conditions = false;
    }
}
?>

<body>
    <div id="container">
        <h1>Formulaire d'inscription</h1>

        <?php if ($success): ?>
            <div id="success">
                <?= htmlspecialchars($successMessage) ?>
            </div>
        <?php endif; ?>

        <form action="" method="POST">
            <div>
                <label for="nom">Nom :</label>
                <input
                    type="text"
                    id="nom"
                    name="nom"
                    value="<?= htmlspecialchars($nom) ?>">
                <?php if (isset($errors['nom'])): ?>
                    <span><?= $errors['nom'] ?></span>
                <?php endif; ?>
            </div>

            <div>
                <label for="prenom">Prénom :</label>
                <input
                    type="text"
                    id="prenom"
                    name="prenom"
                    value="<?= htmlspecialchars($prenom) ?>">
                <?php if (isset($errors['prenom'])): ?>
                    <span><?= $errors['prenom'] ?></span>
                <?php endif; ?>
            </div>

            <div>
                <label for="email">Email :</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="<?= htmlspecialchars($email) ?>">
                <?php if (isset($errors['email'])): ?>
                    <span><?= $errors['email'] ?></span>
                <?php endif; ?>
            </div>

            <div>
                <label for="age">Âge :</label>
                <input
                    type="number"
                    id="age"
                    name="age"
                    value="<?= htmlspecialchars($age) ?>">
                <?php if (isset($errors['age'])): ?>
                    <span><?= $errors['age'] ?></span>
                <?php endif; ?>

            </div>
            <div>
                <label>
                    <input
                        type="checkbox"
                        name="conditions"
                        <?= $conditions ? 'checked' : '' ?>>
                    J'accepte les conditions générales
                </label>
                <?php if (isset($errors['conditions'])): ?>
                    <span><?= $errors['conditions'] ?></span>
                <?php endif; ?>
            </div>
            <button type="submit">S'inscrire</button>
        </form>
    </div>
</body>

</html>