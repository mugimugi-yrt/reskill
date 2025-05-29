<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Task;

class TaskTest extends TestCase
{
    use RefreshDatabase; // テストする度にデータベースをリフレッシュする

    public function test_create_task() {
        // タスクを作成するHTTP POSTリクエストを送信
        $response = $this->post('/tasks/', [
            'content' => '掃除をする',
        ]);
        // タスクがデータベースに存在することを確認
        $this->assertDatabaseHas('tasks', [
            'content' => '掃除をする',
        ]);
    }

    public function test_read_task() {
        // 新しいタスクを作成
        $task = Task::create([
            'content' => '掃除をする',
        ]);
        // タスクの詳細ページへアクセス
        $response = $this->get('/tasks/'.$task->id);
        // レスポンスのコンテンツに指定の文字列が含まれているかどうかを確認
        $response->assertSee('掃除をする');
    }

    public function test_update_task() {
        // 新しいタスクを作成
        $task = Task::create([
            'content' => '掃除をする',
        ]);
        // タスクを更新
        $response = $this->put('/tasks/'.$task->id, [
            'content' => '洗濯をする',
        ]);
        // 更新されたタスクがデータベースに存在することを確認
        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'content' => '洗濯をする'
        ]);
    }

    public function test_delete_task() {
        // 新しいタスクを作成
        $task = Task::create([
            'content' => '掃除をする',
        ]);
        // タスクを削除
        $response = $this->delete('/tasks/'.$task->id);
        // タスクがデータベースから削除されていることを確認
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }
}
