<?php
    class GdA_Audit{

        // Connection
        private $conn;

        // Table
        private $db_table = "GdA_Audit";

        // Columns
        public $id;
        public $fecha;
        public $avillamante;
        public $dnis;
        public $aniguardia;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getGdA_Audits(){
            $sqlQuery = "SELECT id, fecha, avillamante, dnis, aniguardia  FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function createGdA_Audit(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        fecha = :fecha, 
                        avillamante = :avillamante, 
                        dnis = :dnis, 
                        aniguardia = :aniguardia;
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->fecha=htmlspecialchars(strip_tags($this->fecha));
            $this->avillamante=htmlspecialchars(strip_tags($this->avillamante));
            $this->dnis=htmlspecialchars(strip_tags($this->dnis));
            $this->aniguardia=htmlspecialchars(strip_tags($this->aniguardia));
            
            // bind data
            $stmt->bindParam(":fecha", $this->fecha);
            $stmt->bindParam(":avillamante", $this->avillamante);
            $stmt->bindParam(":dnis", $this->dnis);
            $stmt->bindParam(":aniguardia", $this->aniguardia);
            
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // UPDATE
        public function getSingleGdA_Audit(){
            $sqlQuery = "SELECT
                        id, 
                        fecha, 
                        avillamante, 
                        dnis, 
                        aniguardia 
                        
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       id = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->id);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->fecha = $dataRow['fecha'];
            $this->avillamante = $dataRow['avillamante'];
            $this->dnis = $dataRow['dnis'];
            $this->aniguardia = $dataRow['aniguardia'];
            
        }        

        // UPDATE
        public function updateGdA_Audit(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        fecha = :fecha, 
                        avillamante = :avillamante, 
                        dnis = :dnis, 
                        aniguardia = :aniguardia
                    WHERE 
                        id = :id";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->fecha=htmlspecialchars(strip_tags($this->fecha));
            $this->avillamante=htmlspecialchars(strip_tags($this->avillamante));
            $this->dnis=htmlspecialchars(strip_tags($this->dnis));
            $this->aniguardia=htmlspecialchars(strip_tags($this->aniguardia));
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            // bind data
            $stmt->bindParam(":fecha", $this->fecha);
            $stmt->bindParam(":avillamante", $this->avillamante);
            $stmt->bindParam(":dnis", $this->dnis);
            $stmt->bindParam(":aniguardia", $this->aniguardia);
            $stmt->bindParam(":id", $this->id);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteGdA_Audit(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            $stmt->bindParam(1, $this->id);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>

