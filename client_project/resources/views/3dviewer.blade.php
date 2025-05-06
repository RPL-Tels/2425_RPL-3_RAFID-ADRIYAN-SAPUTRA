@extends('layouts.layers')
@section('title', '3dviews')
@section('section')
<div class="container md:px-12 px-4">
    <div id="kotak" class="w-dvh h-screen container"></div>
</div>
<script>
    window.modelUrl = "{{ $modelUrl }}";
</script>
@endsection