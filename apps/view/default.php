<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <base href="<?= $root ?>" >
        <link rel="stylesheet" href="statics/css/styles.css" />
        <title><?= $title ?></title>
    </head>
    <body>
        <div id="global">
            <header>
                <a href=""><h1 id="titreBlog">un titre</h1></a>
                <p><strong>Lorem ipsum dolor sit amet, consectetur adipisicing.</strong></p>
            </header>
            <div id="contenu">
                <?= $content ?>
            </div> <!-- #contenu -->
            <footer id="piedBlog">
                Application réalisée avec PHP, HTML5 et CSS.
            </footer>
        </div> <!-- #global -->
    </body>
</html>
