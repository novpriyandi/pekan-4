@extends('adminlte.master')

@section('page-title')
  Top Questions
@endsection

@section('content')
  <div class="col-12">
    <div class="card">
      <div class="card-body table-responsive p-0">
        <table class="table table-hover text-wrap">
          <tbody>
            @forelse ($pertanyaans as $key => $p)
              <tr href="{{ route('pertanyaan.show', ['pertanyaan' => $p->id]) }}">
                <td align="center">
                    {{ $skor_arr[$key] }}
                  <br>
                  votes
                </td>
                <td align="center">
                  {{ $p->jawabans->count() }}
                  <br>
                  answers
                </td>
                <td>
                  {{ $p->judul }}
                  <br>
                  @foreach ($p->tags as $tag)
                    <span class="badge bg-info">{{ $tag->tag_name }}</span>
                  @endforeach
                  <span class="mr-1 ml-2"> Created at : {{ $p->created_at }} </span>
                  <span class="mr-2 ml-1"> Updated at : {{ $p->updated_at }} </span>
                  <span class="float-right">by {{ $p->user->name }} <i class="fas fa-medal"></i> {{ $p->user->profile->poin }}</span>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="3" align="center">No Questions</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
@endsection

@push('scripts')
  <script>
    $(document).ready(function(){
      $('table tr').click(function(){
        window.location = $(this).attr('href');
        return false;
      });
    });
  </script>
@endpush

@push('script-head')
  <style>
    table tr {
      cursor: pointer;
    }
  </style>
@endpush
