<?php
    namespace App;
    abstract class credentials{
        protected $host = '127.0.0.1';
        private $user = 'campus';
        private $password = 'campus2023';
        protected $dbname = 'campuslands';
        public function __get($name){
            return $this->{$name};
        }
    }
?> 