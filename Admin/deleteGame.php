<?php 

$conn=mysqli_connect('localhost','root','','assoc');
if(isset($_GET['deletedid'])){
    $game_id=$_GET['deletedid'];
    $sql="delete from games where game_id=$game_id";
    $result=mysqli_query($conn,$sql);
    if($result){
        header(('location:games.php'));
    }
    else{
        die(mysqli_error(($conn)));
    }

}

?>