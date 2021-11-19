<?php
    class GdA_Grupo_Persona{

        // Connection
        private $conn;

        // Table
        private $db_table = "GdA_Grupo_Persona";

        // Columns
        public $IDGrupo;
        public $IDPersona;
        public $IDRole;
        public $status;
        

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getGdA_Grupo_Personas(){
            $sqlQuery = "SELECT IDGrupo, IDPersona, IDRole, status FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function createGdA_Grupo_Persona(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        IDGrupo = :IDGrupo,
                        IDPersona = :IDPersona, 
                        IDRole = :IDRole, 
                        status = :status";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->IDGrupo=htmlspecialchars(strip_tags($this->IDGrupo));
            $this->IDPersona=htmlspecialchars(strip_tags($this->IDPersona));
            $this->IDRole=htmlspecialchars(strip_tags($this->IDRole));
            $this->status=htmlspecialchars(strip_tags($this->status));
            
            // bind data
            $stmt->bindParam(":IDGrupo", $this->IDPersona);
            $stmt->bindParam(":IDPersona", $this->IDPersona);
            $stmt->bindParam(":IDRole", $this->IDRole);
            $stmt->bindParam(":status", $this->status);
  
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // UPDATE
        public function getSingleGdA_Grupo_Persona(){
            $sqlQuery = "SELECT
                        IDGrupo, 
                        IDPersona, 
                        IDRole, 
                        status, 
                        designation, 
                        created
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       IDGrupo = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->IDGrupo);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->IDGrupo = $dataRow['IDGrupo'];
            $this->IDPersona = $dataRow['IDPersona'];
            $this->IDRole = $dataRow['IDRole'];
            $this->status = $dataRow['status'];
           
        }        

        // UPDATE
        public function updateGdA_Grupo_Persona(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        IDPersona = :IDPersona, 
                        IDRole = :IDRole, 
                        status = :status, 
                        designation = :designation, 
                        created = :created
                    WHERE 
                        IDGrupo = :IDGrupo";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->IDGrupo=htmlspecialchars(strip_tags($this->IDGrupo));
            $this->IDPersona=htmlspecialchars(strip_tags($this->IDPersona));
            $this->IDRole=htmlspecialchars(strip_tags($this->IDRole));
            $this->status=htmlspecialchars(strip_tags($this->status));
            
        
            // bind data
            $stmt->bindParam(":IDGrupo", $this->IDPersona);
            $stmt->bindParam(":IDPersona", $this->IDPersona);
            $stmt->bindParam(":IDRole", $this->IDRole);
            $stmt->bindParam(":status", $this->status);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteGdA_Grupo_Persona(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE IDGrupo = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->IDGrupo=htmlspecialchars(strip_tags($this->IDGrupo));
        
            $stmt->bindParam(1, $this->IDGrupo);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>

