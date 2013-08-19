<?php
    include "GlobalVars.php"; // Include connection information
    include "Class.php"; // Include the framework

    if (isset($_POST['Register'])){
            $Error_Arrays = array();

            /*
             * HTML Post Validation
             */
            if (!isset($_POST['Username'])){
                $Error_Arrays[] = "Please Enter A Username!";
                echo "test";
            } // If username Is not set then add an error message to the array
            if (!isset($_POST['Password'])){
                $Error_Arrays[] = "Please Enter A Password";
            } // If Password is not set then add an error message to the array
            if (isset($_POST['Username']) && (empty($_POST['Username']))){
                $Error_Arrays[] = "Username Cannot Be Blank!";
            } // If Username is set but empty then add a error message to the array
            if (isset($_POST['Password']) && (empty($_POST['Password']))){
                $Error_Arrays[] = "Password Cannot Be Blank!";
            } // IF Password is set but empty then add a error message to the array
            if ($_POST['Password'] !== $_POST['ConfirmPassword']){
                $Error_Arrays[] = "Password Mismatch!";
            } // Check if passwords match
        if (count($Error_Arrays) > 0){
            echo implode("<br>",$Error_Arrays);
        } // Array should count as 0 if there is no problems, if count is more than 0 stop the user
        else{
            $Authentication = new SlayerSolutions\Authentication(); // Connect To SlayerSolutions Framework
                $Authentication->SetSalt(); // Generate The Salt
                $Password_Details = $Authentication->Hash_Password($_POST['Password']); // Get Details of Salt
            $Create_User = $Database->prepare("INSERT INTO users (Username,Password,Salt) VALUES (?,?,?)");
            $Create_User->bind_param('sss', $_POST['Username'], $Password_Details['Password'], $Password_Details['Salt']);
            $Create_User->execute();
            $Create_User->close();
            echo "User Account Created! Click <a href='index.php'>Here</a> To Login";
        }

    }
?>
<title> Basic Register</title>

<div style="position:absolute;">
    Testing The login Class Version 1

    <form method='POST'>
        Username: <input type='text' name='Username'> <br>
        Password: <input type='password' name='Password'><br>
        Confirm: <input type='password' name='ConfirmPassword'><br>
        <input type='submit' name='Register' value='Register!'>
    </form>

</div>
