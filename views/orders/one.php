<?php
//d($order);
/** @var $order \app\models\Order */
?>

<div class="row">
    <div class="col-xs-6">
        <h2>Заказ</h2>
        <table class="table table-hover table-bordered">
            <tr>
                <th>Заказчик</th>
                <td><?= $order->user->Fullname ?></td>
            </tr>
            <tr>
                <th>Работы</th>
                <td><?= $order->Work_list ?></td>
            </tr>
            <tr>
                <th>Дата начала</th>
                <td><?= (new DateTime($order->Date_from))->format('Y-m-d') ?></td>
            </tr>
            <tr>
                <th>Дата окончания</th>
                <td><?= (new DateTime($order->Date_to))->format('Y-m-d') ?></td>
            </tr>
            <tr>
                <th>Стоимость</th>
                <td><?= number_format($order->Price, '2', ',', ' ') ?></td>
            </tr>
            <tr>
                <?php $currPerformer = $order->lastPerformer; ?>
                <th>Исполнитель</th>
                <td>
                    <?php if ($currPerformer): ?>
                        <?= $currPerformer->user->Fullname ?>
                    <?php else: ?>
                        Исполнитель пока не назначен
                    <?php endif; ?>
                </td>
            </tr>
        </table>
    </div>
</div>

<?php
$performers = $order->performers;
if (!empty($performers)) array_pop($performers);
?>

<?php if (count($performers) > 0): ?>
    <div class="row">
        <div class="col-xs-12">
            <h2>История исполнителей</h2>
            <table class="table table-bordered table-hover">
                <tr>
                    <th>Дата назначения</th>
                    <th>ФИО</th>
                    <th>Причина</th>
                </tr>
                <?php foreach ($performers as $performer): ?>
                    <tr>
                        <td><?= $performer->Date_appointment ?></td>
                        <td><?= $performer->user->Fullname ?></td>
                        <td><?= $performer->Reason ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
<?php endif; ?>
