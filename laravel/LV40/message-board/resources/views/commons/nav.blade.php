@if (Auth::check())
    <ul class="navigation">
        <li>
            <a href="{{ route('home') }}">マイページ</a>
        </li>
        <li>
            <a href="{{ route('messages.index') }}">みんなの投稿</a>
        </li>
        <li>
            <a href="#" onclick="logout()">
                ログアウト
            </a>
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
    </ul>
@endif