<?php
class UserModel extends Model {
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

    //  Lấy danh sách người dùng 
    public function handleGetListUser() {
        $queryGet = $this->db->table('users')
            ->select('id, fullname, thumbnail, email, dob, address, phone, 
                about_content, contact_facebook, contact_twitter, contact_linkedin,
                contact_pinterest, status, create_at')
            ->where('decentralization_id', '=', '2')
            ->get();

        $response = [];
        $checkNull = false;

        if (!empty($queryGet)):
            foreach ($queryGet as $key => $item):
                foreach ($item as $subKey => $subItem):
                    if ($subItem === NULL || $subItem === ''):
                        $checkNull = true;
                    endif;
                endforeach;
            endforeach;
        endif;

        if (!$checkNull):
            $response = $queryGet;
        endif;

        return $response;

    }

    // Lấy danh sách người dùng (nhân sự có thẩm quyền)
    public function handleGetListCompetentPersonnel() {
        $queryGet = $this->db->table('users')
            ->select('id, fullname, thumbnail, email, dob, address, phone, 
                about_content, contact_facebook, contact_twitter, contact_linkedin,
                contact_pinterest, status, create_at')
            ->where('decentralization_id', '=', '3')
            ->get();

        $response = [];
        $checkNull = false;

        if (!empty($queryGet)):
            foreach ($queryGet as $key => $item):
                foreach ($item as $subKey => $subItem):
                    if ($subItem === NULL || $subItem === ''):
                        $checkNull = true;
                    endif;
                endforeach;
            endforeach;
        endif;

        if (!$checkNull):
            $response = $queryGet;
        endif;

        return $response;
    }
    // Xử lý update trạng thái user
    public function handleUpdateStatusAccount($userId)
    {
        $queryGet = $this->db->table('users')
        ->select('status')
        ->where('id', '=', $userId)
            ->first();


        if (!empty($queryGet)) :
            $dataUpdate = [
                'status' => $_POST['status'],
                'update_at' => date('Y-m-d H:i:s')
            ];

            $updateStatus = $this->db->table('users')
            ->where('id', '=', $userId)
                ->update($dataUpdate);


            if ($updateStatus) :
                return true;
            endif;
        endif;

        return false;
    }
    // Xử lý duyệt đăng ký dịch vụ của user
    public function handleConfirmRegisterService($userId, $serviceId)
    {
        $queryGet = $this->db->table('user_service')
        ->select('status')
        ->where('userid', '=', $userId)
        ->where('serviceId', '=', $serviceId)
        ->first();

        if (!empty($queryGet)) :
            $dataUpdate = [
                'status' => 1,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $updateStatus = $this->db->table('user_service')
            ->where('userid', '=', $userId)
            ->where('serviceId', '=', $serviceId)
            ->update($dataUpdate);


            if ($updateStatus) :
                return true;
            endif;
        endif;

        return false;
    }

    public function handleGetPendingService()
    {
        $queryGet = $this->db->table('user_service')
        ->select('services.*, user_service.*, users.fullname, users.email')
        ->join('services', 'services.id = user_service.serviceid')
        ->join('users', 'users.id = user_service.userid')
        ->where('user_service.status', '=', '0')
            ->get();

        $response = [];
        $checkNull = false;

        if (!empty($queryGet)) :
            foreach ($queryGet as $key => $item) :
                foreach ($item as $subKey => $subItem) :
                    if ($subItem === NULL || $subItem === '') :
                        $checkNull = true;
                    endif;
                endforeach;
            endforeach;
        endif;

        if (!$checkNull) :
            $response = $queryGet;
        endif;

        return $response;
    }
    //check is registed this sericester
    public function handleIsRegistered($userId, $serviceId)
    {
        // $queryGet = $this->db->table('user_service')
        // ->select('status')
        // ->where('userid', '=', $userId)
        // ->where('serviceid', '=', $serviceId)
        // ->first();
        $queryGet = $this->db->table('user_service')
        ->select('user_service.status')
        ->join('users', 'users.id = user_service.userid')
        ->join('services', 'services.id = user_service.serviceid')
        ->where('user_service.userid', '=', $userId)  
        ->where('user_service.serviceid', '=', $serviceId)  
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