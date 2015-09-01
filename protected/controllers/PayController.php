<?php

class PayController extends Controller {

    public $layout = '//layouts/html5_main';

    /**
     * 向支付宝提交数据
     */
    public function actionGotopay() {
        if (isset($_POST['chongzhi_form']) && isset($_POST['chongzhi_form']['chongzhimoney'])) {
            #判断传输的资金是否正确
            if (is_numeric($_POST['chongzhi_form']['chongzhimoney']) && $_POST['chongzhi_form']['chongzhimoney'] > 0.01) {
                #生成订单
                $user_id = Yii::app()->user->getId();
                $trade_no = time() . $user_id . rand(10000, 99999);
                $money = $_POST['chongzhi_form']['chongzhimoney'];
                $banktype = "ZFB";
                $remark="赚赚乐在线充值服务";
                if (isset($_POST['chongzhi_form']['bank'])) {
                    $banktype = $_POST['chongzhi_form']['bank'];
                }
                $newRecharge = new Recharge();
                $newRecharge->setAttributes(array(
                    'trade_no' => $trade_no,
                    'user_id' => $user_id,
                    'money' => $money,
                    'payment' => 1,
                    'type' => 1,
                    'fee' => 0,
                    'bankcode' => $banktype,
                    'remark' => $remark,
                ));
                if ($newRecharge->validate() && $newRecharge->save()) {
                    $alipay = Yii::app()->alipay;
                    // If starting a guaranteed payment, use AlipayGuaranteeRequest instead
                    $request = new AlipayDirectRequest();

                    $request->out_trade_no = $trade_no;
                    $request->subject = "赚赚乐充值";
                    $request->body = $remark;
                    $request->total_fee = $money;
                    $request->defaultbank = $banktype;
                    // Set other optional params if needed
                    $form = $alipay->buildForm($request);
                    echo $form;
                    exit();
                }
            }
        }
        $this->redirect("/index.html");
    }

// Server side notification
    public function actionNotify() {
        $alipay = Yii::app()->alipay;
        if ($alipay->verifyNotify()) {
            $order_id = $_POST['out_trade_no'];
            $order_fee = $_POST['total_fee'];
            if ($_POST['trade_status'] == 'TRADE_FINISHED' || $_POST['trade_status'] == 'TRADE_SUCCESS') {
                update_order_status($order_id, $order_fee, $_POST['trade_status']);
                echo "success";
            } else {
                echo "success";
            }
        } else {
            echo "fail";
            exit();
        }
    }

//Redirect notification
    public function actionReturn() {
        $alipay = Yii::app()->alipay;
        if ($alipay->verifyReturn()) {
            $order_id = $_GET['out_trade_no'];
            $total_fee = $_GET['total_fee'];

            if ($_GET['trade_status'] == 'TRADE_FINISHED' || $_GET['trade_status'] == 'TRADE_SUCCESS') {
                update_order_status($order_id, $total_fee, $_POST['trade_status']);
                $this->render('order_paid');
            } else {
                echo "trade_status=" . $_GET['trade_status'];
            }
        } else {
            echo "fail";
            exit();
        }
    }

    /**
     * @return array 过滤器列表，会顺序执行
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // ?代表来宾用户
                'actions' => array('captcha'),
                'users' => array('*'),
            ),
            array('allow', // @代表有角色的
                'actions' => array('gotopay',),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
            ),
            array('deny', // *代表所有的用户
                'users' => array('*'),
            ),
        );
    }

}
