<?php
class AuthModel extends Model {

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

    public function handleLogin($username, $password) {
        $dbValue = $this->db->table('users')->select('id, email, password, status')
            ->where('email', '=', $username)
            ->first();
        $response = [];
        if (!empty($dbValue)) :
            $passwordHash = $dbValue['password'];
            $userId = $dbValue['id'];
            $statusAccount = $dbValue['status'];

            if (password_verify($password, $passwordHash)) :
                $loginToken = sha1(uniqid() . time());
                $dataToken = [
                    'user_id' => $userId,
                    'token' => $loginToken,
                    'created_at' => date('Y-m-d H:i:s')
                ];

                $insertTokenStatus = $this->db->table('login_token')->insert($dataToken);
                if ($insertTokenStatus) :
                    if ($statusAccount == 1) :
                        $insertTokenStatus = $this->db->table('login_token')->insert($dataToken);
                        if ($insertTokenStatus) :
                            $userData = $this->db->table('users')
                                ->select('id, fullname, thumbnail, email, 
                                    dob, address, phone, password, about_content, 
                                    contact_facebook, contact_twitter, contact_linkedin,
                                    contact_pinterest, status, decentralization_id, 
                                    last_activity, delivery_address')
                                ->where('id', '=', $userId)
                                ->first();
                            Session::data('user_data', $userData);

                            return true;
                        endif;
                    endif;

                    if ($statusAccount == 0) :
                        $response = [
                            'message' => 'Vui lòng kích hoạt tài khoản tại Gmail bạn dùng để đăng ký tài khoản'
                        ];
                    endif;

                    if ($statusAccount == 2) :
                        $response = [
                            'message' => 'Tài khoản của bạn đã tạm thời bị khoá. Vui lòng liên hệ quản trị viên để xử lý'
                        ];
                    endif;
                endif;
            endif;
        endif;
        if (!empty($response)) :
            return $response;
        endif;
        return false;
    }
    public function handleRegister()
    {
        $activeToken = sha1(uniqid() . time());
        $dataInsert = [
            'fullname' => $_POST['fullname'],
            'email' => $_POST['email'],
            'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
            'active_token' => $activeToken,
            'decentralization_id' => 2,
            'status' => 2,
            'created_at' => date('Y-m-d H:i:s')
        ];

        $insertStatus = $this->db->table('users')->insert($dataInsert);
        
        if ($insertStatus) :
            // Tạo link active
            // $linkActive = _WEB_ROOT . '/auth/active?token=' . $activeToken;
            $linkActive = 'http://localhost:3000/activateAccount?token=' . $activeToken;
            
            // Thiết lập mail
            $subject = ucwords($_POST['fullname']) . ' ơi. Bạn vui lòng kích hoạt tài khoản';
            $content = 'Chào bạn: ' . ucwords($_POST['fullname']) . '<br>';
            $content .= 'Vui lòng click vào link dưới đây để kích hoạt tài khoản của bạn: <br>';
            $content .= '<a href="' . $linkActive . '">here</a><br>';
            $content .= 'Trân trọng!';
            
            // Trigger webhook
            $webhookUrl = "http://localhost:5678/webhook/send-verification-email"; // Địa chỉ webhook của n8n
            
            $data = [
                'subject' => $subject,
                'content' => $content,
                'email' => $_POST['email'],
            ];
            
            // Khởi tạo cURL
            $ch = curl_init($webhookUrl);
            
            // Cấu hình cURL
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
            
            // Gửi request và nhận phản hồi
            $response = curl_exec($ch);
            
            // Kiểm tra lỗi
            if (curl_errno($ch)) {
                echo 'Error:' . curl_error($ch);
            }
            
            // Đóng cURL
            curl_close($ch);
        
            // Nếu gửi thành công, trả về true
            if ($response) :
                return true;
            endif;
        endif;
        

        return false;
    }
    public function handleActiveAccount($token)
    {
        if (!empty($token)) {
            // Truy vấn sql để so sánh
            $tokenQuery = $this->db->table('users')
                ->select('id, fullname, email')
                ->where('active_token', '=', $token)
                ->first();

            if (!empty($tokenQuery)) {
                $email = $tokenQuery['email'];
                $dataUpdate = [
                    'status' => 1,
                    'active_token' => null
                ];

                $updateStatus = $this->db->table('users')->where('email', '=', $email)->update($dataUpdate);

                // Log kết quả
                file_put_contents('log.txt', print_r($updateStatus, true), FILE_APPEND);
                file_put_contents('log.txt', print_r('\n', true), FILE_APPEND);
                file_put_contents('log.txt', print_r($token, true), FILE_APPEND);

                if ($updateStatus == 1 || $updateStatus == '1') {
                    return true;
                }
            }
        }

        return false;
    }

    public function handleLogout($userId)
    {
        $queryDelete = $this->db->table('login_token')
        ->where('user_id', '=', $userId)
            ->delete();

        if ($queryDelete) :
            Session::delete('login_token');
            Session::delete('user_data');

            return true;
        endif;

        return false;
    }
}