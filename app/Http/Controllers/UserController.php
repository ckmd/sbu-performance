<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Sbu;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        $sbu = $request->sbu;
        $name = $request->name;
        $email = $request->email;
        $role = 2;
        $password = Hash::make('password');

        DB::beginTransaction();

        try {
            $user = new User();

            $user->sbu_id = $sbu;
            $user->role_id = 2;
            $user->name = $name;
            $user->email = $email;
            $user->password = $password;
            
            $user->save();

            DB::commit();

            return redirect()
                ->route('recipient.index')
                ->with('success', 'Recipient Baru Berhasil Dibuat !');
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e);

            return redirect()
                ->back()
                ->with('error', 'Ada yang salah !');
        }        //
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
        $sbus = Sbu::all();
        $user = User::findOrFail($id);
        return view('recipient.edit', compact('user', 'sbus'));
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
        $user = User::findOrFail($id);
        $user->update($request->all());
        return redirect()
            ->route('recipient.index')
            ->with('success', 'Recipient ' . $user->name . ' Berhasil Diperbarui !');
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
        $user = User::findOrFail($id);
        $name = $user->name;
        $user->delete();

        return redirect('/recipient')->with(['success' => 'User ' . $name . ' Berhasil Dihapus !']);
        //
    }
}
