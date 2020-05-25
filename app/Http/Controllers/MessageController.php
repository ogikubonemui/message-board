<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Message;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     // getでmessages/にアクセスされたときの「一覧表示処理」
    public function index()
    {
        // メッセージ一覧を取得
        $messages = Message::all();
        
        // メッセージ一覧ビューで取得した情報を表示
        return view('messages.index',['messages' => $messages,]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     // getでｍessages/createされたときの「新規登録画面表示処理」
    public function create()
    {
        $message = new Message;
        
        return view('messages.create',['message' => $message,]);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     // postでmessages/されたときの「新規登録処理」
    public function store(Request $request)
    {   
        
        // バリデーション
        $request->validate(['content' => 'required|max:255',]);
        
        // メッセージのインスタンスを作成し、コンテントを取り出す
        $message = new Message;
        $message->content = $request->content;
        $message->save();
        
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     // getでmessages/{id}にアクセスされたときの「取得表示処理」
    public function show($id)
    {
        // idの値でメッセージを検索して取得
        $message = Message::findOrFail($id);
        
        // メッセージ詳細ビューで取得した情報を表示
        return view('messages.show',['message' => $message,]);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     // getでmessages/{id}/editにアクセスされたときの「編集表示処理」
    public function edit($id)
    {
        //idの値でメッセージを検索して取得
        $message = Message::findOrFail($id);
        
        // メッセージ編集ビューで取得した値を表示
        return view('messages.edit',['message' => $message],);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     // putまたはpatchでmessages/{id}にアクセスされたときの「更新処理」
    public function update(Request $request, $id)
    {
        
        $request->validate(['content'=>'required|max255',]);
        
        //idの値で取得
        $message = Message::findOrFail($id);
        //メッセージを更新
        $message->content = $request->content;
        $message->save();
        
        // トップページへリダイレクトさせる
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     // deleteでmessages/{id}にアクセスされたときの「削除処理」
    public function destroy($id)
    {
        //idの値で検索して取得
        $message = Message::findOrFail($id);
        // メッセージを削除
        $message->delete();
        
        // トップページへリダイレクトさせる
        return redirect('/');
    }
}
