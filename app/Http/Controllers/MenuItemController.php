<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MenuItemController extends Controller
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
        $data = MenuItem::select('menu_items.id', 'menu_items.title', 'menu_items.url', 'mi.title as parent_name')
        ->leftjoin('menu_items as mi', 'mi.id', '=', 'menu_items.parent_id')
        ->orderBy('menu_items.created_at', 'DESC')
        ->get();

        return view('menu-item.index', compact('data'));
    }

    public function create()
    {
        $parents = MenuItem::all();

        return view('menu-item.create', compact('parents'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|min:3',
                'url' => 'required|min:3',
            ]);

            MenuItem::create([
                'title' => $request->title,
                'url' => $request->url,
                'parent_id' => $request->parent,
            ]);

            return redirect(route('menu-item.index'))->with('success', 'Save successfully');
        } catch (\RuntimeException $e) {
            return redirect(route('menu-item.create'))->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $data = MenuItem::find($id);
        $parents = MenuItem::where('id', '!=', $id)->get();

        return view('menu-item.edit', compact('data', 'parents'));
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'title' => 'required|min:3|unique:menu_items,title,'.$id.',id',
                'url' => 'required|min:3',
            ]);

            MenuItem::find($id)->update([
                'title' => $request->title,
                'url' => $request->url,
                'parent_id' => $request->parent ?? null,
            ]);

            return redirect(route('menu-item.index'))->with('success', 'Update successfully');
        } catch (\RuntimeException $e) {
            return redirect(route('menu-item.edit', $id))->with('error', $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            MenuItem::find($id)->delete();

            return redirect(route('menu-item.index'))->with('success', 'Delete successfully');
        } catch (\RuntimeException $e) {
            return redirect(route('menu-item.edit', $id))->with('error', $e->getMessage());
        }
    }
}
