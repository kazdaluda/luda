<?php

namespace frontend\controllers\payment;

use robokassa\Merchant;
use shop\entities\Shop\Order\Order;
use shop\readModels\Shop\OrderReadRepository;
use shop\useCases\Shop\OrderService;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use robokassa\ResultAction;
use robokassa\SuccessAction;
use robokassa\FailAction;


class RobokassaController extends Controller
{
    public $enableCsrfValidation = false;

    private $orders;
    private $service;

    public function __construct($id, $module, OrderReadRepository $orders, OrderService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->orders = $orders;
        $this->service = $service;
    }
    private function loadModel($id)
    {
        if (!$order = $this->orders->findOwn(\Yii::$app->user->id, $id)) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        return $order;
    }

    public function actionInvoice($id)
    {
        $order = $this->loadModel($id);

        return $this->render('invoice',['ee'=> $order]);

       // return $this->getMerchant()->payment($order->cost, $order->id, 'коментарий писать', null, null);
    }

    public function actionResult($a,$aa,$aaa,$aaaa)
    {
        $dataSet=$_POST;

        if (!$dataSet)
        {
            exit('Ошибка платежаa');
        }
        unset($dataSet['ik_sign']); //Delete string with signature from dataset
ksort($dataSet, SORT_STRING); // Sort elements in array by var names in alphabet queue
array_push($dataSet, '5W1D5Bf0uH1EX7L1'); // Adding secret key at the end of the string
$signString = implode(':', $dataSet); // Concatenation calues using symbol ":"
$sign = base64_encode(md5( $signString, true));
if ($sign != $_POST['ik_sign'])
{
    exit('000000000000');
}
        file_put_contents(__DIR__.'/2.txt',$aa);
    return $sign; // Return the result

    }
    public function actionSuccess()
    {
        \yii::$app->session->setFlash('success', 'Yes');
        return $this->goBack();
    }
    public function actionFail()
    {
        echo "nonnonono";
    }

    /**
     * @inheritdoc
     */
   /* public function actions() {
        return [
            'result' => [
                'class' => 'lan143\interkassa\ResultAction',
                'callback' => [$this, 'resultCallback'],
            ],
            'success' => [
                'class' => 'lan143\interkassa\SuccessAction',
                'callback' => [$this, 'successCallback'],
            ],
            'fail' => [
                'class' => 'lan143\interkassa\FailAction',
                'callback' => [$this, 'failCallback'],
            ],
        ];
    }

    public function successCallback($merchant, $nInvId, $nOutSum, $shp)
    {
        return $this->goBack();
    }

    public function resultCallback($merchant, $nInvId, $nOutSum, $shp)
    {
        $order = $this->loadModel($nInvId);
        try {
            $this->service->pay($order->id);
            return 'OK' . $nInvId;
        } catch (\DomainException $e) {
            return $e->getMessage();
        }
    }

    public function failCallback($merchant, $nInvId, $nOutSum, $shp)
    {
        $order = $this->loadModel($nInvId);
        try {
            $this->service->fail($order->id);
            return 'OK' . $nInvId;
        } catch (\DomainException $e) {
            return $e->getMessage();
        }
    }

    /*private function loadModel($id)
    {
        if (!$order = $this->orders->findOwn(\Yii::$app->user->id, $id)) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        return $order;
    }

    private function getMerchant()
    {
         return Yii::$app->get('interkassa');
    }*/


}