<?php
    class Employee{

        // Connection
        private $conn;

        // Table
        private $db_table = "GdA_Role";

        // Columns+
       public $idrolerole;
       public $Role_Nombre;
       public $status;
       public $persona_alta;
       public $persona_baja;
       public $persona_consulta; 
       public $persona_modificar;
       public $grupo_alta;
       public $grupo_baja;
       public $grupo_consulta;
       public $grupo_modificar; 
       public $role_alta; 
       public $role_baja; 
       public $role_consulta; 
       public $role_modificar; 
       public $grupo_persona_alta; 
       public $grupo_persona_baja; 
       public $grupo_persona_consulta; 
       public $grupo_persona_modificar; 
       public $audit_alta; 
       public $audit_modificar; 
       public $audit_baja; 
       public $audit_consulta; 

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
            $this->idrolerole=htmlspecialchars(strip_tags($this->idrolerole)); 
            $this->Role_Nombre=htmlspecialchars(strip_tags($this->; 
            $this->status=htmlspecialchars(strip_tags($this->; 
            $this->persona_alta=htmlspecialchars(strip_tags($this->; 
            $this->persona_baja=htmlspecialchars(strip_tags($this->; 
            $this->persona_consulta=htmlspecialchars(strip_tags($this->; 
            $this->persona_modificar=htmlspecialchars(strip_tags($this->; 
            $this->grupo_alta=htmlspecialchars(strip_tags($this->; 
            $this->grupo_baja=htmlspecialchars(strip_tags($this->; 
            $this->grupo_consulta=htmlspecialchars(strip_tags($this->; 
            $this->grupo_modificar=htmlspecialchars(strip_tags($this->; 
            $this->role_alta=htmlspecialchars(strip_tags($this->; 
            $this->role_baja=htmlspecialchars(strip_tags($this->;
            $this->role_consulta=htmlspecialchars(strip_tags($this->;
            $this->role_modificar=htmlspecialchars(strip_tags($this->;
            $this->grupo_persona_alta=htmlspecialchars(strip_tags($this->;
            $this->grupo_persona_baja=htmlspecialchars(strip_tags($this->;
            $this->grupo_persona_consulta=htmlspecialchars(strip_tags($this->;
            $this->grupo_persona_modificar=htmlspecialchars(strip_tags($this->;
            $this->audit_alta=htmlspecialchars(strip_tags($this->;
            $this->audit_modificar=htmlspecialchars(strip_tags($this->;
            $this->audit_baja=htmlspecialchars(strip_tags($this->; 
            $this->audit_consulta=htmlspecialchars(strip_tags($this->;
           
        
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