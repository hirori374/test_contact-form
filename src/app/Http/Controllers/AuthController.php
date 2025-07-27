<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use App\Http\Requests\AuthRequest;

class AuthController extends Controller
{
    public function admin()
    {
        $categories = Category::all();
        $contacts = Contact::with('category')->get();
        $contacts = Contact::Paginate(7);
        return view('auth.admin', compact('categories', 'contacts'));
    }
    public function logout()
    {
        auth()->logout();
        return redirect('/login');
    }
    public function destroy(Request $request){
        $id = $request->route('id');
        Contact::find($id)->delete();
        return redirect('/admin');
    }
    public function search(Request $request){
        $categories = Category::all();
        $contacts = Contact::with('category')->get();
        session()->put('keyword', $request->keyword);
        session()->put('gender', $request->gender);
        session()->put('category_id', $request->category_id);
        session()->put('created_at', $request->created_at);
        $contacts = Contact::with('category')
            ->GenderSearch($request->gender)
            ->CategorySearch($request->category_id)
            ->DateSearch($request->created_at)
            ->keywordSearch($request->keyword)
            ->paginate(7);
        
        return view('auth.admin', compact('contacts', 'categories'));
    }
    public function reset()
    {
        $categories = Category::all();
        $contacts = Contact::with('category')->get();
        session()->forget('keyword');
        session()->forget('gender');
        session()->forget('category_id');
        session()->forget('created_at');
        $contacts = Contact::paginate(7);
        return view('auth.admin', compact('contacts', 'categories'));
    }
}
