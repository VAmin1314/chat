@extends('layouts.app')

@section('css')
<link href="{{ asset('css/home.css') }}" rel="stylesheet">
<link href="/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
<link href="/css/style.css" rel="stylesheet">
<link href="/css/style-responsive.css" rel="stylesheet" />
@endsection

@section('content')
<div class="container only" data-token="{{ $token }}" data-id="{{ $user->id }}">
    <div class="row">
        <div class="col-lg-8 col-md-offset-2">
            <section class="panel">
                <header class="panel-heading">
                    聊天室（群聊）
                    <p class="pull-right">登录时间：{{ date('Y-m-d H:i:s', time()) }}</p>
                </header>
                <div class="panel-body profile-activity" >
                    <div class="message-area">

                        <!-- <div class="activity blue">
                            <span>
                                <i class="icon-shopping-cart"></i>
                            </span>
                            <div class="activity-desk">
                                <div class="panel">
                                    <div class="panel-body">
                                        <div class="arrow"></div>
                                        <h4> 管理员A</h4>
                                        <p>Purchased new equipments for zonal office setup and stationaries.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="activity alt blue">
                            <span>
                                <i class="icon-rocket"></i>
                            </span>
                            <div class="activity-desk">
                                <div class="panel">
                                    <div class="panel-body">
                                        <div class="arrow-alt"></div>
                                        <h4> 管理员B</h4>
                                        <p>Lorem ipsum dolor sit amet consiquest dio</p>
                                    </div>
                                </div>
                            </div>
                        </div> -->

                    </div>
                    <div class="chat-form">
                        <div class="input-cont col-lg-12">
                            <textarea type="text" class="form-control content" rows="3" placeholder="输入聊天内容，按 enter 发送"></textarea>
                        </div>
                        <div class="input-cont col-lg-12">
                            <button class="btn btn-info send-content">发送</button>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="/js/jquery.nicescroll.js" type="text/javascript"></script>
<script src="/assets/jquery-knob/js/jquery.knob.js"></script>
<script src="/js/common-scripts.js"></script>
<script src="/assets/layer/layer.js"></script>
<script src="{{ asset('js/home.js') }}"></script>

<script type="text/javascript">
    var ws_url = '{{env("WS_URL")}}';
</script>
@endsection







