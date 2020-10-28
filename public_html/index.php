<?php
    $servername = "*";
    $username = "*";
    $password = "*";
    $dbname = "*";
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        // Create connection
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        $input = ($_POST['idea']);
        $input = preg_replace("/[^A-Za-z0-9\' ]/", '', $input);
        $input = addslashes($input);
        if(strlen($input) >280){
            echo '<script>alert("Please submit a shorter response :)")</script>';
            mysqli_close($conn);
        }
        else{
            if (!$conn) {
                die("Connection error!: " . mysqli_connect_error());
            }
    
            $sql = "INSERT INTO submissions (submission)
            VALUES ('$input')";
    
            if (mysqli_query($conn, $sql)) {
                mysqli_close($conn);
                echo "<script>
                alert('Thank you for sharing! Your response will be reflected within 24 hrs :)');
                window.location.href='submissions.html';
                </script>";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }

        }
    }
    
?>
<!DOCTYPE html>
<html>
    <head>
        <meta property="og:title" content="Voices of Voters" />
        <meta property="og:description" content="Why do you vote?" />
    </head>
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <link href='main.css' rel='stylesheet'>
    <body>
        <script>
            function showDataUse(){
                var x = document.getElementById("dataUse");
                if (x.style.display === "none") {
                    x.style.display = "block";
                } else {
                    x.style.display = "none";
                }
            }
        </script>
        <h1 style="padding-top: 5%; text-align: center;">
            What in 2020 makes you vote?
        </h1>
    <div class="centered">
        <p>Add your voice!</p>
        <form action = "" method = "post">
           <br><input id="idea" type = "text" name = "idea" class = "box"/>
           <div style="font-size: small;">(max 280 characters)</div>
            <input type = "submit" value = " Submit! "/><br />
        </form>
        <p style="text-align: center; font-size: 18px;"><button id="inlinebutton" onclick="showDataUse()" style="border: none; font-size: 18px; background-color: white; text-decoration: underline;">[data use]</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="submissions.html" style="font-size: 18px; color: black;">[view submissions]</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="about.html" style="font-size: 18px; color: black;" >[about us]</a></p>
        <br />
        <div id="dataUse" style="display: none;">
            <p style="font-size: 18px;">When you submit a response, we store your response and the time at which you submitted. No other data are collected. Your responses will be added to other responses and will be shown on the <a href="submissions.html">submissions</a> page within about 24 hours of submission!</p>
        </div>
    </div>

    </body>
</html>
