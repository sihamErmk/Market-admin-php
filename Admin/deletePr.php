<?php
session_start();
include('includes/header.php');

if (isset($_GET['deletedid'])) {
    // Include your database connection file
    include 'config/dbcon.php';
    // Get the ID to be deleted
    $id_produit = $_GET['deletedid']; // Corrected to match the parameter in the URL

    try {
        // Prepare the delete statement
        $sql = "DELETE FROM produit WHERE id_produit = :id_produit"; // Removed the extra space before id_produit
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_produit', $id_produit, PDO::PARAM_INT); // Corrected parameter name

        // Execute the delete statement
        $stmt->execute();

        // Redirect back to the previous page or wherever appropriate
        // header('Location: index.php');
        exit();
    } catch (PDOException $e) {
        // Handle error
        die("Error deleting record: " . $e->getMessage());
    }
} else {
    // Redirect to an error page or handle the case where ID parameter is not set
    ///header('Location: error_page.php');
    exit();
}
?>
