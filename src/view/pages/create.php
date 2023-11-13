<?php
    $this->layout = 'default';
?>

<form action="<?= htmlspecialchars($this->urlFor('create@pages')) ?>" method="POST">
    <div class="grid-container">
        <div class="grid-x grid-padding-x">
            <div class="medium-6 cell">
                <label>
                    <span>Titre</span>
                    <input type="text" name="title" value="">
                </label>
            </div>
            <div class="medium-6 cell">
                <label>
                    <span>Date</span>
                    <input type="date" name="date" value="">
                </label>
            </div>
            <div class="cell medium-12">
                <label>
                    <span>Contenu</span>
                    <textarea name="content"></textarea>
                </label>
            </div>
            <div class="cell medium-12"><button class="expanded button" type="submit">Envoyer</button></div>
        </div>
    </div>
</form>