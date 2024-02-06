@extends('layout.app')
@section('meta_title', trans('crudpermissions::role.create'))

@section('content')
<h1>{{ trans('crudpermissions::role.create') }}</h1>
@include('crudpermissions::role.form')
@endsection