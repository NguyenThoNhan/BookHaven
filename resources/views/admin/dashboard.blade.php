<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- 1. Grid Thống Kê Tổng Quan -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Card Tổng số người dùng -->
                <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between">
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">TỔNG SỐ USER</h3>
                        <p class="mt-1 text-3xl font-semibold text-gray-900">{{ $stats['total_users'] }}</p>
                    </div>
                    <div class="bg-blue-100 text-blue-600 p-3 rounded-full">
                        <i class="fa-solid fa-users fa-xl"></i>
                    </div>
                </div>
                <!-- Card Tổng số sách -->
                <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between">
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">TỔNG SỐ SÁCH</h3>
                        <p class="mt-1 text-3xl font-semibold text-gray-900">{{ $stats['total_books'] }}</p>
                    </div>
                    <div class="bg-green-100 text-green-600 p-3 rounded-full">
                        <i class="fa-solid fa-book fa-xl"></i>
                    </div>
                </div>
                <!-- Card Sách đang mượn -->
                <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between">
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">ĐANG MƯỢN</h3>
                        <p class="mt-1 text-3xl font-semibold text-gray-900">{{ $stats['loans_active'] }}</p>
                    </div>
                    <div class="bg-yellow-100 text-yellow-600 p-3 rounded-full">
                        <i class="fa-solid fa-arrow-up-from-bracket fa-xl"></i>
                    </div>
                </div>
                 <!-- Card Sự kiện sắp tới -->
                <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between">
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">SỰ KIỆN SẮP TỚI</h3>
                        <p class="mt-1 text-3xl font-semibold text-gray-900">{{ $stats['upcoming_events'] }}</p>
                    </div>
                    <div class="bg-indigo-100 text-indigo-600 p-3 rounded-full">
                        <i class="fa-solid fa-calendar-days fa-xl"></i>
                    </div>
                </div>
            </div>

            <!-- 2. Grid cho Biểu đồ -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                <!-- Biểu đồ đường: Lượt mượn 30 ngày qua -->
                <div class="lg:col-span-2 bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Lượt mượn sách (30 ngày qua)</h3>
                    {{-- Dùng data- attribute để truyền dữ liệu JSON an toàn --}}
                    <canvas id="loansChart" data-chart-data="{{ json_encode($loansChartData) }}"></canvas>
                </div>
                <!-- Biểu đồ tròn: Sách theo danh mục -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Phân bố sách theo danh mục</h3>
                    {{-- Dùng data- attribute để truyền dữ liệu JSON an toàn --}}
                    <canvas id="categoriesChart" data-chart-data="{{ json_encode($categoryChartData) }}"></canvas>
                </div>
            </div>

             <!-- 3. Grid cho Hoạt động gần đây -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Bảng: Lượt mượn gần nhất -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Hoạt động mượn/trả gần đây</h3>
                    <ul class="divide-y divide-gray-200">
                        @forelse($recentLoans as $loan)
                            <li class="py-3">
                                <p class="text-sm font-medium text-gray-900">{{ $loan->user->name }} đã 
                                <span class="{{ $loan->status == 'returned' ? 'text-green-600' : 'text-blue-600' }}">
                                {{ $loan->status == 'returned' ? 'trả' : 'mượn' }}</span> sách "{{ Str::limit($loan->book->title, 30) }}"</p>
                                <p class="text-xs text-gray-500">{{ $loan->created_at->diffForHumans() }}</p>
                            </li>
                        @empty
                            <li class="py-3 text-gray-500">Chưa có hoạt động nào.</li>
                        @endforelse
                    </ul>
                </div>
                <!-- Bảng: Người dùng mới nhất -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Người dùng mới đăng ký</h3>
                     <ul class="divide-y divide-gray-200">
                        @forelse($recentUsers as $user)
                            <li class="py-3">
                                <p class="text-sm font-medium text-gray-900">{{ $user->name }} ({{ $user->email }})</p>
                                <p class="text-xs text-gray-500">Tham gia {{ $user->created_at->diffForHumans() }}</p>
                            </li>
                        @empty
                            <li class="py-3 text-gray-500">Chưa có người dùng mới nào.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        {{-- Nhúng thư viện Chart.js --}}
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            // Đoạn script này giờ đây hoàn toàn "sạch" và không chứa code Blade
            document.addEventListener('DOMContentLoaded', function () {
                // --- Biểu đồ Lượt mượn (Line Chart) ---
                const loansCanvas = document.getElementById('loansChart');
                if (loansCanvas) {
                    // Lấy dữ liệu từ thuộc tính data- và chuyển từ chuỗi JSON thành object JavaScript
                    const loansChartData = JSON.parse(loansCanvas.dataset.chartData);
                    
                    new Chart(loansCanvas.getContext('2d'), {
                        type: 'line',
                        data: {
                            labels: loansChartData.labels,
                            datasets: [{
                                label: 'Số lượt mượn',
                                data: loansChartData.data,
                                borderColor: 'rgb(79, 70, 229)',
                                backgroundColor: 'rgba(79, 70, 229, 0.1)',
                                fill: true,
                                tension: 0.3
                            }]
                        },
                        options: {
                            responsive: true,
                            scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } }
                        }
                    });
                }

                // --- Biểu đồ Danh mục (Doughnut Chart) ---
                const categoriesCanvas = document.getElementById('categoriesChart');
                if (categoriesCanvas) {
                    const categoryChartData = JSON.parse(categoriesCanvas.dataset.chartData);

                    new Chart(categoriesCanvas.getContext('2d'), {
                        type: 'doughnut',
                        data: {
                            labels: categoryChartData.labels,
                            datasets: [{
                                data: categoryChartData.data,
                                backgroundColor: ['#4f46e5', '#10b981', '#f59e0b', '#3b82f6', '#8b5cf6', '#ec4899'],
                                hoverOffset: 4
                            }]
                        },
                        options: { 
                            responsive: true, 
                            plugins: { 
                                legend: { 
                                    position: 'bottom',
                                    labels: {
                                        padding: 15
                                    }
                                } 
                            } 
                        }
                    });
                }
            });
        </script>
    @endpush
</x-app-layout>