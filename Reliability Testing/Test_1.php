<?php
/**
 * Created By: Slayer-Software Solutions
 * Date: 16/05/13
 * Time: 18:04
 * http://www.slayer-productions.com
 * Copyright Slayer-Software Solutions 2013 - 2014 
 */

    include "Class.php";
			$Database = new mysqli("localhost","Username","Password","HashTest");

			$Username = "SlayerProductions";
			$InputPass = "Test";
		$FrameWork = new SlayerSolutions\Authentication();

                $Select = $Database->prepare("SELECT Salt,Hash FROM hash WHERE Username=?");
                $Select->bind_param('s',$Username);
                $Select->execute();
                $Select->bind_result($Stored_Salt,$Stored_Hash);
                $Select->fetch();
                $Select->close();
                $Test = $FrameWork->Check_Password($InputPass,$Stored_Hash,$Stored_Salt);
                if ($Test === true){
                    echo "Hashes Match!";
                }else{
                    echo "Hashes Do Not Match!";
                }