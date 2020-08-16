<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Pertanyaan;
use App\Jawaban;
use App\Tag;
use Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Helpers\Vote;

class PertanyaanController extends Controller {
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pertanyaans = Pertanyaan::all();
        $skor_arr = [];
        foreach ($pertanyaans as $key => $p) {
            $votes = $p->votes;
            $skor_vote = 0;
            foreach ($votes as $vote) {
                $skor_vote += $vote->poin;
            }
            $skor_arr[$key] = $skor_vote;
        }

        return view('pertanyaan.index', compact('pertanyaans', 'skor_arr'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pertanyaan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'isi' => 'required'
        ]);

        $tags_arr = explode(',' , $request["tags"]);
        $tag_ids = [];

        foreach($tags_arr as $tag_name)
        {
            $tag = Tag::firstOrCreate(['tag_name' => $tag_name]);
            $tag_ids[] = $tag->id;
        }

        $pertanyaan = Pertanyaan::create([
            "judul" => $request["judul"],
            "isi" => $request["isi"]
        ]);

        $pertanyaan->tags()->sync($tag_ids);
        $user = Auth::user();
        $user->pertanyaans()->save($pertanyaan);
        Alert::success('Berhasil', 'Berhasil menambah PERTANYAAN baru');

        return redirect('/pertanyaan')->with('success', 'Pertanyaan Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pertanyaan = Pertanyaan::find($id);
        $jawabans = $pertanyaan->jawabans;
        $votes = $pertanyaan->votes;
        $user = Auth::user();
        $vote["user"] = $user;
        $vote["poin"] = $user->profile->poin;
        $vote["up"] = $votes->where('user_id', $user->id)->where('poin', 1)->count() > 0;
        $vote["down"] = $votes->where('user_id', $user->id)->where('poin', -1)->count() > 0;
        $vote["btn1"] = $vote["btn2"] = "btn-outline-secondary";

        if ($vote["up"]) {
            $vote["btn1"] = "btn-success disabled";
        }

        if ($vote["down"]) {
            $vote["btn2"] = "btn-danger disabled";
        } else {
            if ($vote["poin"] < 15) {
                $vote["btn2"] = "btn-outline-secondary disabled";
            }
        }

        $skor_vote = 0;
        foreach ($votes as $v) {
            $skor_vote += $v->poin;
        }
        $vote["skor"] = $skor_vote;

        return view('pertanyaan.show', compact('pertanyaan', 'jawabans', 'vote'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pertanyaan = Pertanyaan::find($id); //SELECT * FROM
        $tags = $pertanyaan->tags;
        $tag_ids = [];
        foreach($tags as $tag)
        {
            $tag_ids[] = $tag->tag_name;
        }

        $tag_value = implode(',' , $tag_ids);

        return view('pertanyaan.edit', compact('pertanyaan', 'tag_value'));
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
        $request->validate([
            'judul' => 'required',
            'isi' => 'required'
        ]);

        $tags_arr = explode(',' , $request["tags"]);
        $tag_ids = [];

        foreach($tags_arr as $tag_name)
        {
            $tag = Tag::firstOrCreate(['tag_name' => $tag_name]);
            $tag_ids[] = $tag->id;
        }

        Pertanyaan::where('id', $id)->update([
            "judul" => $request["judul"],
            "isi" => $request["isi"]
        ]);
        //dd($update);
        $update = Pertanyaan::find($id);
        //dd($update);
        $update->tags()->sync($tag_ids);

        Alert::success('Berhasil', 'Berhasil UPDATE Pertanyaan');

        return redirect(route('pertanyaan.show', ['pertanyaan' => $id]))->with('success', 'Berhasil Update pertanyaan!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pertanyaan::destroy($id);
        return redirect('/pertanyaan')->with('success', 'Pertanyaan Berhasil dihapus');
    }

    public function tepat($id, $jawaban_id)
    {
        $pertanyaan = Pertanyaan::find($id);
        $poin_user = 0;
        if (!empty($pertanyaan->jawaban_tepat_id)) {
            $jawaban = $pertanyaan->jawabans->where('id', $pertanyaan->jawaban_tepat_id)->first();
            $user = $jawaban->user;
            $poin_user = $user->profile->poin;
            $poin_user -= 15;
            $user->profile->poin = $poin_user;
            $user->profile->save();
        }
        $pertanyaan->jawaban_tepat_id = $jawaban_id;
        $pertanyaan->save();

        $jawaban = $pertanyaan->jawabans->where('id', $jawaban_id)->first();
        $user = $jawaban->user;
        $poin_user = $user->profile->poin;
        $poin_user += 15;
        $user->profile->poin = $poin_user;
        $user->profile->save();

        Alert::success('Berhasil', 'Berhasil menentukan JAWABAN PALING TEPAT');

        return redirect(route('pertanyaan.show', ['pertanyaan' => $id]));
    }

    public function jawaban(Request $request, $id)
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

    public function updateJawaban(Request $request, $id)
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

}
