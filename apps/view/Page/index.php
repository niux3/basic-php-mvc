<?php
    $this->layout = "default";
    $this->title = 'yoo';
?>
<?php foreach($articles as $index => $article): ?>
<article>
    <h1><?= $article->BIL_TITRE ?></h1>
</article>
<?php endforeach; ?>
