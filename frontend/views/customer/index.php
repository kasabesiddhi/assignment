<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Customers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Add new', ['create'], ['class' => 'btn btn-success']) ?>
 <div class="user-type-form" >

        <?php
        $form = ActiveForm::begin(['method'=>'GET','id' => 'login-form', 'action' => 'index.php?r=customer/sort'
        ]);
        ?>
        <table>
            <tr>
                <td><b>Age:</b></td>
                <td style="padding-right: 20px">
                    <select style="height: 30px;width:150px" id="age" name="age" >
                        <option value="0">All</option>

                            <option value="1">Less than 25</option>
                            <option value="2">Greater or equal to 25</option>
                     
                    </select>
                    <span class="error-message" id="age_error"></span>
                </td>
                 <td><b>Name:</b></td>
                <td style="padding-right: 20px">
                  <input type = "text" id="name" name="name">
                    <span class="error-message" id="name_error"></span>
                </td>
              <td><b>Email:</b></td>
                <td style="padding-right: 20px">
                  <input type = "text" id="email" name="email">
                    <span class="error-message" id="email_error"></span>
                </td>
                
               
                <td style="padding-left: 20px">
                    <?= Html::submitButton('Search', ['class' => 'btn btn-success', 'onclick' => 'return myfunction()']) ?>
                </td>
            </tr>
        </table>

        <span style="color: red; margin-left: 45%;display:none" id="date_error"></span><br/>

        <?php ActiveForm::end(); ?>
        <br/>
    </div>

    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'c_id',
            'c_name',
            'c_email:email',
            'c_address',
            'c_zip',
            'c_telephone',
           // 'c_dob',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
