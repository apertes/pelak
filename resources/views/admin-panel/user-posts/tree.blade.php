@extends('admin-panel.layouts.master')
@section('content')
<div id="user-post-tree-app"></div>
@endsection
@push('scripts')
    @vite('resources/js/user-post-tree.js')
@endpush 