<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Notifications\clientNotification;
use App\Notifications\clientRegistrationNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $clients = Client::when($request->input('term'), static function ($query, $term){
                $query->where('last_name', 'LIKE', '%'. $term . '%')
                    ->Orwhere('email', 'LIKE', '%'. $term . '%');
            })->latest()->paginate(3);

        return response()->json($clients);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {

        //dd( $request->all());

       $request->validate([
           'first_name'     => ['required','string'],
           'last_name'      => ['required','string'],
           'email'          => ['required','string','email','unique:clients,email'],
           'date_of_birth'  => ['required','date'],
           'legal_counsel'  => ['required','string'],
           'case_file'      => ['image', 'max:5242880','required'],
           'profile_image' => ['nullable','max:5242880','image',
               function ($attribute, $value, $fail) {
                   if (filled($value)) {
                       $allowedMimeTypes = ['image/jpeg','image/gif','image/png'];
                       $contentType = $value->getClientMimeType();
                       if(!in_array($contentType, $allowedMimeTypes, true)){
                           $fail($attribute.' is not an image.');

                       }
                   }
               },],
       ]);


        $fileOne = $request->file('case_file');
        $fileTwo =  $request->file('profile_image');
        $caseFilePath = $fileOne->store('case_files');

        $profileImagePath = $request->hasFile('profile_image') ? $fileTwo->store('profileImages') : '';

        $client = Client::create([
            'first_name'     => $request->input('first_name'),
            'last_name'      => $request->input('last_name'),
            'email'          => $request->input('email'),
            'date_of_birth'  => $request->input('date_of_birth'),
            'legal_counsel'  => $request->input('legal_counsel'),
            'date_profiled'  => now(),
            'case_file'      => $caseFilePath,
            'profile_image'  => $profileImagePath
        ]);
        $client->notify(new clientRegistrationNotification($client));
        return response()->json($client,200);

    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $client = Client::where('id', $id)->firstOrFail();
        return response()->json($client);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
