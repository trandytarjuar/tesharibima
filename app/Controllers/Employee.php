<?php namespace App\Controllers;
 
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\EmployeeModel;

class Employee extends ResourceController
{
    use ResponseTrait;

    public function index()
    {
        $model = new EmployeeModel();
        $data = $model->findAll();
        return $this->respond($data);
    }
    public function show($id = null)
    {
        $model = new EmployeeModel();
     
         $data = $model->getWhere(['id'=>$id]);
         
            if($data){
                return $this->respond($data);
            }else {
                return $this->failNotFound(' data tidak di temukan dengan id'.$id);
            }
    }
    public function create()
    {
        $model = new EmployeeModel();
        $data = [
            'nama_lengkap' => $this->request->getVar('nama_lengkap'),
            'tempat_lahir' => $this->request->getVar('tempat_lahir'),
            'tgl_lahir' => $this->request->getVar('tgl_lahir'),
            'email' => $this->request->getVar('email'),
            'phone' => $this->request->getVar('phone'),
            'pekerjaan' => $this->request->getVar('pekerjaan'),
            'gaji' => $this->request->getVar('gaji')
        ];
        $model ->insert($data);
        $response = [
            'status' =>201,
            'error' => null,
            'message' => [
                'succes' => 'Data Saved'
            ]
        ];
        return $this->respondCreated($response);

    }

    public function update($id = null)
    {
        $model = new EmployeeModel();
        $input = $this->request->getRawInput();
        $data = [
            'nama_lengkap' => $input('nama_lengkap'),
            'tempat_lahir' => $input('tempat_lahir'),
            'tgl_lahir' => $input('tgl_lahir'),
            'email' => $input('email'),
            'phone' => $input('phone'),
            'pekerjaan' => $input('pekerjaan'),
            'gaji' => $input('gaji'),
        ];
        $model->update($id,$data);
        $response = [
            'status' =>200,
            'error' => null,
            'messages' => [
                'succes' => 'data updated'
            ]
            
        ];
        return $this->respond($response);
    }
    public function delete($id = null)
    {
        $model = new EmployeeModel();
        $data = $model->find($id);
        if($data){
            $model->delete($id);
            $response = [
                'status' =>200,
                'error' => null,
                'messages' => [
                    'succes' => 'data updated'
                ] 
                ];
                return $this->respondDeleted($response);
        }else{
            return $this->failNotFound("data not found with id".$id);
        }
    }
}