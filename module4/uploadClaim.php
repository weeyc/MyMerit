<?php

$link = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());

mysqli_select_db($link, "mymerit") or die(mysqli_error());


if(isset($_GET['mID'])){

      $meritID = $_GET['mID'];

      $proveSql = "SELECT prove
      FROM merit
      WHERE MeritID = '$meritID'";

    $result = mysqli_query($link,$proveSql);
    $row = mysqli_fetch_array($result);

    $image = $row['prove'];
    $image_src = "claimProve/".$image;
?>
    <img src='<?php echo $image_src;  ?>' >
<?php
  
}

 
if (isset($_POST['upload'])) {

  $meritID = $_POST['mID'];
  $name = $_FILES['file']['name'];
  $target_dir = "claimProve/";
  $target_file = $target_dir . basename($_FILES["file"]["name"]);

  // Select file type
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  // Valid file extensions
  $extensions_arr = array("jpg","jpeg","png","gif");

  // Check extension
  if( in_array($imageFileType,$extensions_arr) ){
 
     // Insert record
     $query = "UPDATE merit
     SET prove='$name'
     WHERE MeritID='$meritID'";

     $result1 = mysqli_query($link,$query);
  
     if ($result1){
        move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name);
         //chg status to pending
         $sql2 = "UPDATE merit
         SET approval_status='pending'
         WHERE MeritID='$meritID'";

         $result2=mysqli_query($link, $sql2); 
         ?>
             <script type="text/javascript">
                 alert("Upload claim successful, please wait for program coordinator approval");
                 window.location = "http://localhost/mymerit/module4/claimMerit.php";
             </script>   
<?php
     }else {
  ?>
                      <script type="text/javascript">
                          alert("Upload failed");
                       
                      </script>   
  <?php   
              }
  }
}
      


  ?>