<?php

namespace App\Http\Controllers;
use App\Models\Categories;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
 
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$category = new Categories;
        //$category->all();
        $categories = Categories::all();

        return view('category/categoryIndex',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('category/categoryCreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request);
        $create = Categories::create([
            'name'=>$request->input('name'),
            'description'=>$request->input('description')
        ]);
        if($create){
            return redirect()->route('category.index');
        }else {
            return redirect()->back()->with('message', 'Erro na insercao');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Categories::findOrFail($id);
        //dd($category);
        return view('category/categoryShow', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Categories::findOrFail($id);
        //dd($category);
        return view('category/categoryEdit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //dd($request);
        //outra maneira de quebrar o request para salvar
        $category=Categories::findOrFail($id);
        $update = $category->update($request->except(['_token','_method']));
        if($update){
            return redirect()->route('category.index');
        }else {
            return redirect()->back()->with('message', 'Erro na atualizacao');

        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Categories::findOrFail($id);
        $category->delete();
        return redirect()->route('category.index');
    }
}
