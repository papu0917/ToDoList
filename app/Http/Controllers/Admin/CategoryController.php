<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;

class CategoryController extends Controller
{
    public function add(Request $request)
    {
        return view('admin.category.create');
        
    }
    
    public function create(Request $request)
    {
        $category = new Category;
        $form = $request->all();
      
        unset($form['_token']);
      
        $category->fill($form);
        $category->save();
      
      
      
      return redirect('admin/category');
        
    }
    
    public function index(Request $request)
    {
        $cond_title = $request->cond_title;
        if ($cond_title != '') {
            // 検索されたら検索結果を取得する
            $category = Category::where('name', $cond_title)->get();
        } else {
            // それ以外はすべてのニュースを取得する
            $category = Category::all();
        }
        
        $category = Category::paginate(5);
        
        return view('admin.category.index', ['posts' => $category, 'cond_title' => $cond_title]);
        
        
    }
    
    public function edit(Request $request)
    {
        $category = Category::find($request->id);
        if (empty($category)) {
            abort(404);
        }
        return view('admin.category.edit', ['category_form' => $category]);
        
        
        
    }
    
    public function update(Request $request)
    {
        // Validationをかける
        $this->validate($request, Category::$rules);
        // ToDo Modelからデータを取得する
        $category = Category::find($request->id);
        // 送信されてきたフォームデータを格納する
        $category_form = $request->all();
        unset($category_form['_token']);
      
        // 該当するデータを上書きして保存する
        $category->fill($category_form)->save();
        return redirect('admin/category/');
        
    }
    
    public function delete(Request $request)
    {
        // 該当するNews Modelを取得
        $category = Category::find($request->id);
        // 削除する
        $category->delete();
        
        return redirect('admin/category/');
    }
}
