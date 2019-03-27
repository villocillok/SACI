<?php
    class Connection {
        private $hostname = 'localhost';
        private $username = 'root';
        private $password = '';
        private $database = 'saci_db';
        private $connection, $query;

        //private $hostname = 'localhost';
        //private $username = 'saci_qc';
        //private $password = 'kiel_Villocillo123';
        //private $database = 'saci_db';
        //private $connection, $query;

        function open() {
            return $this->connection = mysqli_connect($this->hostname, $this->username, $this->password, $this->database);
        }

        function show_error() {
            return mysqli_error($this->connection);
        }

        function escape_string($string = '') {
            if($string != '') {
                return mysqli_real_escape_string($this->connection, $string);
            } else {
                return false;
            }
        }

        function query($sql) {
            return $this->query = mysqli_query($this->connection, $sql);
        }

        function affected_rows() {
            return mysqli_affected_rows($this->connection);
        }

        function num_rows() {
            return mysqli_num_rows($this->query);
        }

        function fetch_array() {
            return mysqli_fetch_array($this->query);
        }

        function fetch_assoc() {
            return mysqli_fetch_assoc($this->query);
        }

        function close() {
            mysqli_close($this->connection);
        }
        
        function check_error() {
            return mysqli_error($this->connection);
        }
    }
?>