<?php
    namespace apps\core;

    /**
     * Classe modélisant une vue
     *
     * @version 1.0
     * @author Renaud Bourdeau
     */
    class View {

        /** Nom du fichier associé à la vue */
        private $file;

        /** Titre de la vue (défini dans le fichier vue) */
        private $title;

        // définit le gabarit
        public $layout;

        /**
         * Constructeur
         *
         * @param string $action Action à laquelle la vue est associée
         * @param string $controller Nom du contrôleur auquel la vue est associée
         */
        public function __construct($action, $controller = "") {
            // Détermination du nom du fichier vue à partir de l'action et du constructeur
            // La convention de nommage des fichiers vues est : Vue/<$controller>/<$action>.php
            $file = APPS."view/";
            if ($controller != "") {
                $file = sprintf('%s%s/', $file, substr($controller, strrpos($controller, '\\') + 1));
            }
            $this->file = sprintf("%s%s.php", $file, $action);
        }


        /**
         * Génère et affiche la vue
         *
         * @param array $data Données nécessaires à la génération de la vue
         */
        public function render($data) {
            // Génération de la partie spécifique de la vue
            $content = $this->generate($this->file, $data);
            // On définit une variable locale accessible par la vue pour la racine Web
            // Il s'agit du chemin vers le site sur le serveur Web
            // Nécessaire pour les URI de type controleur/action/id
            $root = Configuration::get("root", "/");
            // Génération du gabarit commun utilisant la partie spécifique
            // Renvoi de la vue générée au navigateur
            $args = [
                'title' => $this->title,
                'content' => $content,
                'root' => $root,
            ];
            $layout = sprintf('%sview/%s.php', APPS, $this->layout);
            echo $this->generate($layout,$args);
        }


        /**
         * Génère un fichier vue et renvoie le résultat produit
         *
         * @param string $file Chemin du fichier vue à générer
         * @param array $data Données nécessaires à la génération de la vue
         * @return string Résultat de la génération de la vue
         * @throws Exception Si le fichier vue est introuvable
         */
        private function generate($file, $data) {
            if (file_exists($file)) {
                // Rend les éléments du tableau $data accessibles dans la vue
                extract($data);
                // Démarrage de la temporisation de sortie
                ob_start();
                // Inclut le fichier vue
                // Son résultat est placé dans le tampon de sortie
                require $file;
                // Arrêt de la temporisation et renvoi du tampon de sortie
                return ob_get_clean();
            } else {
                throw new \Exception("Fichier '$file' introuvable");
            }
        }


        /**
         * Nettoie une valeur insérée dans une page HTML
         * Permet d'éviter les problèmes d'exécution de code indésirable (XSS) dans les vues générées
         *
         * @param string $valeur Valeur à nettoyer
         * @return string Valeur nettoyée
         */
        private function clean($valeur) {
            return htmlspecialchars($valeur, ENT_QUOTES, 'UTF-8', false);
        }
    }
