<?php
class Payment extends Controller {
    private $paymentModel;

    public function __construct() {
        $this->paymentModel = $this->model('PaymentModel', 'user');
    }

    public function receiveVNPayCallback() {
        if (isset($_GET) && !empty($_GET)) {
            $vnpayData = $_GET;
            $this->paymentModel->handleVNPayCallback($vnpayData);
        } else {
            file_put_contents('vnpay_callback.log', 'Không có dữ liệu từ VNPay', FILE_APPEND);
        }
    }    

    public function deleteCartAfterPayment() {
        $request = new Request();

        if ($request->isPost()) :
            $jsonData = file_get_contents("php://input");
            $data = json_decode($jsonData, true); // Chuyển đổi JSON thành mảng PHP
            $response = [];
            
            if (!empty($data['userId']) && !empty($data['products'])) :
                $userId = $data['userId'];
                $productList = $data['products'];

                $result = $this->paymentModel->handleDeleteCartAfterPayment($userId, $productList);

                if ($result) :
                    $response = [
                        'status' => true,
                        'message' => 'Xoá thành công'
                    ];
                else :
                    $response = [
                        'status' => false,
                        'message' => 'Xoá thất bại'
                    ];
                endif;

                echo json_encode($response);
            endif;
        endif;
    }
}