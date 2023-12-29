<?php
class TimeWorkModel extends Model {
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

    // Lấy thông tin của thời gian làm việc
    public function handleGetListTimeWork() {
        $queryGet = $this->db->table('timeworking')
            ->get();

        $response = [];
        $checkNull = false;

        if (!empty($queryGet)):
            foreach ($queryGet as $key => $item):
                foreach ($item as $subKey => $subItem):
                    if ($subItem === NULL || $subItem === ''):
                        if ($subKey !== 'id' 
                                && $subKey !== 'time_text'):
                            $checkNull = true;
                        endif;
                    endif;
                endforeach;
            endforeach;
        endif;

        if (!$checkNull):
            $response = $queryGet;
        endif;
        return $response;
    }
    //Thêm thời gian làm việc
    public function handleAddTimeWork($data = []){
        $dataInsert = [
            'timeworking' => $data['timeworking'],
        ];

        $insertStatus = $this->db->table('timeworking')->insert($dataInsert);

        if($insertStatus):
            return true;
        endif;

        return false;
    }
    //UPDATE TimeWork
    public function handleUpdateTimeWork($id){
        $queryGet = $this->db->table('timeworking')
        ->where('id','=',$id)
        ->first();
        if(!empty($queryGet)):
            $dataUpdate =[
                'timeworking' => $_POST['timeworking'],
            ]; 
            $updateData = $this->db->table('timeworking')
            ->where('id','=',$id)
            ->update($dataUpdate);  
            if ($updateData):
                return true;
            endif;
        endif;
    }
    // DELETE timework
    public function handleDeleteTimeWork($id){
        $queryGet = $this->db->table('timeworking')
        ->where('id','=',$id)
        ->first();

        if(!empty($queryGet)):
            $deleteData = $this->db->table('timeworking')
            ->where('id','=',$id)
            ->delete($queryGet);

            if ($deleteData):
                return true;
            endif;
        endif;
    }
    //Get infor time work
    public function handleGetInfoTimeWork($id) {
        $queryGet = $this->db->table('timeworking')
            ->where('id','=',$id)    
            ->first();

        $response = [];

        if (!empty($queryGet)):
            $response = $queryGet;
        endif;    

        return $response;
    }
}