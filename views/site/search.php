<?php
/**
 * Created by PhpStorm.
 * User: kohone
 * Date: 29.06.2015
 * Time: 18:36
 */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

?>

<div class="form-inline">
    <?php

    $form = ActiveForm::begin(['layout' => 'horizontal']);

    // Form field without label
    echo $form->field($model, 'mail', [
        'inputOptions' => [
            'placeholder' => $model->getAttributeLabel('mail'),
        ],
    ])->label(true);

    echo "<hr />";

    // Control sizing in horizontal mode
    echo $form->field($model, 'mail', [
        'horizontalCssClasses' => [
            'wrapper' => 'col-sm-2',
        ]
    ]);

    echo "<hr />";

    // With 'default' layout you would use 'template' to size a specific field:
    echo $form->field($model, 'mail', [
        'template' => '{label} <div class="row"><div class="col-sm-4">{input}{error}{hint}</div></div>'
    ]);

    echo "<hr />";

    // Input group
    echo $form->field($model, 'mail', [
        'inputTemplate' => '<div class="input-group"><span class="input-group-addon">@</span>{input}</div>',
    ]);

    ActiveForm::end();

    ?>
</div>