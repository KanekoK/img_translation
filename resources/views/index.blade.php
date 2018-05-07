@extends('layout.common')

@section('title', '文字認識翻訳')
@include('layout.head')

@include('layout.header')

@section('contents')
  <div class="file_upload">
    <form action="confirm" method="post">
      <input type="file">
      <input type="submit" value="翻訳">
    </form>
  </div>
  <div class="trans_lang">
    <form action="">
      <p>FROM：
        <select name="" id="">
          <option value="">日本語</option>
          <option value="">英語</option>
          <option value="">韓国語</option>
          <option value="">中国語</option>
        </select>
      </p>
      <p>TO：
        <select name="" id="">
          <option value="">日本語</option>
          <option value="">英語</option>
          <option value="">韓国語</option>
          <option value="">中国語</option>
        </select>
      </p>
    </form>
  </div>
@endsection
@include('layout.main')

@include('layout.footer')
