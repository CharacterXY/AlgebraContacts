<?php

class DB{

    private static $instance = null;
    private $config;
    private $conn;
    private $query;
    private $error = false;
    private $results;
    private $count = 0;

    // Constructor
    private function __construct(){

        $this->config = Config::get('database');

        $driver = $this->config['driver'];
        $db_name = $this->config[$driver]['db'];
        $host = $this->config[$driver]['host'];
        $user = $this->config[$driver]['user'];
        $pass = $this->config[$driver]['pass'];
        $charset = $this->config[$driver]['charset'];
        $dsn = $driver . ':dbname=' . $db_name . ';host=' . $host . ';charset=' . $charset;

        try {
            $this->conn = new PDO($dsn, $user, $pass);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    // Singleton pattern
    public static function getInstance(){
        if(!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function query($sql, $params = array()){
        $this->error = false;

        if($this->query = $this->conn->prepare($sql)){
            
           
            if (!empty($params)) {
            
                $counter = 1;
                foreach ($params as $key => $param) {
                    $this->query->bindValue($counter, $param);
                    $counter++;
                }
            }

            if($this->query->execute()){
                $this->result = $this->query->fetchAll(Config::get('database')['fetch']);
                $this->count = $this->query->rowCount();
            }else{
                $this->error = true;
                if (Config::get('app')['display_errors']) {
                    die($this->query->errorInfo()[2]);
                }
                
            }            
        }
        return $this;
    }

    private function action($action, $table, $where = array()){
        if (!empty($where)) {
               
            $array_chunks = array_chunk($where, 4);
            $field_num = count($array_chunks);
            $condition = '';
            $i = 1;

            foreach ($array_chunks as $chunks) {
                $values[] = $chunks[2];
                $condition .= $chunks[0]." ".$chunks[1]."?";
                
                if ($i < $field_num) {
                    $condition .= $chunks[3]." ";
                }
                $i++;
            }
            $sql = "$action FROM $table WHERE $condition";
  
            if (!$this->query($sql,$values)->getError()) {
                return $this;
                }
            }  else {
                $sql = "$action FROM $table";

                if  (!$this->query($sql)->getError()) {
                    return $this;
                }
            }	
        return false;
    }

    public function get($columns, $table, $where = array()){
        return $this->action("SELECT $columns", $table, $where);
    }

    public function find($id, $table){
        return $this->action("SELECT *", $table, ['id', '=', $id]);
    }

    public function delete($table, $where = array()){
        return $this->action("DELETE", $table, $where);
    }

    public function insert($table, $fields){
        $keys = implode(',', array_keys($fields));
        $field_num = count($fields);
        $values = '';
        $x = 1;

        foreach ($fields as $key => $field) {
            $values .= '?';
            if ($x < $field_num) {
                $values .= ',';
            }
            $x++;
        }

        $sql = "INSERT INTO $table ($keys) VALUES ($values)";

        if (!$this->query($sql, $fields)->getError()) {
            return $this;
        }
        return false;
    }

    public function update($table, $id, $fields){
        $field_num = count($fields);
        $values = '';
        $x = 1;
        foreach ($fields as $key => $field) {
            $values .= "$key = ?";
            if ($x < $field_num) {
                $values .= ',';
            }
            $x++;
        }
        
        $sql = "UPDATE $table SET $values WHERE id = $id";
        if (!$this->query($sql, $fields)->getError()) {
            return $this;
        }
        return false;
    }

    public function getError(){
        return $this->error;
    }

    public function getConnection(){
        return $this->conn;
    }

    public function getResults(){
        return $this->results;
    }

    public function getCount(){
        return $this->count;
    }

    public function getFirst(){
        return $this->results[0];
    }
}

?>
