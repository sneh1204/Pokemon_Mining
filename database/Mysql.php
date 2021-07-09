<?php
class Mysql{

    private $db = "localhost";
    private $username = "root";
    private $password = "asd_1234"; // 'asd_1234' for fallentech.tk
    private $dbname = "mining";
    private $conn = null;

    public function __construct(){
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host={$this->db};dbname={$this->dbname}", $this->username, $this->password, null);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->executeDefaults();
        }
        catch(PDOException $e){
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function getConn(){
        return $this->conn;
    }

    public function executeDefaults(){
        $query = "CREATE TABLE IF NOT EXISTS admin (id INT AUTO_INCREMENT PRIMARY KEY, user VARCHAR(20) NOT NULL, pass VARCHAR(20) NOT NULL)";
        $this->conn->exec($query);
        $query = "SELECT count(*) as res from admin";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result["res"] == 0){
            $query = "INSERT INTO admin SET user = :user, pass = :pass";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':user', 'admin');
            $stmt->bindValue(':pass', 'admin123');
            $stmt->execute();
        }
    }

    public function checkLogIn($user, $pass){
        $query = "SELECT count(*) as res from admin WHERE user = :user AND pass = :pass";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user', $user);
        $stmt->bindParam(':pass', $pass);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result["res"] > 0)  return true;
        else return false;
    }

    public function isAPokemon(String $name){
        $name = strtolower($name);
        $name = str_replace('_', ' ', $name);
        $query = "SELECT Name from pokemons WHERE lower(Name) = '$name'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        if($stmt->rowCount() <= 0)  return false;
        else    return true;
    }

    public function getPokemonInfo(String $name){
        $name = strtolower($name);
        $name = str_replace('_', ' ', $name);
        $query = "SELECT * from pokemons WHERE lower(Name) = '$name'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result[0];
    }

    public function getPercentage($val, $max, $decimals=0){
        return number_format(($val/$max) * 100, $decimals);
    }

    public function getPokemonInfoInPercentage(String $name){
        $name = strtolower($name);
        $name = str_replace('_', ' ', $name);
        $query = "SELECT * from pokemons WHERE lower(Name) = '$name'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll()[0];
        return array(
            $this->getPercentage($result['Total'], $this->getHighestTotal()['Total']),
            $this->getPercentage($result['HP'], $this->getHighestHP()['HP']),
            $this->getPercentage($result['Attack'], $this->getHighestAttack()['Attack']),
            $this->getPercentage($result['Defense'], $this->getHighestDefense()['Defense']),
            $this->getPercentage($result['Sp. Attack'], $this->getHighestSpAttack()['Sp. Attack']),
            $this->getPercentage($result['Sp. Defense'], $this->getHighestSpDefense()['Sp. Defense']),
            $this->getPercentage($result['Speed'], $this->getHighestSpeed()['Speed'])
        );
    }

    public function getSearchValues($str){
        $query = "SELECT Name from pokemons WHERE Name LIKE '$str%' LIMIT 5";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        if($stmt->rowCount() <= 0)  return 0;
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getSearchValuesByPage($str, $page){
        $offset = ($page-1) * 10;
        $query = "SELECT * from pokemons WHERE Name LIKE '$str%' LIMIT $offset,10";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        if($stmt->rowCount() <= 0)  return [];
        $result = $stmt->fetchAll();
        return $result;
    }

    public function totalCountForSearch($str){
        $query = "SELECT count(*) as tot from pokemons WHERE Name LIKE '$str%'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result[0]['tot'];
    }

    public function getHighestTotal(){
        $query = "SELECT Name, Total from pokemons ORDER BY `Total` DESC LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        if($stmt->rowCount() <= 0)  return false;
        $result = $stmt->fetchAll();
        return $result[0];
    }

    public function getHighestHP(){
        $query = "SELECT Name, HP from pokemons ORDER BY `HP` DESC LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        if($stmt->rowCount() <= 0)  return false;
        $result = $stmt->fetchAll();
        return $result[0];
    }

    public function getHighestAttack(){
        $query = "SELECT Name, Attack from pokemons ORDER BY Attack DESC LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        if($stmt->rowCount() <= 0)  return false;
        $result = $stmt->fetchAll();
        return $result[0];
    }

    public function getHighestDefense(){
        $query = "SELECT Name, Defense from pokemons ORDER BY `Defense` DESC LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        if($stmt->rowCount() <= 0)  return false;
        $result = $stmt->fetchAll();
        return $result[0];
    }

    public function getHighestSpAttack(){
        $query = "SELECT Name, `Sp. Attack` from pokemons ORDER BY `Sp. Attack` DESC LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        if($stmt->rowCount() <= 0)  return false;
        $result = $stmt->fetchAll();
        return $result[0];
    }

    public function getHighestSpDefense(){
        $query = "SELECT Name, `Sp. Defense` from pokemons ORDER BY `Sp. Defense` DESC LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        if($stmt->rowCount() <= 0)  return false;
        $result = $stmt->fetchAll();
        return $result[0];
    }

    public function getHighestSpeed(){
        $query = "SELECT Name, `Speed` from pokemons ORDER BY `Speed` DESC LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        if($stmt->rowCount() <= 0)  return false;
        $result = $stmt->fetchAll();
        return $result[0];
    }

    public function getAllPokemons(){
        $query = "SELECT * from pokemons";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        if($stmt->rowCount() <= 0)  return false;
        $result = $stmt->fetchAll();
        return $result;
    }

    public function close(){
        $this->conn = null;
    }
}
?>