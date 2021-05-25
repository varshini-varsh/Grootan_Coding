<!-----------------html------------------------------------------>

<!DOCTYPE html>
<html>
 <head>
  <title>Grootan Coding</title>
  #ajax
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  #css
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
   #bootstrap
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 </head>
 <body>
  <br />
  <div class="container">
   <h2 align="center">Upload CSV File using PHP</a></h2>
   <br />
   <form method="post" enctype='multipart/form-data'>
    <p><label>Browse...</label>
    <input type="file" name="product_file" /></p>
    <br />
    <input type="submit" name="upload" class="btn btn-info" value="Upload" />
   </form>  
  </div>
 </body>
</html>


<!---------------------------------------php---------------------------------------------------->
<?php
$connect = mysqli_connect("localhost", "root", "", "csvtodatabase");
$message = '';

if(isset($_POST["upload"]))
{
 if($_FILES['product_file']['name'])
 {
  $filename = explode(".", $_FILES['product_file']['name']);
  if(end($filename) == "csv")
  {
   $handle = fopen($_FILES['product_file']['tmp_name'], "r");
   while($data = fgetcsv($handle))
   {
    $id = mysqli_real_escape_string($connect, $data[0]);
    $name = mysqli_real_escape_string($connect, $data[1]);  
    $email= mysqli_real_escape_string($connect, $data[2]);
    $password = mysqli_real_escape_string($connect, $data[3]);
    $query = "
     UPDATE data
     SET name = '$name', 
     email = '$email', 
     password = '$password' 
     WHERE id = '$id'
    ";
    mysqli_query($connect, $query);
   }
   fclose($handle);
   header("location: index.php?updation=1");
  }
  else
  {
   $message = '<label class="text-danger"> Select CSV file</label>';
  }
 }
 else
 {
  $message = '<label class="text-danger">Select File</label>';
 }
}

if(isset($_GET["updation"]))
{
 $message = '<label class="text-success">Updated Successfully...</label>';
}
$query = "SELECT * FROM data";
$result = mysqli_query($connect, $query);
?>
