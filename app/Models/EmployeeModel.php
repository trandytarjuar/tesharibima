<?php 
namespace App\Models;

use CodeIgniter\Model;

class EmployeeModel extends Model
{
    protected $table = 'employee';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_lengkap','tempat_lahir','tgl_lahir', 'email', 'phone','pekerjaan','gaji'];
}