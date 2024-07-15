<header>
    <div class="navbar bg-base-100">
        <div class="navbar-start">
            <div class="dropdown">
                <div tabindex="0" role="button" class="btn btn-ghost btn-circle">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h7" />
                    </svg>
                </div>
                <ul tabindex="0"
                    class="menu min-h-screen dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-[269px]">
                    @include('Components.menu')
                </ul>
            </div>
        </div>
        <div class="navbar-center">
            <a href="/" class="btn btn-ghost text-xl">Dasboard</a>
        </div>
        <div class="navbar-end">

            <a href="/login?isLogout=true" class="btn btn-ghost">
                Đăng Xuất
                <svg viewBox="0 0 24 24" width="18" fill="none" xmlns="http://www.w3.org/2000/svg"
                    stroke="#f5e324">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path d="M21 12L13 12" stroke="#b8c936" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                        <path d="M18 15L20.913 12.087V12.087C20.961 12.039 20.961 11.961 20.913 11.913V11.913L18 9"
                            stroke="#b8c936" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path
                            d="M16 5V4.5V4.5C16 3.67157 15.3284 3 14.5 3H5C3.89543 3 3 3.89543 3 5V19C3 20.1046 3.89543 21 5 21H14.5C15.3284 21 16 20.3284 16 19.5V19.5V19"
                            stroke="#b8c936" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </g>
                </svg>
            </a>
        </div>
    </div>
</header>
