<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Food;
use App\Category;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         //$foods = Food::latest()->get();
        $foods = Food::latest()->paginate(10);
        return view('admin.food.index', compact('foods'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $categories = Category::all()->pluck('name', 'id')->prepend('pleaseSelect');
        return view('admin.food.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|integer',
            'category' => 'required',
            'image' => 'required|mimes:png,jpeg,jpg'
        ]);
         $image = $request->file('image');
         $name = time().'.'.$image->getClientOriginalExtension();
         $destinationPath = public_path('/images');
         $image->move($destinationPath, $name);

         Food::create([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'price' => $request->get('price'),
            'category_id' => $request->get('category'),
            'image' => $name
         ]);
         return redirect()->route('food.index')->with('message', 'Food Created');

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
        $food = Food::find($id);
        return view('admin.food.edit', compact('food'));
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
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|integer',
            'category' => 'required',
            'image' => 'mimes:png,jpeg,jpg'
        ]);

        $food = Food::find($id);
        $name = $food->image;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time().'.'.$image->getClientOriginalExtension();
         $destinationPath = public_path('/images');
         $image->move($destinationPath, $name);
        }
        $food->name = $request->get('name');
        $food->description = $request->get('description');
        $food->price = $request->get('price');
        $food->category_id = $request->get('category');
        $food->image = $name;
        $food->save();

        return redirect()->route('food.index')->with('message', 'Food Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Food $food)
    {
        // $food = Food::find($id);
        // $food->delete();
        $food->delete();

        //return back();
        return redirect()->route('food.index')->with('message', 'Food Delete');
    }

    public function listFood()
    {
        //return $categories = Category::with('food')->get();
        $categories = Category::with('food')->get();
        return view('food.list', compact('categories'));
    }

    public function view($id)
    {
        $food = Food::find($id);
        return view('food.detail', compact('food'));
    }
}
