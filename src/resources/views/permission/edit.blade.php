@extends('layout.app')
@section('meta_title', trans('crudpermissions::permission.edit'))

@section('content')
<h1>{{ trans('crudpermissions::permission.edit') }}</h1>
@include('crudpermissions::permission.form')
@endsection