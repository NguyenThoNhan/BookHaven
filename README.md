<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# 📖 Project BookHaven: Hệ Thống Quản Lý Thư Viện Tích Hợp Chữ Ký Số

Một dự án ứng dụng web được xây dựng trên nền tảng Laravel 10, mô phỏng một hệ thống quản lý thư viện số hiện đại với các tính năng nâng cao như phân quyền, chữ ký số bất đối xứng, và trải nghiệm người dùng tương tác.

| **Họ và tên sinh viên:** | **NGUYỄN THỌ NHÂN** |
| :---------------------- | :--------------------------------- |
| **Mã Sinh viên:**       | **23010786**    |

---

## 🚀 Giới Thiệu Dự Án

**BookHaven** không chỉ là một trang web quản lý mượn/trả sách thông thường. Dự án này được phát triển nhằm giải quyết các bài toán thực tế trong quản lý tài nguyên số, đặc biệt là vấn đề **đảm bảo tính toàn vẹn của tài liệu điện tử**. Bằng việc áp dụng thuật toán chữ ký số sử dụng cặp khóa Public/Private (RSA-SHA256), hệ thống có khả năng xác thực liệu nội dung một tài liệu có bị thay đổi hay không trong suốt quá trình được mượn.

Ngoài ra, dự án còn tập trung vào việc xây dựng trải nghiệm người dùng phong phú thông qua các tính năng Gamification, quản lý sự kiện, và một chế độ "Thư viện ảo" 3D độc đáo.

## ✨ Các Tính Năng Nổi Bật

### 1. Kiến Trúc và Mô Hình Hóa Dữ Liệu
-   🏛️ **Nền tảng Laravel 10:** Toàn bộ ứng dụng được xây dựng trên phiên bản mới nhất của Laravel Framework, tận dụng các tính năng hiện đại như Vite, Eloquent ORM, và hệ thống Routing mạnh mẽ.
-   🗃️ **Mô Hình Hóa Đa Đối Tượng:** Hệ thống mô hình hóa và quản lý mối quan hệ phức tạp giữa **6 đối tượng chính**: `User`, `Book`, `Loan`, `Category`, `Event` và `Badge` Các mối quan hệ (One-to-Many, Many-to-Many) được định nghĩa chặt chẽ thông qua Eloquent.
-   ☁️ **Database Migration trên Cloud:** Áp dụng kỹ thuật Eloquent Migrations để định nghĩa, phiên bản hóa và triển khai cấu trúc cơ sở dữ liệu một cách tự động và an toàn, trực tiếp lên một dịch vụ CSDL trên Cloud (Aiven for MySQL).
-   
### 2. Chức năng chính:
-   👤 **Hệ thống Xác thực & Phân quyền:** Phân chia rõ ràng vai trò `Admin` và `User` với các quyền hạn riêng biệt.
-   📚 **Quản lý Tài nguyên (CRUD):** Xây dựng một giao diện quản trị CRUD (Create, Read, Update, Delete) hoàn chỉnh cho các đối tượng cốt lõi như **Sách (`Book`)**, **Danh mục (`Category`)**, và **Sự kiện (`Event`)**.
-   💻 **Quản lý Tài liệu Online:** Cho phép Admin upload file `.txt` làm nội dung cho tài liệu điện tử.
-   ✍️ **Chữ Ký Số Bất Đối Xứng:** Tự động ký lên tài liệu online bằng **Private Key** khi người dùng mượn và xác thực bằng **Public Key** khi trả, đảm bảo tính toàn vẹn tuyệt đối.
-   👥 **Quản lý Người dùng & Lượt mượn:** Admin có thể theo dõi và quản lý toàn bộ người dùng và các hoạt động mượn/trả trong hệ thống.
-   🎉 **Quản lý Sự kiện:** Admin có thể tạo và quản lý các sự kiện của thư viện.
-   💻 **Quản lý mail liên hệ, hỏi đáp:** Admin thông qua mailtrap.io trả lời tư vấn cho khách hàng.

### 3. Trải Nghiệm Người Dùng Tương Tác:
-   🚀 **Mượn/Trả tài liệu:** Người dùng mượn/trả tài liệu on/off với chữ ký số.
-   ❤️ **Tủ sách Yêu thích:** Lưu lại những cuốn sách quan tâm để xem sau.
-   🏆 **Gamification:** Hệ thống điểm thưởng và huy hiệu khi người dùng hoàn thành các hoạt động như trả sách.
-   📅 **Đăng ký Sự kiện:** Xem và đăng ký tham gia các sự kiện do thư viện tổ chức.
-   🏛️ **Thư viện ảo 3D:** Một không gian 3D tương tác, cho phép người dùng "dạo bước" và khám phá các kệ sách như trong một thư viện thực thụ.
-   💻 **Liên hệ và hỏi đáp:** Người dùng liên hệ với quản trị viên thông qua mailtrap.io

### 4. Bảo Mật Toàn Diện (Security)
-   🔑 **Định danh & Xác thực (`Authentication`):** Tích hợp `Laravel Breeze` cung cấp một hệ thống đăng ký, đăng nhập, và quản lý phiên (session) an toàn, tuân thủ các chuẩn bảo mật hiện đại.
-   🛡️ **Phân quyền (`Authorization`):** Sử dụng `Gates` và `Policies` của Laravel để định nghĩa các quy tắc truy cập chặt chẽ, đảm bảo người dùng chỉ có thể thực hiện các hành động được phép trên dữ liệu của chính mình hoặc theo vai trò được gán.
-   📝 **An toàn Dữ liệu Đầu vào:**
    -   **Chống CSRF:** Mọi form `POST`, `PATCH`, `DELETE` đều được bảo vệ bằng token `@csrf`.
    -   **Xác thực Dữ liệu (`Validation`):** Tất cả dữ liệu gửi lên từ người dùng đều được kiểm tra nghiêm ngặt bằng `Request Validation` trước khi xử lý.
-   🔒 **An toàn Dữ liệu Đầu ra và Lưu trữ:**
    -   **Chống XSS:** Dữ liệu xuất ra view được tự động escape bởi cú pháp `{{ }}` của Blade.
    -   **Chống SQL Injection:** Eloquent ORM sử dụng Parameter Binding, loại bỏ hoàn toàn nguy cơ tấn công SQL Injection.
    -   **Chữ Ký Số Bất Đối Xứng:** Áp dụng thuật toán RSA-SHA256 với cặp khóa Private/Public để ký và xác thực tính toàn vẹn của tài liệu, một cấp độ bảo mật cao hơn so với HMAC.

## 5. 🛠️ Công Nghệ Sử Dụng

-   **Backend:** Laravel 10, PHP 8.1+
-   **Frontend:** Blade, JavaScript (ES6+), CSS 3D Transforms
-   **Database:** MySQL (Kết nối và Migrate tới Aiven Cloud)
-   **Authentication:** Laravel Breeze
-   **Core Technologies:** Eloquent ORM, Artisan Commands, Middlewares, Policies, Events & Listeners.

---

## 🏗️ Sơ Đồ Cấu Trúc (Class Diagram)

**![Flow Activity Flow](images/sodocautruc.drawio.png)**

*Sơ đồ minh họa các đối tượng chính (`User`, `Book`, `Loan`, `Event`, `Category`, `Badge`) và các mối quan hệ giữa chúng (One-to-Many, Many-to-Many).*

## ⚙️ Sơ Đồ Thuật Toán (Activity Diagram)

#### Sơ đồ 1: Quy trình Xác thực Tính toàn vẹn của Tài liệu Online

**![Flow Activity Flow](images/thuattoan1.drawio.png)**

*Sơ đồ mô tả các bước từ khi người dùng mượn tài liệu, hệ thống ký bằng Private Key, người dùng sửa đổi nội dung, cho đến khi trả lại và hệ thống xác thực bằng Public Key.*

#### Sơ đồ 2: Quy trình Tự động Trao huy hiệu cho Người dùng

**![Flow Activity Flow](images/thuattoan2.drawio.png)**

*Sơ đồ mô tả luồng hoạt động của hệ thống Event-Listener: Sự kiện `BookReturned` được phát ra, `GamificationSubscriber` lắng nghe, thực hiện truy vấn để đếm số sách đã mượn và kiểm tra điều kiện để trao huy hiệu "Độc Giả Chăm Chỉ".*

---

## 📸 Ảnh Chụp Màn Hình Chức Năng Chính

| Trang Chủ & Slider Sách Phổ Biến | Trang Chi Tiết Sách & Nút Tương Tác |
| :------------------------------: | :----------------------------------: |
| **![UI](images/a1.png)**         | **![UI](images/a4.png)**    |
| **Thư Viện Ảo 3D**               | **Dashboard Quản Trị của Admin**   |
| **![UI](images/a2.png)**         | **![UI](images/a5.png)**        |
| **Quản lý Lịch sử Mượn/Trả**     | **Trang Profile với Huy hiệu**     |
| **![UI](images/a3.png)**         | **![UI](images/a6.png)**         |

---

## 💻 Code Minh Họa Phần Chính

### 1. Model `User` và các mối quan hệ phức tạp
*File: `app/Models/User.php`*
```php
<?php
...
public function loans()
{
    return $this->hasMany(Loan::class);
}

public function badges()
{
    return $this->belongsToMany(Badge::class, 'badge_user') // Chỉ định rõ tên bảng trung gian
                 ->withTimestamps('unlocked_at', 'unlocked_at');
}

public function favoriteBooks()
{
    return $this->belongsToMany(Book::class, 'favorites');
}

public function registeredEvents()
{
    return $this->belongsToMany(Event::class, 'event_registrations');
}
```
### 2. Logic Ký và Xác thực Chữ Ký Số
*File: app/Http/Controllers/LoanController.php*
```php
// Ví dụ: Đoạn code ký bằng Private Key trong hàm store()
// hoặc đoạn code xác thực bằng Public Key trong hàm update()

// Ký tài liệu
openssl_sign($originalContent, $signature, $privateKey, OPENSSL_ALGO_SHA256);
$digitalSignature = base64_encode($signature);

// Xác thực tài liệu
$isVerified = openssl_verify($currentContent, $originalSignature, $publicKey, OPENSSL_ALGO_SHA256);
if ($isVerified === 1) {
    // ... Nội dung vẹn toàn
}
```
### 🔗 Liên Kết
Link Repository: [https://github.com/NguyenThoNhan/BookHaven]
Link Deploy: [https://bookhaven-app.onrender.com]
