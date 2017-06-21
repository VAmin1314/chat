@extends('layouts.app')

@section('css')
<link href="{{ asset('css/home.css') }}" rel="stylesheet">
<link href="/css/style.css" rel="stylesheet">
@endsection

@section('content')
<div class="container only" data-token="{{ $token }}" data-id="{{ $user->id }}">
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    聊天室（群聊）
                    <p class="pull-right">登录时间：{{ date('Y-m-d H:i:s', time()) }}</p>
                </header>
                <div class="panel-body profile-activity" >
                    <div class="message-area"> </div>
                    <div class="chat-form">
                        <div class="input-cont col-lg-12">
                            <textarea type="text" class="form-control content" rows="3" placeholder="输入聊天内容，按 enter 发送"></textarea>
                        </div>
                        <div class="input-cont col-lg-2 col-md-offset-5">
                            <button class="btn btn-info send-content">发 送</button>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="/assets/layer/layer.js"></script>
<script src="{{ asset('js/home.js') }}"></script>

<script type="text/javascript">
    var ws_url = '{{env("WS_URL")}}';
</script>
@endsection







