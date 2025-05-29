<ul class="navigation">
    <!-- lavoro画像 -->
    <div id='logo'>
        <img src="{{ asset('logo/lavoro_logo_rmv.png') }}">
        <img src="{{ asset('logo/admin_rmv.png') }}" id='admin'>
    </div>
    <div id='menu'>
        <li><a href="{{ route('admin.users.index') }}">ユーザー一覧</a></li>
        <li><a href="{{ route('admin.hotels.index') }}">宿一覧</a></li>
        <li><a href="{{ route('admin.plans.index') }}">プラン一覧</a></li>          
        <li><a href="{{ route('admin.request') }}">管理者追加依頼</a></li>   
        <li>
            <a href="#" onclick="logout()">ログアウト</a>
            <form action="{{ route('logout') }}" method="post" id="logout-form">
                @csrf
            </form>
            <script type="text/javascript">
                function logout() {
                    event.preventDefault();
                    if (window.confirm('ログアウトしますか？')) {
                        document.getElementById('logout-form').submit();
                    }
                }
            </script>
        </li>
    </div>      
</ul>