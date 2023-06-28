<?php
    namespace App;
    class campers extends connect{
        private $queryGet = 'SELECT idCamper AS "Identificador", nombreCamper AS "Nombre", apellidoCamper AS "Apellido", fechaNac AS "Fecha Nacimiento", idReg AS "Identificador_Region" FROM campers';
        private $queryDelete = 'DELETE FROM campers WHERE idCampers= :Identificador';
        private $queryUpdate = 'UPDATE campers SET idCamper = :Identificador  WHERE idCamper = :idCamper';
        private $queryPost = 'INSERT INTO campers(idCampers) VALUES(:Identificador)';
        private $message;
        use getInstance;
        function __construct(private $idCamper=1){
            parent::__construct();
        }
        public function getCampers(){
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
        public function deleteCampers(){
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
        public function updateCampers(){
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
        public function postCampers(){
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