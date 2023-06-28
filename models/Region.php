<?php 
    namespace Models;
    class Region{
        protected static $conn;
        protected static $columnsTbl=['idReg','nombreReg','idPais'];
        private $idReg;
        private $nombreReg;
        private $idPais;
        public function __construct($args=[]){
            $this->idReg = $args['idReg'] ?? '';
            $this->nombreReg = $args['nombreReg'] ?? '';
            $this->idPais = $args['idPais'] ?? '';            
        }
        public function saveData($data){
            $delimiter = ":";
            $dataBd = $this->sanitizarAttributos();
            $valCols = $delimiter . join(',:',array_keys($data));
            $cols = join(',',array_keys($data));
            $sql = "INSERT INTO region ($cols) VALUES ($valCols)";
            $stmt= self::$conn->prepare($sql);
            try {
                $stmt->execute($data);
                $response=[[
                    'idReg' => self::$conn->lastInsertId(),
                    'nombreReg' => $data['nombreReg'],
                    'idPais' => $data['idPais']
                ]];
            }catch(\PDOException $e) {
                return $sql . "<br>" . $e->getMessage();
            }
            return json_encode($response);
        }       
        public function loadAllData(){
            $sql = "SELECT idReg,nombreReg,idPais FROM region";
            $stmt= self::$conn->prepare($sql);
            $stmt->execute();
            $countries = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $countries;
        }
        public function deleteData($id){
            $sql = "DELETE FROM region where idReg = :id";
            $stmt= self::$conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        }
        public function updateData($data){
            $sql = "UPDATE region SET nombreReg = :nombreReg, idPais = :idPais where idReg = :idReg";
            $stmt= self::$conn->prepare($sql);
            $stmt->bindParam(':nombreReg', $data['nombreReg']);
            $stmt->bindParam(':idPais', $data['idPais']);
            $stmt->bindParam(':idReg', $data['idReg']);
            $stmt->execute();
        }
        public static function setConn($connBd){
            self::$conn = $connBd;
        }
        public function atributos(){
            $atributos = [];
            foreach (self::$columnsTbl as $columna){
                if($columna === 'idReg') continue;
                $atributos [$columna]=$this->$columna;
             }
             return $atributos;
        }
        public function sanitizarAttributos(){
            $atributos = $this->atributos();
            $sanitizado = [];
            foreach($atributos as $key => $value){
                $sanitizado[$key] = self::$conn->quote($value);
            }
            return $sanitizado;
        }
    }
?>