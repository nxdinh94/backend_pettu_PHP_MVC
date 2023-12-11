<?php
class User extends Controller {
    private $userModel;

    public function __construct() {
        $this->userModel = $this->model('UserModel', 'admin');
    }

    // Lấy danh sách bài viết 
    public function getListUser() {
        $request = new Request();

        if ($request->isGet()): // Kiểm tra get

            $result = $this->userModel->handleGetListUser(); // Gọi xử lý ở Model

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

    // Lấy danh sách người chức năng
    public function getListCompetentPersonnel() {
        $request = new Request();

        if ($request->isGet()): // Kiểm tra get

            $result = $this->userModel->handleGetListCompetentPersonnel(); // Gọi xử lý ở Model

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


    // Update trạng thái account
    public function updateStatusAccount() {
        $request = new Request();

        if ($request->isPost()): // Kiểm tra get
            $data = $request->getFields();

            if (!empty($data['user_id'])):
                $userId = $data['user_id'];

                $result = $this->userModel->handleUpdateStatusAccount($userId); // Gọi xử lý ở Model

                if (!empty($result)):
                    $response = [
                        'message' => 'Thay đổi thành công',
                    ];
                else:
                    $response = [
                        'message' => 'Đã có lỗi xảy ra'
                    ];
                endif;
            else:
                $response = [
                    'message' => 'Đã có lỗi xảy ra'
                ];
            endif;

            echo json_encode($response);

        endif;
    }
    // Duyệt đăng ký của user
    public function confirmRegisterService()
    {
        $request = new Request();

        if ($request->isPost()) : // Kiểm tra get
            $data = $request->getFields();

            if (!empty($data['userId']) && $data['serviceId']) :
                $userId = $data['userId'];
                $serviceId = $data['serviceId'];

                $result = $this->userModel->handleConfirmRegisterService($userId, $serviceId); // Gọi xử lý ở Model

                if (!empty($result)) :
                    $response = [
                        'message' => 'Đã duyệt thành công',
                        'status' => true,
                    ];
                else :
                    $response = [
                        'message' => 'Đã có lỗi xảy ra',
                        'status' => false,

                    ];
                endif;
            else :
                $response = [
                    'message' => 'Đã có lỗi xảy ra'
                ];
            endif;

            echo json_encode($response);

        endif;
    }
    // Lấy danh sách dịch vụ đã đăng ký của người dùng
    public function getPendingService()
    {
        $request = new Request();

        if ($request->isGet()) :
            $result = $this->userModel->handleGetPendingService();

            if (!empty($result)) :
                $response = [
                    'data' => $result,
                    'status' => true
                ];
            else :
                $response = [
                    'message' => 'Đã có lỗi xảy ra',
                    'status' => false
                ];
            endif;

            echo json_encode($response);
        endif;
    }
    // kieemr tra dijch vuj ddax ddawng kis chuwa
    public function isRegistered()
    {
        $request = new Request();

        if ($request->isPost()) : // Kiểm tra get
            $data = $request->getFields();

            if (!empty($data['userId'])&& !empty($data['serviceId'])) :
                $userId = $data['userId'];
                $serviceId = $data['serviceId'];
                $result = $this->userModel->handleIsRegistered($userId,$serviceId ); // Gọi xử lý ở Model

                if (!empty($result)) :
                    $response = [
                        'status' => true,
                        'data' => $result,
                    ];
                else :
                    $response = [
                        'status' => false,
                        'message' => 'Không có dữ liệu'
                    ];
                endif;
            else :
                $response = [
                    'message' => 'Params not found'
                ];
            endif;

            echo json_encode($response);
        endif;
    }
}