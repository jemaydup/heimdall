<?php
    class Persona{

        // Connection
        private $conn;

        // Table
        private $db_table = "GdA_Persona";

        // Columns
        public $Legajo;
        public $Nombre;
        public $Apellido;
        public $ANI;
        public $Guardia;
        public $Password;
	    public $Status;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getPersona(){
            $sqlQuery = "SELECT Legajo, Nombre, Apellido, ANI, Guardia, Password, Status FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function createPersona(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                    Legajo = :Legajo, 
                    Nombre = :Nombre, 
                    Apellido = :Apellido, 
                    ANI = :ANI, 
                    Guardia = :Guardia
                    Password = :Password, 
                    Status = :Status" ;
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->Legajo=htmlspecialchars(strip_tags($this->Legajo));
            $this->Nombre=htmlspecialchars(strip_tags($this->Nombre));
            $this->Apellido=htmlspecialchars(strip_tags($this->Apellido));
            $this->ANI=htmlspecialchars(strip_tags($this->ANI));
            $this->Guardia=htmlspecialchars(strip_tags($this->Guardia));
            $this->Password=htmlspecialchars(strip_tags($this->Password));
            $this->Status=htmlspecialchars(strip_tags($this->Status));

            // bind data
            $stmt->bindParam(":Legajo", $this->Legajo);
            $stmt->bindParam(":Nombre", $this->Nombre);
            $stmt->bindParam(":Apellido", $this->Apellido);
            $stmt->bindParam(":ANI", $this->ANI);
            $stmt->bindParam(":Guardia", $this->Guardia);
            $stmt->bindParam(":Password", $this->Password);
            $stmt->bindParam(":Status", $this->Status);

            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // UPDATE
        public function getSinglePersona(){
            $sqlQuery = "SELECT
                        Legajo, 
                        Nombre, 
                        Apellido, 
                        ANI, 
                        Guardia, 
                        Password,
                        Status
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       Legajo = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->Legajo);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->Legajo = $dataRow['Legajo'];
            $this->Nombre = $dataRow['Nombre'];
            $this->Apellido = $dataRow['Apellido'];
            $this->ANI = $dataRow['ANI'];
            $this->Guardia = $dataRow['Guardia'];
            $this->Password = $dataRow['Password'];
            $this->Status = $dataRow['Status'];
        }        

        // UPDATE
        public function updatePersona(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        Legajo = :Legajo, 
                        Nombre = :Nombre, 
                        Apellido = :Apellido, 
                        ANI = :ANI, 
                        Guardia = :Guardia,
                        Password = :Password
                        Status = :Status
                    WHERE 
                        Legajo = :Legajo";
        
            $stmt = $this->conn->prepare($sqlQuery);
           
            $this->Legajo=htmlspecialchars(strip_tags($this->Legajo));
            $this->Nombre=htmlspecialchars(strip_tags($this->Nombre));
            $this->Apellido=htmlspecialchars(strip_tags($this->Apellido));
            $this->ANI=htmlspecialchars(strip_tags($this->ANI));
            $this->Guardia=htmlspecialchars(strip_tags($this->Guardia));
            $this->Password=htmlspecialchars(strip_tags($this->Password));
            $this->Status=htmlspecialchars(strip_tags($this->Status));

        
            // bind data
            $stmt->bindParam(":Legajo", $this->Legajo);
            $stmt->bindParam(":Nombre", $this->Nombre);
            $stmt->bindParam(":Apellido", $this->Apellido);
            $stmt->bindParam(":ANI", $this->ANI);
            $stmt->bindParam(":Guardia", $this->Guardia);
            $stmt->bindParam(":Password", $this->Password);
            $stmt->bindParam(":Status", $this->Status);

            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deletePersona(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE Legajo = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id=htmlspecialchars(strip_tags($this->Legajo));
        
            $stmt->bindParam(1, $this->Legajo);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>

