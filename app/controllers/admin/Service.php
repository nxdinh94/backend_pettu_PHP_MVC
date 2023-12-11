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

}