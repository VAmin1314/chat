$(function () {
    var token = $('.only').attr('data-token');
    var uid = $('.only').attr('data-id');
    $('.only').attr('data-token', '');
    $('.content').focus();

    // 链接成功
    ws = new WebSocket('ws://'+ws_url);
    ws.onopen = function() {
        console.log("连接成功");
        sendMessage('all');
    };
    // 收到消息
    ws.onmessage = function(e) {
        var data = eval('('+e.data+')');
        console.log(data);

        if (data.type == 'login') {
            layer.msg('登录成功');
        } else if (data.type == 'chat') {
            var type = false;
            if (data.id == uid) {
                type = true;
            }

            html = '<div class="activity '+ (type?'alt':'') +' blue">'+
            '<span>'+
            '<i class="icon-rocket"></i>'+
            '</span>'+
            '<div class="activity-desk">'+
            '<div class="panel">'+
            '<div class="panel-body">'+
            '<div class="arrow'+ (type?'-alt':'') +'"></div>'+
            '<h4> '+ data.name +'</h4>'+
            '<p>' + data.message + '</p>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '</div>';
            console.log(html);
            $('.message-area').append(html).scrollTop($('.message-area')[0].scrollHeight);

        }
    };

    $(".content").keydown(function (e) {
        if(e.which == 13) {
            var content = $(this).val();
            if (content == '') {
                layer.msg('发送内容不能为空');
                return false;
            }

            sendMessage('all', content);
            $('.content').val('');
            return false;
        }
    });

    $('.send-content').click(function () {
        var content = $('.content').val();
        if (content == '') {
            layer.msg('发送内容不能为空');
        }

        sendMessage('all', content);
        $('.content').val('');
        return false;
    })

    function sendMessage (uid, content = '') {
        var info = '{"uid": "'+uid+'", "content": "'+content+'", "token": "'+token+'", "to": "all"}';
        console.log(info);
        ws.send(info);
    }

    // ws.onclose = function(e) {
    //     console.log(e);
    // };
})