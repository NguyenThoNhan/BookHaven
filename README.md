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

### Chức năng chính:
-   👤 **Hệ thống Xác thực & Phân quyền:** Phân chia rõ ràng vai trò `Admin` và `User` với các quyền hạn riêng biệt.
-   📚 **Quản lý Sách (CRUD):** Admin có toàn quyền Thêm, Sửa, Xóa các đầu sách và tài liệu điện tử.
-   💻 **Quản lý Tài liệu Online:** Cho phép Admin upload file `.txt` làm nội dung cho tài liệu điện tử.
-   ✍️ **Chữ Ký Số Bất Đối Xứng:** Tự động ký lên tài liệu online bằng **Private Key** khi người dùng mượn và xác thực bằng **Public Key** khi trả, đảm bảo tính toàn vẹn tuyệt đối.
-   👥 **Quản lý Người dùng & Lượt mượn:** Admin có thể theo dõi và quản lý toàn bộ người dùng và các hoạt động mượn/trả trong hệ thống.
-   🎉 **Quản lý Sự kiện:** Admin có thể tạo và quản lý các sự kiện của thư viện.

### Chức năng tương tác của Người dùng:
-   🚀 **Mượn/Trả tài liệu:** Người dùng mượn/trả tài liệu on/off với chữ ký số.
-   ❤️ **Tủ sách Yêu thích:** Lưu lại những cuốn sách quan tâm để xem sau.
-   🏆 **Gamification:** Hệ thống điểm thưởng và huy hiệu khi người dùng hoàn thành các hoạt động như trả sách.
-   📅 **Đăng ký Sự kiện:** Xem và đăng ký tham gia các sự kiện do thư viện tổ chức.
-   🏛️ **Thư viện ảo 3D:** Một không gian 3D tương tác, cho phép người dùng "dạo bước" và khám phá các kệ sách như trong một thư viện thực thụ.

## 🛠️ Công Nghệ Sử Dụng

-   **Backend:** Laravel 10, PHP 8.1+
-   **Frontend:** Blade, JavaScript (ES6+), CSS 3D Transforms
-   **Database:** MySQL (Kết nối và Migrate tới Aiven Cloud)
-   **Authentication:** Laravel Breeze
-   **Core Technologies:** Eloquent ORM, Artisan Commands, Middlewares, Policies, Events & Listeners.

---

## 🏗️ Sơ Đồ Cấu Trúc (Class Diagram)

*(...Khu vực này sẽ được cập nhật sau khi bạn hoàn thành việc vẽ sơ đồ...)*

**[Để trống hoặc chèn ảnh sơ đồ lớp của bạn vào đây]**

*Sơ đồ minh họa các đối tượng chính (`User`, `Book`, `Loan`, `Event`, `Category`, `Badge`) và các mối quan hệ giữa chúng (One-to-Many, Many-to-Many).*

## ⚙️ Sơ Đồ Thuật Toán (Activity Diagram)

*(...Khu vực này sẽ được cập nhật sau khi bạn hoàn thành việc vẽ sơ đồ...)*

#### Sơ đồ 1: Quy trình Xác thực Tính toàn vẹn của Tài liệu Online

**[Để trống hoặc chèn ảnh sơ đồ thuật toán 1 của bạn vào đây]**

*Sơ đồ mô tả các bước từ khi người dùng mượn tài liệu, hệ thống ký bằng Private Key, người dùng sửa đổi nội dung, cho đến khi trả lại và hệ thống xác thực bằng Public Key.*

#### Sơ đồ 2: Quy trình Tự động Trao huy hiệu cho Người dùng

**[Để trống hoặc chèn ảnh sơ đồ thuật toán 2 của bạn vào đây]**

*Sơ đồ mô tả luồng hoạt động của hệ thống Event-Listener: Sự kiện `BookReturned` được phát ra, `GamificationSubscriber` lắng nghe, thực hiện truy vấn để đếm số sách đã mượn và kiểm tra điều kiện để trao huy hiệu "Độc Giả Chăm Chỉ".*

---

## 📸 Ảnh Chụp Màn Hình Chức Năng Chính

| Trang Chủ & Slider Sách Phổ Biến | Trang Chi Tiết Sách & Nút Tương Tác |
| :------------------------------: | :----------------------------------: |
| **[Chèn ảnh Trang Chủ]**         | **[Chèn ảnh Trang Chi Tiết Sách]**   |
| **Thư Viện Ảo 3D**               | **Dashboard Quản Trị của Admin**   |
| **[Chèn ảnh Thư Viện Ảo]**        | **[Chèn ảnh Dashboard Admin]**        |
| **Quản lý Lịch sử Mượn/Trả**        | **Trang Profile với Huy hiệu**     |
| **[Chèn ảnh Quản lý Lịch sử]**  | **[Chèn ảnh Trang Profile]**         |

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
Link Repository: [Dán link GitHub repo của bạn vào đây]
