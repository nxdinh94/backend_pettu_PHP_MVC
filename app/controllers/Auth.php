<?php
class Auth extends Controller {
    private $authModel;

    public function __construct() {
        $this->authModel = $this->model('AuthModel');

    }

    public function login() {
        $request = new Request();

        if ($request->isPost()): // Kiểm tra post
            if (!empty($_POST)):
                $data = $request->getFields();

                if (!empty($data)):
                    $username = $data['username'];
                    $password = $data['password'];
    
                    $result = $this->authModel->handleLogin($username, $password);
                    if (is_array($result)) :
                        $response = $result;
                    else :
                        if ($result) :
                            $response = [
                                'message' => 'Đăng nhập thành công',
                                'status' => true,
                                'user_data' => Session::data('user_data'),
                            ];
                        else :
                            $response = [
                                'message' => 'Đăng nhập thất bại',
                                'status' => false,
                            ];
                        endif;
                    endif;
                    
                    echo json_encode($response);

                endif;
            endif;
        endif;
    }
    public function register()
    {
        $request = new Request();

        if ($request->isPost()) : // Kiểm tra post
            $request->rules([
                'fullname' => 'required|min:6',
                'email' => 'required|email|unique:users:email',
                'password' => 'required|min:8|special',
                're_password' => 'required|match:password'
            ]);

            $request->message([
                'fullname.required' => 'Họ tên không được để trống',
                'fullname.min' => 'Họ tên phải lớn hơn 5 ký tự',
                'email.required' => 'Email không được để trống',
                'email.email' => 'Định dạng email không hợp lệ',
                'email.unique' => 'Email đã tồn tại',
                'password.required' => 'Mật khẩu không được để trống',
                'password.min' => 'Mật khẩu phải lớn hơn 7 ký tự',
                'password.special' => 'Mật khẩu phải có ít nhất 1 ký tự hoa và 1 ký tự đặc biệt',
                're_password.required' => 'Mật khẩu không được để trống',
                're_password.match' => 'Mật khẩu không trùng khớp',
            ]);

            $validate = $request->validate();
            if ($validate) :
                $result = $this->authModel->handleRegister();

                if ($result) :
                    $response = [
                        'message' => 'Tạo tài khoản thành công',
                        'status' => true
                    ];
                else :
                    $response = $request->errors();
                endif;
            else :
                $response = $request->errors();
            endif;

            echo json_encode($response);
        endif;
    }

    public function active()
    {
        $response = [];
        $token = $_GET['token'];

        if (!empty($token)) :
            $result = $this->authModel->handleActiveAccount($token);

            if ($result) :
                $response = [
                    'message' => true
                ];
            else :
                $response = [
                    'message' => false
                ];
            endif;

            echo json_encode($response);
        endif;
    }
    public function logout(){
        $request = new Request();
        $response = [];
        $data = $request->getFields();
        
        if (!empty($data['userId'])):
            $userId = $data['userId'];
            if (!empty($userId)) :
                $result = $this->authModel->handleLogout($userId);

                if ($result) :
                    $response = [
                        'message' => 'Đăng xuất thành công'
                    ];
                else :
                    $response = [
                        'message' => 'Bạn chưa đăng nhập'
                    ];
                endif;

                echo json_encode($response);
            endif;
        endif;
    }
}