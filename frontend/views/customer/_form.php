<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $model frontend\models\Customer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'c_name')->textInput() ?>

    <?= $form->field($model, 'c_email')->textInput() ?>

    <?= $form->field($model, 'c_address')->textInput() ?>

    <?= $form->field($model, 'c_zip')->textInput() ?>

    <?= $form->field($model, 'c_telephone')->textInput() ?>

    <?= $form->field($model, 'c_dob')->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'Enter date'],
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd',
            //'value'=>date('yyyy-mm-dd'),
            'autoclose' => true
        ]
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Add' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
