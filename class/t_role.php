<?php
    class Employee{

        // Connection
        private $conn;

        // Table
        private $db_table = "GdA_Role";

        // Columns+
       public $idrolerole;
       public $Role_Nombre;# varchar(50) NOT NULL,
       public $status; # tinyint(1) NOT NULL,
       public $persona_alta; #; #inyint(1) NOT NULL,
       public $persona_baja; #; #inyint(1) NOT NULL,
       public $persona_consulta; #inyint(1) NOT NULL,
       public $persona_modificar; # tinyint(1) NOT NULL,
       public $grupo_alta; # tinyint(1) NOT NULL,
       public $grupo_baja; # tinyint(1) NOT NULL,
       public $grupo_consulta; # tinyint(1) NOT NULL,
       public $grupo_modificar; # tinyint(1) NOT NULL, 
       public $role_alta; #inyint(1) NOT NULL,
       public $role_baja; #inyint(1) NOT NULL,
       public $role_consulta; #inyint(1) NOT NULL,
       public $role_modificar; #inyint(1) NOT NULL,
       public $grupo_persona_alta; #inyint(1) NOT NULL,
       public $grupo_persona_baja; #inyint(1) NOT NULL,
       public $grupo_persona_consulta; #inyint(1) NOT NULL,
       public $grupo_persona_modificar; #inyint(1) NOT NULL,
       public $audit_alta; #inyint(1) NOT NULL,
       public $audit_modificar; #inyint(1) NOT NULL,
       public $audit_baja; #inyint(1) NOT NULL,
       public $audit_consulta; #inyint(1) NOT NULL

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getRole(){
            $sqlQuery = "SELECT idrole, Role_Nombre, email, age, designation, created FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function createEmployee(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        Role_Nombre = :Role_Nombre, 
                        email = :email, 
                        age = :age, 
                        designation = :designation, 
                        created = :created";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->Role_Nombre=htmlspecialchars(strip_tags($this->Role_Nombre));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->age=htmlspecialchars(strip_tags($this->age));
            $this->designation=htmlspecialchars(strip_tags($this->designation));
            $this->created=htmlspecialchars(strip_tags($this->created));
        
            // bind data
            $stmt->bindParam(":Role_Nombre", $this->Role_Nombre);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":age", $this->age);
            $stmt->bindParam(":designation", $this->designation);
            $stmt->bindParam(":created", $this->created);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // UPDATE
        public function getSingleEmployee(){
            $sqlQuery = "SELECT
                        idrole, 
                        Role_Nombre, 
                        email, 
                        age, 
                        designation, 
                        created
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       idrole = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->idrole);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->Role_Nombre = $dataRow['Role_Nombre'];
            $this->email = $dataRow['email'];
            $this->age = $dataRow['age'];
            $this->designation = $dataRow['designation'];
            $this->created = $dataRow['created'];
        }        

        // UPDATE
        public function updateRole(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                    idrolerole = :idrolerole,
                    Role_Nombre = :Role_Nombre,
  `status` tinyint(1) NOT NULL,
  `persona_alta` tinyint(1) NOT NULL,
  `persona_baja` tinyint(1) NOT NULL,
  `persona_consulta` tinyint(1) NOT NULL,
  `persona_modificar` tinyint(1) NOT NULL,
  `grupo_alta` tinyint(1) NOT NULL,
  `grupo_baja` tinyint(1) NOT NULL,
  `grupo_consulta` tinyint(1) NOT NULL,
  `grupo_modificar` tinyint(1) NOT NULL,
  `role_alta` tinyint(1) NOT NULL,
  `role_baja` tinyint(1) NOT NULL,
  `role_consulta` tinyint(1) NOT NULL,
  `role_modificar` tinyint(1) NOT NULL,
  `grupo_persona_alta` tinyint(1) NOT NULL,
  `grupo_persona_baja` tinyint(1) NOT NULL,
  `grupo_persona_consulta` tinyint(1) NOT NULL,
  `grupo_persona_modificar` tinyint(1) NOT NULL,
  `audit alta` tinyint(1) NOT NULL,
  `audit_modificar` tinyint(1) NOT NULL,
  `audit_baja` tinyint(1) NOT NULL,
  `audit_consulta` tinyint(1) NOT NULL

                        Role_Nombre = :Role_Nombre, 
                        email = :email, 
                        age = :age, 
                        designation = :designation, 
                        created = :created
                    WHERE 
                        idrole = :idrole";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->Role_Nombre=htmlspecialchars(strip_tags($this->Role_Nombre));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->age=htmlspecialchars(strip_tags($this->age));
            $this->designation=htmlspecialchars(strip_tags($this->designation));
            $this->created=htmlspecialchars(strip_tags($this->created));
            $this->idrole=htmlspecialchars(strip_tags($this->idrole));
        
            // bind data
            $stmt->bindParam(":Role_Nombre", $this->Role_Nombre);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":age", $this->age);
            $stmt->bindParam(":designation", $this->designation);
            $stmt->bindParam(":created", $this->created);
            $stmt->bindParam(":idrole", $this->idrole);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteRole(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE idrolerole = ?";
            $stmt = $this->conn->prepare($sqlQuery);
            $this->idrolerole=htmlspecialchars(strip_tags($this->idrolerole));
            $stmt->bindParam(1, $this->idrolerole);
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>

