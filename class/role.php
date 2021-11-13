<?php
    class Employee{

        // Connection
        private $conn;

        // Table
        private $db_table = "GdA_Role";

        // Columns+
       public $idrole;
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
            $sqlQuery = "SELECT id, name, email, age, designation, created FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function createEmployee(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        name = :name, 
                        email = :email, 
                        age = :age, 
                        designation = :designation, 
                        created = :created";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->age=htmlspecialchars(strip_tags($this->age));
            $this->designation=htmlspecialchars(strip_tags($this->designation));
            $this->created=htmlspecialchars(strip_tags($this->created));
        
            // bind data
            $stmt->bindParam(":name", $this->name);
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
                        id, 
                        name, 
                        email, 
                        age, 
                        designation, 
                        created
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       id = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->id);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->name = $dataRow['name'];
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
                    idrole = :idrole,
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

                        name = :name, 
                        email = :email, 
                        age = :age, 
                        designation = :designation, 
                        created = :created
                    WHERE 
                        id = :id";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->age=htmlspecialchars(strip_tags($this->age));
            $this->designation=htmlspecialchars(strip_tags($this->designation));
            $this->created=htmlspecialchars(strip_tags($this->created));
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            // bind data
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":age", $this->age);
            $stmt->bindParam(":designation", $this->designation);
            $stmt->bindParam(":created", $this->created);
            $stmt->bindParam(":id", $this->id);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteRole(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE idrole = ?";
            $stmt = $this->conn->prepare($sqlQuery);
            $this->idrole=htmlspecialchars(strip_tags($this->idrole));
            $stmt->bindParam(1, $this->idrole);
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>

