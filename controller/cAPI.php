<?php
    class cAPI extends mAPI {
        public function cExportAPI() {
            $result = $this->mExportAPI();
            
            if (!$result)
                return false;
            return $result;
        }
    }
?>