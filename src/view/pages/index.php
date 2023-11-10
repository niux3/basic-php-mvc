<?php 
$this->layout = 'default';
?>
<ul>
    <?php foreach($rows as $v): ?>
    <li><a href="<?=$this->urlFor('show@pages', [':id' => $v->id]) ?>" class="button"><?= $v->title ?></a></li>
    <?php endforeach ?>
</ul>
<hr>
<p><?= $this->urlFor('index@pages')?></p>
<p><?= $this->urlFor('show@pages', [':uuid' => '123-a56', ':id' => 1, ':slug' => 'quelque-chose'])?></p>
<p><a href="<?=$this->urlFor('show@pages', [':uuid' => '123aze123', ':slug' => 'autre-chose', ':id' => 23]) ?>?v=123456">un lien</a></p>
<hr>

<p><?= $prenom ?></p>
<p><?= $age ?></p>
<p> >>>> <?= $echo ?> <<<< </p>
