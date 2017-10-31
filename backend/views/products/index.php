<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProductsSerach */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Add new product', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'ASIN',
            'Title',
            'Price',
            [
                'attribute' => 'image',
                'label' => 'Picture',
                'format' => 'html',
                'value' => function($data, $row){
                    return $data->Picture != "" ? '<img style="max-width:80px" src="'.$data->Picture.'">': null;
                },
            ],
            'EAN',
            'Brand',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
