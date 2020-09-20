<?php
    namespace apps\core;
    /*
     * Classe de routage des requêtes entrantes.
     *
     * @version 1.0
     * @author Renaud Bourdeau
     */
     /**
      *
      */
     class Router{
        /**
        * Méthode principale appelée par le contrôleur frontal
        * Examine la requête et exécute l'action appropriée
        */
        function executeRequest(){
            try{
                $request = new Request(array_merge($_GET, $_POST));
                $controller = $this->getController($request);
                $action = $this->getAction($request);
                $controller->execute($action);
            }catch(Exception $e){
                $this->errorManager($e);
            }
        }

        /**
         * Instancie le contrôleur approprié en fonction de la requête reçue
         *
         * @param Request $requete Requête reçue
         * @return Instance d'un contrôleur
         * @throws Exception Si la création du contrôleur échoue
        */
        private function getController(Request $request){
            if ($request->argumentIsExist('controller')) {
                $controller = $request->getArguments('controller');
                // Première lettre en majuscules
                $controller = ucfirst(strtolower($controller));
            }else{
                $controller = Configuration::get('controller');
            }

            //convention de nommage
            $classController = sprintf('\apps\controller\%sController', $controller);
            $controller = new $classController();
            $controller->setRequest($request);
            return $controller;
        }


        /**
        * Détermine l'action à exécuter en fonction de la requête reçue
        *
        * @param Requete $requete Requête reçue
        * @return string Action à exécuter
        */
        private function getAction(Request $request){
            if ($request->argumentIsExist('action')) {
                return $request->getArguments('action');
            }else{
                return Configuration::get('action');
            }
        }


        /**
        * Gère une erreur d'exécution (exception)
        *
        * @param Exception $exception Exception qui s'est produite
        */
        private function errorManager(Exception $exception){
            $view = new View('error');
            $view->render(['msgErreur' => $exception->getMessage()]);
        }
    }
