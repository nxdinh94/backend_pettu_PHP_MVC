<?php
class User extends Controller
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = $this->model('UserModel', 'user');
    }

    // Đăng ký dịch vụ
    public function registerService()
    {
        $request = new Request();

        $data = $request->getFields();

        if (
            !empty($data['userId'])
            && !empty($data['serviceId']) && !empty('register_day')&& !empty($data['periodTime'])
        ) :


            $dataRequest = [
                'userId' => $data['userId'],
                'serviceId' => $data['serviceId'],
                'register_day' =>$data['register_day'],
                'periodTime' => $data['periodTime'],
            ];

            $result = $this->userModel->handleRegisterService($dataRequest);

            if ($result) :
                $response = [
                    'message' => 'Hoàn tất đăng ký, hệ thống đang xử lý yêu cầu!!!',
                    'status' => true,
                ];
            else :
                $response = [
                    'message' => 'Đăng ký dịch vụ thất bại',
                    'status' => false,
                ];
            endif;

            echo json_encode($response);
        endif;
    }
    // Thay đổi thời gian sử dụng dịch vụ
    public function updatePeriodTime() {
        $request = new Request();

        $data = $request->getFields();

        if (!empty($data)):

            $result = $this->userModel->handleUpdatePeriodTime($data);

            if ($result):
                $response = [
                    'message' => 'Thay đổi thành công',
                    'status' => true
                ];
            else:
                $response = [
                    'message' => 'Thay đổi không thành công',
                    'status' => false
                ];
            endif;

            echo json_encode($response);
        endif;
    }
}
