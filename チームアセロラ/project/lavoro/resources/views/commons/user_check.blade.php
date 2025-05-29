<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    {{-- titleつける場合 @section('title', 'ページタイトル') としてください --}}
    @hasSection('title')
        <title>@yield('title')</title>
    @else
        <title>{{ config('app.name') }}</title>
    @endif
    {{--
    @section
        <link rel="stylesheet" href="css/app.css">
    @endsection
    としてください --}}
    <link rel="stylesheet" href="/css/app.css">
    @hasSection('css')
        @yield('css')
    @endif
</head>

<body>
    @if(Auth::check())
        <header>
            <div class="container">
                @if (Auth::user()->is_admin)
                    @include('commons.admin_nav')
                @else
                    @include('commons.user_nav')
                @endif
            </div>
        </header>
        <main>
    @endif
    @if(Auth::check())  @endif
    <div class="container">
        <h2>@yield('title')</h2>
        <div class="details">
            @yield('sending_form')
                @csrf
                <div class="detail-item">
                    <label>氏名</label>
                    <input type="hidden" name="last_name" value="{{ $formData['last_name'] }}">{{ $formData['last_name'] }}
                    <input type="hidden" name="first_name" value="{{ $formData['first_name'] }}">{{ $formData['first_name'] }}
                </div>
                <div class="detail-item">
                    <label>フリガナ</label>
                    <input type="hidden" name="last_ruby" value="{{ $formData['last_ruby'] }}">{{ $formData['last_ruby'] }}
                    <input type="hidden" name="first_ruby" value="{{ $formData['first_ruby'] }}">{{ $formData['first_ruby'] }}
                </div>
                <div class="detail-item">
                    <label>パスワード</label>
                    {{ str_repeat('●', strlen($formData['password'])) }}
                    <input type="hidden" name="password" value="{{ $formData['password'] }}">
                </div>
                <div class="detail-item">
                    <label>メールアドレス</label>
                    <input type="hidden" name="email" value="{{ $formData['email'] }}">{{ $formData['email'] }}
                </div>
                <div class="detail-item">
                    <label>電話番号</label>
                    <input type="hidden" name="tel" value="{{ $formData['tel'] }}">{{ $formData['tel'] }}
                </div>
                
                <div class="detail-item">
                    <label>会社名</label>
                    <input type="hidden" name="company" value="{{ $formData['company'] }}">{{ $formData['company'] }}
                </div>
                <div class="detail-item">
                    <label>生年月日</label>
                    <input type="hidden" name="birthday" value="{{ $formData['birthday'] }}">{{ $formData['birthday'] }}
                </div>
                <div class="detail-item">
                    <label>住所</label>
                    <table>
                        <tr>
                            <td>郵便番号：</td>
                            <td>〒<input type="hidden" name="address_post" value="{{ $formData['address_post'] }}">{{ $formData['address_post'] }}</td>
                        </tr>
                        <tr>
                            <td>都道府県：</td>
                            <td><input type="hidden" name="address_pref" value="{{ $formData['address_pref'] }}">{{ $formData['address_pref'] }}</td>
                        </tr>
                        <tr>
                            <td>市区町村：</td>
                            <td><input type="hidden" name="address_town" value="{{ $formData['address_town'] }}">{{ $formData['address_town'] }}</td>
                        </tr>
                        <tr>
                            <td>丁目番地号：</td>
                            <td><input type="hidden" name="address_street" value="{{ $formData['address_street'] }}">{{ $formData['address_street'] }}</td>
                        </tr>
                        <tr>
                            <td>ﾏﾝｼｮﾝ名・部屋番号等：</td>
                            <td><input type="hidden" name="address_num" value="{{ $formData['address_num'] }}">{{ $formData['address_num'] }}</td>
                        <tr>
                    </table>
                </div>
                <div class="detail-item">
                    <label>性別</label>
                    <input type="hidden" name="gender" value="{{ $formData['gender'] }}">{{ $formData['gender'] }}
                </div>
                <div class="detail-item">
                    <label>お知らせ配信</label>
                    <input type="hidden" name="get_notice" value="{{ $formData['get_notice'] }}">
                    @if ($formData['get_notice'])
                        受け取る
                    @else
                        受け取らない
                    @endif
                </div>
            @yield('send_button')
            </form>
        </div>
        <p id="back">
            @yield('back_link')
        </p>
    </div>
    @if(Auth::check()) </main> @endif

</body>

</html>