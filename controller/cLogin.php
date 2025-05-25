<?php
    class cLogin extends mLogin{
        public function cCheckinlogin($username, $password) {
            return $this->mCheckinlogin($username, $password);
        }
        
        public function cConfirmlogin($username, $password) {
            return $this->mConfirmlogin($username, $password);
        }
    }
?>