<?php

namespace app\controllers;

use app\models\Order;
use app\models\Performer;
use app\models\User;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\MethodNotAllowedHttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class OrdersController extends Controller
{
    public function actionIndex()
    {
        $orders = $this->getOrders();
        return $this->render('index', compact('orders'));
    }

    public function actionAjaxIndex()
    {
        $orders = $this->getOrders();
        if ($this->request->isAjax) {
            return $this->renderPartial('ajax/index', compact('orders'));
        }
        throw new MethodNotAllowedHttpException();
    }

    public function actionAppointPerformer()
    {
        if ($this->request->isPost && $this->request->isAjax) {
            $data = $this->request->post();
            $performer = new Performer();
            $this->response->format = Response::FORMAT_JSON;

            if ($performer->load($data, '') && $performer->validate()) {
                /** @var Performer $currPerformer */
                $currPerformer = Order::findOne($data['Order'])->lastPerformer;
                if ($currPerformer) {
                    $currPerformer->Reason = $data['Reason'];
                    $currPerformer->save();
                }
                $performer->Reason = '';
                $performer->save();
                $this->response->data = ['errors' => 'no'];
            } else {
                $this->response->data = ['errors' => $performer->getErrors()];
            }
        } else {
            throw new NotFoundHttpException();
        }
    }

    public function actionOne()
    {
        $orderId = (int)$this->request->get('id');
        $order = Order::findOne($orderId);

        if ($order) {
            return $this->render('one', compact('order'));
        }
        throw new NotFoundHttpException();
    }

    public function actionAdd()
    {
        $order = new Order();

        if ($this->request->isPost) {
            if ($order->load($this->request->post()) && $order->save()) {
                \Yii::$app->session->setFlash('success', 'Ваш заказ был успешно размещен');
                return $this->redirect(Url::to('/'));
            } else {
                \Yii::$app->session->setFlash('error', 'Произошла непредвиденная ошибка');
            }
        }

        $users = User::findAll(['Role_id' => 2]);
        return $this->render('add', compact('order', 'users'));
    }

    private function getOrders()
    {
        if ($this->request->get('filter')) {
            $date = $this->request->get('date') ?: date('Y-m-d', time());
            if (!strtotime($date))
                $date = date('Y-m-d', time());
            $price = $this->request->get('price') ?: 0;
            $price = is_numeric($price) ? $price : 0;
            return $orders = Order::find()
                ->where('Date_from >= :date', [':date' => $date])
                ->andWhere('Price >= :price', [':price' => $price])
                ->orderBy('ID DESC')
                ->with('user')
                ->all();
        }
        return $orders = Order::find()
            ->orderBy('ID DESC')
            ->with('user')
            ->with('performers')
            ->all();
    }
}