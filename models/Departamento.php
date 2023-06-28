<?php 
    namespace Models;
    class Departamento{
        protected static $conn;
        protected static $columnsTbl=['idDep','nombreDep','idPais'];
        private $idDep;
        private $nombreDep;
        private $idPais;
        public function __construct($args=[]){
            $this->idDep = $args['idDep'] ?? '';
            $this->nombreDep = $args['nombreDep'] ?? '';
            $this->idPais = $args['idPais'] ?? '';
        }
        public function saveData($data){
            $delimiter = ":";
            $dataBd = $this->sanitizarAttributos();
            $valCols = $delimiter . join(',:',array_keys($data));
            $cols = join(',',array_keys($data));
            $sql = "INSERT INTO departamento ($cols) VALUES ($valCols)";
            $stmt= self::$conn->prepare($sql);
            try {
                $stmt->execute($data);
                $response=[[
                    'idDep' => self::$conn->lastInsertId(),
                    'nombreDep' => $data['nombreDep'],
                    'idPais' => $data['idPais']
                ]];
            }catch(\PDOException $e) {
                return $sql . "<br>" . $e->getMessage();
            }
            return json_encode($response);
        }
        public function loadAllData(){
            $sql = "SELECT idDep,nombreDep,idPais FROM departamento";
            $stmt= self::$conn->prepare($sql);
            $stmt->execute();
            $countries = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $countries;
        }
        
        public static function setConn($connBd){
            self::$conn = $connBd;
        }
        public function atributos(){
            $atributos = [];
            foreach (self::$columnsTbl as $columna){
                if($columna === 'idDep') continue;
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