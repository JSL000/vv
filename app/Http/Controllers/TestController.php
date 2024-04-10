<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Inertia\Inertia;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class TestController extends Controller
{
    public function index(Request $request)
    {
        $books = Book::get();

        $data = [
            'books' => $books,
            'count' => 5,
            'title' => '黃昏書店',
        ];
        return Inertia::render('Test', [
            'response' => $data,
        ]);
    }

    public function store()
    {

        $arr = [1, 2, 3, 4];
        $newArr = [];
        foreach ($arr as $item) {
            // dd($item);
            // dump($item);
            // 把每一個$item加1後，放入新陣列
            // array_push($newArr, $item + 1);

            // 把每一個$item加上文字後，放入新陣列
            // array_push($newArr, $item . '元');
            array_push($newArr, "{$item}個");
        }
        // dd($newArr);


        // $data = [
        //     [
        //         'id' => 1,
        //         'name' => 'Stanley',
        //     ],
        //     [
        //         'id' => 2,
        //         'name' => 'Tony',
        //     ],
        // ];

        // $newData = [];

        // foreach($data as $value) {
        //     dump($value);
        // }

        // foreach($data as $value) {
        //     dump($value['name']);
        //     array_push($newData, $value['name']);
        // }
        // dump($newData);
        // // 小練習
        // $teachers = [
        //     (object) [
        //         'id' => 1,
        //         'name' => '張三豐',
        //     ],
        //     (object) [
        //         'id' => 2,
        //         'name' => '李四川',
        //     ],
        // ];
        // $newTeachers = [];

        // foreach($teachers as $teacher) {
        //     dump($teacher->name);
        //     array_push($newTeachers, $teacher->name);

        // };
        // dd($newTeachers);
        $books = [
            [
                'name' => '哈利波特',
                'price' => '610',
            ],
            [
                'name' => '沙丘',
                'price' => '780',
            ],
        ];
        // Book::create([
        //     'name' => '哈利波特',
        //     'price' =>'500',
        // ]);

        foreach ($books as $book) {
            Book::create($book);
        }
        $books = Book::get();

        // $data = [
        //     'books' => $books,
        // ];

        // return Inertia::render('Test',[
        //     'response' => $data,
        // ]);

        //重新改變路線，導向/test路由，進而回到Test的頁面
        return redirect('/test');
    }
    // 新增書本
    public function add(Request $request)
    {
        $message = '';

        //例外處理
        try {
            //code...
            Book::create([
                'name' => $request->name,
                'price' => $request->price,
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            $message = '失敗';
        }
        // 物件用小箭頭
        // dd($request -> name);

        // 回到test頁面
        return redirect('/test')->with(['message' => $message]);
    }

    // 刪除書本
    public function deleteBook(Request $request)
    {
        // 物件用小箭頭
        //dd($request->all());

        // 找到指定id的書本並賦值給$book
        $book = Book::find($request->id);
        //dd($book);
        $message = '';
        // 書是否存在
        if ($book) {
            // 刪掉指定的書本
            $book->delete();
            $message = '成功';
        } else {
            $message = '失敗';
        }
        //dd($message);


        
    }
    public function updateBook(Request $request)
    {
        dd($request->all());
        $book = Book::find($request->id);
        $book->update([
            'name' => $request->name,
            'price' => $request->price,
        ]);
    }
}
