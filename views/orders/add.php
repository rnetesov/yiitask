<div class="row">
    <div class="col-xs-6">
        <h2>Добавить заказ</h2>
        <?php
        /** @var \app\models\Order $order */
        /** @var array $users */

        use yii\helpers\Html;
        use yii\widgets\ActiveForm;

        $form = ActiveForm::begin([
                'id' => 'add-order-form'
            ]
        ) ?>

        <?= $form->field($order, 'Work_list')->label('Наименование работы') ?>
        <?= $form->field($order, 'Date_from')->label('Дата начала работ')->input('date') ?>
        <?= $form->field($order, 'Date_to')->label('Дата окончания работ')->input('date') ?>
        <?= $form->field($order, 'Price')->label('Цена работы') ?>
        <?php
        $items = [];
        foreach ($users as $user) {
            $items[$user->ID] = $user->Fullname;
        }
        ?>
        <?= $form->field($order, 'Customer_id')->label('Заказчики')->dropDownList($items) ?>

        <div class="form-group">
            <?= Html::submitButton('Добавить', [
                'class' => 'btn btn-primary'
            ]) ?>
        </div>
        <?php ActiveForm::end() ?>
    </div>
</div>