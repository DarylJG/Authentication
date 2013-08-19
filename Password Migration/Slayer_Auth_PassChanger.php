<?php
/**
 * Created By: Slayer-Software Solutions
 * User: Daryl
 * Date: 16/05/13
 * Time: 18:04
 * http://www.slayer-productions.com
 * Copyright Slayer-Software Solutions 2013 - 2014
 *
 * Consult the document found with this script for a step by step guide.
 * http://www.github.com/SlayerSolutions/Authentication
 *
 */

    include "Class.php";
			$Database = new mysqli("localhost","DatabaseUsername","DatabasePassword","DatabaseName");

		$FrameWork = new SlayerSolutions\Authentication();


$Query = $Database->prepare("FIRST QUERY");
$Query->execute();
$Query->bind_result($ID,$Password);
$Query->store_result();
   while ($Query->fetch()){
       $FrameWork->SetSalt();
       $Hashed = $FrameWork->Hash_Password($Password);
       $Secondary_Query = $Database->prepare("SECOND QUERY");
       $Secondary_Query->bind_param('ssi', $Hashed['Password'],$Hashed['Salt'],$ID);
       $Secondary_Query->execute();
       $Secondary_Query->close();
   }
$Query->close();
