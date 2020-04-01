<?php

use common\models\User;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var \yii\web\View $this
 */

?>
    <div class="row">
    <div class="col-sm-3">
        <h2>Группы</h2>
        <hr>
        <?= $groups ?>
        <hr>
        <button class="btn btn-primary" data-toggle="modal" data-target="#create-group">Create group</button>
    </div>
    <div class="col-sm-9">
        <?php if (@$_GET['group_id']): ?>

        <?= $messages ?>
        <div>
        <?php
            $form = ActiveForm::begin(['action' => ['chat/send-message']]);
        ?>
            <br>
            <div class="input-group">
                <input type="hidden" name="SendMessageForm[group_id]" value="<?= @$_GET['group_id'] ?>">
                <input type="text" class="form-control" placeholder="Your message..." name="SendMessageForm[message]" required>
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit">Send!</button>
                </span>
            </div>
        <?php
            ActiveForm::end();
        ?>
        </div>
        <?php else: ?>
            <b>Выберите группу слева.</b>
        <?php endif ?>
    </div>
</div>

<?php
    Modal::begin([
        'id' => 'create-group',
        'header' => '<h2>Create group</h2>',
    ]);
    $form = ActiveForm::begin(['action' => ['chat/create-group']]);
    $model = new \frontend\models\CreateGroupForm();
?>

    <?= $form->field($model, 'title')->textInput()->label('Group name'); ?>
    <div class="form-group">
        <?= Html::submitButton('Create', ['class' => 'btn btn-primary']) ?>
    </div>

<?php
    ActiveForm::end();
    Modal::end();
?>

<?php
    Modal::begin([
        'id' => 'add-user',
        'header' => '<h2>Add user to group</h2>',
    ]);
    $form = ActiveForm::begin(['action' => ['chat/add-user']]);
    $model = new \frontend\models\AddUserForm();
?>

    <?= $form->field($model, 'group_id')->hiddenInput()->label(false) ?>
    <label>Группа: <span id="groupName"></span></label>
    <?= $form->field($model, 'user_id')->dropDownList(User::getList())->label('Пользователь') ?>

    <div class="form-group">
        <?= Html::submitButton('Add', ['class' => 'btn btn-primary']) ?>
    </div>

<?php
    ActiveForm::end();
    Modal::end();

    $this->registerJs('
        $("#add-user").on("show.bs.modal", function (e) {
            var btn = e.relatedTarget;
            $("#groupName").text($(btn).data("name"));
            $("#adduserform-group_id").val($(btn).data("id"));
        });
    ');
?>
