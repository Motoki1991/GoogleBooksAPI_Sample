<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class GoogleBooksSearch
{
    //staticメンバ
    static private $_access_key;
    static private $_secret_key;
    //APIに問い合わせ、検索結果を格納してインスタンスを返す
    public static function Search($book_name)
    {
        //urlを生成する
        $url = "https://www.googleapis.com/books/v1/volumes?q=" . $book_name;

        //google books APIにリクエストして、レスポンスをjsonで受け取る
        $json = file_get_contents($url);

        //jsonからインスタンスを生成して返す        
        //echo $json;        
        $instance = new GoogleBooksSearch($json); 
        return $instance;
    }
    ////////////////////////////

    //privateフィールド
    private $_index = 0;
    private $_result_list = null;
    public $ResultCount = 0;
    /////////////////////

    private function __construct($json)
    {
        $this->_index = 0; //次の要素のindexを表す
        $json_decode = json_decode($json);
        $this->_result_list = $json_decode->{"items"};
        // echo gettype($_result_list) . "\n";
        $this->ResultCount = count($this->_result_list);
        // echo $this->ResultCount . "\n";
    }

    //検索結果をイテレーティブに取得する
    public function NextResult()
    {
        $result;
        if($this->IsHasNext() === True)
        {
            //結果を1行取ってくる処理
            $result = $this->_result_list[$this->_index];
            $this->_index = $this->_index + 1;
            echo "取ってきた！\n";
        }        
        return $result;
    }

    //次の検索結果があるかを返す
    public function IsHasNext()
    {
        $result = True;        
        if($this->_index > count($this->_result_list))
        {
            $result = False;
        }
        return $result;
    }
    
}

//テスト実行用
$obj = GoogleBooksSearch::Search("json");
// echo gettype($obj) . "\n";
echo $obj->ResultCount."\n";
echo $obj->IsHasNext()."\n";
$record = $obj->NextResult();
echo gettype($record)."\n";
echo $record->{"id"}."\n";