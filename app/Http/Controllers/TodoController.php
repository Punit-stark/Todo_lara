<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Todo;

use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories=Category::all();
        $todos=Todo::with('category')->latest()->get();   //with() relationship execute all query in one, latest(),get() return obj of collection which can render in UI 
        return view('dashboard',compact('todos','categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        Todo::create([
          'title'=> $request->title,
           'content'=> $request->content,
          'category_id'=> $request->category_id,
          'updated_at'=>now(),
        ]);
        return redirect('/dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
