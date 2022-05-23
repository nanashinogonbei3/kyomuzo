<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use Illuminate\Support\Facades\Auth;
// 追加
use Illuminate\Support\Facades\DB;
// パスワードをHash化
use Illuminate\Support\Facades\Hash;


class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // タイムアウトしない
        ini_set("max_execution_time", 0); 
        // パース時間を設定しない
        ini_set("max_input_time", 0); 
        // $data = ['msg'=>'これはコントローラから渡されたメッセージです。'];
        // return view('product.test2', $data);

        // $members = Member::orderBy('desc')
        // ->Paginate(2);
        // dd($members);
        // return view('product.test2', compact('members'));


        // DBファサード編 これならOK
        // $members = DB::table('members')->get();

     

        // DBファサード編 これはブレードに$members を渡せていない。
        // $members = DB::table('members')->get();
        // return view('product.test2',['members' => $members]);
    

        // クエリビルダ編 dd が効く
        $members = Member::orderBy('id', 'asc')
        ->Paginate(7);
 
  
        return view('product.member', ['members' => $members]); 


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Member $member)
    {
        return view('shop/registration', compact('member'));
    }


    
    public function confirm(Request $registration)
    {
        
    // バリデーションを実行（結果に問題があれば処理を中断してエラーを返す
    $registration->validate( [
        
        // 氏名
        'last_name' => 'required',
        // 名前
        'first_name' => 'required',
        // emailは、メールアドレス形式に。
        'email' => 'required | email',
        // パスワードは英数字記号を混合パスワードは8桁以上で
        'password' => 'required | min:8', 'regex:/^[!-~]+$/',
        // 電話番号は10桁または11桁になります
        'phone_number' => 'required | numeric','digits_between:10,11',
        // 郵便番号
        'postal_code' => 'required | min:8', 'regex',
        // 郵便局APIを使用するため、都道府県、市区名、町名までのrequiredは全て不要
        'address4' => 'required',
        // 建物名があれば入力
    ],

        [
        //氏名 
        'last_name.required' => '氏名を入力してください。',
        // 名前
        'first_name.required' => 'お名前を入力してください。',
        // メールアドレス
        'email.required' => 'メールアドレスを入力してください。。',
        'email.email' => 'メールアドレス形式ではありません。',
        // パスワード
        'password.required' => 'パスワードを入力してください。',
        'password.min' => 'パスワードは8桁以上を入力してください。',
        'password.regex' => 'パスワードは英数字記号を混合してください。',
        // 電話番号 
        'phone_number.required' => '電話番号を入力してください。',
        'phone_number.numeric' => '電話番号はハイフンなしで10桁から11桁で入力してください。',
        'phone_number.digits_between' => '電話番号はハイフンなしで10桁から11桁で入力してください。',
        // 郵便番号
        'postal_code.required' => '郵便番号を入力してください。',
        // 番地は―（ハイフン）を含めて８桁にしてください。
        'postal_code.min' => '郵便番号は8桁にしてください。',
        // 'postal_code.numeric' => '郵便番号はハイフンなしで7桁を入力してください。',
        'postal_code.regex' => '郵便番号はハイフンを入れてください。',
        // 番地を入力してください。
        'address4.required' => '番地を入力してください。',          
    ]);

        // フォームから受け取った全ての値を取得し$inputに代入
        $input = $registration->all();

        // バリデーション設定のない確認画面join_confirm.blade.phpで
        // デベロッパーツールを使って値を書き換えられないように
        // セッションに値を保管しておく
        // セッションに値を保存する
        $registration->session()->put('inputs', $input);


        // コンパクトはオブジェクトで、配列ではないから、ブレード表示は
        // $registration->email 
        // 因みに配列の時は、$registration['email']と書く。
        // だがLaravelの場合Eloquentを使うので、オブジェクトで扱うため
        // $registration->email とオブジェクトとして扱う。
        return view('shop/join_confirm', [
            'inputs' => $input,
        ]);

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // タイムアウトしない
        ini_set("max_execution_time", 0); 
        // パース時間を設定しない
        ini_set("max_input_time", 0); 

        $member = new Member();

        $member->fill($request->session()->get('inputs'));

        $inputs = $request->session()->get('inputs');
    
        $member->password = Hash::make($inputs['password']);

        $member->save();

        // ログイン画面にリダイレクト 
        return redirect()->route('login');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        // タイムアウトしない
        ini_set("max_execution_time", 0); 
        // パース時間を設定しない
        ini_set("max_input_time", 0); 
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }



    // パスワードにHash(暗号化)するために全カラム
    protected function pwhash(Request $request, Member $member)
    {
        return Member::create([ 
            'last_name' => $request['last_name'],
            'first_name' => $request['first_name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'phone_number' => $request['phone_number'],   
            'postal_code' => $request['postal_code'],
            'address1' => $request['address1'],
            'address2' => $request['address2'],
            'address3' => $request['address3'],
            'address4' => $request['address4'],
            'address5' => $request['address5'],
        ]);

        return redirect()->route('shop.join_confirm');
    }

    // ログイン入力フォーム画面を表示する
    public function getAuth(Request $request)
    {
        $param = ['message' => 'ログインして下さい。'];
        return view('shop.login', $param);
    }

    // 入力したインプットした値を受け取るー＞login.bladeから送信
    public function postAuth(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        if (Auth::attempt(
            [
                'email' => $email,
                'password' => $password
            ]
        )) {
   
            // 入力したEmailとパスワードがtrueなら、index画面に遷移する。
            return redirect()->route('index');
            
            // 入力したEmailとパスワードがfalseなら、ログイン入力フォーム画面にリダイレクト。
        } else {
            $msg = 'ログインに失敗しました。';
            return redirect()->route('login');
        }
    }

    public function orderconfirm() {
        // フォームの確認のために、一時表示用
        return redirect()->route('orderconfirm');
            
    }



}
