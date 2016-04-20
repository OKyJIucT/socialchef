<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

$this->title = 'Вход';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">

    <!--row-->
    <div class="row">
        <!--content-->
        <section class="content center full-width">
            <div class="modal container">
                <h3>Вход</h3>

                <?php $form = ActiveForm::begin([
                    'id' => 'login-form',
                    'options' => ['class' => 'form-horizontal'],
                    'fieldConfig' => [
                        'template' => "{input}\n{error}",
                    ],
                ]); ?>

                <div class="f-row">
                    <?= $form->field($model, 'username')->textInput(['placeholder' => " Ваш логин"]) ?>
                </div>
                <div class="f-row">
                    <?= $form->field($model, 'password')->passwordInput(['placeholder' => " Ваш пароль"]) ?>
                </div>

                <div class="f-row">
                    <?= $form->field($model, 'rememberMe')->checkbox([
                        'template' => "{input} {label}",
                    ]) ?>
                </div>

                <div class="f-row bwrap">
                    <?= Html::submitButton('Войти', ['name' => 'login-button']) ?>
                </div>

                <p><a href="/reg">Создать учетную запись</a></p>
                <p><a href="#">Забыли пароль?</a></p>

                <?php ActiveForm::end(); ?>

            </div>
        </section>
        <!--//content-->
    </div>
    <!--//row-->
</div>
