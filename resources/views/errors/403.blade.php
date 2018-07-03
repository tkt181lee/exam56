@extends('layouts.app') 
@section('content')
  <h1>403 Forbidden.</h1>
  <p>您沒有權限可以執行目前的動作喔！</p>
  <?php
    $default_error_message = "快滾回 <a href='".url('')."'>首頁</a> 吧！";
  ?>
  {!! isset($exception)? ($exception->getMessage()?$exception->getMessage():$default_error_message): $default_error_message
  !!}
@endsection