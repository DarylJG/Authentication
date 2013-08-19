<?php
/**
 * Created By: Slayer-Software Solutions
 * Date: 17/05/13
 * Time: 15:57
 * http://www.slayer-productions.com
 * Copyright Slayer-Software Solutions 2013 - 2014 
 */


namespace SlayerSolutions;
    class Authentication{
            protected $Depreciated = 1;
            protected $Notices = 1;
            protected $Warnings = 1;

            protected $Salt_Configuration;
            public $Salt;
			public $Version = "0.0.2";
        public function __construct($Error_Params = null){
            if (isset($Error_Params)){
                if (isset($Error_Params['Depreciated'])){
                    $this->Depreciated = $Error_Params['Depreciated'];
                }
                if (isset($Error_Params['Notices'])){
                    $this->Notices = $Error_Params['Notices'];
                }
                if (isset($Error_Params['Warnings'])){
                    $this->Warnings = $Error_Params['Warnings'];
                }
            }
        }
        /*
         Start Error Triggering
         Self-Contained Error Triggering set into individual cats
       */
        protected function Trigger_Depreciated($Message){
            if ($this->Depreciated === 1){
                trigger_error($Message,E_USER_DEPRECATED);
            }
        }
        protected function Trigger_Notice($Message){
            if ($this->Notices === 1){
                trigger_error($Message,E_USER_NOTICE);
            }
        }
        protected function Trigger_Fatal($Message){
            trigger_error($Message,E_USER_ERROR);
        }
        protected function Trigger_Warning ($Message){
            if ($this->Warnings === 1){
                trigger_error($Message,E_USER_WARNING);
            }
        }
        /*
         * End Error Triggering
         */

        public function SetSalt(){
            $ByteSize = mcrypt_get_iv_size(MCRYPT_CAST_256, MCRYPT_MODE_CFB);
            $Salt = mcrypt_create_iv($ByteSize, MCRYPT_DEV_RANDOM);
            $this->Salt = $Salt;
        }
        public function Hash_Password($Password){
            $Return_Array = array();
            $Return_Array['Salt'] = $this->Salt;
            $Return_Array['Password'] = crypt($Password,$this->Salt);
            return $Return_Array;
        }
        public function Check_Password($User_Input,$Hashed_Password,$Stored_Salt){
            $Hash = crypt($User_Input,$Stored_Salt);
            if ($Hashed_Password !== $Hash){
                return false;
            }
            return true;
        }

    } // End Class
