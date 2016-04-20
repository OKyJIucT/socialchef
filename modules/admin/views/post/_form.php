<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use vova07\imperavi\Widget;

use app\models\Category;

/* @var $this yii\web\View */
/* @var $model app\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>



    <?=
    $form->field($model, 'category_id')
        ->dropDownList(
            ArrayHelper::map(Category::find()->all(), 'id', 'title'),
            ['prompt' => 'Выберите категорию']
        )
    ?>

    <?= $form->field($model, 'image')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'short_text')->widget(Widget::className(), [
        'settings' => [
            'lang' => 'ru',
            'minHeight' => 250,
            'imageUpload' => Url::to(['/site/image-upload']),
            'imageManagerJson' => Url::to(['/site/images-get']),
            'plugins' => [
                'imagemanager'
            ]
        ]
    ]); ?>

    <?= $form->field($model, 'full_text')->widget(Widget::className(), [
        'settings' => [
            'lang' => 'ru',
            'minHeight' => 500,
            'imageUpload' => Url::to(['/site/image-upload']),
            'imageManagerJson' => Url::to(['/site/images-get']),
            'plugins' => [
                'imagemanager'
            ]
        ]
    ]); ?>

    <?= $form->field($model, 'active')->checkbox(['id' => 'active']) ?>

    <div class="clearfix"></div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Редактировать', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>


    <div class="clearfix"></div>
    <?php ActiveForm::end(); ?>




</div>
