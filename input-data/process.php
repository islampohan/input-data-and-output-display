<!DOCTYPE html>

<html>

<head>
    <title>Complete Message</title>
</head>

<body>
    <center>
        <?php

        // servername => localhost
        // username => username
        // password => empty
        // database name => your_db
        $conn = mysqli_connect("localhost","username","","your_db");
        
        // Check connection
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            exit();
        }
        
        // Taking all 7 values from the form data(input)
        $message =  $_REQUEST['message'];
        $datetime = date_create()->format('Y-m-d H:i:s');
        // Performing split data
        $message = explode(",", $message);
        $windspeed = $message[0];
        $winddir = $message[1];
        $temp = $message[2];
        $rh = $message[3];
        $pressure = $message[4];
        $rain = $message[5];
        $solrad = $message[6];
        // here our table name is college
        $sql = "INSERT INTO your_table  VALUES ('$datetime','$windspeed', 
            '$winddir','$temp','$rh','$pressure','$rain','$solrad')";
        
        if(mysqli_query($conn, $sql)){
            echo "<h3>data stored in a database successfully." 
                . " Please browse your localhost php my admin" 
                . " to view the updated data</h3>"; 

        } else{
            echo "ERROR: Hush! Sorry $sql. " 
                . mysqli_error($conn);
        }
        
        // Close connection
        mysqli_close($conn);
        ?>
    </center>
</body>
    <h2>Input COMMS</h2>
    <h3>Data telah terkirim!</h3>

</html>
