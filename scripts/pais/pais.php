<?php
    namespace App;
    class pais extends connect{
        private $queryGet = 'SELECT idPais AS "Identificador", nombrePais AS "Nombre_Pais" FROM pais';
        private $queryDelete = 'DELETE FROM pais WHERE idPais= :Identificador';
        private $queryUpdate = 'UPDATE pais SET idPais = :Identificador  WHERE idPais = :idPais';
        private $queryPost = 'INSERT INTO pais(idPais) VALUES(:Identificador)';
        private $message;
        use getInstance;
        function __construct(private $idPais=1){
            parent::__construct();
        }
        public function getPais(){
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
        public function deletePais(){
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
        public function updatePais(){
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
        public function postPais(){
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