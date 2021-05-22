<?php use yii\helpers\Url;

if (count($orders) > 0): ?>
    <table class="table table-bordered table-hover" id="my-orders-table">
        <tr style="background-color: #F5F5F5; color: #204d74">
            <th>ФИО</th>
            <th>Работы</th>
            <th>Дата начала</th>
            <th>Дата окончания</th>
            <th>Стоимость</th>
            <th>Исполнитель</th>
            <th>Исполнитель</th>
        </tr>
        <?php foreach ($orders as $order): ?>
            <?php $class = (strtotime($order['Date_from']) < time() && is_null($order->lastPerformer)) ? 'danger' : '' ?>
            <tr class="<?= $class ?>">
                <td><a href="<?= Url::to(['/orders/one', 'id' => $order->ID]) ?>"><?= $order->user->Fullname ?></a>
                </td>
                <td><?= $order->Work_list ?></td>
                <td class="col-xs-1"><?= (new DateTime($order->Date_from))->format('Y-m-d') ?></td>
                <td class="col-xs-1"><?= (new DateTime($order->Date_to))->format('Y-m-d') ?></td>
                <td><?= number_format($order->Price, '2', ',', ' ') ?></td>
                <td>
                    <?php if ($performer = $order->lastPerformer): ?>
                        <?= $performer->user->Fullname ?>
                    <?php endif; ?>
                </td>
                <td>
                    <?php if ($performer): ?>
                        <button type="button"
                                class="btn btn-sm btn-default my-btn"
                                data-performer="yes"
                                data-order-id="<?= $order->ID ?>"
                                data-toggle="modal"
                                data-target="#modal-change-performer">
                            Изменить исполнителя
                        </button>
                    <?php else: ?>
                        <button type="button"
                                class="btn btn-sm btn-danger my-btn"
                                data-performer="no"
                                data-order-id="<?= $order->ID ?>"
                                data-toggle="modal"
                                data-target="#modal-change-performer">
                            Назначить исполнителя
                        </button>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>
