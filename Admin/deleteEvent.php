<?php 

$conn=mysqli_connect('localhost','root','','assoc');
if(isset($_GET['deletedid'])){
    $event_id=$_GET['deletedid'];
    $sql="delete from events where event_id=$event_id";
    $result=mysqli_query($conn,$sql);
    if($result){
        header(('location:event.php'));
    }
    else{
        die(mysqli_error(($conn)));
    }

}

?>
