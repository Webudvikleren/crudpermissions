@extends('layout.app')
@section('meta_title', trans('crudpermissions::permission.create'))

@section('content')
<h1>{{ trans('crudpermissions::permission.create') }}</h1>
@include('crudpermissions::permission.form')
@endsection