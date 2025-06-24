# Sử dụng một image PHP 8.1 với Apache đã được tối ưu
FROM richarvey/nginx-php-fpm:1.13.0

# Thiết lập thư mục làm việc
WORKDIR /var/www/html

# Sao chép mã nguồn của ứng dụng vào trong image
COPY . .

# Cài đặt các dependencies bằng Composer
# --no-interaction: không hỏi câu hỏi nào
# --optimize-autoloader: tối ưu hóa autoloader
# --no-dev: không cài các gói chỉ dành cho phát triển
RUN composer install --no-interaction --optimize-autoloader --no-dev

# Cài đặt các dependencies cho frontend
RUN npm install && npm run build

# Cấp quyền sở hữu cho thư mục storage và bootstrap/cache
RUN chown -R www-data:www-data storage bootstrap/cache

# Thiết lập quyền truy cập file
RUN chmod -R 775 storage bootstrap/cache

# Sao chép file cấu hình Nginx cho Laravel
COPY docker/nginx.conf /etc/nginx/sites-available/default.conf

# Expose port 80 để Nginx có thể nhận request
EXPOSE 80

# Lệnh để khởi động server (CMD đã được định nghĩa trong image gốc)
