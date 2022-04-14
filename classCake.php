<?php
    $arrayCakes[];
    class Cake{
        private $id;
        private $name;
        private $arrayIngredients[];
        private $quantity;

        public function setId($id) {$this->id=$id;}  //encapsulation
        public function getId(){return $id;}  
        public function setName($name){$this->name=$name;}  
        public function getName(){return $name;}  
        public function setarrayIngredients($arrayIngredients[]){$this->arrayIngredients=$arrayIngredients;}  
        public function getarrayIngredients(){return $arrayIngredients;}  
        public function setQuantity($quantity){$this->quantity=$quantity;}  
        public function getQuantity(){return $quantity;}  

        public Cake($id,$name,$arrayIngredients[],$quantity){
            $this->id=$id;$this->name=$name;$this->arrayIngredients=$arrayIngredients;$this->quantity=$quantity;}
               
        public function initialiseCakes(){       //onload initialise all cakes
            $sql = "SELECT * FROM cakeMade";
            $stmt= $this->connect()->prepare($sql);
            $stmt->execute();
            $stmt->fetchAll(PDO::FETCH_OBJ);
            $arrayCakes = array();
            while($row = mysql_fetch_assoc($stmt)){
                $arrayCakes[] = row;
            }
            print_r($arrayCakes);
            echo $arrayCakes[0];
            return $arrayCakes;
        }
                //assign each ingredient to the cake add, update cake
        public function setCake($arrayCakes[], $idCake, $arrayIngredients[]){
            $sql = "SELECT * FROM cakeMade WHERE cakeId = $arrayCakes['$id']";
            $stmt= $this->connect()->prepare($sql);
            $stmt->execute();
            $stmt->fetchAll(PDO::FETCH_OBJ);
            $arrayIngredients[] = array();
            $arrayIngredients[] = row;
            return $arrayIngredients;
        }
    }
?>