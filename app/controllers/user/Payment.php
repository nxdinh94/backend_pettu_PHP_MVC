<?php
class Payment extends Controller {
    private $paymentModel;

    public function __construct() {
        $this->paymentModel = $this->model('PaymentModel', 'user');
    }

    public function receiveVNPayCallback() {
        // Nếu có $_GET và data từ vnpay thì gọi model và truyền giá trị $_GET cho model xử lý
        if (isset($_GET) && !empty($_GET)) {
            $vnpayData = $_GET;
            $this->paymentModel->handleVNPayCallback($vnpayData);
        } else {
            file_put_contents('vnpay_callback.log', 'Không có dữ liệu từ VNPay', FILE_APPEND);
        }
    }    
}