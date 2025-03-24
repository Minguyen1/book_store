{{-- Header 1 --}}
<div class="container-fluid container1">
    <div class="logo">
        <a href="{{ route('home') }}">
            <img src="{{ asset('storage/images/book_store_logo.png') }}" alt="Logo">
        </a>
    </div>
    <div class="search">
        <form action="{{ route('user.search') }}" method="POST" class="form_search">
            @csrf
            <input type="text" name="query" placeholder="Tìm kiếm .....">
            <button type="submit" style="border: none; background-color: inherit;">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </form>
    </div>
    <div class="account">
        <div class="cart">
            <a href="{{ route('user.cart') }}" style="color: inherit; text-decoration: none;">
                <i class="fa-solid fa-cart-shopping"></i>
                <span>Giỏ hàng</span>
            </a>
        </div>
        <div class="user">
            <i class="fa-solid fa-user users"></i>
            <span>Tài khoản</span>
        </div>
    </div>
</div>

{{-- Thanh tìm kiếm cho màn hình < 769px --}}
<div class="mobile">
    <div class="search1">
        <form action="{{ route('user.search') }}" method="POST" class="form_search1">
            @csrf
            <input type="text" placeholder="Search .....">
            <button type="submit" style="border: none; background-color: inherit;">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </form>
    </div>
</div>

{{-- Header 2 --}}
<div class="container-fluid container2" style="border-bottom: 1px solid gray;">
    <ul class="navbar">
        <li class="li"><a href="{{ route('home') }}">Trang chủ</a></li>
        <li class="dropdown li">
            <a href="#"><i class="fa-solid fa-bars"></i> Danh mục</a>
            <ul class="dropdown-menu">
                @foreach ($categories as $category)
                    <li><a href="{{ route('user.category', $category->id) }}">{{ $category->name }}</a></li>
                @endforeach
            </ul>
        </li>
        <li class="li"><a href="#">Tin tức</a></li>
        <li class="li"><a href="#">Khuyến mãi</a></li>
    </ul>
</div>

{{-- Khối đăng nhập, đăng ký --}}
@guest
    <div class="log hidden">
        <ul>
            <li><a href="{{ route('form_login') }}">Đăng nhập</a></li>
            <li><a href="{{ route('form_register') }}">Đăng ký</a></li>
        </ul>
    </div>
@endguest
@auth
    <div class="log hidden">
        <ul>
            <li><a href="{{ route('user.profile') }}">Thông tin cá nhân</a></li>
            <li><a href="{{ route('user.detailOrder') }}">Đơn hàng</a></li>
            <li><a href="{{ route('user.historyDetailOrder') }}">Lịch sử đơn hàng</a></li>
            <li>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn">Đăng xuất</button>
                </form>
            </li>
        </ul>
    </div>
@endauth
