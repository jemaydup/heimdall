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
            $sqlQuery = "SELECT idrolerole, Role_Nombre, status, persona_alta, persona_baja, persona_consulta, persona_modificar, grupo_alta, grupo_baja, grupo_consulta, grupo_modificar, role_alta, role_baja, role_consulta, role_modificar, grupo_persona_alta, grupo_persona_baja, grupo_persona_consulta, grupo_persona_modificar, audit_alta, audit_modificar, audit_baja, audit_consulta FROM " . $this->db_table . "";
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
        
            // sanitize Completar Campos
            $this->Role_Nombre=htmlspecialchars(strip_tags($this->Role_Nombre));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->age=htmlspecialchars(strip_tags($this->age));
            $this->designation=htmlspecialchars(strip_tags($this->designation));
            $this->created=htmlspecialchars(strip_tags($this->created));
        
            // bind data Completar Campos
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
        public function getSingleRole(){
            $sqlQuery = "SELECT idrolerole, Role_Nombre, status, persona_alta, persona_baja, persona_consulta, persona_modificar, grupo_alta, grupo_baja, grupo_consulta, grupo_modificar, role_alta, role_baja, role_consulta, role_modificar, grupo_persona_alta, grupo_persona_baja, grupo_persona_consulta, grupo_persona_modificar, audit_alta, audit_modificar, audit_baja, audit_consulta FROM ". $this->db_table ."
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
                    idrolerole, 
                    Role_Nombre, 
                    status, 
                    persona_alta, 
                    persona_baja, 
                    persona_consulta, 
                    persona_modificar, 
                    grupo_alta, 
                    grupo_baja, 
                    grupo_consulta, 
                    grupo_modificar, 
                    role_alta, 
                    role_baja, 
                    role_consulta, 
                    role_modificar, 
                    grupo_persona_alta, 
                    grupo_persona_baja, 
                    grupo_persona_consulta, 
                    grupo_persona_modificar, 
                    audit_alta, 
                    audit_modificar, 
                    audit_baja, 
                    audit_consulta
                    WHERE 
                        idrole = :idrole";
        
            $stmt = $this->conn->prepare($sqlQuery);
        //completar campos
            $this->Role_Nombre=htmlspecialchars(strip_tags($this->Role_Nombre));
            $this->idrolerole=htmlspecialchars(strip_tags($this->Role_Nombre)); 
                    Role_Nombre, 
                    status, 
                    persona_alta, 
                    persona_baja, 
                    persona_consulta, 
                    persona_modificar, 
                    grupo_alta, 
                    grupo_baja, 
                    grupo_consulta, 
                    grupo_modificar, 
                    role_alta, 
                    role_baja, 
                    role_consulta, 
                    role_modificar, 
                    grupo_persona_alta, 
                    grupo_persona_baja, 
                    grupo_persona_consulta, 
                    grupo_persona_modificar, 
                    audit_alta, 
                    audit_modificar, 
                    audit_baja, 
                    audit_consulta
           
        
            // bind data Completar campos
            $stmt->bindParam(":Role_Nombre", $this->Role_Nombre);
        
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