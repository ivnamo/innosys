<?php

    class DashboardModel extends Mysql
    {
        

        public function __construct()
        {
            parent::__construct();
        }


        public function selectUsers()
        {
            
            $sql = "SELECT COUNT(*) as count FROM persona WHERE status!=0 ";
            $request_count = $this->select($sql);
            return $request_count;
        }

    }//fin class

?>