  <!--php code for adding an event starts here--->


  <?php

$conn=mysqli_connect('localhost','root','','assoc');
if($conn){
    echo "true";
}
if(isset($_POST['submit'])){
   echo "true";
   $event_title = mysqli_real_escape_string($conn, $_POST['event_title']);
   $event_desc = mysqli_real_escape_string($conn, $_POST['event_desc']);
   $location = mysqli_real_escape_string($conn, $_POST['location']);
   $organizer = mysqli_real_escape_string($conn, $_POST['organizer']);
   $speakers = mysqli_real_escape_string($conn, $_POST['speakers']);
   $sponsors = mysqli_real_escape_string($conn, $_POST['sponsors']);
   $face_url= mysqli_real_escape_string($conn, $_POST['face_url']);
   $twit_url = mysqli_real_escape_string($conn, $_POST['twit_url']);
   $link_url = mysqli_real_escape_string($conn, $_POST['link_url']);
   $insta_url = mysqli_real_escape_string($conn, $_POST['insta_url']);
   $event_type = mysqli_real_escape_string($conn, $_POST['event_type']);
   $starttime=$_POST['starttime'];
   $endstime=$_POST['endstime'];
   $startdate=$_POST['startdate'];
   $enddate=$_POST['enddate'];
   #image now 
   
    $select = " SELECT * FROM events WHERE event_title = '$event_title' ";

    $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){
      $error[] = 'event already exist! try to update it instead';
   }else{
         $insert = "INSERT INTO events(event_title,event_desc, starttime, endstime,location, organizer, speakers, registrationDead, sponsors, face_url, twit_url, link_url, insta_url, event_type, startdate, enddate) VALUES ('$event_title','$event_desc',$starttime,$endstime,'$location','$organizer','$speakers',$registrationDead,'$sponsors','$face_url','$twit_url','$link_url','$insta_url','$event_type',$startdate,$enddate)";
         $res=mysqli_query($conn, $insert);
   }

};
?>