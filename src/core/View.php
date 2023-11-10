<?php
namespace src\core;

/**
 * Classe modélisant une vue
 *
 * @version 1.0
 * @author Renaud Bourdeau
 */
class View {

    // chemin vers la vue
    private $path;
    
    // répertoire vers la vue
    private $directory;

    // la vue
    private $file;

    // définit le gabarit
    public $layout = 'default';

    /**
     * Constructeur
     *
     * @param string $viewFile Action à laquelle la vue est associée
     * @param string $directory Nom du contrôleur auquel la vue est associée
     */
    function __construct($directory, $file) {
        try{
            $this->directory = $directory;
            $this->file = $file;
            $mask = '%s/view/%s/%s.php';
            $this->path = sprintf($mask, SRC, $this->directory, $this->file);
            if(!file_exists($this->path)){
                throw new \Exception(sprintf('file not found : %s', $this->path));
            }
        }catch(Exception $e){
            if(DEBUG){
                echo $e->getMessage();
            }else{
                // $controller = new Controller();
            }
        }
    }


    /**
     * Génère et affiche la vue
     *
     * @param array $data Données nécessaires à la génération de la vue
     */
    public function render($data) {
        extract($data);
        ob_start();
        require_once $this->path;
        $content = ob_get_clean();
        require_once sprintf('%s/view/layout/%s.php', SRC, $this->layout);
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
            throw new \Exception("File not found '$file'");
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


    function urlFor($name, $params=[]){
        return BASE_URL.'/'.Router::url($name, $params);
    }
}

