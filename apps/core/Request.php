<?php
    namespace apps\core;
    /*
     * Classe modélisant une requête HTTP entrante
     *
     * @version 1.0
     * @author Renaud Bourdeau
     */
    class Request {

        /** Tableau des paramètres de la requête */
        private $arguments;


        /**
         * Constructeur
         *
         * @param array $arguments Paramètres de la requête
         */
        public function __construct($arguments) {
            $this->arguments = $arguments;
        }


        /**
         * Renvoie vrai si le paramètre existe dans la requête
         *
         * @param string $nom Nom du paramètre
         * @return bool Vrai si le paramètre existe et sa valeur n'est pas vide
         */
        public function argumentIsExist($name) {
            return (isset($this->arguments[$name]) && $this->arguments[$name] != "");
        }


        /**
         * Renvoie la valeur du paramètre demandé
         *
         * @param string $nom Nom d paramètre
         * @return string Valeur du paramètre
         * @throws Exception Si le paramètre n'existe pas dans la requête
         */
        public function getArguments($name) {
            if ($this->argumentIsExist($name)) {
                return $this->arguments[$name];
            }
            else {
                throw new Exception("Paramètre '$name' absent de la requête");
            }
        }
    }
