<?php
use yii\bootstrap\Modal;
use yii\widgets\Pjax;

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
    <div class="apple-tip">Для управления яблоком кликните по нему</div>

    <div class="apple-tree-box">
        <div class="apple-tree">
            <div class="apple-tree-group">
                <?php foreach ( $applesFromTree as $apple ) : ?>
                    <div class="apple"
                         data-id="<?= $apple->id ?>"
                         data-color="<?= $apple->color ?>"
                         data-created_at="<?= $apple->created_at ?>"
                         style="background:<?= $apple->color ?>">
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="apple-ground-group">
                <?php foreach ( $applesOnGround as $apple ) : ?>
                    <div class="apple-on-ground"
                         data-id="<?= $apple->id ?>"
                         data-color="<?= $apple->color ?>"
                         data-created_at="<?= $apple->created_at ?>"
                         data-fallen_at="<?= $apple->fallen_at ?>"
                         data-status="<?= $apple->status ?>"
                         data-residue="<?= $apple->residue ?>"
                         style="background:<?= $apple->color ?>">
                        <?php if ( $apple->status === 'spoiled' ) : ?>
                            <div class="apple-worm"></div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>

    </div>

</div>

<!-- Свойства яблок на дереве -->
<?php Modal::begin([
//    'size' => 'modal-lg',
    'header' => '<h2>Свойства выбранного яблока</h2>',
    'id' => 'apple-properties-modal',
]); ?>
    <div style="font-size: 1.2em">
        <div>Цвет яблока:</div>
        <div class="apple-prop-color" style="font-style: italic"></div>
        <br>
        <div>Статус яблока:</div>
        <div class="apple-prop-status" style="font-style: italic"></div>
        <br>
        <div>Выращено:</div>
        <div class="apple-prop-created_at" style="font-style: italic"></div>
        <br>
    </div>
<?php Modal::end() ?>

<!-- Поедание яблок с земли -->
<?php Modal::begin([
//    'size' => 'modal-sm',
    'header' => '<h2>Поедание яблока</h2>',
    'id' => 'apple-eat-modal',
]); ?>
<div style="font-size: 1.2em">
    <div>Сколько процентов откусим?</div>
    <input type="range" min="0" max="100" step="1" value="20" oninput="this.nextElementSibling.value = this.value">
    <output class="output-eat-apple"></output>
    <br>
    <a href="#" class="btn btn-success eat-apple-btn">Выполнить</a>
</div>
<?php Modal::end() ?>

<!-- Свойства яблок на земле -->
<?php Modal::begin([
//    'size' => 'modal-lg',
    'header' => '<h2>Свойства выбранного яблока</h2>',
    'id' => 'apple_on_ground-properties-modal',
]); ?>
    <div style="font-size: 1.2em">
        <div>Цвет яблока:</div>
        <div class="apple_on_ground-prop-color" style="font-style: italic"></div>
        <br>
        <div>Статус яблока:</div>
        <div class="apple_on_ground-prop-status" style="font-style: italic"></div>
        <br>
        <div>Выращено:</div>
        <div class="apple_on_ground-prop-created_at" style="font-style: italic"></div>
        <br>
        <div>Упало:</div>
        <div class="apple_on_ground-prop-fallen_at" style="font-style: italic"></div>
        <br>
        <div>Остаток яблока в процентах:</div>
        <div class="apple_on_ground-prop-residue" style="font-style: italic"></div>
        <br>
    </div>
<?php Modal::end() ?>