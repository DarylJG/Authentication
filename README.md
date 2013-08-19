### SlayerSolutions Authentication:


We are aiming to deliver a powerfull yet simple framework revolved around password security

-----------------------



### Connecting To The FrameWork!

	            include "Class.php";
	            $Configuration_Params = array(
	              "Depreciated" => 1,
	              "Warnings" => 1,
	              "Notices" => 1,
 	             "VersionAlerts" => 1
	            );
	          $FrameWork = new SlayerSolutions\Authentication($Configuration_Params); // Passing Configuration Params Are Completely optional


### Generating A Secure Hash:

The SetSalt() function must be called for any type of salt to be generated: 

	          $FrameWork->SetSalt(); // This will generate a random salt. 
	        	$Hashed_Password = $FrameWork->Hash_Password($_POST['Password']); // Mainly used for account registration/password changing. This will return an array containing the hashed password and the salt. 


### A Working Example:

 	        $FrameWork->SetSalt();
	        $_POST['Password'] = "ThisIsATest"; // Manipulate a $_POST 
	        $Hashed_Password = $FrameWork->Hash_Password($_POST['Password']);
		echo "<pre>";
		print_r($Hashed_Password);
		echo "</pre>";

### Expected Output Will Be Similar To: 
	        	Array
	        	(
	        		[Salt] => 0¹¢Ê÷R}òŠ«°§<€[
	        		[Password] => 04mgHUyb3Ob6
	        	) // Due to Github not properly encoding ASCII this might display differently to the framework 
-------
