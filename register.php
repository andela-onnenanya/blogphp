<html>
    <head>
        <title>My first PHP Website</title>
    </head>
    <body>
        <h2>Registration Page</h2>
        <a href="index.php">Click here to go back</a><br/><br/>
        <form action="register.php" method="POST">
           Enter Username: <input type="text" name="username" required="required" /> <br/>
           Enter password: <input type="password" name="password" required="required" /> <br/>
           <input type="submit" value="Register"/>
        </form>
    </body>
</html>
<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $link = mysqli_connect("localhost", "root","") or die(mysql_error());
	$username = mysqli_real_escape_string($link, $_POST['username']);
    $password = mysqli_real_escape_string($link, $_POST['password']);

    
    echo "Username entered is: " . $username . "<br/>";
    echo "Password entered is: " . $password;

    $bool = true;
	mysqli_connect("localhost", "root","") or die(mysql_error()); //Connect to server
	mysqli_select_db($link, "first_db") or die("Cannot connect to database"); //Connect to database
    $query = mysqli_query($link, "Select * from users"); //Query the users table
    print '<script>alert($query);</script>';
	while($row = mysqli_fetch_array($query, 3)) //display all rows from query
	{
		$table_users = $row['username']; // the first username row is passed on to $table_users, and so on until the query is finished
		if($username == $table_users) // checks if there are any matching fields
		{
			$bool = false; // sets bool to false
			Print '<script>alert("Username has been taken!");</script>'; //Prompts the user
			Print '<script>window.location.assign("register.php");</script>'; // redirects to register.php
		}
	}
	if($bool) // checks if bool is true
	{
		mysqli_query($link, "INSERT INTO users (username, password) VALUES ('$username','$password')"); //Inserts the value to table users
		Print '<script>alert("Successfully Registered!");</script>'; // Prompts the user
		Print '<script>window.location.assign("register.php");</script>'; // redirects to register.php
	}

}
?>