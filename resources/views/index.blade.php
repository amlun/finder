@extends('layouts.app')

<script>
    var photos = {!! $photo_path !!};
    var curPage = {{ $photos->currentPage() }};
    var maxPage = {{ $photos->lastPage() }};
</script>

@section('content')
    <div class="layout">
        <gallery></gallery>
        <pagination></pagination>
    </div>
@endsection