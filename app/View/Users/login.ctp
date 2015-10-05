<?php $this->assign('title', 'Đăng nhập'); ?>

<script type="text/javascript">
    var start = new Date().getTime();
</script>

<div>
    <h3 class="title" style="margin-bottom: 15px">Đăng nhập thật dễ dàng</h3><br>
    <div class="auto-work">
        <?= $this->Html->image(
            'loading.gif',
            array('style' => 'width: 30px')
        ); ?>
        <span class="alert-not-work" style="margin-left: 30px">Đang đăng nhập...</span>
    </div>
    <div class="error-login" style="display: none;margin-top: 20px;">
        <p><b>Quá trình đăng nhập đã xảy ra chút lỗi, hãy quay lại đăng nhập lần sau.</b></p>
    </div>
    <div class="if-auto-not-work" style="display: none;">
        <p style="margin-top: 20px;">
            <b>Click vào nút dưới đây để đăng nhập với tài khoản Facebook của bạn. Tài khoản của bạn trên Lót Dép Hóng sẽ
                tự động được tạo sau lần đăng nhập đầu tiên mà không cần đăng ký.</b>
        </p>

        <?= $this->Html->link(
            $this->Html->image(
                'login-fb.png'
            ),
            '#',
            array('id' => 'loginFBBtn', 'escape' => false)
        ); ?>
        <div id="response"></div>

    </div>
    <br><br>
    <i>Chú ý: Bằng việc đăng nhập bạn đã đồng ý với <?= $this->Html->link(
            'Điều khoản sử dụng',
            array('controller' => 'pages', 'action' => 'clause')
        ) ?> của Lót Dép Hóng</i>
</div>

<script type="text/javascript">

    function getUserData() {
        FB.api('/me', {fields: 'id,name,email,picture'}, function(response) {
            $.ajax({
                type: "post",
                url: 'users/insert_user',
                dataType: 'json',
                data: {user_id: response.id, user_name: response.name, user_email:response.email, user_picture:response.picture.data.url},
                success: function(data){
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    console.log(errorThrown);
                }
            })
                .done(function (data) {
                    if (data.success) {
                        window.location = data.redirect;
                    } else {
                        $('.error-login').css('display', 'block');
                        $('.if-auto-not-work').css('display', 'none');
                    }
                });

//            window.location = 'users/insert_user/?user_id='+response.id+'&user_name='+response.name+'&user_email='+response.email+'&user_picture='+response.picture.data.url;
        });
    }

    window.fbAsyncInit = function() {
        //SDK loaded, initialize it
        FB.init({
            appId      : '969054379835076',
            xfbml      : true,
            status : true,
            cookie : true,
            version    : 'v2.4'
        });

        //check user session and refresh it
        FB.getLoginStatus(function(response) {
            if (response.status === 'connected') {
                //user is authorized
                document.getElementById('loginFBBtn').style.display = 'none';
                var end = new Date().getTime();

                if (end-start < 4000) {
                    setTimeout(function(){
                        getUserData();
                    }, 4000);
                } else {
                    getUserData();
                }
            } else {
                var end = new Date().getTime();
                if (end-start < 4000) {
                    setTimeout(function(){
                        $('.if-auto-not-work').css('display', 'block');
                        $('.auto-work').css('display', 'none');
                    }, 4000);
                } else {
                    $('.auto-work').css('display', 'none');
                    $('.if-auto-not-work').css('display', 'block');
                }
            }
        });
    };

    //load the JavaScript SDK
    (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

    //add event listener to login button
    document.getElementById('loginFBBtn').addEventListener('click', function(e) {
        e.preventDefault();
        //do the login
        FB.login(function(response) {
            if (response.authResponse) {
                //user just authorized your app
                document.getElementById('loginFBBtn').style.display = 'none';
                getUserData();
            }
        }, {scope: 'email,public_profile', return_scopes: true});
    }, false);

</script>
