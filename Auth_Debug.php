<?php

	include "Auth.php"; 
	$Auth = new Authentication(); 
	$Auth->SetSalt();
	
	$Simulated_Input = $Auth->Hash_Password("Testing");
	echo '==============================================
	<br>
	Testing Password Hashing
	<br><br> 
	
	<pre>';
		print_r($Simulated_Input);
	echo "</pre> 
	<br>
	=========================================<br><br><br>";
	echo "Checking If Non-Matching Passwords mark up as a (bool) true, to simulate an allowed access/Correction in passwords <br><br>";
	$Possible_Hackers_Input = "Nonmatchingpasswrd";
	
	$Check_Password = $Auth->Check_Password($Possible_Hackers_Input,$Simulated_Input['Password'],$Simulated_Input['Salt']);
	var_dump($Check_Password);
		echo "</pre> <br>
	=========================================<br><br><br>";
	echo "Checking if Matching Passwords markup as a (bool) true, which is expected. <br><br>"; 
	$Authorized_Users_Input = "Testing";
	$Another_Check = $Auth->Check_password($Authorized_Users_Input,$Simulated_Input['Password'],$Simulated_Input['Salt']);
	var_dump($Another_Check);
	
	
	echo "<br><br><br><br><br>
		New Test: Setting a static manually input salt so password hashes never change.";
		echo "<br><br><br>"; 
		
	unset($Auth);
	$New_Auth = new Authentication(); 
	$New_Auth->Salt = "lejsdkljf";

	$Simulated = $New_Auth->Hash_Password("Test");
	echo "Printing Array <br>"; 
	echo "<pre>";
		print_r($Simulated);
	echo "</pre>"; 
	
	echo "============================================<br><br>"; 
	
	echo "Checking if incorrect password markups match to a (bool) true on static salt"; 
	$Check_Password = $New_Auth->Check_Password('Non',$Simulated['Password'],$Simulated['Salt']);
	echo "<br>";
	var_dump($Check_Password); 
	echo "<bR><br><br> ================================================ <bR>";
	
	echo "Checking if correct password markups match to a (bool) true on static salt <strong>Expected</strong>"; 
	
	$Check_password = $New_Auth->Check_Password('Test',$Simulated['Password'],$Simulated['Salt']);
	echo "<bR>"; 
	var_dump($Check_password);
	
	echo "<br><br><br>
	
	
	
	Overall Results: <br>
	<strong>Expected False Returns 2</strong> -- Actual <strong>2</strong> <br>
	<strong> Expected True Returns 2</strong> -- Actual <strong>2</strong>";
?>