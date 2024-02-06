@extends('layout.app')
@section('meta_title', trans('crudpermissions::role.edit'))

@section('content')
<h1>{{ trans('crudpermissions::role.edit') }}</h1>
@include('crudpermissions::role.form')
@endsection