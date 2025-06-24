<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Thư Viện Sách BookHaven') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Form tìm kiếm -->
            <div class="mb-8">
                <form action="{{ route('home') }}" method="GET">
                    <div class="flex">
                        <input type="text" name="search" placeholder="Tìm kiếm theo tiêu đề hoặc tác giả..." class="w-full rounded-l-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" value="{{ request('search') }}">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-r-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500">
                            Tìm
                        </button>
                    </div>
                </form>
            </div>

            <!-- === BẮT ĐẦU SLIDER SÁCH PHỔ BIẾN (PHIÊN BẢN MỚI) === -->
            @if($popularBooks->count() > 0)
                <div class="mb-12">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Sách Phổ Biến</h2>
                    <div class="swiper popular-books-slider">
                        <div class="swiper-wrapper">
                            @foreach($popularBooks as $book)
                                <div class="swiper-slide h-full">
                                    {{-- Toàn bộ card là một link lớn --}}
                                    <a href="{{ route('books.show', $book) }}" class="flex bg-white rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 ease-in-out overflow-hidden h-56">
                                        <!-- Ảnh bên trái -->
                                        <div class="w-1/3 flex-shrink-0">
                                            <img class="h-full w-full object-cover" src="{{ $book->cover_image_path ? asset('storage/' . $book->cover_image_path) : 'https://via.placeholder.com/400x600.png/003366?text=BookHaven' }}" alt="Bìa sách {{ $book->title }}">
                                        </div>
                                        <!-- Nội dung bên phải -->
                                        <div class="w-2/3 p-4 flex flex-col">
                                            {{-- 1. Tiêu đề hiển thị ngay, in đậm --}}
                                            <h3 class="text-xl font-bold text-gray-900 line-clamp-2">{{ $book->title }}</h3>
                                            <p class="text-sm text-gray-600 mt-1 flex-shrink-0">Tác giả: {{ $book->author }}</p>
                                            
                                            {{-- 2. Thêm danh mục --}}
                                            <div class="mt-2 flex flex-wrap gap-1">
                                                @foreach($book->categories->take(2) as $category)
                                                    <span class="text-xs bg-gray-200 text-gray-800 px-2 py-1 rounded-full">{{ $category->name }}</span>
                                                @endforeach
                                            </div>

                                            {{-- Đẩy nút xuống dưới cùng --}}
                                            <div class="flex-grow"></div>

                                            {{-- 3. Thêm nút "Đăng ký ngay" (Xem Chi Tiết) --}}
                                            <div class="mt-2 flex-shrink-0">
                                                <span class="inline-block bg-indigo-600 text-white font-semibold text-sm px-4 py-2 rounded-full hover:bg-indigo-700 transition-colors">
                                                    Xem Chi Tiết
                                                </span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>

                <style>
                    .popular-books-slider { width: 100%; padding-bottom: 40px !important; }
                    .swiper-pagination-bullet-active { background-color: #4338ca !important; }
                </style>
            @endif
            <!-- === KẾT THÚC SLIDER SÁCH PHỔ BIẾN === -->


            <!-- Lưới sách chính (Giữ nguyên) -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Khám Phá Thêm</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @forelse ($books as $book)
                            <a href="{{ route('books.show', $book) }}" class="block group">
                                <div class="overflow-hidden rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 ease-in-out bg-white h-full flex flex-col">
                                    <div class="flex-shrink-0">
                                        <img class="h-56 w-full object-cover" src="{{ $book->cover_image_path ? asset('storage/' . $book->cover_image_path) : 'https://via.placeholder.com/400x600.png/003366?text=BookHaven' }}" alt="Bìa sách {{ $book->title }}">
                                    </div>
                                    <div class="p-4 flex flex-col flex-grow">
                                        <h3 class="text-lg font-semibold text-gray-900 group-hover:text-indigo-600">{{ Str::limit($book->title, 40) }}</h3>
                                        <p class="text-sm text-gray-600 mt-1">{{ $book->author }}</p>
                                        <div class="mt-2 flex flex-wrap gap-1">
                                            @foreach($book->categories as $category)
                                                <span class="text-xs bg-gray-200 text-gray-800 px-2 py-1 rounded-full">{{ $category->name }}</span>
                                            @endforeach
                                        </div>
                                        <div class="mt-auto pt-2">
                                            @if($book->type == 'online')
                                                <span class="inline-block bg-green-200 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded-full">Tài liệu Online</span>
                                            @else
                                                <span class="inline-block bg-blue-200 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded-full">Sách Vật Lý</span>
                                                <span class="text-sm {{ $book->quantity > 0 ? 'text-gray-700' : 'text-red-500 font-bold' }}">
                                                    {{ $book->quantity > 0 ? 'Còn lại: ' . $book->quantity : 'Hết sách' }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <div class="col-span-full text-center py-12">
                                <p class="text-gray-500 text-lg">Không tìm thấy sách hoặc tài liệu nào.</p>
                            </div>
                        @endforelse
                    </div>
                     <div class="mt-8">
                        {{ $books->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    {{-- Script cho Swiper (đã bỏ TypeIt) --}}
    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (document.querySelector('.popular-books-slider')) {
                const swiper = new Swiper('.popular-books-slider', {
                    loop: true,
                    slidesPerView: 1,
                    spaceBetween: 30,
                    autoplay: {
                        delay: 3000, // 4 giây
                        disableOnInteraction: false,
                    },
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                    },
                    breakpoints: {
                        768: { slidesPerView: 2, spaceBetween: 20 },
                        1024: { slidesPerView: 2, spaceBetween: 30 }
                    }
                });
            }
        });
    </script>
    @endpush
</x-app-layout>