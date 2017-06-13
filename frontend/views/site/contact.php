<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;




$this->title = 'Contact';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">




    <div class="row">
        <div class="col-lg-6">
            <p>
                If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.
            </p>

            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

            <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'email') ?>

            <?= $form->field($model, 'subject') ?>

            <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>
            
            <?= $form->field($model, 'reCaptcha')->widget(\himiklab\yii2\recaptcha\ReCaptcha::className()) ?>
        

            <?php
            /*   $form->field($model, 'verifyCode')->widget(Captcha::className(), [
              'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
              ]) */
            ?>

            <div class="form-group">
                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
        <div class="col-lg-5">

            <?php echo $map->display(); ?>
            <br />
            <p style="text-align:left">Head Office Address: 13 Marjorie Street, Regents Park Johannesburg, South Africa <br />
                Phone: 084 715 9888 or 078 533 9895 <br />
                E-mail: info@onlineprinters.co.za <br />
            </p>
        </div>
    </div>

</div>
