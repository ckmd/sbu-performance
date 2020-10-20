<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TemplateMail;

class MailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function send(Request $request)
    {
        $file           = $request->file('attachment');
        $penerima       = $request->penerima;
        $totalPenerima  = count($penerima);
        // foreach($penerima as $kPenerima => $vPenerima){
        $details = [
            'body'          => $request->message,
            'subject'       => $request->subject,
            'attachment'    => $file,
            'targetEmail'   => $penerima
        ];
        \Mail::send(new \App\Mail\SbuMail($details));
        // }
        return redirect()->back()->with(['success' => 'Pesan Berhasil Dikirim ke '. $totalPenerima .' Penerima']);
    }

    public function index()
    {
        $templateMail = TemplateMail::first();
        return view('template-email.index', compact('templateMail'));
        //
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;
        $subject = $request->subject;
        $description = $request->description;

        TemplateMail::find($id)
            ->update(
                [
                    'subject' => $subject,
                    'description' => $description
                ]
            );
        
        return redirect()
            ->route('mail.index')
            ->with('success', 'Template Email Berhasil Diperbarui !');
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
