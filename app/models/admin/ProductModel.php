<?php
class ProductModel extends Model
{
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


    public function handleGetListProduct()
    {
        $queryGet = $this->db->table('product')
            ->get();

        $response = [];
        $checkNull = false;

        if (!empty($queryGet)) :
            foreach ($queryGet as $key => $item) :
                foreach ($item as $subKey => $subItem) :
                    if ($subItem === NULL || $subItem === '') :
                        if (
                            $subKey !== 'promotionid'
                            && $subKey !== 'evaluate_star'
                        ) :
                            $checkNull = true;
                        endif;
                    endif;
                endforeach;
            endforeach;
        endif;
        if (!$checkNull) :
            $response = $queryGet;
        endif;
        return $response;
    }
    //Thêm SP
    public function handleAddProduct($data = []){
        $dataInsert = [
            'product_name' => $data['product_name'],
            'slug' => $data['slug'],
            'price' => $data['price'],
            'quantity' => $data['quantity'],
            'ingredient' => $data['ingredient'],
            'thumpnail2' => $data['thumpnail2'],
            'origin' => $data['origin'],
            // 'promotionid' => $data['promotionid'],
            'dimensions' => $data['dimensions'],
            'color' => $data['color'],
            'evaluate_star' => $data['evaluate_star'],
            'evaluate_quantity' => $data['evaluate_quantity'],
            'description' => $data['description'],
            'product_status' => $data['product_status'],
            'created_at' => date('Y-m-d H:i:s'),
        ];

        $insertStatus = $this->db->table('product')->insert($dataInsert);

        if($insertStatus):
            return true;
        endif;

        return false;
    }

    //UPDATE PRODUCT
    public function handleUpdateProduct($productId){
        $queryGet = $this->db->table('product')
        ->where('productid','=',$productId)
        ->first();

        if(!empty($queryGet)):
            $dataUpdate =[
                'product_name' => $_POST['product_name'],
                'slug' => $_POST['slug'],
                'price' => $_POST['price'],
                'quantity' => $_POST['quantity'],
                'ingredient' => $_POST['ingredient'],
                'thumpnail2' => $_POST['thumpnail2'],
                'origin' => $_POST['origin'],

                'dimensions' => $_POST['dimensions'],
                'color' => $_POST['color'],
                
                'description' => $_POST['description'],
                'product_status' => $_POST['product_status'],
            'updated_at' => date('Y-m-d H:i:s'),
            ];

            $updateData = $this->db->table('product')
            ->where('productid','=',$productId)
            ->update($dataUpdate);  

            if ($updateData):
                return true;
            endif;
        endif;
    }

    // DELETE PRODUCT
    public function handleDeleteProduct($productId){
        $queryGet = $this->db->table('product')
        ->where('productid','=',$productId)
        ->first();

        if(!empty($queryGet)):
            $deleteData = $this->db->table('product')
            ->where('productid','=',$productId)
            ->delete($queryGet);

            if ($deleteData):
                return true;
            endif;
        endif;
    }
}
