<?php

use Views\Entities\Head;
use Views\Entities\Raw;

/**
 * @var Views\ChatterView $this
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, user-scalable=no"/>
    <style type="text/css">
        <?= $this->loadStyles(); ?>

    </style>
</head>
<body>
<div class="wrapper">
    <div class="post-content indent">
        <? foreach ($this->lines as $block): ?>
            <?php if ($block instanceof Raw) : ?>
                <?= $block; ?>
                <?php continue; ?>
            <?php endif; ?>
            <blockquote class="chat">
                <p class="them <?= ($block instanceof Head ? 'head' : ''); ?>"><?= $block; ?></p>
            </blockquote>
        <? endforeach; ?>
    </div>
</body>
</html>
