<?php
    namespace App;
    class region extends connect{
        private $queryGet = 'SELECT idReg AS "Identificador", nombreReg AS "Nombre_Region", idDep AS "Identificador_Departamento" FROM region';
        private $queryDelete = 'DELETE FROM region WHERE idReg= :Identificador';
        private $queryUpdate = 'UPDATE region SET idReg = :Identificador  WHERE idReg = :idReg';
        private $queryPost = 'INSERT INTO region(idReg) VALUES(:Identificador)';
        private $message;
        use getInstance;
        function __construct(private $idReg=1, public $nombreReg=1){
            parent::__construct();
        }
        public function getRegion(){
            try {
                $res = $this->conx->prepare($this->queryGet);
                $res->execute();
                $this->message = ["code" => 200, "Message" => $res->fetchAll(\PDO::FETCH_ASSOC)];
            } catch (\PDOException $e) {
                $this->message = ["code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
            } finally {
                print_r($this->message);
            }
        }
        public function deleteRegion(){
            try {
                $res = $this->conx->prepare($this->queryDelete);
                $res->bindValue("Identificador", $this->id);
                $res->execute();
                $this->message = ["Code" => 200, "Message" => "Data delete"];
            } catch (\PDOException $e) {
                $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
            } finally {
                print_r($this->message);
            }
        }
        public function updateRegion(){
            try {
                $res = $this->conx->prepare($this->queryUpdate);
                $res->bindValue("Identificador", $this->id);
                $res->execute();

                if ($res->rowCount() > 0) {
                    $this->message = ["Code" => 200, "Message" => "Data updated"];
                } else {
                    $this->message = ["Code" => 404, "Message" => "No matching record found"];
                }
            } catch (\PDOException $e) {
                $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
            } finally {
                print_r($this->message);
            }
        }
        public function postRegion(){
            try {
                $res = $this->conx->prepare($this->queryPost);
                $res->bindValue("Identificador", $this->id);
                $res->execute();
                $this->message = ["Code" => 200 + $res->rowCount(), "Message" => "inserted data"];
            } catch (\PDOException $e) {
                $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
            } finally {
                print_r($this->message);
            }
        }
    }
?>