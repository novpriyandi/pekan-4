@extends('adminlte.master')

@push('script-head')
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
@endpush

@section('content')
<div class="ml-3 mt-3 w-100">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit Pertanyaan {{ $pertanyaan->id }}</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form role="form" action="/pertanyaan/{{ $pertanyaan->id }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label for="judul">Judul</label>
                    <input type="text" class="form-control" id="judul" name="judul" value="{{ old('judul', $pertanyaan->judul) }}" placeholder="Enter judul">
                    @error('judul')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="isi"> Isi </label>
                    {{-- <input type="text" class="form-control" id="isi" name="isi" value="{{ old('isi', '') }}"  placeholder="Enter isi"> --}}
                    <textarea id="isi" name="isi" class="form-control my-editor">{!! old('isi', $pertanyaan->isi ?? '') !!}</textarea>
                    @error('isi')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="tags">Tags</label>
                    <input type="text" class="form-control" id="tags" name="tags" value="{{ old('tags', $tag_value) }}" placeholder="Pisahkan dengan koma, contoh: postingan,beritaterkini,update">
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Edit</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('fm/tinytext.js')}}"></script>
@endpush
