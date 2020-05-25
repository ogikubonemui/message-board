@extends('layouts.app')

@section('content')

    <h1>メッセージ一覧</h1>
    @if (count($messages) > 0)
        <table class ="table table-striped">
            <thread>
                <tr>
                    <th>id</th>
                    <th>メッセージ</th>
                </tr>
            </thread>
            <tbody>
                @foreach ($messages as $message)
                <tr>
                    {{-- メッセージ詳細ページへのリンク --}}
                    <td>{!! link_to_route('messages.show', $message->id, ['message' => $message->id]) !!}</td>
                    <td>{{ $message->content }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    {!! link_to_route('messages.create', '新規メッセージの投稿', [], ['class' => 'btn btn-primary']) !!}

@endsection