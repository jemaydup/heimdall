<?php
    class GdA_Grupo{

        // Connection
        private $conn;

        // Table
        private $db_table = "GdA_Grupo";

        // Columns
        public $IDGrupo;
        public $Nombre_grupo;
        public $RP;
        public $Activo;
       
        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getGdA_Grupos(){
            $sqlQuery = "SELECT IDGrupo, Nombre_grupo, RP   FROM " . $this->db_table . " WHERE Activo = '1'";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function createGdA_Grupo(){
            $sqlQuery = "INSERT INTO". $this->db_table ."
                    SET
                        Nombre_grupo = :Nombre_grupo, 
                        RP = :RP, 
                        Activo = :Activo, 
                        IDGrupo = :IDGrupo";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->Nombre_grupo=htmlspecialchars(strip_tags($this->Nombre_grupo));
            $this->RP=htmlspecialchars(strip_tags($this->RP));
            $this->Activo=htmlspecialchars(strip_tags($this->Activo));
            $this->IDGrupo=htmlspecialchars(strip_tags($this->IDGrupo));
  
        
            // bind data
            $stmt->bindParam(":Nombre_grupo", $this->Nombre_grupo);
            $stmt->bindParam(":RP", $this->RP);
            $stmt->bindParam(":Activo", $this->Activo);
            $stmt->bindParam(":IDGrupo", $this->IDGrupo);
      
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // UPDATE
        public function getSingleGdA_Grupo(){
            $sqlQuery = "SELECT
                        IDGrupo, 
                        Nombre_grupo, 
                        RP, 
                        Activo, 
                         
                        
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       IDGrupo = ? 
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->IDGrupo);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->Nombre_grupo = $dataRow['Nombre_grupo'];
            $this->RP = $dataRow['RP'];
            $this->Activo = $dataRow['Activo'];
            $this->IDGrupo = $dataRow['IDGrupo'];
       
        }        

        // UPDATE
        public function updateGdA_Grupo(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        Nombre_grupo = :Nombre_grupo, 
                        RP = :RP, 
                        Activo = :Activo, 
                        
                    WHERE 
                        IDGrupo = :IDGrupo";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->Nombre_grupo=htmlspecialchars(strip_tags($this->Nombre_grupo));
            $this->RP=htmlspecialchars(strip_tags($this->RP));
            $this->Activo=htmlspecialchars(strip_tags($this->Activo));
            $this->IDGrupo=htmlspecialchars(strip_tags($this->IDGrupo));
        
            // bind data
            $stmt->bindParam(":Nombre_grupo", $this->Nombre_grupo);
            $stmt->bindParam(":RP", $this->RP);
            $stmt->bindParam(":Activo", $this->Activo);
            $stmt->bindParam(":IDGrupo", $this->IDGrupo);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteGdA_Grupo(){
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

