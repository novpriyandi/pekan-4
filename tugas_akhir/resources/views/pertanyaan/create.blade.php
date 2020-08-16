@extends('adminlte.master')

@push('script-head')
  <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
@endpush

@section('page-title')
  Ask Question
@endsection

@section('content')
<div class="col-md-12">
  <div class="card card-primary">
    <!-- form start -->
    <form role="form" action="/pertanyaan" method="POST">
      @csrf
      <div class="card-body">
        <div class="form-group">
          <label for="judul"> Judul </label>
          <input type="text" class="form-control" id="judul" name="judul" value="{{ old('judul', '') }}" placeholder="Enter judul">
          @error('judul')
            <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>
        <div class="form-group">
          <label for="isi"> Isi </label>
          {{-- <input type="text" class="form-control" id="isi" name="isi" value="{{ old('isi', '') }}"  placeholder="Enter isi"> --}}
          <textarea id="isi" name="isi" class="form-control my-editor">{!! old('isi', $isi ?? '') !!}</textarea>
          @error('isi')
            <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>
        <div class="form-group">
          <label for="tags">Tags</label>
          <input type="text" class="form-control" id="tags" name="tags" value="{{ old('tags', '') }}" placeholder="Pisahkan dengan koma, contoh: postingan,beritaterkini,update">
        </div>
      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Create</button>
      </div>
    </form>
  </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('fm/tinytext.js')}}"></script>
@endpush
