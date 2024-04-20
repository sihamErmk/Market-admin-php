
<?php 

if(isset($_GET['stateid'])) {
    @include 'config/dbcon.php';
    $id=$_GET['stateid'];
    $select = "SELECT * FROM respe WHERE id_respE = :id";
    $query = $conn->prepare($select);
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();
    if ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        $state = $row['status'];
        if($state==1){
            $sql="UPDATE respe
            SET status = 0
            where id_respE=$id
            ";
            $query = $conn->prepare($sql);
            $query->execute();
            header('location: respE.php');
            exit();
            //echo "The state of admin was changed successfully";
        }
        if($state==0){
            $sql="UPDATE respe
            SET status = 1
            where id_respE=$id
            ";
             $query = $conn->prepare($sql);
             $query->execute();
            //echo "The state of admin was changed successfully";
            header('location: respE.php');
            exit();
        }
    }
}

?>