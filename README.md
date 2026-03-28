# Product & User Management System (Laravel MVC)

## Team Members
Hồ Văn Tiết - Developer  

Hồ Thị Như - Developer  

## Introduction
Dự án này là một hệ thống quản lý sản phẩm và người dùng được xây dựng trên mô hình MVC (Model-View-Controller) sử dụng Framework Laravel. Hệ thống cho phép quản trị viên vận hành các thao tác nghiệp vụ cơ bản, tối ưu hóa quy trình quản lý kho hàng và thông tin nhân sự.

## Features

### Product Management
CRUD Operations: Thêm mới, xem danh sách, cập nhật và xóa sản phẩm.  
Smart Filter: Tìm kiếm sản phẩm theo tên.  
Category Filtering: Lọc sản phẩm theo danh mục cụ thể.  
Price Range: Bộ lọc sản phẩm theo khoảng giá.  
Stock Tracking: Quản lý số lượng tồn kho.  

### User & Auth System
Authentication: Đăng ký tài khoản mới và Đăng nhập hệ thống bảo mật.  
Role-based: Phân quyền người dùng (Admin/User).  
Profile Management: Xem và chỉnh sửa thông tin người dùng, cập nhật mật khẩu.  

## Technologies Used
Backend: PHP (Laravel Framework)  
Database: MySQL  
Frontend: Blade Template Engine, CSS (Custom Clean UI), JavaScript  
Architecture: MVC (Model - View - Controller)  
Tools: Composer

## Project Structure
Dự án tuân thủ nghiêm ngặt cấu trúc thư mục của Laravel:

```
app/
 ├── Models/           # Định nghĩa cấu trúc dữ liệu (Product, User, Category)
 ├── Http/
 │    └── Controllers/ # Xử lý logic nghiệp vụ (ProductController, AuthController)
resources/
 ├── views/            # Giao diện người dùng (Blade Templates)
 └── css/              # Custom Stylesheet (Clean UI)
routes/
 └── web.php           # Định nghĩa các tuyến đường (Routes) của ứng dụng
```

## Installation Guide

1. Clone repository:
```
git clone https://github.com/vti0209/producttest_group2_tietandnhu27a.git
cd producttest_group2_tietandnhu27a
```

2. Install dependencies:
```
composer install
npm install && npm run build
```

3. Setup environment:
```
cp .env.example .env
php artisan key:generate
```

4. Configure database:
Mở file .env và cập nhật thông số kết nối Database:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_db_name
DB_USERNAME=root
DB_PASSWORD=
```

5. Run Migrations:
```
php artisan migrate
```

6. Start Server:
```
php artisan serve
```

Truy cập: http://127.0.0.1:8000

## Database Schema

products table  
id: Primary Key  
name: Tên sản phẩm  
price: Giá bán  
category_id: Khóa ngoại liên kết danh mục  
stock: Số lượng tồn kho  
description: Mô tả chi tiết  

users table  
id: Primary Key  
username: Tên đăng nhập  
fullname: Họ và tên  
email: Địa chỉ email  
password: Mật khẩu (Hashed)  
role: Quyền hạn (admin/user)  

## Project Objective
Dự án được thực hiện nhằm mục đích thực hành và áp dụng các kiến thức chuyên sâu về:
- Luồng dữ liệu trong mô hình MVC  
- Kỹ năng lập trình Backend với Laravel  

## Notes
Dự án này phục vụ mục đích học tập và kiểm tra giữa kỳ.   

© 2026 - Team Tiet & Nhu
