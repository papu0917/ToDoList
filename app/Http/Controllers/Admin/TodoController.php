<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ToDo;
use App\Category;
use Carbon\Carbon;
use Auth;


class TodoController extends Controller
{
    public function add()
    {
        $categories = Category::all();
        
        return view('admin.todo.create', ['categories' => $categories]);
    }
  
    public function create(Request $request)
    {
        $this->validate($request, ToDo::$rules);
    
        $to_do = new ToDo;
        $form = $request->all();
      
        unset($form['_token']);
      
        $to_do->fill($form);
        $to_do->user_id = Auth::id(); // ログインユーザーのIDを設定
        $to_do->is_complete = 0; // 未完了状態を設定
        $to_do->save();
        
     
        return redirect('admin/todo');
    }  
  
    public function index(Request $request)
    {
        $cond_title = $request->cond_title;
        if ($cond_title != '') {
            // 検索されたら検索結果を取得する
            $toDoQuery = ToDo::where('title', $cond_title);
        } else {
            // それ以外はすべてのニュースを取得する
            $toDoQuery = ToDo::where('is_complete', 0);
        }
        
        $order = $request->order;
        if ($order != '') {
            $toDoQuery->orderBy('priority', $order);
        }
        // dd($order);
        
        $cond_name = $request->cond_name;
        // dd($cond_name);
        
        if ($cond_name != '') {
            // dd($cond_name);
            $toDoQuery->whereHas('category', function($query) use ($cond_name) {
                // slugをkeywordで検索
                $query->where('name', $cond_name);
            });
        }
        
        
        
        $toDos = $toDoQuery->paginate(5);
    
        return view('admin.todo.index', ['posts' => $toDos, 'cond_title' => $cond_title, 'cond_name' => $cond_name]);
    }
  
    public function edit(Request $request)
    {
        // News Modelからデータを取得する
        $to_do = ToDo::find($request->id);
        if (empty($to_do)) {
            abort(404);    
        }
        
        $categories = Category::all();
        
        return view('admin.todo.edit', ['to_do_form' => $to_do, 'categories' => $categories]);
        
    }
  
    public function update(Request $request)
    {
        // Validationをかける
        $this->validate($request, ToDo::$rules);
        // ToDo Modelからデータを取得する
        $to_do = ToDo::find($request->id);
        // 送信されてきたフォームデータを格納する
        $to_do_form = $request->all();
        unset($to_do_form['_token']);
      
        // 該当するデータを上書きして保存する
        $to_do->fill($to_do_form)->save();

        return redirect('admin/todo');
    }
  
    public function delete(Request $request)
    {
        // 該当するNews Modelを取得
        $to_do = ToDo::find($request->id);
        // 削除する
        $to_do->delete();
        
        return redirect('admin/todo/');
    }  
  
    public function complete(Request $request)
    {
        $to_do = ToDo::find($request->id);
        $to_do->is_complete = 1;  
        $to_do->save();
        
        return redirect('admin/todo/completed');
    }
    
    public function completed(Request $request)
    {
        $cond_title = $request->cond_title;
        if ($cond_title != '') {
            // 検索されたら検索結果を取得する
            $posts = ToDo::where('title', $cond_title)->get();
        }  else {
            // それ以外はすべてのニュースを取得する
            $posts = ToDo::where('is_complete', 1)->get();
        }
        
            $posts = ToDo::paginate(5);
        
            return view('admin.todo.completed', ['posts' => $posts, 'cond_title' => $cond_title]);
    }
    
    public function uncomplete(Request $request)
    {
        $to_do = ToDo::find($request->id);
        $to_do->is_complete = 0;  
        $to_do->save();
        
        return redirect('admin/todo/');
    }
}



// - タスクの登録(Newsの投稿と同じ)
// - タスクの一覧(「is_complete=0」のデータだ��表示する)
// - タスクの完了
//   - 「is_complete」を1にする(updateとdeleteの処理を参考にする)
//   - 削除リンクで削除する代わりにis_complete=1にupdateする
// - 完了済みタスクの一覧(「is_complete=0」のデータだけ表示する)