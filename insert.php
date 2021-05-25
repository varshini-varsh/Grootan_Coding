<?php

$con = mysqli_connect ("localhost","root","","datacsv");
if($con)
{
    #print_r($_FILES['csvfile']);
    $file=$_FILES['csvfile']['tmp_name'];
    $handle=fopen($file,"r");
    $i=0;
    while (($cont=fgetcsv($handle,1000,","))!==false)
    {
        $table=rtrim($_FILES['csvfile']['name'],".csv");
        if($i==0)
        {
            $name=$cont[0];
            $dept=$cont[1];
            $email=$cont[2];
            $password=$cont[3];
            $salary=$cont[4];

            $query = "CREATE TABLE $table ($name VARCHAR(50),$dept VARCHAR(10), $email VARCHAR(50), $password VARCHAR(50), $salary INT(6);";   
            echo $query,"<br>" ;
            mysqli_query($con,$query);
        }
        else
        {
            $query = "INSERT INTO $table ($name,$dept,$email,$password,$salary) VALUES('$cont[0]','$cont[1]','$cont[2]','$cont[3]','$cont[4]');";
            echo $query,"<br>";
            mysqli_query($con,$query);
        }
        $i++;
    }
}
else
{
    echo"connection failed";
}

?>