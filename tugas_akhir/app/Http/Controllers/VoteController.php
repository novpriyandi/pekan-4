<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Pertanyaan;
use App\Jawaban;
use RealRashid\SweetAlert\Facades\Alert;

class VoteController extends Controller
{
    public function pertanyaan($id, $poin)
    {

        $pertanyaan = Pertanyaan::find($id);

        //CEK APAKAH SUDAH PERNAH MELAKUKAN VOTE
        $user_aktif = Auth::user();
        $votes = $pertanyaan->votes;
        $vote["up"] = $votes->where('user_id', $user_aktif->id)->where('poin', 1)->count() > 0;
        $vote["down"] = $votes->where('user_id', $user_aktif->id)->where('poin', -1)->count() > 0;

        if ($vote["up"] || $vote["down"]) {
            if ($vote["up"] && $poin != 1) {
                $poin_user = $pertanyaan->user->profile->poin;
                $poin_user -= 10;
                $pertanyaan->user->profile->poin = $poin_user;
                $pertanyaan->user->profile->save();
            }
            elseif ($vote["down"] && $poin == 1) {
                $poin_user = $user_aktif->profile->poin;
                $poin_user += 1;
                $user_aktif->profile->poin = $poin_user;
                $user_aktif->profile->save();
            }
            $votes->where('user_id', $user_aktif->id)->first()->delete();
        }
        //AKHIR DARI CEK

        // (kondisi) ? (jika true) : (jika false);
        //jika poin = 1 (upvote) mengambil user yang  membuat pertanyaan, jika false mengambil  user yang melakukan downvote
        ($poin == 1) ? $user = $pertanyaan->user : $user = Auth::user();

        $poin_user = $user->profile->poin;

        //jika (upvote) +10, jika false -1
        ($poin == 1) ? $poin_user += 10 : $poin_user += $poin;

        //simpan di poin dan save di DB
        $user->profile->poin = $poin_user;
        $user->profile->save();

        $vote = $pertanyaan->votes()->create([
            "poin" => $poin,
            "user_id" => Auth::user()->id
        ]);

        Alert::success('Berhasil', 'Berhasil melakukan Vote');
        return redirect(route('pertanyaan.show', ['pertanyaan' => $id]));
    }

    public function jawaban($Pid, $Jid, $poin)
    {
        $jawaban = Jawaban::find($Jid);

        //CEK APAKAH SUDAH PERNAH MELAKUKAN VOTE
        $user_aktif = Auth::user();
        $votes = $jawaban->votes;
        $vote["up"] = $votes->where('user_id', $user_aktif->id)->where('poin', 1)->count() > 0;
        $vote["down"] = $votes->where('user_id', $user_aktif->id)->where('poin', -1)->count() > 0;

        if ($vote["up"] || $vote["down"]) {
            if ($vote["up"] && $poin != 1) {
                $poin_user = $jawaban->user->profile->poin;
                $poin_user -= 10;
                $jawaban->user->profile->poin = $poin_user;
                $jawaban->user->profile->save();
            }
            elseif ($vote["down"] && $poin == 1) {
                $poin_user = $user_aktif->profile->poin;
                $poin_user += 1;
                $user_aktif->profile->poin = $poin_user;
                $user_aktif->profile->save();
            }
            $votes->where('user_id', $user_aktif->id)->first()->delete();
        }

        //AKHIR DARI CEK

        // (kondisi) ? (jika true) : (jika false);
        //jika poin = 1 (upvote) mengambil user yang  membuat jawaban, jika false mengambil  user yang melakukan downvote
        ($poin == 1) ? $user = $jawaban->user : $user = Auth::user();

        $poin_user = $user->profile->poin;

        //jika (upvote) +10, jika false -1
        ($poin == 1) ? $poin_user += $poin*10 : $poin_user += $poin;

        //simpan di poin dan save di DB
        $user->profile->poin = $poin_user;
        $user->profile->save();

        $vote = $jawaban->votes()->create([
            "poin" => $poin,
            "user_id" => Auth::user()->id
        ]);

        Alert::success('Berhasil', 'Berhasil melakukan Vote');
        return redirect(route('pertanyaan.show', ['pertanyaan' => $Pid]));
    }
}
