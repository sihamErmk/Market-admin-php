<?php 




if(isset($_GET['stateid'])) {
    @include 'config/dbcon.php';
    $id=$_GET['stateid'];
    $select = "SELECT * FROM admin WHERE id_admin = :id";
    $query = $conn->prepare($select);
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();
    if ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        $state = $row['status'];
        if($state==1){
            $sql="UPDATE admin
            SET status = 0
            where id_admin=$id
            ";
            $query = $conn->prepare($sql);
            $query->execute();
            header('location: admin.php');
            exit();
            //echo "The state of admin was changed successfully";
        }
        if($state==0){
            $sql="UPDATE admin
            SET status = 1
            where id_admin=$id
            ";
             $query = $conn->prepare($sql);
             $query->execute();
            //echo "The state of admin was changed successfully";
            header('location: admin.php');
            exit();
        }
    }
}

?>