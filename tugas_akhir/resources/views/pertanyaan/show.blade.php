@extends('adminlte.master')

@push('script-head')
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
@endpush

@section('page-title')
{{ $pertanyaan->judul }}
@endsection

@section('content')
<div class="col-12">
    <!-- PERTANYAAN -->
    <div class="card">
        <div class="card-body">
            <div class="user-panel pt-2 pl-2 d-flex bg-dark">
                <div class="image p-2">
                    <img src="{{ asset($pertanyaan->user->profile->photo) }}" class="img-circle elevation-2"
                        alt="User Image">
                </div>
                <div class="info p-2">
                    <p href="#" class="d-inline pr-2">{{ $pertanyaan->user->name }}     <i class="fas fa-medal"></i> {{ $pertanyaan->user->profile->poin }}</p>
                    <a class="btn {{ $vote["btn1"] }} pl-4 pr-4 ml-2 mr-1"
                        href="{{ route('vote.pertanyaan', ['pertanyaan' => $pertanyaan->id, 'poin' => '1']) }}">
                        <span class="thumb"><i class="far fa-thumbs-up "></i></span>
                    </a>
                    <a class="btn btn-outline-warning pl-5 pr-5 ml-1 mr-1">
                        <span class="thumb">{{ $vote["skor"] }}</i></span>
                    </a>
                    <a class="btn {{ $vote["btn2"] }} pl-4 pr-4 ml-1"
                        href="{{ route('vote.pertanyaan', ['pertanyaan' => $pertanyaan->id, 'poin' => '-1']) }}">
                        <span class="thumb"><i class="far fa-thumbs-down"></i></span>
                    </a>
                </div>
            </div>
            <div class="mt-2 mb-2">
                <p class="card-text">{!! $pertanyaan->isi !!}</p>
            </div>

            <!-- JAWABAN TEPAT -->
            @if ($pertanyaan->jawaban_tepat_id != null)
            <div class="card">
                <div class="card-body bg-secondary">
                    <div class="user-panel pt-2 pl-2 d-flex bg-light">
                        <div class="image">
                            <img src="{{ asset($pertanyaan->jawaban_tepat->user->profile->photo) }}"
                                class="img-circle elevation-2" alt="User Image">
                        </div>
                        <div class="info">
                            <p href="" class="d-inline">{{ $pertanyaan->jawaban_tepat->user->name }} <i class="fas fa-medal"></i> {{ $pertanyaan->jawaban_tepat->user->profile->poin }}</p>
                            <button type="button" class="btn btn-success btn-sm ml-2">Jawaban Tepat</button>
                        </div>
                    </div>
                    <div class="p-2">
                        <p class="card-text">{!! $pertanyaan->jawaban_tepat->isi !!}</p>
                    </div>
                </div>
            </div>
            @endif
            <div>
                Tags :

                @foreach ($pertanyaan->tags as $tag)
                <button class="btn btn-primary btn-sm">{{ $tag->tag_name }}</button>
                @endforeach

            </div>
            <div class="m-2">
                Created at : {{ $pertanyaan->created_at }}
                <br>
                Updated at : {{ $pertanyaan->updated_at }}
                {{-- MENAMPILKAN TOMBOL EDIT PERTANYAAN --}}
                {{-- jika id user aktif sama dengan id pembuat pertanyaan --}}
                @if ($vote["user"]->id == $pertanyaan->user->id)
                    <a href="/pertanyaan/{{ $pertanyaan->id }}/edit" class="btn btn-info btn-md float-right">Edit Pertanyaan</a>
                @endif
            </div>
        </div>

        {{-- FOOTER --}}
        <div class="card-footer text-muted">
            {{-- KOMENTAR PERTANYAAN --}}
            @foreach ($pertanyaan->komentars as $komentar)
            <div class="d-flex mt-2">
                <div class="p-2 w-100 bd-highlight">
                    <p>{{ $komentar->isi }}</p>
                </div>
                <div class="p-2 flex-shrink-1 bd-highlight">
                    <p>Oleh : {{ $komentar->user->name }}</p>
                    <p>{{ $komentar->created_at }}</p>
                    {{-- MENAMPILKAN TOMBOL HAPUS KOMENTAR --}}
                    {{-- jika id user aktif sama dengan id pembuat komentar --}}
                    @if ($vote["user"]->id == $komentar->user->id)
                    <form action="{{ route('komentar.pertanyaanDestroy', ['pertanyaan' => $pertanyaan->id, 'komentar' => $komentar->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Hapus Komentar"  class="btn btn-danger btn-sm">
                    </form>
                    @endif

                </div>
            </div>
            <div class="mt-2" style="border-bottom-style:solid; border-bottom-width:thin;"></div>
            @endforeach

            {{-- INPUT KOMENTAR PERTANYAAN --}}
            <div class="card mt-2">
                <div class="card-body">
                    <form role="form" action="{{ route('komentar.pertanyaan', ['pertanyaan' => $pertanyaan->id]) }}"
                        method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control input-sm" id="komentar" name="komentar"
                                value="{{ old('komentar', '') }}" placeholder="Enter komentar">
                            @error('komentar')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-sm float-left">Tambahkan Komentar</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

</div>

<!-- SEMUA JAWABAN -->
@foreach ($jawabans as $j)
<div class="card m-2 w-100">
    <div class="card-body bg-secondary">
        <div class="user-panel pt-2 pl-2 d-flex bg-light">
            <div class="image p-2">
                <img src="{{ asset($j->user->profile->photo) }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info p-2">
                <p href="#" class="d-inline pr-2">{{ $j->user->name }} <i class="fas fa-medal"></i> {{ $j->user->profile->poin }}</p>

                @php
                    $user = $vote["user"];
                    $votes = $j->votes;
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
                @endphp

                <a class="btn {{ $vote["btn1"] }} pl-4 pr-4 ml-1 mr-1"
                    href="{{ route('vote.jawaban', ['pertanyaan' => $pertanyaan->id, 'jawaban' => $j->id, 'poin' => '1']) }}">
                    <span class="thumb"><i class="far fa-thumbs-up "></i></span>
                </a>
                <a class="btn btn-outline-warning pl-5 pr-5 ml-1 mr-1">
                    <span class="thumb">{{ $vote["skor"] }}</i></span>
                </a>
                <a class="btn {{ $vote["btn2"] }} pl-4 pr-4 ml-1"
                    href="{{ route('vote.jawaban', ['pertanyaan' => $pertanyaan->id, 'jawaban' => $j->id, 'poin' => '-1']) }}">
                    <span class="thumb"><i class="far fa-thumbs-down"></i></span>
                </a>
            </div>
        </div>
        <div class="p-2">
            <p class="card-text">{!! $j->isi !!}</p>
        </div>
        <div class="m-2">
            Created at : {{ $j->created_at }}
            <br>
            Updated at : {{ $j->updated_at }}
            {{-- MENAMPILKAN TOMBOL EDIT JAWABAN --}}
            {{-- jika id user aktif sama dengan id pembuat jawaban --}}
            @if ($vote["user"]->id == $j->user->id)
            <a href="{{ route('jawaban.edit', ['pertanyaan' => $pertanyaan->id, 'jawaban' => $j->id]) }}" class="btn btn-info btn-md float-right">Edit Jawaban</a>
            @endif
        </div>

        {{-- MENAMPILKAN TOMBOL JAWABAN TERBAIK --}}
        {{-- jika id user aktif sama dengan id pembuat pertanyaan dan bukan pembuat jawaban dan jawaban bukan jawaban tepat, maka dapat menentukan jawaban terbaik --}}
        @if ($user->id == $pertanyaan->user->id && $user->id != $j->user->id && $pertanyaan->jawaban_tepat_id != $j->id)
        <a href="{{ route('pertanyaan.tepat', ['pertanyaan' => $pertanyaan->id, 'jawaban' => $j->id]) }}"
            class="btn btn-primary">Jadikan Paling Tepat</a>
        @endif

    </div>

    {{-- FOOTER --}}
    <div class="card-footer text-muted">

        {{-- KOMENTAR JAWABAN --}}
        @foreach ($j->komentars as $komentar)
        <div class="d-flex mt-2">
            <div class="p-2 w-100 bd-highlight">
                <p>{{ $komentar->isi }}</p>
            </div>
            <div class="p-2 flex-shrink-1 bd-highlight">
                <p>Oleh : {{ $komentar->user->name }}</p>
                <p>{{ $komentar->created_at }}</p>
                {{-- MENAMPILKAN TOMBOL HAPUS KOMENTAR --}}
                {{-- jika id user aktif sama dengan id pembuat komentar --}}
                @if ($vote["user"]->id == $komentar->user->id)
                <form action="{{ route('komentar.jawabanDestroy', ['pertanyaan' => $pertanyaan->id, 'komentar' => $komentar->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="Hapus Komentar"  class="btn btn-danger btn-sm">
                </form>
                @endif
            </div>
        </div>
        <div class="mt-2" style="border-bottom-style:solid; border-bottom-width:thin;">

        </div>
        @endforeach

        {{-- INPUT KOMENTAR UNTUK JAWABAN --}}
        <div class="card mt-2">
            <div class="card-body">
                <form role="form"
                    action="{{ route('komentar.jawaban', ['jawaban' => $j->id, 'pertanyaan' => $pertanyaan->id]) }}"
                    method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control input-sm" id="komentar" name="komentar"
                            value="{{ old('komentar', '') }}" placeholder="Enter komentar">
                        @error('komentar')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-sm float-left">Tambahkan Komentar</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

</div>
@endforeach


{{-- INPUT JAWABAN ANDA --}}
<div class="w-100">
    <form role="form" action="{{ route('jawaban.store', ['pertanyaan' => $pertanyaan->id]) }}" method="POST">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="jawaban"> Jawaban Anda </label>
                {{-- <input type="text" class="form-control" id="isi" name="isi" value="{{ old('isi', '') }}"
                placeholder="Enter isi"> --}}
                <textarea id="jawaban" name="jawaban"
                    class="form-control my-editor">{!! old('jawaban', $jawaban ?? '') !!}</textarea>
                @error('jawaban')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Simpan Jawaban</button>
            </div>
        </div>

    </form>
</div>

</div>

@endsection

@push('scripts')
<script src="{{ asset('fm/tinytext.js')}}"></script>
@endpush
