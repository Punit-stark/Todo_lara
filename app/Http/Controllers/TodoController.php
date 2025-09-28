<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Todo;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        $todos = Todo::with('category')
            ->where('user_id', auth::id())   // ✅ filter by logged in user
            ->latest()
            ->get();
            return view('dashboard', compact('todos', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Todo::create([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'user_id'     => auth::id(),
            'updated_at' => now(),
        ]);
        return redirect('/dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
  
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $categories = Category::all();
        $todos = Todo::find($id);
        return view('update', compact('todos', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $todos = Todo::find($id);
        $todos->update([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'updated_at' => now(),
        ]);
        return redirect('/dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $todo = Todo::find($id);
        $todo->delete();
        return redirect('/dashboard');
    }
}
