<br>
@foreach($messages as $message)
    @if (Auth::user()->name == $message->user->name)
        <span class="myName">
    @else
        <span class="othersName">
    @endif
    {{ $message->user->name }} </span>
    :
    <span id="timestamp"> {{ $message->created_at }}</span><br>
    <span id="msgContent">{!! nl2br(e($message->content)) !!}</span><br>
    @if (Auth::user()->name == $message->user->name)
        -- <a href="{{ route('messages.edit', $message->id) }}">編集</a><br>
    @endif
    <hr>
@endforeach
{{ $messages->links() }}