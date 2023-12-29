<?php
$routes['default_controller'] = 'authcontroller';
// Đường dẫn ảo -> đường dẫn thật
$routes['tin-tuc/.+-(\d+).html'] = 'news/category/$1';

// Định tuyến API
$routes['api/login'] = 'auth/login'; // API login
$routes['api/logout'] = 'auth/logout'; // API đăng xuất
$routes['api/register'] = 'auth/register'; // API register

// Admin API
$routes['api/dashboard/listUser'] = 'admin/dashboard/user/getListUser';// API lấy danh sách người dùng - AdminPage
$routes['api/dashboard/listCompetentPersonnel'] = 'admin/dashboard/user/getListCompetentPersonnel'; // API lấy danh sách nhân sự - AdminPage
$routes['api/dashboard/isRegistered'] = 'admin/dashboard/user/isRegistered'; // API lấy trạng thái dịch vụ người dùng đã đăng ký
$routes['api/dashboard/confirmRegisterService'] = 'admin/dashboard/user/confirmRegisterService'; // API duyệt trạng thái đăng ký dịch vụ - AdminPage

$routes['api/services/getTimeWorking'] = 'admin/service/getTimeWorking'; // API thời gian dùng dịch vụ

$routes['api/pets/petsInfo'] = 'admin/home/getPetDetailInfo'; // API thông tin chi tiết của Pets
$routes['api/services/servicesInfo'] = 'admin/service/getServiceDetailInfo'; // API thông tin chi tiết của Services
$routes['api/expert_team/teamInfo'] = 'admin/expertteam/getExpertTeamInfo'; // API lấy thông tin đội ngũ chuyên gia
$routes['api/blogs/listBlog'] = 'admin/blog/getListBlog'; // API lấy danh sách blog theo danh mục
$routes['api/dashboard/getPendingService'] = 'admin/dashboard/user/getPendingService'; // API lấy danh sách dịch vụ đã đăng ký đăng chờ duyệt
//API user
$routes['api/users/update'] = 'user/profile/updateInfo'; // update user
 // API update trạng thái tài khoản
$routes['api/dashboard/updateStatusAccount'] = 'admin/dashboard/user/updateStatusAccount';
$routes['api/users/getService'] = 'user/profile/getService'; // API lấy danh sách dịch vụ đã đăng ký - Profile
$routes['api/users/deleteService'] = 'user/profile/deleteService'; // API xoá dịch vụ đã đăng ký - Profile
$routes['api/users/registerService'] = 'user/user/registerService'; // API người dùng đăng ký dịch vụ - User
$routes['api/products/listProduct'] = 'admin/product/getListProduct'; // API lấy danh sách sản phẩm
$routes['api/users/updatePeriodTime'] = 'user/user/updatePeriodTime'; // API thay đổi thời gian sử dụng dịch vụ - User

$routes['api/users/addProductToCart'] = 'user/cart/addToCart'; // API thêm sản phẩm vào giỏ hàng - User
$routes['api/users/updateQuantityInCart'] = 'user/cart/updateQuantityInCart'; // API thay đổi số lượng sản phẩm trong giỏ hàng - User
$routes['api/users/deleteProductInCart'] = 'user/cart/removeProductInCart'; // API xoá sản phẩm trong giỏ hàng - User
$routes['api/users/getListProductCart'] = 'user/cart/getListProductInCart'; // API lấy danh sách sản phẩm trong giỏ hàng - User
$routes['api/users/countListProductCart'] = 'user/cart/countListProductInCart'; // API lấy số lượng sản phẩm trong giỏ hàng - User

$routes['api/users/checkOutCart'] = 'user/cart/checkout'; // API bắt đầu thanh toán giỏ hàng - User
$routes['api/users/paymentCart'] = 'user/cart/payment'; // API xác nhận thanh toán giỏ hàng - User
$routes['api/users/billDetail'] = 'user/cart/getBillDetail'; // API lấy thông tin trong billdetai - User
$routes['api/users/deleteBillDetail'] = 'user/cart/deleleBillDetail'; // API xoá billdetai khi không thanh toán - User
$routes['api/dashboard/getPendingBill'] = 'admin/dashboard/cart/getListBillPending'; // API lấy danh sách hoá đơn chờ duyệt - User
$routes['api/users/getApprovedBill'] = 'user/cart/getListBillApproved'; // API lấy danh sách hoá đơn đã được duyệt - User
$routes['api/dashboard/getListProduct'] = 'admin/dashboard/product/getListProduct'; //API lấy danh sách sản phẩm
$routes['api/dashboard/addProduct'] = 'admin/dashboard/product/addProduct'; //API thêm sản phẩm
$routes['api/dashboard/uppdateProduct'] = 'admin/dashboard/product/updateProduct'; //API cập nhập sản phẩm
$routes['api/dashboard/deleteProduct'] = 'admin/dashboard/product/deleteProduct'; //API xóa sản phẩm
$routes['api/dashboard/getListTimeWork'] = 'admin/dashboard/timework/getListTimeWork'; //API lấy danh sách thông tin thời 
$routes['api/dashboard/addTimeWork'] = 'admin/dashboard/timework/addTimeWork'; //API thêm thời gian việc làm
$routes['api/dashboard/updateTimeWork'] = 'admin/dashboard/timework/updateTimeWork'; //API cập nhập thời gian việc làm
$routes['api/dashboard/deleteTimeWork'] = 'admin/dashboard/timework/deleteTimeWork'; //API xóa thời gian việc làm
$routes['api/dashboard/getInfoTimeWork'] = 'admin/dashboard/timework/getInfoTimeWork'; //API xem thông tin  thời gian việc làm của từng nhân viên
$routes['api/dashboard/getAllPendingBill'] = 'admin/dashboard/cart/getListAllBillPending'; // API lấy danh sách tất cả hoá đơn chờ duyệt - AdminPage
$routes['api/dashboard/changeBillStatus'] = 'admin/dashboard/cart/changeBillStatus'; // API duyệt trạng thái hoá đơn - AdminPage
$routes['api/dashboard/changePaymentStatus'] = 'admin/dashboard/user/changeServicePaymentStatus'; // API thay đổi trạng thái thanh toán dịch vụ
$routes['api/dashboard/deleteService'] = 'admin/dashboard/service/delete'; // API xoá dịch vụ - AdminPage
$routes['api/dashboard/updateService'] = 'admin/dashboard/service/update'; // API sửa dịch vụ - AdminPage
$routes['api/dashboard/addService'] = 'admin/dashboard/service/add'; // API thêm dịch vụ - AdminPage
$routes['api/dashboard/getUnpaidService'] = 'admin/dashboard/service/getListUnpaidService'; // API lấy danh sách dịch vụ user chưa thanh toán - AdminPage
$routes['api/dashboard/changeServicePaymentStatus'] = 'admin/dashboard/service/changeServicePaymentStatus'; // API duyệt trạng thái đã thanh toán dịch vụ - AdminPage
$routes['api/dashboard/countListExpert'] = 'admin/dashboard/count/countListExpert';//count experteam
$routes['api/dashboard/countListUser'] = 'admin/dashboard/count/countListUser';
$routes['api/dashboard/countListProduct'] = 'admin/dashboard/count/countListProduct';
$routes['api/dashboard/countListService'] = 'admin/dashboard/count/countListService';
$routes['api/dashboard/countListStatusBill'] = 'admin/dashboard/count/countListStatusBill';//API số đơn hàng chờ duyệt
$routes['api/dashboard/countListStatusPayment'] = 'admin/dashboard/count/countListStatusPayment';//API Số dịch vụ thanh toán chờ duyệt
$routes['api/dashboard/countListStatusUser_Service'] = 'admin/dashboard/count/countListStatusUser_Service';// API số dịch vụ chờ duyệt

?>