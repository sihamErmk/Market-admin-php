

<?php

// Check if the ID parameter is set in the URL
if(isset($_GET['deletedid'])) {
    // Include your database connection file
    include 'config/dbcon.php';
    // Get the ID to be deleted
    $id_admin = $_GET['deletedid'];

    try {
        // Prepare the delete statement
        $sql = "DELETE FROM admin WHERE id_admin = :id_admin";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_admin',$id_admin, PDO::PARAM_INT);

        // Execute the delete statement
        $stmt->execute();

        header('location: admin.php');
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
