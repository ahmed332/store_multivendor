<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $request = request();
        $query = Category::query();
       $categories = Category::leftJoin('categories as parents','parents.id','=','categories.parent_id')->
       select([
        'categories.*',
        'parents.name as parent_name'
       ])
       ->filter($request->query())
       ->paginate(5);
 
        // $categories = $query->latest()->paginate(5);
        // $categories = Category::Active()->paginate(); //get scope frommodel with only active
        return view('dashboard.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parents = Category::all();
        $category= new Category();
        // dd($category);
                return view('dashboard.categories.create',compact('parents','category'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->input('name');
        // $request->post('name');
        // $request->query('name');
        // $request->name;
        // $request['name'];
        // dd($request->all());//return array of all input
        // $category = new Category($request->all());
        // // $category->name = $request->post('name');
        // // $category->parent_id = $request->post('parent_id');
        // $category->save();
        // or 
        $request->validate(Category::rules()
            );
         $request->merge([
            'slug'=>Str::slug($request->post('name'))
        ]);
        $data = $request->except('image');
       
        $data['image'] =$this->uploadImage($request);

       

        // mass assignment بعت كل البيانات مره واحده لازم اضيف fillable in model
        $category = Category::create($data);
        //PRG
        return redirect()->route('dashboard.categories.index')->with('success','category created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category=Category::find($id);
        try{
            $category= Category::findOrFail($id);
        }catch(Exception $e){
            return redirect()->route('dashboard.categories.index')
            ->with('info','record not found');
        }
        // $parents=Category::where('id','<>',$id)
        // ->whereNull('parent_id')

        // ->where('parent_id','<>',$id)
        // ->get();
        $parents=Category::all();
        return view('dashboard.categories.edit',compact('category','parents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(Category::rules($id));
        $category = Category::find($id);
        $oldImage =$category->image;
        $data = $request->except('image');
        
      $new_img= $this->uploadImage($request);
      if($new_img){
          $data['image']=$new_img;
      }
      $category->update($data);
        
        if($oldImage && $new_img){
            Storage::disk('public')->delete($oldImage);
        }
        
        return redirect()->route('dashboard.categories.index')->with('success','category updated');

        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);

        $category->delete();
        // if ($category->image) {
        //     Storage::disk('public')->delete($category->image);
        // }
        // $category->destroy($id);
        return redirect()->route('dashboard.categories.index')->with('delete','category deleted');
    }

    public function trash(){
        $categories=Category::onlyTrashed()->paginate();
        return view('dashboard.categories.trash',compact('categories'));
    }
    public function restore(Request $request,$id){
        $category=Category::onlyTrashed()->findOrFail($id);
        $category->restore();
        return redirect()->route('dashboard.categories.index')->with('success','category restored');
    } 
    public function forceDelete($id){
         $category=Category::onlyTrashed()->findOrFail($id);
        $category->forceDelete();
         if ($category->image) {
            Storage::disk('public')->delete($category->image);
         }
        return redirect()->route('dashboard.categories.index')->with('success','category deleted');
    }
    protected function uploadImage(Request $request){
         if(!$request->hasFile('image')){
            return;
         }

            $file = $request->file('image') ;//uploadedfile object
            // $file->getClientOriginalName(); //return origin file name
           $path = $file->store('uploads',[
                'disk'=>'public'
            ]);
           return $path;
        
    }
}
