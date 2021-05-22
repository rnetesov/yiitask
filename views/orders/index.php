<?php
/** @var array $orders */

use app\models\User;
use yii\helpers\Url;

?>
<!-- Modal -->
<div class="modal fade" id="modal-change-performer" role="dialog">
    <div class="modal-dialog modal-sm">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Назначить исполнителя</h4>
            </div>
            <div class="modal-body">
                <form action="<?= Url::to('orders/appoint-performer') ?>" method="post" id="change-performer">
                    <input type="hidden" name="<?= Yii::$app->request->csrfParam ?>"
                           value="<?= Yii::$app->request->getCsrfToken() ?>">
                    <input type="hidden" name="Date_appointment" value="<?= date('Y-m-d H:i:s', time()) ?>">
                    <div class="form-group">
                        <select class="form-control" name="User_id">
                            <option disabled selected>Назначить исполнителя</option>
                            <?php foreach (User::findAll(['Role_id' => 3]) as $performer): ?>
                                <option value="<?= $performer->ID ?>"><?= $performer->Fullname ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                                  placeholder="Причина смены исполнителя" name="Reason"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-default" form="change-performer">Назначить</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Отменить</button>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <h2>Заказы</h2>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">Фильтр</div>
            <div class="panel-body">
                <form class="form-inline" method="get" action="<?= Url::to('/') ?>">
                    <input type="hidden" name="filter" value="yes">
                    <input type="date" name="date" class="form-control" placeholder="Дата">
                    <input type="text" name="price" class="form-control" placeholder="Стоимость">
                    <button type="submit" class="btn btn-default">Применить</button>
                    <button type="button" class="btn btn-default" onclick="location.href='<?= Url::to('/') ?>'">Сбросить</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <a href="<?= Url::to(['orders/add']) ?>" class="btn btn-default" style="margin-bottom: 20px">Добавить заказ</a>

        <?php if (Yii::$app->session->hasFlash('success')): ?>
            <div class="alert alert-success alert-dismissible show" role="alert">
                <?= Yii::$app->session->getFlash('success') ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <?php if (Yii::$app->session->hasFlash('error')): ?>
            <div class="alert alert-danger alert-dismissible show" role="alert">
                <?= Yii::$app->session->getFlash('error') ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <?php if (count($orders) > 0): ?>
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
    </div>
</div>

<script>
    modalWnd = $('#modal-change-performer');
    ordersTable = $('#my-orders-table');

    modalWnd.on('show.bs.modal', function (event) {
        btnElem = $(event.relatedTarget);
        orderId = btnElem.data('order-id');

        if (btnElem.data('performer') === 'no') {
            let textarea = modalWnd.find('textarea');
            textarea.prop('readonly', 'readonly');
            textarea.attr('placeholder', '');

        }
        modalWnd.find('form').prepend(`<input type="hidden" name="Order" value="${orderId}">`);
    })

    modalWnd.on('hidden.bs.modal', function () {
        elem = $('#modal-change-performer').find('textarea').removeAttr('readonly');
        elem.val('');
        modalWnd.find('form input[name="Order"]').remove();
    })

    $('#change-performer').submit(function (e) {
        e.preventDefault();
        $.ajax({
            type : "POST",
            url : '/orders/appoint-performer',
            data : $(this).serialize(),
            dataType : 'json',
            success : function (data) {
                if (data.errors === 'no') {
                    $.get(`/orders/ajax-index${window.location.search}`, function (data) {
                        $('#my-orders-table').replaceWith(data);
                        modalWnd.modal('hide');
                    });
                } else {
                    result = '';
                    for (const error in data.errors) {
                        for (const errorElement of data.errors[error]) {
                            result += errorElement + '\n';
                        }
                    }
                    alert(result);
                }
            },
        });
    });
</script>