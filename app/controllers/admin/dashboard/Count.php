<?php
class Count extends Controller{
    private $countModel;

    public function __construct() {
        $this->countModel = $this->model('CountModel', 'admin');
    }

    public function countListExpert() {
        $request = new Request();
        $response = [];

        if ($request->isGet()):
            $result = $this->countModel->handleCountListExpert();

            if (is_numeric($result)):
                $response = [
                    'status' => true,
                    'data' => $result
                ];
            else:
                $response = [
                    'status' => false,
                ];
            endif;

            echo json_encode($response);
        endif;
    }

    public function countListUser() {
        $request = new Request();
        $response = [];

        if ($request->isGet()):
            $result = $this->countModel->handleCountListUser();

            if (is_numeric($result)):
                $response = [
                    'status' => true,
                    'data' => $result
                ];
            else:
                $response = [
                    'status' => false,
                ];
            endif;

            echo json_encode($response);
        endif;
    }

    public function countListProduct() {
        $request = new Request();
        $response = [];

        if ($request->isGet()):
            $result = $this->countModel->handleCountListProduct();

            if (is_numeric($result)):
                $response = [
                    'status' => true,
                    'data' => $result
                ];
            else:
                $response = [
                    'status' => false,
                ];
            endif;

            echo json_encode($response);
        endif;
    }

    public function countListService() {
        $request = new Request();
        $response = [];

        if ($request->isGet()):
            $result = $this->countModel->handleCountListService();

            if (is_numeric($result)):
                $response = [
                    'status' => true,
                    'data' => $result
                ];
            else:
                $response = [
                    'status' => false,
                ];
            endif;

            echo json_encode($response);
        endif;
    }
 public function countListStatusBill() {
        $request = new Request();
        $response = [];

        if ($request->isGet()):
            $result = $this->countModel->handleCountListStatusBill();

            if (is_numeric($result)):
                $response = [
                    'status' => true,
                    'data' => $result
                ];
            else:
                $response = [
                    'status' => false,
                ];
            endif;

            echo json_encode($response);
        endif;
    }

    public function countListStatusPayment() {
        $request = new Request();
        $response = [];

        if ($request->isGet()):
            $result = $this->countModel->handleCountListStatusPayment();

            if (is_numeric($result)):
                $response = [
                    'status' => true,
                    'data' => $result
                ];
            else:
                $response = [
                    'status' => false,
                ];
            endif;

            echo json_encode($response);
        endif;
    }

    public function countListStatusUser_Service() {
        $request = new Request();
        $response = [];

        if ($request->isGet()):
            $result = $this->countModel->handleCountListStatusUser_Service();

            if (is_numeric($result)):
                $response = [
                    'status' => true,
                    'data' => $result
                ];
            else:
                $response = [
                    'status' => false,
                ];
            endif;

            echo json_encode($response);
        endif;
    }

}