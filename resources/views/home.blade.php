@extends('layouts.app')

@section('css')
<link href="{{ asset('css/home.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container only" data-token="{{ $token }}">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">聊天室</div>
                <div class="container-fluid">
                    <div class="row full">
                        <div class="col-md-3 leftmenu paddingNone">
                            <ul class="list-group">
                                <li class="people active">
                                    <img src="{{ asset('images/1.png') }}">
                                    <span>群聊</span>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-9 paddingNone">
                            <div class="chatContent">

                            </div>
                            <div>
                                <form>
                                    <div class="form-group">
                                        <textarea type="email" class="content" id="content" placeholder="输入聊天内容" rows="4"></textarea>
                                    </div>
                                    <!-- <button type="button" class="btn btn-default sendContent"> 发送</button> -->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('js/home.js') }}"></script>
@endsection
