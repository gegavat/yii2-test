<?php
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $applesFromTree \app\models\Apple */
/* @var $applesOnGround \app\models\Apple */

$this->title = 'Яблочное приложение';
?>

<div class="site-index">
    <div class="apple-func">
        <a href="#" class="btn btn-success" id="apple-generate">
            <span class="glyphicon glyphicon-grain" aria-hidden="true"></span>
            Вырастить яблоко
        </a>
    </div>
    <div class="clearfix"></div>

    <div class="apple-tree-box">
        <div class="apple-tree">
            <div class="apple-tree-group">
                <?php foreach ( $applesFromTree as $apple ) : ?>
                    <div class="apple" data-id="<?= $apple->id ?>" style="background:<?= $apple->color ?>"></div>
                <?php endforeach; ?>
            </div>

            <div class="apple-ground-group">
                <?php foreach ( $applesOnGround as $apple ) : ?>
                    <div class="apple-on-ground" data-id="<?= $apple->id ?>" style="background:<?= $apple->color ?>"></div>
                <?php endforeach; ?>
            </div>

        </div>


    </div>

</div>
