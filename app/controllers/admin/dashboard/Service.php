<?php
class Service extends Controller {
    private $serviceModel;

    public function __construct() {
        $this->serviceModel = $this->model('ServiceModel', 'admin');
    }

    // Lấy danh sách bài viết 
    public function getListService() {
        $request = new Request();

        if ($request->isGet()): // Kiểm tra get

            $result = $this->serviceModel->handleGetListService(); // Gọi xử lý ở Model

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


    // Sửa dịch vụ
    public function update()
    {
        $request = new Request();

        if ($request->isPost()) :
            $data = $request->getFields();
            $response = [];

            if (!empty($data)) :
                $request->rules([
                    'name' => 'required',
                    'slug' => 'required',
                    'content' => 'required',
                    'cost' => 'required',
                    'teamid' => 'required',
                ]);

                $request->message([
                    'name.required' => 'Tên dịch vụ không được để trống',
                    'slug.required' => 'Đường dẫn không được để trống',
                    'content.required' => 'Nội dung không được để trống',
                    'cost.required' => 'Giá không được để trống',
                    'teamid.required' => 'Bộ phận đảm nhiệm không được để trống',
                ]);

                $validate = $request->validate();

                if ($validate) :
                    if (!empty($data['serviceId'])) :
                        $serviceId = $data['serviceId'];
                        $result = $this->serviceModel->handleUpdateService($data, $serviceId);
                    endif;

                    if ($result) :
                        $response = [
                            'status' => true,
                            'message' => 'Thay đổi thành công'
                        ];
                    else :
                        $response = [
                            'status' => false,
                            'message' => 'Thay đổi thất bại'
                        ];
                    endif;
                else :
                    $response = [
                        'status' => false,
                        'errors' => Session::flash('pettu_session_errors')
                    ];
                endif;

                echo json_encode($response);
            endif;
        endif;
    }


    // Thêm dịch vụ
    public function add() {
        $request = new Request();

        if ($request->isPost()):
            $data = $request->getFields();
            $response = [];

            if (!empty($data)):
                $request->rules([
                    'name' => 'required',
                    'slug' => 'required',
                    'content' => 'required',
                    'cost' => 'required',
                    'teamid' => 'required',
                ]);

                $request->message([
                    'name.required' => 'Tên dịch vụ không được để trống',
                    'slug.required' => 'Đường dẫn không được để trống',
                    'content.required' => 'Nội dung không được để trống',
                    'cost.required' => 'Giá không được để trống',
                    'teamid.required' => 'Bộ phận đảm nhiệm không được để trống',
                ]);

                $validate = $request->validate();

                if ($validate):
                    $result = $this->serviceModel->handleAddService($data);

                    if ($result):
                        $response = [
                            'status' => true,
                            'message' => 'Thêm thành công'
                        ];
                    else:
                        $response = [
                            'status' => false,
                            'message' => 'Thêm thất bại'
                        ];
                    endif;
                else:
                    $response = [
                        'status' => false,
                        'errors' => Session::flash('pettu_session_errors')
                    ];
                endif;

                echo json_encode($response);
            endif;
        endif;


    }
    // Xoá dịch vụ
    public function delete() {
        $request = new Request();

        if ($request->isPost()):
            $data = $request->getFields();
            $response = [];

            if (!empty($data['serviceId'])):
                $serviceId = $data['serviceId'];

                if (!empty($serviceId)):
                    $result = $this->serviceModel->handleDeleteService($serviceId);

                    if ($result):
                        $response = [
                            'status' => true,
                            'message' => 'Xoá thành công'
                        ];
                    else:
                        $response = [
                            'status' => false,
                            'message' => 'Xoá thất bại'
                        ];
                    endif;
                endif;

                echo json_encode($response);
            endif;
        endif;
    }
    //lay toan bo danh sách dich vu chưa thanh toán
    public function getListUnpaidService() {
        $request = new Request();

        if ($request->isGet()):
            $result = $this->serviceModel->handleGetListUnpaidService();

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

            echo json_encode($response);      
        endif;
    }
    
    // Duyệt trạng thái đã thanh toán dịch vụ của người dùng 
    public function changeServicePaymentStatus() {
        $request = new Request();

        if ($request->isPost()):
            $data = $request->getFields();
            $response = [];

            if (!empty($data['userId']) && !empty($data['serviceId'])):
                $userId = $data['userId'];
                $serviceId = $data['serviceId'];

                if (!empty($userId) && !empty($serviceId)):
                    $result = $this->serviceModel->handleChangeServicePaymentStatus($userId, $serviceId);

                    if ($result):
                        $response = [
                            'status' => true,
                            'message' => 'Duyệt thành công',
                        ];
                    else:
                        $response = [
                            'status' => false,
                            'message' => 'Đã có lỗi xảy ra'
                        ];
                    endif;

                    echo json_encode($response);
                endif;
            endif;
        endif;
    }
}
?>