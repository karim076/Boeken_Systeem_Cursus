<!-- top_navigation info -->
<div class="top_nav_info">
    <div class="main">
        <div class="left">
            <a href="https://goo.gl/maps/htm885qECxbzpzmD8" target="_blank" class="items location-info">
                <i class='bx bxs-map icon'></i>
                <span>teststraat 120, 4011 EE Breda</span>
            </a>
            <a href="mailto:masjid-assunnah@gmail.com" target="_blank" class="items location-info">
                <i class='bx bx-envelope icon'></i>
                <span>k.alkichouhi@student.avans.nl</span>
            </a>
        </div>
        <div class="right">
            <div class="items social_items">
                <a href="https://www.facebook.com/sunnahtvnl/" target="_blank" rel="noopener noreferrer" class="icon"><i class='bx bxl-facebook-circle'></i></a>
                <a href="https://www.youtube.com/@sunnahtv311/streams" target="_blank" rel="noopener noreferrer" class="icon"><i class='bx bxl-youtube'></i></a>
                <a href="https://wa.me/+31685811283?" target="_blank" rel="noopener noreferrer" class="icon"><i class='bx bxl-whatsapp'></i></a>
            </div>
            <!-- language buttons switch -->
            <div class="lang-box lang-navi">
                <button class="lang-main btn-none" popovertarget="lang-more">
                    <i class="flag">🇳🇱</i>
                    <span class="name">NL</span>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- navigation -->
<nav class="nav-mini">
    <div class="main">
        <div class="mobile-menu">
            <!-- language buttons switch -->
            <div class="lang-box lang-navi">
                <button class="lang-main btn-none" popovertarget="lang-more">
                    <i class="flag">🇳🇱</i>
                    <span class="name">NL</span>
                </button>
            </div>
        </div>
        <div class="logo">
            <a href="{{ route('home') }}" target="_self">
                <img src="{{ asset('storage/images/logo.png') }}" alt="home">
            </a>
        </div>
        <div class="navi-list">
            <ul class="nav-box">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="">Over Ons</a></li>
                <li><a href="">Contact</a></li>
                <li><a href="{{ route('books.index') }}" class="navi-active">Boeken</a></li>
            </ul>
            <!-- mobile social info -->
            <div class="social_items">
                <a href="https://www.facebook.com/sunnahtvnl/" target="_blank" rel="noopener noreferrer" class="icon"><i class='bx bxl-facebook-circle'></i></a>
                <a href="https://www.youtube.com/@sunnahtv311/streams" target="_blank" rel="noopener noreferrer" class="icon"><i class='bx bxl-youtube'></i></a>
                <a href="https://wa.me/+31685811283?" target="_blank" rel="noopener noreferrer" class="icon"><i class='bx bxl-whatsapp'></i></a>
            </div>
        </div>
        <div class="mobile-menu">
            <!-- mobile hamburger -->
            <div class="hamburg mobile-left-nav-menu">
                <input id="left-navbar-menu" type="checkbox" class="hamburg_input">
                <label for="left-navbar-menu" class="burger">
                    <span></span>
                    <span></span>
                    <span></span>
                </label>
            </div>
        </div>
    </div>
</nav>
