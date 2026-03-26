<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    // Mở khóa các cột để có thể Thêm/Sửa hàng loạt
    protected $fillable = [
        'username',
        'fullname',
        'email',
        'role',
        'password'
    ];

    // Các cột nên ẩn khi xuất dữ liệu ra (để bảo mật)
    protected $hidden = [
        'password',
    ];
}
