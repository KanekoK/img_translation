@extends('layout.common')

@section('title', '文字認識翻訳')
@include('layout.head')

@include('layout.header')

@section('contents')
  <div class="file_upload">
    <form action="confirm" method="post">
      {{-- csrf_field() --}}
      <input type="file" class="mx-auto">
      <p>FROM：
        <select name="from_lang" id="from_lang">
          <option value="ja">日本語</option>
          <option value="en">英語</option>
          <option value="ko">韓国語</option>
          <option value="ka">中国語</option>
        </select>
      </p>
      <p>TO：
        <select name="to_lang" id="to_lang">
          <option value="ja">日本語</option>
          <option value="en">英語</option>
          <option value="ko">韓国語</option>
          <option value="ka">中国語</option>
        </select>
      </p>
      <input type="submit" value="翻訳">
      {{-- <input type="hidden" name="_token" value="{{csrf_token()}}"> --}}
    </form>
  </div>
@endsection
@include('layout.main')

@include('layout.footer')
