
<?php 
session_start();
include('includes/header.php');

$host = 'localhost';
$dbname = 'super';
$username = 'root';
$password = '';

try {
    // Create a PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
    // Assuming $id_fournisseur is defined elsewhere
    $query_commandes_envoyees = $pdo->prepare('SELECT * FROM commande WHERE id_fournisseur = ?');
    $query_commandes_envoyees->execute([$id_fournisseur]);
    $commandes_envoyees = $query_commandes_envoyees->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Handle PDO errors
    echo "PDO Error: " . $e->getMessage();
} catch (Exception $e) {
    // Handle other errors
    echo "Error: " . $e->getMessage();
}

?>

<h2>Commandes envoyées</h2>
<table class="table">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Produit</th>
            <th scope="col">Quantité</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($commandes_envoyees as $commande): ?>
            <tr>
                <td><?= $commande['id_commande'] ?></td>
                <td><?= $commande['id_produit'] ?></td>
                <td><?= $commande['quantite'] ?></td>
                <td>
                    <form method="post">
                        <input type="hidden" name="id_commande" value="<?= $commande['id_commande'] ?>">
                        <select name="etat_commande">
                            <option value="Acceptée">Accepter</option>
                            <option value="Refusée">Refuser</option>
                        </select>
                        <button type="submit" name="submit_etat">Mettre à jour</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
