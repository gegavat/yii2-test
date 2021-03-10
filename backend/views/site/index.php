<?php
use yii\bootstrap\Modal;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
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
                <div class="apple-bg"></div>
                <div class="apple-bg"></div>
                <div class="apple-bg"></div>
                <div class="apple-bg"></div>
                <div class="apple-bg"></div>
                <div class="apple-bg"></div>
                <div class="apple-bg"></div>
                <div class="apple-bg"></div>
                <div class="apple-bg"></div>
                <div class="apple-bg"></div>
                <div class="apple-bg"></div>
                <div class="apple-bg"></div>
                <div class="apple-bg"></div>
                <div class="apple-bg"></div>
                <div class="apple-bg"></div>
                <div class="apple-bg"></div>
                <div class="apple-bg"></div>
            </div>
        </div>
    </div>

</div>



<?php Modal::begin([
//    'size' => 'modal-sm',
    /*'options' => [
        'style' => [
            'margin-top' => '5%'
        ]
    ],*/
    'header' => '<h3>Укажите цвет яблока</h3>',
    'id' => 'apple-generate-modal',
]); ?>
<?php Modal::end() ?>