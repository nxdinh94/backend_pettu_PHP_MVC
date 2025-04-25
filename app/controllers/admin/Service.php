<?php
class Service extends Controller {
    private $serviceModel;

    public function __construct() {
        $this->serviceModel = $this->model('ServiceModel', 'admin');
    }

    // Lấy thông tin chi tiết của Pets
    public function getServiceDetailInfo() {
        $request = new Request();

        if ($request->isGet()): // Kiểm tra get
            
            $result = $this->serviceModel->handleGetDetail(); // Gọi xử lý ở Model

            if (!empty($result)):
                $response = $result;
            else:
                $response = [
                    'message' => 'Đã có lỗi xảy ra'
                ];
            endif;

            echo json_encode($response);
        endif;
    }
    // Lấy thời gian làm việc
    public function getTimeWorking()
    {
        $request = new Request();

        if ($request->isGet()) : // Kiểm tra post

            
               

        $result = $this->serviceModel->handleGetTimeWorking(); // Gọi xử lý ở Model

        if (!empty($result)) :
            $response = $result;
        else :
            $response = [
                'message' => 'Đã có lỗi xảy ra'
            ];
        endif;
           

            echo json_encode($response);
        endif;
    }

    public function getListUserServiceToday() {
        $request = new Request();

        if ($request->isGet()):
            $result = $this->serviceModel->handleGetListUserServiceToday();

            if (!empty($result)):
                $response = [
                    'status' => true,
                    'data' => $result
                ];
            else:
                $response = [
                    'status' => false,
                    'message' => 'Đã có lỗi xảy ra'
                ];
            endif;
            header('Content-Type: application/json');
            echo json_encode($response);      
        endif;
    }

    public function createUserServiceSurvey() {
        $request = new Request();

        if ($request->isPost()):
            $jsonData = file_get_contents("php://input");
            $data = json_decode($jsonData, true); // Chuyển đổi JSON thành mảng PHP
            $response = [];

            $result = $this->serviceModel->handleCreateUserServiceSurvey($data); // Gọi xử lý ở Model

            if ($result):
                $response = [
                    'status' => true,
                    'message' => 'Khảo sát dịch vụ thành công'
                ];
            else:
                $response = [
                    'status' => false,
                    'message' => 'Đã có lỗi xảy ra'
                ];
            endif;
            header('Content-Type: application/json');
            echo json_encode($response);
        endif;
    }
}