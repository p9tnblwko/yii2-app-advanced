<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Products */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="products-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ASIN')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Picture')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'EAN')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Brand')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Add', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
