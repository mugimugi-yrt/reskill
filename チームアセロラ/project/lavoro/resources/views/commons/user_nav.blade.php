<ul class="navigation">
    <!-- lavoro画像 -->
    <li><a href="{{ route("searches.top") }}">プラン検索</a></li>
    <li><a href="{{ route("reservations.index") }}">予約履歴</a></li>
    <li><a href="">ユーザー情報変更</a></li>          
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
    <li><a href="">退会</a></li>         
</ul>