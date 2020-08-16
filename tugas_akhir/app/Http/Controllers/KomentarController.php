<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Pertanyaan;
use App\Jawaban;
use App\Komentar_Pertanyaan;
use App\Komentar_Jawaban;
use RealRashid\SweetAlert\Facades\Alert;

class KomentarController extends Controller
{
    public function pertanyaan(Request $request, $id)
    {
        $request->validate([
            'komentar' => 'required',
        ]);

        $pertanyaan = Pertanyaan::find($id);
        $user = Auth::user();

        $komentar = $pertanyaan->komentars()->create([
            'isi' => $request["komentar"],
            'user_id' => $user->id
        ]);


        //$user->komentar_pertanyaans()->save($komentar);
        Alert::success('Berhasil', 'Berhasil menambah KOMENTAR baru');

        return redirect(route('pertanyaan.show', ['pertanyaan' => $id]));
    }

    public function jawaban(Request $request, $Pid, $Jid)
    {
        $request->validate([
            'komentar' => 'required',
        ]);

        $jawaban = Jawaban::find($Jid);
        $user = Auth::user();

        $komentar = $jawaban->komentars()->create([
            'isi' => $request["komentar"],
            'user_id' => $user->id
        ]);


        //$user->komentar_pertanyaans()->save($komentar);
        Alert::success('Berhasil', 'Berhasil menambah KOMENTAR baru');

        return redirect(route('pertanyaan.show', ['pertanyaan' => $Pid]));
    }

    public function destroyPertanyaan($Pid, $Kid)
    {

        Komentar_Pertanyaan::destroy($Kid);
        Alert::success('Berhasil', 'Berhasil menghapus KOMENTAR');
        return redirect(route('pertanyaan.show', ['pertanyaan' => $Pid]));
    }

    public function destroyJawaban($Pid, $Kid)
    {

        Komentar_Jawaban::destroy($Kid);
        Alert::success('Berhasil', 'Berhasil menghapus KOMENTAR');
        return redirect(route('pertanyaan.show', ['pertanyaan' => $Pid]));
    }
}
