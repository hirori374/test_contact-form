<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::with('category')->get();
        $categories = Category::all();
        return view('index', compact('contacts','categories'));
    }
    public function confirm(ContactRequest $request){
        $categories = Category::all();
        $tel1 = $request->input('tel1');
        $tel2 = $request->input('tel2');
        $tel3 = $request->input('tel3');
        $tel = $tel1 . '' . $tel2 . '' . $tel3;
        $contact = $request->only(['category_id','first_name','last_name','gender','email','tel1','tel2','tel3','address','building','detail']);
        $contact['tel'] = $tel;
        $category = Category::find($contact['category_id']);
        return view('confirm' , compact('contact', 'category'));
    }
    public function store(ContactRequest $request){
        $contact = $request->only(['category_id','first_name','last_name','gender','email','tel','address','building','detail']);
        Contact::create($contact);
        return view('thanks');
    }
    public function thanks(){
        return view('thanks');
    }
    public function correction(Request $request){
        $contact = $request->all();
        session()->flash('contact', $contact);
        return redirect('/');
    }
    public function admin(){
        $contacts = Contact::paginate(7);
        return view('auth.admin');
    }
    //public function admin(Request $request){
        //$contact = $request->only(['category_id','first_name','last_name','gender','email','tel','address','building','detail']);
        //Contact::create($contact);
        //$contacts = Contact::Paginate(7);
        //return view('auth/admin',['contacts' => $contacts]);
    //}
}
