<?php
    namespace apps\core;
    /**
     * Classe de gestion des paramètres de configuration
     *
     * @version 1.0
     * @author Renaud Bourdeau
     */
    class Configuration {

        /** Tableau des paramètres de configuration */
        private static $parameters;


        /**
         * Renvoie la valeur d'un paramètre de configuration
         *
         * @param string $nom Nom du paramètre
         * @param string $valeurParDefaut Valeur à renvoyer par défaut
         * @return string Valeur du paramètre
         */
        public static function get($name, $default = null) {
            if (isset(self::getParameters()[$name])) {
                $value = self::getParameters()[$name];
            }else{
                $value = $default;
            }
            return $value;
        }


        /**
         * Renvoie le tableau des paramètres en le chargeant au besoin depuis un fichier de configuration.
         * Les fichiers de configuration recherchés sont config/dev.ini et config/prod.ini (dans cet ordre)
         *
         * @return array Tableau des paramètres
         * @throws Exception Si aucun fichier de configuration n'est trouvé
         */
        private static function getParameters() {
            if (self::$parameters == null) {
                $path = APPS."config/dev.ini";
                if (!file_exists($path)) {
                    $path = APPS."config/prod.ini";
                }
                if (!file_exists($path)) {
                    throw new Exception("Aucun fichier de configuration trouvé");
                }
                else {
                    self::$parameters = parse_ini_file($path);
                }
            }
            return self::$parameters;
        }
    }
