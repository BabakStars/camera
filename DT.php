<?php

if(isset($_POST['pass']))
{
    $password = $_POST['pass'];
    if($password == "pasis12712345678")
    {
        $link = mysqli_connect("localhost","Database username","Database password","Database name");
		mysqli_set_charset($link, "utf8");
		    if(mysqli_connect_errno())
				{
			    	exit("An error occurred with this description" . mysqli_connect_error());
				}
				$querys = "SELECT * FROM `photograf` WHERE 1";
				            $result = mysqli_query($link,$querys);
				            $row = mysqli_fetch_array($result);
							$lastpath = $row['name'];
							echo($lastpath);
    }
    else
    {
        echo("The password is incorrect!");
    }
}
?>