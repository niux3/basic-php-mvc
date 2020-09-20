<?php
    namespace apps\core;

    /**
     * Classe abstraite Controller
     * Fournit des services communs aux classes Controleur dérivées
     *
     * @version 1.0
     * @author Renaud Bourdeau
     */
    abstract class Controller {

        /** Action à réaliser */
        private $action;

        /** Requête entrante */
        protected $request;

        /**
         * Définit la requête entrante
         *
         * @param Request $requete Requete entrante
         */
        public function setRequest(Request $request){
            $this->request = $request;
        }


        /**
         * Exécute l'action à réaliser.
         * Appelle la méthode portant le même nom que l'action sur l'objet Controleur courant
         *
         * @throws Exception Si l'action n'existe pas dans la classe Controleur courante
         */
        public function execute($action){
            if (method_exists($this, $action)) {
                $this->action = $action;
                $this->{$this->action}();
            } else {
                $view = new View('404');
                $view->render(array('msgErreur' => 'page introuvable'));
            }
        }


        /**
         * Génère la vue associée au contrôleur courant
         *
         * @param array $donneesVue Données nécessaires pour la génération de la vue
         */
        protected function render($data = []){
            // Détermination du nom du fichier vue à partir du nom du contrôleur actuel
            $classeController = get_class($this);
            $controller = str_replace("Controller", "", $classeController);

            // Instanciation et génération de la vueF
            $vue = new View($this->action, $controller);
            $vue->render($data);
        }
    }
