<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\ReCaptcha;

/* @var $this yii\web\View */
/* @var $model app\models\RegForm */
/* @var $form ActiveForm */

$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-reg">

    <?php $form = ActiveForm::begin([
        'id' => 'reg-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{input}\n{error}",
        ],
    ]); ?>

    <section class="content center full-width" style="visibility: visible; animation-name: fadeInUp;">
        <div class="modal container">
            <h3>Регистрация</h3>

            <div class="f-row">
                <?= $form->field($model, 'username')->textInput(['placeholder' => 'Логин']) ?>
            </div>
            <div class="f-row">
                <?= $form->field($model, 'email')->textInput(['placeholder' => 'Электропочта']) ?>
            </div>
            <div class="f-row">
                <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Пароль']) ?>
            </div>
            <div class="f-row">
                <?= $form->field($model, 'reCaptcha')->widget(
                    ReCaptcha::className(),
                    ['siteKey' => '6LfkVAsTAAAAAA8qCya2QRj6cm_FlMSZwcLL8eBt']
                ) ?>
            </div>

            <div class="f-row bwrap">
                <?= Html::submitButton('Регистрация') ?>
            </div>
            <p>Уже зарегистрированы? <a href="/login">Войти.</a></p>
        </div>
    </section>

    <?php ActiveForm::end(); ?>

</div><!-- site-reg -->
