<?php

use kartik\grid\GridView;

$this->title = 'Список';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="contact-list">

    <?php echo GridView::widget([
        'dataProvider' => $data_provider,
        'filterModel' => $search_model,
        'columns' => [
            [
                'attribute' => 'contact_id',
                'width' => '100px',
                'headerOptions' => ['class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'group' => true,
            ],
            [
                'attribute' => 'email',
                'headerOptions' => ['class' => 'text-center'],
                'group' => true,
                'value' => function ($model, $key, $index, $widget) {
                    return $model->contact->email;
                },
            ],
            [
                'attribute' => 'text',
                'headerOptions' => ['class' => 'text-center'],
            ],
        ],
        'pjax' => true,
        'panel' => [ 'type' => GridView::TYPE_PRIMARY ],
    ]); ?>
</div>
