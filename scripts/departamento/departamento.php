<?php
    namespace App;
    class departamento extends connect{
        private $queryGet = 'SELECT idDep AS "Identificador", nombreDep AS "Nombre_Departamento", idPais AS "Identificador Pais" FROM departamento';
        private $queryDelete = 'DELETE FROM departamento WHERE idDep= :Identificador';
        private $queryUpdate = 'UPDATE departamento SET idDep = :Identificador  WHERE idDep = :idDep';
        private $queryPost = 'INSERT INTO departamento(idDep) VALUES(:Identificador)';
        private $message;
        use getInstance;
        function __construct(private $idDep=1){
            parent::__construct();
        }
        public function getDepartamento(){
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
        public function deleteDepartamento(){
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
        public function updateDepartamento(){
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
        public function postDepartamento(){
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
