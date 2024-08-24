<?php
namespace spl2024\models;
     
abstract class Model
{
    protected $table;
    protected $db;
    protected static $conf = [
        'host'=>'localhost', 'user'=>'root','pass'=>'','dbname'=>'test'
    ];
    
    function __construct(){
        $conn =  new \mysqli(
            self::$conf['host'],
            self::$conf['user'],
            self::$conf['pass'],
            self::$conf['dbname']
        );
        if ($conn->connect_errno) {
            die($conn->connect_error);
        }
        $conn->set_charset('utf8');
        $this->db = $conn;
    }
    
    public static function setDbConf($conf){
        self::$conf = $conf;
    } 
    
    function query($sql, $orderby=null, $limit=0, $offset=0){
        $sql .= $orderby ? "ORDER BY {$orderby}" : '';
        $sql .= $limit>0 ? "LIMIT {$limit} OFFSET {$offset}" : '';
        $rs = $this->db->query($sql);
        if (!$rs) die ('DBエラー: ' . $sql . '<br>' . $this->db->error);
        return $rs->fetch_all(MYSQLI_ASSOC);
    }

    function execute($sql){
        $rs = $this->db->query($sql);
        if (!$rs) die ('DBエラー: ' . $sql . '<br>' . $this->db->error);
    } 
        
    function getList($where=1, $orderby=null, $limit=0, $offset=0){
        $sql = "SELECT * FROM {$this->table} WHERE {$where}";
        return $this->query($sql,$orderby, $limit, $offset);
    }

    function getDetail($where){
        $sql = "SELECT * FROM {$this->table} WHERE {$where}";
        $rs = $this->db->query($sql);
        if (!$rs) die ('DBエラー: ' . $sql . '<br>' . $this->db->error);
        return $rs->fetch_assoc();
    }
    
    function insert($data){
        $keys = implode(',', array_keys($data));
        $values = array_map(fn($v)=>is_string($v) ? "'{$v}'" : $v, array_values($data));
        $values = implode(",", $values);
        $sql = "INSERT INTO {$this->table} ($keys) VALUES ($values)";
        $this->execute($sql);
        return $this->db->affected_rows;
    }
    function update($data, $where){
        $keys = array_keys($data);
        $values = array_map(fn($v)=>is_string($v) ? "'{$v}'" : $v, array_values($data));
        $values = array_map(fn($k, $v)=>"{$k}={$v}", array_combine($keys, $values));
        $sql = "UPDATE {$this->table} SET {$values} WHERE {$where}";
        $this->execute($sql);
        return $this->db->affected_rows;
    }
    function delete($where){
        $sql = "DELETE FROM {$this->table} WHERE {$where}";
        $this->execute($sql);
        return $this->db->affected_rows;
    }
}
