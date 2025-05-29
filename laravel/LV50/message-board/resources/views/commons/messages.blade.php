<br>
@foreach($messages as $message)
    @if (Auth::user()->name == $message->user->name)
        <span class="myName">{{ $message->user->name }} </span>
        :
        <span id="timestamp"> {{ $message->created_at }}</span>
        -- <a href="{{ route('messages.edit', $message) }}">編集</a><br>
    @else
        <span class="othersName">{{ $message->user->name }} </span>
        :
        <span id="timestamp"> {{ $message->created_at }}</span><br>
    @endif

    <span id="msgContent">{!! nl2br(e($message->content)) !!}</span><br>

    @if (Auth::user()->name != $message->user->name)
        @if(Auth::user()->isLike($message->id))
            <form action="{{ route('likes.destroy') }}" method="post">
                @csrf
                @method('delete')
                <input type="hidden" name="message_id" value="{{ $message->id }}">
                <button type="submit">イイネ解除</button> 
                <a href="{{ route('messages.show', $message) }}">{{ $message->getLikeUsersCount() }}</a>
                人がイイネ！と言っています
            </form>
        @else
            <form action="{{ route('likes.store') }}" method="post">
                @csrf
                <input type="hidden" name="message_id" value="{{ $message->id }}">
                <button type="submit">イイネ！</button> 
                <a href="{{ route('messages.show', $message) }}">{{ $message->getLikeUsersCount() }}</a>
                人がイイネ！と言っています
            </form> 
        @endif
    @endif
    <hr>
@endforeach
{{ $messages->links() }}