<?php
session_start();
include('includes/header.php');

$host = 'localhost';
$dbname = 'super';
$username = 'root';
$password = '';

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    // Set PDO to throw exceptions on error
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Handle database connection error
    echo "Error: " . $e->getMessage();
    exit(); // Terminate script
}

$error_message = ""; // Initialize the error message variable

// Handle errors for retrieving products
try {
    $query_produits = $pdo->prepare('SELECT id_produit, pnom FROM produit');
    $query_produits->execute();
    $produits = $query_produits->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $error_message .= "Error retrieving products: " . $e->getMessage() . "<br>";
}

// Handle errors for retrieving suppliers
try {
    $query_fournisseurs = $pdo->prepare('SELECT id_fournisseur, nom FROM fournisseur ');
    $query_fournisseurs->execute();
    $fournisseurs = $query_fournisseurs->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $error_message .= "Error retrieving suppliers: " . $e->getMessage() . "<br>";
}

// Display the error message if there's any
if (!empty($error_message)) {
    echo "<div class='alert alert-danger'>$error_message</div>";
}

// Traiter l'envoi du formulaire
if (isset($_POST['submit'])) {
    // Récupérer les données du formulaire
    $id_produit = $_POST['id_produit'];
    $quantite = $_POST['quantite'];
    $id_fournisseur = $_POST['id_fournisseur'];

    // Insérer la commande dans la base de données
    try {
        $sql = "INSERT INTO commande (id_produit, quantite, id_fournisseur, etat_commande) VALUES (?, ?, ?, 'En attente')";

        $query = $pdo->prepare($sql);
        $query->execute([$id_produit, $quantite, $id_fournisseur]);

        // Afficher un message de succès
        echo "<div class='alert alert-success'>La commande a été passée avec succès!</div>";
    } catch (PDOException $e) {
        echo "<div class='alert alert-danger'>Erreur lors de l'ajout de la commande: " . $e->getMessage() . "</div>";
    }
}

// Récupérer la liste des commandes depuis la base de données
try {
    $query_commandes = $pdo->prepare('SELECT * FROM commande');
    $query_commandes->execute();
    $commandes = $query_commandes->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "<div class='alert alert-danger'>Erreur lors de la récupération des commandes: " . $e->getMessage() . "</div>";
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passer une commande</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Passer une commande</h2>
        <form method="post">
            <div class="form-group">
                <label for="id_produit">Produit:</label>
                <select class="form-control" id="id_produit" name="id_produit" required>
                    <option value="">Sélectionner un produit</option>
                    <?php foreach ($produits as $produit): ?>
                        <?php if (isset($produit['id_produit']) && isset($produit['pnom'])): ?>
                            <option value="<?= $produit['id_produit'] ?>"><?= $produit['pnom'] ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="quantite">Quantité:</label>
                <input type="number" class="form-control" id="quantite" name="quantite" required>
            </div>
            <div class="form-group">
            <label for="id_fournisseur">Fournisseur:</label>
<select class="form-control" id="id_fournisseur" name="id_fournisseur" required>
    <option value="">Sélectionner un fournisseur</option>
    <?php foreach ($fournisseurs as $fournisseur): ?>
        <option value="<?= $fournisseur['id_fournisseur'] ?>"><?= $fournisseur['nom'] ?></option>
    <?php endforeach; ?>
</select>

            </div>
            <button type="submit" class="btn btn-primary" name="submit">Passer la commande</button>
        </form>

       
        <!-- Après le formulaire -->
        <h2>Liste des commandes</h2>
<table class="table">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Produit</th>
            <th scope="col">Quantité</th>
            <th scope="col">Fournisseur</th>
            <th scope="col">État de la commande</th> <!-- Nouvelle colonne pour l'état de la commande -->
        </tr>
    </thead>
    <tbody>
        <?php foreach ($commandes as $commande): ?>
            <tr>
                <td><?= $commande['id_commande'] ?></td>
                <td>
                    <?php
                    // Récupérer le nom du produit à partir de la base de données
                    $query_nom_produit = $pdo->prepare('SELECT pnom FROM produit WHERE id_produit = ?');
                    $query_nom_produit->execute([$commande['id_produit']]);
                    $nom_produit = $query_nom_produit->fetchColumn();
                    echo $nom_produit;
                    ?>
                </td>
                <td><?= $commande['quantite'] ?></td>
                <td>
                    <?php
                    // Récupérer le nom du fournisseur à partir de la base de données
                    $query_nom_fournisseur = $pdo->prepare('SELECT nom FROM fournisseur WHERE id_fournisseur = ?');
                    $query_nom_fournisseur->execute([$commande['id_fournisseur']]);
                    $nom_fournisseur = $query_nom_fournisseur->fetchColumn();
                    echo $nom_fournisseur;
                    ?>
                </td>
                <td><?= $commande['etat_commande'] ?></td> <!-- Afficher l'état de la commande -->
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

