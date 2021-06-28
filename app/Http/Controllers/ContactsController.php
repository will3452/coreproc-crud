<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Array
     */
    public function validateFields(Request $request){
        $data = $request->validate([
            'name'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'address'=>'required',
            'img'=>''
        ]);
       

        return $data;
    }


    public function __construct(){
        $this->middleware('auth');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validateFields($request);
        $data['img'] = $request->has('img') ? $request->img->store('/public/contact') : null;
        auth()->user()->contacts()->create($data);
        toast('Contact was added!', 'success');
        return back();
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
        $contact = auth()->user()->contacts()->findOrFail($id);

        //
        $data = $this->validateFields($request);
        $data['img'] = $request->has('img') ? $request->img->store('/public/contact') : $contact->img;
        toast('Contact was updated!', 'success');
        $contact->update($data);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact = auth()->user()->contacts()->findOrFail($id);

        $contact->delete();
        toast('Contact was deleted!', 'success');
        return back();
    }

    public function edit(Request $request, $id){
        $contact = auth()->user()->contacts()->findOrFail($id);
        return view('contact.edit', compact('contact'));
    }
}
