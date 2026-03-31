-- =====================================================
-- TẠO DATABASE CHO HỆ THỐNG QUẢN LÝ SẢN PHẨM
-- =====================================================

-- Xóa database nếu tồn tại (cẩn thận khi chạy trên production)
DROP DATABASE IF EXISTS product_management;

-- Tạo database mới với charset UTF-8 hỗ trợ tiếng Việt
CREATE DATABASE product_management 
CHARACTER SET utf8mb4 
COLLATE utf8mb4_unicode_ci;

USE product_management;

-- =====================================================
-- 1. BẢNG USERS (Người dùng - Đăng nhập/Đăng ký)
-- =====================================================
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE COMMENT 'Tên đăng nhập',
    password VARCHAR(255) NOT NULL COMMENT 'Mật khẩu đã mã hóa',
    email VARCHAR(100) UNIQUE COMMENT 'Email người dùng',
    fullname VARCHAR(100) COMMENT 'Họ và tên',
    role ENUM('admin', 'user') DEFAULT 'user' COMMENT 'Vai trò: admin/user',
    last_login DATETIME COMMENT 'Lần đăng nhập cuối',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT 'Ngày tạo',
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Ngày cập nhật'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- 2. BẢNG CATEGORIES (Loại sản phẩm)
-- =====================================================
CREATE TABLE categories (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL UNIQUE COMMENT 'Tên loại sản phẩm',
    description TEXT COMMENT 'Mô tả loại sản phẩm',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT 'Ngày tạo',
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Ngày cập nhật'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- 3. BẢNG PRODUCTS (Sản phẩm)
-- =====================================================
CREATE TABLE products (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL COMMENT 'Tên sản phẩm',
    price DECIMAL(15,0) NOT NULL COMMENT 'Giá sản phẩm (VNĐ)',
    category_id INT COMMENT 'Mã loại sản phẩm',
    stock INT NOT NULL DEFAULT 0 COMMENT 'Số lượng tồn kho',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT 'Ngày tạo',
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Ngày cập nhật',
    
    -- Khóa ngoại
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL,
    
    -- Indexes để tối ưu truy vấn
    INDEX idx_category (category_id),
    INDEX idx_price (price),
    INDEX idx_name (name)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- 4. THÊM DỮ LIỆU MẪU
-- =====================================================

-- Thêm tài khoản người dùng
-- Lưu ý: Mật khẩu đã mã hóa bcrypt, mật khẩu gốc là "123456"
INSERT INTO users (username, password, email, fullname, role) VALUES
('hieupc', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'hieu@example.com', 'Hieu PC', 'admin'),
('user1', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user1@example.com', 'Nguyen Van A', 'user'),
('user2', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user2@example.com', 'Tran Thi B', 'user');

-- Thêm loại sản phẩm
INSERT INTO categories (name, description) VALUES 
('Điện thoại', 'Các dòng điện thoại thông minh từ các thương hiệu nổi tiếng'),
('Thời trang', 'Quần áo, giày dép, túi xách và phụ kiện thời trang'),
('Đồng hồ', 'Đồng hồ đeo tay các loại, từ thể thao đến sang trọng'),
('Mỹ phẩm', 'Sản phẩm làm đẹp, trang điểm, chăm sóc da'),
('Sách', 'Sách các thể loại: văn học, kỹ năng, lập trình...'),
('Gia dụng', 'Đồ dùng gia đình, thiết bị nhà bếp, nội thất');

-- Thêm sản phẩm (theo ảnh đã cho)
INSERT INTO products (name, price, category_id, stock) VALUES
('iPhone 15', 25000000, 1, 10),
('Samsung S24', 22000000, 1, 15),
('MacBook Pro', 45000000, 1, 5),
('Dell XPS', 35000000, 1, 8),
('Áo thun', 200000, 2, 50),
('Giày sneaker', 1500000, 2, 30),
('Đồng hồ Casio', 500000, 3, 40),
('Sơn môi', 300000, 4, 25),
('Sách lập trình', 150000, 5, 60),
('Nồi cơm điện', 1200000, 6, 20);

-- Thêm thêm một số sản phẩm khác để dữ liệu phong phú
INSERT INTO products (name, price, category_id, stock) VALUES
('iPhone 14', 18000000, 1, 25),
('Samsung A54', 8000000, 1, 35),
('Áo khoác gió', 450000, 2, 40),
('Quần jean', 350000, 2, 45),
('Đồng hồ Rolex', 450000000, 3, 2),
('Son 3CE', 450000, 4, 60),
('Dụng cụ nấu ăn', 890000, 6, 35),
('Sách dạy nấu ăn', 120000, 5, 28);

-- =====================================================
-- 5. TẠO VIEW (Hỗ trợ hiển thị dữ liệu)
-- =====================================================

-- View hiển thị danh sách sản phẩm kèm tên loại
CREATE OR REPLACE VIEW v_products AS
SELECT 
    p.id,
    p.name,
    p.price,
    FORMAT(p.price, 0) AS price_formatted,
    c.id AS category_id,
    c.name AS category_name,
    p.stock,
    p.created_at,
    p.updated_at
FROM products p
LEFT JOIN categories c ON p.category_id = c.id;

-- View thống kê số lượng sản phẩm theo loại
CREATE OR REPLACE VIEW v_category_stats AS
SELECT 
    c.id,
    c.name AS category_name,
    COUNT(p.id) AS total_products,
    SUM(p.stock) AS total_stock,
    MIN(p.price) AS min_price,
    MAX(p.price) AS max_price,
    AVG(p.price) AS avg_price
FROM categories c
LEFT JOIN products p ON c.id = p.category_id
GROUP BY c.id, c.name;

-- =====================================================
-- 6. TẠO STORED PROCEDURES (Thủ tục lưu trữ)
-- =====================================================

DELIMITER //

-- Stored procedure tìm kiếm sản phẩm với các bộ lọc
CREATE PROCEDURE sp_search_products(
    IN p_keyword VARCHAR(255),
    IN p_category_id INT,
    IN p_max_price DECIMAL(15,0),
    IN p_sort_by VARCHAR(50),
    IN p_limit INT,
    IN p_offset INT
)
BEGIN
    SET @sql = 'SELECT p.*, c.name AS category_name 
                FROM products p
                LEFT JOIN categories c ON p.category_id = c.id
                WHERE 1=1';
    
    IF p_keyword IS NOT NULL AND p_keyword != '' THEN
        SET @sql = CONCAT(@sql, ' AND p.name LIKE ', QUOTE(CONCAT('%', p_keyword, '%')));
    END IF;
    
    IF p_category_id IS NOT NULL AND p_category_id > 0 THEN
        SET @sql = CONCAT(@sql, ' AND p.category_id = ', p_category_id);
    END IF;
    
    IF p_max_price IS NOT NULL AND p_max_price > 0 THEN
        SET @sql = CONCAT(@sql, ' AND p.price <= ', p_max_price);
    END IF;
    
    -- Sắp xếp
    CASE p_sort_by
        WHEN 'price_asc' THEN SET @sql = CONCAT(@sql, ' ORDER BY p.price ASC');
        WHEN 'price_desc' THEN SET @sql = CONCAT(@sql, ' ORDER BY p.price DESC');
        WHEN 'name_asc' THEN SET @sql = CONCAT(@sql, ' ORDER BY p.name ASC');
        WHEN 'name_desc' THEN SET @sql = CONCAT(@sql, ' ORDER BY p.name DESC');
        ELSE SET @sql = CONCAT(@sql, ' ORDER BY p.created_at DESC');
    END CASE;
    
    -- Phân trang
    IF p_limit IS NOT NULL AND p_limit > 0 THEN
        SET @sql = CONCAT(@sql, ' LIMIT ', p_limit);
        IF p_offset IS NOT NULL AND p_offset >= 0 THEN
            SET @sql = CONCAT(@sql, ' OFFSET ', p_offset);
        END IF;
    END IF;
    
    PREPARE stmt FROM @sql;
    EXECUTE stmt;
    DEALLOCATE PREPARE stmt;
END //

-- Stored procedure đăng nhập
CREATE PROCEDURE sp_login(
    IN p_username VARCHAR(50)
)
BEGIN
    SELECT id, username, password, fullname, role, last_login
    FROM users
    WHERE username = p_username;
END //

-- Stored procedure cập nhật thời gian đăng nhập
CREATE PROCEDURE sp_update_last_login(
    IN p_user_id INT
)
BEGIN
    UPDATE users 
    SET last_login = NOW() 
    WHERE id = p_user_id;
END //

-- Stored procedure thống kê tổng quan
CREATE PROCEDURE sp_dashboard_stats()
BEGIN
    -- Tổng số sản phẩm
    SELECT COUNT(*) AS total_products FROM products;
    
    -- Tổng số loại sản phẩm
    SELECT COUNT(*) AS total_categories FROM categories;
    
    -- Tổng số người dùng
    SELECT COUNT(*) AS total_users FROM users;
    
    -- Tổng giá trị hàng tồn kho
    SELECT SUM(price * stock) AS total_inventory_value FROM products;
    
    -- Top 5 sản phẩm tồn kho nhiều nhất
    SELECT name, stock FROM products ORDER BY stock DESC LIMIT 5;
END //

DELIMITER ;

-- =====================================================
-- 7. TẠO TRIGGERS (Tự động xử lý)
-- =====================================================

DELIMITER //

-- Trigger kiểm tra giá sản phẩm không được âm
CREATE TRIGGER tr_product_price_check
BEFORE INSERT ON products
FOR EACH ROW
BEGIN
    IF NEW.price < 0 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Giá sản phẩm không được âm';
    END IF;
END //

-- Trigger kiểm tra tồn kho không được âm
CREATE TRIGGER tr_product_stock_check
BEFORE UPDATE ON products
FOR EACH ROW
BEGIN
    IF NEW.stock < 0 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Tồn kho không được âm';
    END IF;
END //

-- Trigger tự động cập nhật updated_at (đã có trong định nghĩa bảng)
-- Nhưng có thể tạo trigger riêng nếu cần
CREATE TRIGGER tr_products_update_timestamp
BEFORE UPDATE ON products
FOR EACH ROW
BEGIN
    SET NEW.updated_at = CURRENT_TIMESTAMP;
END //

CREATE TRIGGER tr_categories_update_timestamp
BEFORE UPDATE ON categories
FOR EACH ROW
BEGIN
    SET NEW.updated_at = CURRENT_TIMESTAMP;
END //

DELIMITER ;

-- =====================================================
-- 8. CÁC CÂU TRUY VẤN MẪU THƯỜNG DÙNG
-- =====================================================

-- 8.1. Đăng nhập
-- SELECT * FROM users WHERE username = 'hieupc' LIMIT 1;

-- 8.2. Lấy danh sách sản phẩm (có phân trang)
-- SELECT * FROM v_products ORDER BY id DESC LIMIT 0, 10;

-- 8.3. Tìm kiếm sản phẩm
-- CALL sp_search_products('iPhone', NULL, NULL, NULL, 10, 0);

-- 8.4. Lọc sản phẩm theo loại và giá
-- SELECT * FROM products 
-- WHERE category_id = 1 AND price <= 30000000 
-- ORDER BY price ASC;

-- 8.5. Thống kê số lượng sản phẩm theo loại
-- SELECT * FROM v_category_stats;

-- 8.6. Tổng giá trị hàng tồn kho
-- SELECT SUM(price * stock) AS total_value FROM products;

-- 8.7. Top 5 sản phẩm có giá cao nhất
-- SELECT name, price FROM products ORDER BY price DESC LIMIT 5;

-- 8.8. Sản phẩm sắp hết hàng (tồn kho < 10)
-- SELECT name, stock FROM products WHERE stock < 10 ORDER BY stock ASC;

-- =====================================================
-- 9. TẠO USER VÀ PHÂN QUYỀN (Tùy chọn)
-- =====================================================

-- Tạo user cho ứng dụng (chạy với quyền root)
-- CREATE USER IF NOT EXISTS 'app_user'@'localhost' IDENTIFIED BY 'your_password';
-- GRANT SELECT, INSERT, UPDATE, DELETE ON product_management.* TO 'app_user'@'localhost';
-- FLUSH PRIVILEGES;

-- =====================================================
-- HIỂN THỊ THÔNG TIN DATABASE
-- =====================================================

-- Hiển thị tất cả bảng
SHOW TABLES;

-- Hiển thị cấu trúc các bảng
DESCRIBE users;
DESCRIBE categories;
DESCRIBE products;

-- Kiểm tra dữ liệu
SELECT '=== USERS ===' AS '';
SELECT * FROM users;

SELECT '=== CATEGORIES ===' AS '';
SELECT * FROM categories;

SELECT '=== PRODUCTS ===' AS '';
SELECT * FROM products;

SELECT '=== PRODUCT VIEW ===' AS '';
SELECT * FROM v_products LIMIT 10;

SELECT '=== CATEGORY STATS ===' AS '';
SELECT * FROM v_category_stats;