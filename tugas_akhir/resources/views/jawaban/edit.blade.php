@extends('adminlte.master')

@push('script-head')
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
@endpush

@section('content')
<div class="ml-3 mt-3 w-100">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit Jawaban {{ $jawaban->id }}</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form role="form" action="{{ route('jawaban.update', ['pertanyaan' => $jawaban->pertanyaan->id, 'jawaban' => $jawaban->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label for="jawaban"> Jawaban Anda </label>
                    <textarea id="jawaban" name="jawaban"
                        class="form-control my-editor">{!! old('jawaban', $jawaban->isi) !!}</textarea>
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
