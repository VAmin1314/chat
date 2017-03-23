$(function () {
    var token = $('.only').attr('data-token');
    $('.only').attr('data-token', '');
    // 链接成功
    // ws = new WebSocket('ws://192.168.0.112:8080');
    ws = new WebSocket('ws://118.89.139.72:9111');
    ws.onopen = function() {
        console.log("连接成功");
        sendMessage('all');
    };
    // 收到消息
    ws.onmessage = function(e) {
        var data = eval('('+e.data+')');
        if (data.type == 'login') {
            type = '';
        }
        console.log(data);
        $('.chatContent').append('<p>'+data.message+'</p>');
    };

    $("#content").keydown(function (e) {
        if(e.which == 13) {
            var content = $(this).val();
            if (content == '') {
                return false;
            }
            sendMessage('all', content);
            $(this).val('');
            return false;
        }
    });

    function sendMessage (uid, content = '') {
        var info = '{"uid": "'+uid+'", "content": "'+content+'", "token": "'+token+'"}';
        console.log(info);
        ws.send(info);
    }

    // ws.onclose = function(e) {
    //     console.log(e);
    // };
})