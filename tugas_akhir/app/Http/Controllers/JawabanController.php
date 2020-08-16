<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pertanyaan;
use App\Jawaban;
use Auth;
use RealRashid\SweetAlert\Facades\Alert;

class JawabanController extends Controller
{
    public function store(Request $request, $id)
    {
        $request->validate([
            'jawaban' => 'required'
        ]);

        $pertanyaan = Pertanyaan::find($id);
        $user = Auth::user();

        $jawaban = $pertanyaan->jawabans()->create([
            "isi" => $request["jawaban"],
            "user_id" => $user->id
        ]);

        Alert::success('Berhasil', 'Berhasil menambah JAWABAN baru');

        return redirect(route('pertanyaan.show', ['pertanyaan' => $id]));
    }

    public function edit($Pid, $Jid)
    {
        $jawaban = Jawaban::find($Jid); //SELECT * FROM
        return view('jawaban.edit', compact('jawaban'));
    }

    public function update(Request $request, $Pid, $Jid)
    {
        $request->validate([
            'jawaban' => 'required'
        ]);

        Jawaban::where('id', $Jid)->update([
            "isi" => $request["jawaban"]
        ]);

        Alert::success('Berhasil', 'Berhasil UPDATE Jawaban');

        return redirect(route('pertanyaan.show', ['pertanyaan' => $Pid]))->with('success', 'Berhasil Update pertanyaan!');
    }
}
