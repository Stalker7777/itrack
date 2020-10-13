<?php

use yii\helpers\Html;

$this->title = 'Создать комментарий';
$this->params['breadcrumbs'][] = ['label' => 'Список', 'url' => ['list']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
