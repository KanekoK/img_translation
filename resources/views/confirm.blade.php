@extends('layout.common')

@section('title', '文字認識翻訳')
@include('layout.head')

@include('layout.header')

@section('contents')

<div class="left_block">
  <p>写真</p>
  <img src="" alt="">
</div>
<div class="right_block">
  <div class="right_up">
    <p>翻訳前</p>
    <div class="before_text">
      <p>テキストテキストテキストテキストテキストテキストテキスト</p>
    </div>
  </div>
  <div class="right_down">
    <p>翻訳後</p>
    <div class="after_text">
      <p>テキストテキストテキストテキストテキストテキストテキスト</p>
    </div>
  </div>
</div>

@endsection
@include('layout.main')

@include('layout.footer')