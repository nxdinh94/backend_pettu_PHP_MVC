<?php
class CountModel extends Model {
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

    public function handleGetListExpert() {
        $queryGet = $this->db->table('expert_team')
            ->select('id')
            ->get();

        $response = [];

        if (!empty($queryGet)):
            $response = $queryGet;
        endif;

        return $response;
    }

    public function handleCountListExpert() {
        return count($this->handleGetListExpert());
    }

    //
    public function handleGetListUser() {
        $queryGet = $this->db->table('users')
            ->select('id')
            ->where('decentralization_id','=', 2)
            ->get();

        $response = [];

        if (!empty($queryGet)):
            $response = $queryGet;
        endif;

        return $response;
    }

    public function handleCountListUser() {
        return count($this->handleGetListUser());
    }

    //
    public function handleGetListProduct() {
        $queryGet = $this->db->table('product')
            ->select('productid')
            ->get();

        $response = [];

        if (!empty($queryGet)):
            $response = $queryGet;
        endif;

        return $response;
    }

    public function handleCountListProduct() {
        return count($this->handleGetListProduct());
    }

    //

    public function handleGetListService() {
        $queryGet = $this->db->table('services')
            ->select('id')
            ->get();

        $response = [];

        if (!empty($queryGet)):
            $response = $queryGet;
        endif;

        return $response;
    }

    public function handleCountListService() {
        return count($this->handleGetListService());
    }
 //BILL
    public function handleGetListStatusBill() {
        $queryGet = $this->db->table('bill')
            ->select('billid')
            ->where('status','=',0)
            ->get();

        $response = [];

        if (!empty($queryGet)):
            $response = $queryGet;
        endif;

        return $response;
    }

    public function handleCountListStatusBill() {
        return count($this->handleGetListStatusBill());
    }

    // Status USER_Service
    public function handleGetListStatusUser_Service() {
        $queryGet = $this->db->table('user_service')
            ->select('userid')
            ->where('status','=',0)
            ->get();

        $response = [];

        if (!empty($queryGet)):
            $response = $queryGet;
        endif;

        return $response;
    }

    public function handleCountListStatusUser_Service() {
        return count($this->handleGetListStatusUser_Service());
    }

    // Status Payment
    public function handleGetListStatusPayment() {
        $queryGet = $this->db->table('user_service')
            ->select('userid')
            ->where('payment_status','=',1)
            ->get();

        $response = [];

        if (!empty($queryGet)):
            $response = $queryGet;
        endif;

        return $response;
    }

    public function handleCountListStatusPayment() {
        return count($this->handleGetListStatusPayment());
    }
}