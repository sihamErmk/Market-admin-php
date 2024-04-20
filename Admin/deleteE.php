
<?php

// Check if the ID parameter is set in the URL
if(isset($_GET['deletedid'])) {
    // Include your database connection file
    include 'config/dbcon.php';
    // Get the ID to be deleted
    $id_respE= $_GET['deletedid'];

    try {
        // Prepare the delete statement
        $sql = "DELETE FROM respe WHERE id_respE = :id_respE";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_respE',$id_respE, PDO::PARAM_INT);

        // Execute the delete statement
        $stmt->execute();

        // Redirect back to the previous page or wherever appropriate
        header('Location: respE.php');
        exit();
    } catch(PDOException $e) {
        // Handle error
        die("Error deleting record: " . $e->getMessage());
    }
} else {
    // Redirect to an error page or handle the case where ID parameter is not set
    ///header('Location: error_page.php');
    exit();
}
?>