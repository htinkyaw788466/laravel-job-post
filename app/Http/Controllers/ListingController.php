<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('listings/index',[
            'listings'=>Listing::latest()->filter
            (request(['tag','search']))->paginate(6)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('listings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $formFields=$request->validate([
            'title'=>'required',
            'company'=>['required',Rule::unique('listings','company')],
            'location'=>'required',
            'website'=>'required',
            'email'=>['required','email'],
            'tags'=>'required',
            'description'=>'required'
        ]);

        if($request->hasFile('logo')){
            $formFields['logo']=$request->file('logo')
                                 ->store('logos','public');
         }

         $formFields['user_id'] = auth()->id();

        Listing::create($formFields);

        return redirect('/')->with('message','listing created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Listing $listing)
    {
        return view('listings/show',[
            'listing'=>$listing
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Listing $listing)
    {
        return view('listings/edit',['listing'=>$listing]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Listing $listing)
    {
        //make sure logged in user is owner
        if($listing->user_id!=auth()->id()){
            abort(403,'unauthorized action');
        }

        $formFields=$request->validate([
            'title'=>'required',
            'company'=>['required'],
            'location'=>'required',
            'website'=>'required',
            'email'=>['required','email'],
            'tags'=>'required',
            'description'=>'required'
        ]);

        if($request->hasFile('logo')){
            $formFields['logo']=$request->file('logo')->store('logos','public');
        }

        $listing->create($formFields);
        return back()->with('message','listing edit successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Listing $listing)
    {
        //make sure logged in user is owner
        if($listing->user_id!=auth()->id()){
            abort(403,'unauthorized action');
        }

        $listing->delete();
        return redirect('/')->with('message','listing deleted successfully');
    }

    public function manage(){
        return view('listings.manage',
        ['listings' => auth()->user()->listings()->paginate(6)]);
    }
}
