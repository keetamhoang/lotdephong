$(document).ready(function () {
    var str = location.href.toLowerCase();
    $(".navbar-nav li a").each(function () {
        if (str.indexOf(this.href.toLowerCase()) > -1) {
            $("li.highlight").removeClass("highlight");
            $(this).parent().addClass("highlight");
        }
    });
    $("li.highlight").parents().each(function () {
        if ($(this).is("li")) {
            $(this).addClass("highlight");
        }
    });

    if (str.indexOf('dang-nhap') > -1) {
        var start = new Date().getTime();
    }

    if ($('.next-home span').hasClass('disabled')) {
        $('.next-home').css('display', 'none');
    }
});

$(document).ready(function () {
    $('.show-noti-btn').on('click', function () {
        if ($('.haveNotifications').css('display') != 'none' && $('.haveNotifications').length) {
            var start = new Date().getTime();

            $('.image-load-noti').css('display', 'block');

            var url = $(this).find('input').val() + 'follows/showNewNoti';
            var user_id = $(this).attr('id');

            $.ajax({
                type: "post",
                url: url,
                data: {user_id: user_id},
                dataType: 'json',
                success: function(data){
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    console.log(errorThrown);
                }
            })
                .done(function (data) {
                    if (data.success) {
                        $('.show-noti-ul').html('');
                        var li = '';
                        var end = new Date().getTime();

                        $('.haveNotifications').css('display', 'none');

                        if (data.listNoti.length) {

                            var url = window.location.origin;

                            for (i = 0; i < data.listNoti.length; i++) {
                                li += '<li>'+
                                    '<a role="menuitem" tabindex="-1" href="'+ url +'/su-kien/'+data.listNoti[i]['Event']['slug']+'">' +
                                        '<div id="title-noti">' +
                                            'Sự kiện <i>' + data.listNoti[i]['Event']['name']+ '</i> đã được cập nhật thông tin mới'+
                                        '</div>'+
                                    '</a>'+
                                '</li>';
                            }


                        } else {
                            li = '<li style="padding: 18px 0px;">' +
                                '<div role="menuitem" tabindex="-1" style="text-align: center">' +
                                '<div style="font-weight: normal;">' +
                                'Hiện tại chưa có thông báo nào mới.' +
                                '</div>' +
                                '</div>' +
                                '</li>';
                        }

                        if (end - start < 1000) {
                            setTimeout(function () {
                                $('.image-load-noti').css('display', 'none');
                                $('.show-noti-ul').append(li);
                            }, 1000);
                        } else {
                            $('.image-load-noti').css('display', 'none');
                            $('.show-noti-ul').append(li);
                        }
                    }
                })
                .error(function () {
                    console.log('error');
                });
        } else {
            $('.show-noti-ul').html('');

            var li = '<li style="padding: 18px 0px;">' +
                '<div role="menuitem" tabindex="-1" style="text-align: center">' +
                '<div style="font-weight: normal;">' +
                'Hiện tại chưa có thông báo nào mới.' +
                '</div>' +
                '</div>' +
                '</li>';
            $('.show-noti-ul').append(li);
        }

    });
});

$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});
