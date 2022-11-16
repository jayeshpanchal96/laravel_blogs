<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Blog;
use Response;
use DB;
class BlogController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = Blog::latest()->get();
        return view('home', compact('data'))->with('i', (request()->input('page', 1) - 1) * 5);
    }
    public function search_data($date=null)
    {
        if($date == null || $date == 'null'){
            $datas = Blog::latest()->get(); 
        }else{
            $datas = Blog::whereDate('created_at', '=', $date)->get();
        }
        $dataItems=array();
        $blogData = array();
        if(!empty($datas) && count($datas) > 0){
          foreach($datas as $item){
            $catNames=categoryNameByids($item->category_ids);
            $dataItems['title']=$item->title;
            $dataItems['categories']=$catNames;
            $dataItems['content']=$item->title;
            $dataItems['image']=$item->image;
            $dataItems['created_at']= date('d-M-y',strtotime($item->created_at));
            $blogData[]=$dataItems;
          }
        }

        return Response::json($blogData); 
    }

    public function create()
    {
        $categories = Category::all();
        return view('create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'          =>  'required',
            'content'         =>  'required',
            'image'         =>  'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000',
            'categories'=>  'required',
        ]);

        $file_name = time() . '.' . request()->image->getClientOriginalExtension();
      
        request()->image->move(public_path('images'), $file_name);

        $blog = new Blog;
        $blog->title = $request->title;
        $blog->category_ids = implode(',',$request->categories);
        $blog->content = $request->content;
        $blog->image = $file_name;

        $blog->save();

        return redirect()->route('home')->with('success', 'Blog Added successfully.');
    }
}
