<?php
    error_reporting(E_ALL);
	include "Class.php"; // Include Authentication Class
    include "GlobalVars.php"; // include Database
		session_start(); // Start session globals 
		$SlayerAuth = new SlayerSolutions\Authentication(); // Connect to Slayer API

        if (isset($_POST['Login'])){
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

            if (count($Error_Arrays) > 0){
                echo implode("<br>",$Error_Arrays);
                exit;
            } // Array should count as 0 if there is no problems, if count is more than 0 stop the user

            // If reaching this point then everything checks out alright

                $Get_UserInfo = $Database->prepare("SELECT Password,Salt FROM users WHERE Username=?");
                $Get_UserInfo->bind_param('s',$_POST['Username']);
                $Get_UserInfo->execute();
                $Get_UserInfo->bind_result($Stored_Password,$Stored_Salt);
                $Get_UserInfo->fetch();
                $Get_UserInfo->close();
            $Results = $SlayerAuth->Check_Password($_POST['Password'],$Stored_Password,$Stored_Salt);
            /*
             * Check the user inputted password against the stored salt and hashed password from the database
             */
            if ($Results['Error Code'] == 1){
                $_SESSION['Username'] = $_POST['Username'];
                $_SESSION['Salt'] = $Stored_Salt; // Optional
                header ("Location: LoggedIn.php");
            }// API Returns 1 on success
            else{
                echo $Results['Error Message'];
                exit; // Stop Script Executing
            }



        }else{
            echo "Error Encountered, Please Try Again";
            exit;
        }