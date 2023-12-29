<?php
class ServiceModel extends Model {
    public function tableFill()
    {
        return '';
    }

    public function fieldFill()
    {
        return '';
    }

    public function primaryKey()
    {
        return '';
    }

    // Lấy thông tin cơ bản của dich vu
    public function handleGetDetail() {
        $queryGet = $this->db->table('services')
        ->select('services.*, staff_position.name as staff_position_name')
        ->join('staff_position', 'staff_position.position_id = services.teamid')
        ->get();

        $response = [];
        $checkNull = false;

        if (!empty($queryGet)) :
            foreach ($queryGet as $key => $item) :
                foreach ($item as $subKey => $subItem):
                    if ($subItem === NULL || empty($subItem)):
                        $checkNull = true;
                    endif;
                endforeach;
            endforeach;
        else :
            $response = [
                'message' => 'Chưa có người dùng đăng ký dịch vụ'
            ];
            $checkNull = true;
        endif;

        if (!$checkNull):
            $response = $queryGet;
        endif;

        return $response;
    }
    // Xử lý lấy thời gian làm việc
    public function handleGetTimeWorking()
    {
        $queryGet = $this->db->table('timeworking')
        ->select('timeworking.*')
        ->get();

        $response = [];
        $checkNull = false;

        if (!empty($queryGet)) :
            foreach ($queryGet as $key => $item) :
                if ($item === NULL || $item === '') :
                    $checkNull = true;
                endif;
            endforeach;
        endif;

        if (!$checkNull) :
            $response = $queryGet;
        endif;

        return $response;
    }
 
    // Xử lý xoá dịch vụ
    public function handleDeleteService($serviceId) {
        $checkEmpty = $this->db->table('services')
            ->select('id')
            ->where('id', '=', $serviceId)
            ->first();

        if (!empty($checkEmpty)):
            $deleteStatus =  $this->db->table('services')
                ->where('id', '=', $serviceId)
                ->delete();

            if ($deleteStatus):
                return true;
            endif;
        endif;

        return false;
    }

    // Xử lý sửa dịch vụ
    public function handleUpdateService($data, $serviceId)
    {
        $checkEmpty = $this->db->table('services')
        ->select('id')
            ->where('id', '=', $serviceId)
            ->first();

        if (!empty($checkEmpty)) :
            $dataUpdate = [
                'name' => $data['name'],
                'slug' => $data['slug'],
                'icon' => $data['icon'],
                'dersc' => $_POST['dersc'],
                'content' => $_POST['content'],
                'cost' => $data['cost'],
                'teamid' => $data['teamid'],
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            $updateStatus = $this->db->table('services')
            ->where('id', '=', $serviceId)
                ->update($dataUpdate);

            if ($updateStatus) :
                return true;
            endif;
        endif;

        return false;
    }

    // Xử lý thêm dịch vụ
    public function handleAddService($data) {
        $dataInsert = [
            'name' => $data['name'],
            'slug' => $data['slug'],
            'icon' => $data['icon'],
            'dersc' => $_POST['dersc'],
            'content' => $_POST['content'],
            'cost' => $data['cost'],
            'teamid' => $data['teamid'],
            'created_at' => date('Y-m-d H:i:s'),
            'update_at' => date('Y-m-d H:i:s'),
        ];

        $insertStatus = $this->db->table('services')
            ->insert($dataInsert);

        if ($insertStatus):
            return true;
        endif;

        return false;
    }
    // Xử lý lấy danh sách dịch vụ chưa thanh toán của user
    public function handleGetListUnpaidService() {
        $queryGet = $this->db->table('user_service')
            ->select('user_service.serviceid, user_service.userid,  user_service.status, 
              user_service.payment_status, user_service.created_at,users.email, services.name as serviceName')
            
            ->join('users', 'users.id = user_service.userid')
            ->join('services', 'services.id = user_service.serviceid')
            
            ->get();

        $response = [];
        $checkNull = false;

        if (!empty($queryGet)):
            foreach ($queryGet as $key => $item):
                if ($item === NULL || $item === ''):
                    $checkNull = true;
                endif;
            endforeach;
        endif;

        if (!$checkNull):
            $response = $queryGet;
        endif;

        return $response;
    }
     // Xử lý duyệt trạng thái đã thanh toán dịch vụ của người dùng 
    public function handleChangeServicePaymentStatus($userId, $serviceId) {
        $queryCheck = $this->db->table('user_service')
            ->select('payment_status')
            ->where('userid', '=', $userId)
            ->where('serviceid', '=', $serviceId)
            ->first();

        if (!empty($queryCheck)):
            $dataUpdate = [
                'payment_status' => 1,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $updateStatus = $this->db->table('user_service')
                ->where('userid', '=', $userId)
                ->where('serviceid', '=', $serviceId)
                ->update($dataUpdate);

            if ($updateStatus):
                return true;
            endif;
        endif;

        return false;
    }
}