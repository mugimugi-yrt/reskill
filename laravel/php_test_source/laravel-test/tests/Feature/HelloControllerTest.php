<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HelloControllerTest extends TestCase
{
    public function test_hello_route_returns_hello_view() {
        // リクエストを送信し、レスポンスを受け取る
        $response = $this->get('/hello');

        // 正常なレスポンスが返されたことを検証
        $response->assertStatus(200);

        // hello.blade.phpがレスポンスに含まれていることを検証
        $response->assertViewIs('hello');
    }
    public function test_greeting_message_with_name_query_parameter() {
        // クエリパラメータ name に "山田太郎" を与えてリクエストを送信
        $response = $this->get('/hello?name=山田太郎');

        // 正常なレスポンスが返されたことを確認
        $response->assertStatus(200);

        // レスポンスのHTMLに "Hello, 山田太郎さん!" の文字列が含まれていることを確認
        $response->assertSee('Hello, 山田太郎さん！');
    }
    public function test_greeting_message_with_default_name() {
        // クエリパラメータ name を指定せずリクエストを送信
        $response = $this->get('/hello');

        // 正常なレスポンスが返されたことを確認
        $response->assertStatus(200);

        // レスポンスのHTMLに "Hello, 名無しさん!" の文字列が含まれていることを確認
        $response->assertSee('Hello, 名無しさん！');
    }
}
