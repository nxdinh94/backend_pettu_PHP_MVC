<?php
class TimeWork extends Controller {
    private $timeWorkModel;

    public function __construct() {
        $this->timeWorkModel = $this->model('TimeWorkModel', 'admin');
    }

    // Lấy danh sách thời gian làm việc
    public function getListTimeWork() {
        $request = new Request();

        if ($request->isGet()): // Kiểm tra get

            $result = $this->timeWorkModel->handleGetListTimeWork(); // Gọi xử lý ở Model

            if (!empty($result)):
                $response = [
                    'status' =>true,
                    'data'=> $result
                ];
            else:
                $response = [
                    'message' => 'Đã có lỗi xảy ra'
                ];
            endif;

            echo json_encode($response);
        endif;
    }
    // ADD Time Working
    public function addTimeWork(){
        $request = new Request();
        $response =[];

        if ($request->isPost()):
            $data = $request->getFields();

            if(!empty($data)):
                $request->rules([
                    'timeworking' => 'required',
                ]);

                $request->message([
                    'timeworking.required' =>'thời gian làm việc không được để trống.',
                ]);

                $validate = $request->validate();

                if($validate):
                    $result = $this->timeWorkModel->handleAddTimeWork($data);

                    if($result):
                        $response = [
                            'status'=> true,
                            'message' => 'Thêm thành công'
                        ];
                    else:
                        $response = [
                            'status'=> false,
                            'message' => 'Thêm thất bại'
                        ];
                    endif;
                else:
                    $response = [
                        'status' => false,
                        'errors' => Session :: flash('pettu_session_errors')
                    ];
                endif;

                echo json_encode($response);
            endif;
        endif;
    }
    //Update thời gian làm việc
    public function updateTimeWork() {
        $request = new Request();

        if ($request->isPost()): // Kiểm tra get
            $data = $request->getFields();

            $request->rules([
                'timeworking' => 'required',
            ]);

            $request->message([
                'timeworking.required' =>'thời gian làm việc không được để trống.',
            ]);

            $validate = $request->validate();

            if($validate):
                if (!empty($data['id'])):
                    $id = $data['id'];
                    $result = $this->timeWorkModel->handleUpdateTimeWork($id); // Gọi xử lý ở Model
                if(!empty($result)):
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
                        'message' => 'Đã có lỗi xảy ra!'
                    ];
                endif;echo json_encode($response);
            endif;
        endif;
    }
     //DELETE timeworking
    public function deleteTimeWork(){
        $request = new Request();

        if ($request->isPost()): // Kiểm tra get
            $data = $request->getFields();

            if (!empty($data['id'])):
                $id = $data['id'];

                $result = $this->timeWorkModel->handleDeleteTimeWork($id); // Gọi xử lý ở Model

                if (!empty($result)):
                    $response = [
                        'message' => 'Xóa thành công',
                    ];
                else:
                    $response = [
                        'message' => 'Đã có lỗi xảy ra'
                    ];
                endif;
            else:
                $response = [
                    'message' => 'Đã có lỗi xảy ra!'
                ];
            endif;

            echo json_encode($response);

        endif;
    }
    public function getInfoTimeWork() {
        $request = new Request();

        if ($request->isPost()): // Kiểm tra get
            $data = $request->getFields();

            if (!empty($data['id'])):
                $id = $data['id'];

                $result = $this->timeWorkModel->handleGetInfoTimeWork($id); // Gọi xử lý ở Model

                if (!empty($result)):
                    $response = [
                        'status' => true,
                        'data' => $result
                    ];
                else:
                    $response = [
                        'message' => 'Đã có lỗi xảy ra'
                    ];
                endif;
            else:
                $response = [
                    'message' => 'Đã có lỗi xảy ra!'
                ];
            endif;

            echo json_encode($response);

        endif;
    }

}