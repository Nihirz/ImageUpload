
<?php

if (isset($_POST['submit'])) 
{
  $target_dir = "uploads/";
  $file_name = rand(10,99999). basename($_FILES["image"]["name"]);
  $target_file = $target_dir . $file_name;
  $uploadOk = 1;
   $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  // Check if image file is a actual image or fake image
  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
      echo "Sorry, only image files are allowed.";
      $uploadOk = 0;
  }
  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else 
  {
      if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        
       $title = $_POST['title'];
		$description = $_POST['description'];
       
        
        $insert = "INSERT INTO slider(title,description,img) VALUES ('$title','$description','$target_file')";
        $query = mysqli_query($connection,$insert);

        if ($query == true) {
          
          echo "<script>alert('Data Inserted');location.href='slider.php';</script>";

        }
          
      } 
      else {
          echo "Sorry, there was an error uploading your file.";
      }
  }
}
?>