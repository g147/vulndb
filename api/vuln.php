<?php
class Vuln{
 
    private $conn;
    private $table_name = "vulns";
 
    public $cve;
    public $prod;
    public $ver;
    public $port;
    public $author;
    public $type;
    public $date;
    public $desc;

    
    public function __construct($db){
        $this->conn = $db;
    }

    function deleteVuln(){
        $query = "DELETE FROM
                    " . $this->table_name . "
                WHERE
                    cve=:cve";

        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(":cve", $this->cve);

        if($stmt->execute()){
            return true;
        }

        return false;
        
    }
    function findVuln(){
        $query = "SELECT * FROM
                    " . $this->table_name . "
                WHERE
                    cve=:cve LIMIT 1";

        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(":cve", $this->cve);
        $stmt->execute();
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        return $res;
            
    }
    function firstVuln(){
        $query = "SELECT MIN(id) AS max_id FROM
                    " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $id = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $query = "SELECT * FROM
                    " . $this->table_name . "
                 WHERE 
                    id=:id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id['max_id']);
        $stmt->execute();
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        return $res;
            
    }
    function nextVuln(){
        $query = "SELECT id FROM
                    " . $this->table_name . "
                WHERE
                    cve=:cve LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":cve", $this->cve);
        $stmt->execute();
        $id = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $query = "SELECT * FROM
                    " . $this->table_name . "
                 WHERE 
                    id=:id+1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id['id']);
        $stmt->execute();
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        return $res;
            
    }
    function preVuln(){
        $query = "SELECT id FROM
                    " . $this->table_name . "
                WHERE
                    cve=:cve LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":cve", $this->cve);
        $stmt->execute();
        $id = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $query = "SELECT * FROM
                    " . $this->table_name . "
                 WHERE 
                    id=:id-1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id['id']);
        $stmt->execute();
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        return $res;
            
    }
    function lastVuln(){
        $query = "SELECT MAX(id) AS min_id FROM
                    " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $id = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $query = "SELECT * FROM
                    " . $this->table_name . "
                 WHERE 
                    id=:id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id['min_id']);
        $stmt->execute();
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        return $res;
            
    }

    function updateVuln(){
        $query = "UPDATE
                    " . $this->table_name . "
                SET 
                    cve=:cve, product=:prod, version=:ver, port=:port, author=:author, type=:type, date=:date, description=:desc 
                WHERE
                    cve=:cve";

        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(":cve", $this->cve);
        $stmt->bindParam(":prod", $this->prod);
        $stmt->bindParam(":ver", $this->ver);
        $stmt->bindParam(":port", $this->port);
        $stmt->bindParam(":author", $this->author);
        $stmt->bindParam(":type", $this->type);
        $stmt->bindParam(":date", $this->date);
        $stmt->bindParam(":desc", $this->desc);

        if($stmt->execute()){
            return true;
        }

        return false;
        
    }
    function insertVuln(){
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                     cve=:cve, product=:prod, version=:ver, port=:port, author=:author, type=:type, date=:date, description=:desc";
    
        $stmt = $this->conn->prepare($query);
        
        $this->id = md5($this->cve+$this->date+$this->desc);
        $stmt->bindParam(":cve", $this->cve);
        $stmt->bindParam(":prod", $this->prod);
        $stmt->bindParam(":ver", $this->ver);
        $stmt->bindParam(":port", $this->port);
        $stmt->bindParam(":author", $this->author);
        $stmt->bindParam(":type", $this->type);
        $stmt->bindParam(":date", $this->date);
        $stmt->bindParam(":desc", $this->desc);

        if($stmt->execute()){
            return true;
        }
    
        return false;
        
    }
    
}
