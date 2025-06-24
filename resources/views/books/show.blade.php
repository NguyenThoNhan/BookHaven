<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $book->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    @if (session('success'))
                        <div class="mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
                            <p class="font-bold">Thành công</p>
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="mb-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4" role="alert">
                             <p class="font-bold">Lỗi</p>
                            <p>{{ session('error') }}</p>
                        </div>
                    @endif

                    <div class="md:flex">
                        <!-- Cột trái: Ảnh bìa -->
                        <div class="md:w-1/3 md:pr-8">
                             <img class="rounded-lg shadow-lg w-full" src="{{ $book->cover_image_path ? asset('storage/' . $book->cover_image_path) : 'https://via.placeholder.com/400x600.png/003366?text=BookHaven' }}" alt="Bìa sách {{ $book->title }}">
                        </div>

                        <!-- Cột phải: Thông tin & Hành động -->
                        <div class="md:w-2/3 mt-6 md:mt-0">
                            <!-- === TIÊU ĐỀ VÀ NÚT YÊU THÍCH === -->
                            <div class="flex justify-between items-start">
                                <h1 class="text-3xl font-bold text-gray-900">{{ $book->title }}</h1>
                                @auth
                                    <button id="favorite-toggle-btn" 
                                            data-book-id="{{ $book->id }}" 
                                            class="text-2xl p-2 rounded-full transition-colors duration-200 {{ $isFavorited ? 'text-red-500 bg-red-100' : 'text-gray-400 hover:bg-gray-100' }}">
                                        <i class="fa-solid fa-heart"></i>
                                    </button>
                                @endauth
                            </div>

                            <p class="text-lg text-gray-700 mt-2">bởi <span class="font-semibold">{{ $book->author }}</span></p>
                            
                            <div class="mt-4 flex flex-wrap gap-2">
                                @foreach($book->categories as $category)
                                    <a href="{{ route('categories.show', $category) }}" class="text-sm bg-indigo-100 hover:bg-indigo-200 text-indigo-800 px-3 py-1 rounded-full">{{ $category->name }}</a>
                                @endforeach
                            </div>
                            
                            <p class="mt-6 text-gray-600 leading-relaxed">{{ $book->description }}</p>

                            <!-- Thông tin Loại sách & Số lượng -->
                            <div class="mt-8 border-t pt-6">
                                <div class="flex items-center space-x-4">
                                @if($book->type == 'online')
                                    <span class="inline-block bg-green-200 text-green-800 text-lg font-semibold px-3 py-1 rounded-full">Tài liệu Online</span>
                                @else
                                    <span class="inline-block bg-blue-200 text-blue-800 text-lg font-semibold px-3 py-1 rounded-full">Sách Vật Lý</span>
                                    <span class="text-lg {{ $book->quantity > 0 ? 'text-gray-700' : 'text-red-500 font-bold' }}">
                                        {{ $book->quantity > 0 ? 'Còn lại: ' . $book->quantity : 'Đã hết sách' }}
                                    </span>
                                @endif
                                </div>
                            </div>
                            
                            <!-- Nút hành động Mượn/Trả -->
                            <div class="mt-8">
                                @auth
                                    @if($currentLoan)
                                        <form action="{{ route('loans.return', $currentLoan) }}" method="POST">
                                            @csrf @method('PATCH')
                                            <button type="submit" class="w-full text-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-red-600 hover:bg-red-700"><i class="fa-solid fa-right-from-bracket mr-2"></i> Trả Lại</button>
                                        </form>
                                    @else
                                        @if($book->type == 'physical')
                                            @if ($book->quantity > 0)
                                                <form action="{{ route('loans.store', $book) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="w-full text-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700"><i class="fa-solid fa-book-bookmark mr-2"></i> Mượn Ngay</button>
                                                </form>
                                            @else
                                                 <button disabled class="w-full text-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-gray-400 cursor-not-allowed">Đã Hết Sách</button>
                                            @endif
                                        @else
                                            <form id="borrow-form" action="{{ route('loans.store', $book) }}" method="POST" class="hidden">@csrf</form>
                                            <button id="show-signature-modal-btn" type="button" class="w-full text-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700"><i class="fa-solid fa-signature mr-2"></i> Mượn & Áp dụng Chữ Ký Số</button>
                                        @endif
                                    @endif
                                @else
                                     <a href="{{ route('login') }}" class="block w-full text-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">Đăng nhập để mượn</a>
                                @endauth
                            </div>
                            
                            @if($book->type == 'online' && $currentLoan)
                                <div class="mt-8 border-t pt-6">
                                    <h3 class="text-xl font-semibold">Nội dung tài liệu</h3>
                                    <div class="mt-2 p-4 bg-gray-50 rounded-md border">
                                        <pre class="whitespace-pre-wrap font-mono text-sm">{{ $book->content }}</pre>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- === MODAL XÁC NHẬN CHỮ KÝ SỐ === -->
    <div id="signature-modal" class="fixed inset-0 bg-gray-900 bg-opacity-75 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 p-5 border w-full max-w-md shadow-lg rounded-xl bg-white">
            <div class="mt-3 text-center">
                <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-blue-100">
                    <i class="fa-solid fa-file-signature fa-2x text-blue-600"></i>
                </div>
                <h3 class="text-xl leading-6 font-bold text-gray-900 mt-4">Xác Nhận Chữ Ký Số</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-600">Quản trị viên yêu cầu bạn xác thực việc áp dụng chữ ký số cho tài liệu này.</p>
                    <p class="mt-3 text-xs text-gray-500 bg-gray-100 p-3 rounded-lg">Bằng việc đồng ý, một chữ ký điện tử sẽ được tạo ra dựa trên nội dung gốc của tài liệu để đảm bảo tính toàn vẹn.</p>
                </div>
                <div class="items-center px-4 py-3 space-y-3">
                    <button id="confirm-borrow-btn" class="px-4 py-3 bg-green-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"><i class="fa-solid fa-check mr-2"></i> Đồng ý & Mượn tài liệu</button>
                    <button id="close-modal-btn" class="px-4 py-2 bg-gray-200 text-gray-800 text-base font-medium rounded-md w-full shadow-sm hover:bg-gray-300">Từ chối</button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // --- LOGIC CHO NÚT YÊU THÍCH ---
            const favoriteButton = document.getElementById('favorite-toggle-btn');
            if (favoriteButton) {
                favoriteButton.addEventListener('click', function() {
                    this.disabled = true; // Ngăn click nhiều lần
                    const bookId = this.dataset.bookId;
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                    fetch(`/favorites/${bookId}/toggle`, {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.is_favorited) {
                            this.classList.remove('text-gray-400', 'hover:bg-gray-100');
                            this.classList.add('text-red-500', 'bg-red-100');
                        } else {
                            this.classList.remove('text-red-500', 'bg-red-100');
                            this.classList.add('text-gray-400', 'hover:bg-gray-100');
                        }
                    })
                    .catch(error => console.error('Error:', error))
                    .finally(() => { this.disabled = false; });
                });
            }

            // --- LOGIC CHO MODAL XÁC NHẬN CHỮ KÝ SỐ ---
            const modal = document.getElementById('signature-modal');
            const showModalBtn = document.getElementById('show-signature-modal-btn');
            const closeModalBtn = document.getElementById('close-modal-btn');
            const confirmBorrowBtn = document.getElementById('confirm-borrow-btn');
            const borrowForm = document.getElementById('borrow-form');

            if (showModalBtn) {
                showModalBtn.addEventListener('click', () => { modal.classList.remove('hidden'); });
            }
            if (closeModalBtn) {
                closeModalBtn.addEventListener('click', () => { modal.classList.add('hidden'); });
            }
            if (confirmBorrowBtn) {
                confirmBorrowBtn.addEventListener('click', () => {
                    confirmBorrowBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin mr-2"></i> Đang xử lý...';
                    confirmBorrowBtn.disabled = true;
                    borrowForm.submit();
                });
            }
            document.addEventListener('keydown', (event) => {
                if (event.key === 'Escape' && !modal.classList.contains('hidden')) {
                    modal.classList.add('hidden');
                }
            });
        });
    </script>
    @endpush
</x-app-layout>