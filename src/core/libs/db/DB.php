<?php
    namespace src\core\libs\db;
    use \PDO;

    class DB{
        private $pdo = null;
        private $query = null;

        public function __construct($params){
            $this->pdo = new PDO($params['dns'], $params['user'], $params['password']);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        public function beginTransaction(){
            $this->pdo->beginTransaction();
        }

        public function commit(){
            $this->pdo->commit();
        }

        public function rollBack(){
            $this->pdo->rollBack();
        }

        public function query($sql, $params = []){
            try {
                if(count($params) > 0){
                    $this->query = $this->pdo->prepare($sql);
                    $this->query->execute($params);
                }else{
                    $this->query = $this->pdo->query($sql);
                }

                return $this;
            } catch (Exception $e) {
                return false;
            }
        }

        public function fetch(){
            return $this->query->fetchAll(PDO::FETCH_OBJ);
        }

        public function getLastInsertId(){
            return $this->pdo->lastInsertId();
        }
    }
