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
 
}