$(function () {
    $('.create-slug-btn').on('click', function () {
        var title = $('.title-event-input').val();

        title  = title.toString().toLowerCase()
            .replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẵ|ẳ/g, 'a')
            .replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, 'e')
            .replace(/ì|í|ị|ỉ|ĩ/g, 'i')
            .replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, 'o')
            .replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, 'u')
            .replace(/ỳ|ý|ỵ|ỷ|ỹ/g, 'y')
            .replace(/đ/g, 'd')
            .replace(/À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ/g, 'A')
            .replace(/È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ/g, 'E')
            .replace(/Ì|Í|Ị|Ỉ|Ĩ/g, 'I')
            .replace(/Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ/g, 'O')
            .replace(/Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ/g, 'U')
            .replace(/Ỳ|Ý|Ỵ|Ỷ|Ỹ/g, 'Y')
            .replace(/Đ/g, 'D')
            .replace(/\s+/g, '-')           // Replace spaces with -
            .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
            .replace(/\-\-+/g, '-')         // Replace multiple - with single -
            .replace(/^-+/, '')             // Trim - from start of text
            .replace(/-+$/, '');

        $('.slug-event-input').val(title);
    });

    $('.delete-btn').on('click', function (e) {
        if(confirm("Bạn muốn xóa nó không?")){
            return true;
        }
        else{
            return false;
        }
    });
});

function insert_row_link(parent, child) {
    child = '<div class="row">' + child + '</div>';
    parent.append(child);
}

$(function () {
    $(document).on('click', '.create-link-btn', function () {
        var child = $(this).parent().parent();
        var parent = child.parent();
        var child = child.html();

        $(this).removeClass('create-link-btn btn-success').addClass('remove-link-btn btn-danger');
        $(this).html('Xóa link');
        insert_row_link(parent, child);
    })

    $(document).on('click', '.remove-link-btn', function () {
        $($(this).parent().parent()).remove();
    });
});

$(document).ready(function () {
    var str = location.href.toLowerCase();
    $(".navbar-nav li a").each(function () {
        if (str.indexOf(this.href.toLowerCase()) > -1) {
            $(".navbar-nav li.active").removeClass("active");
            $(this).parent().addClass("active");
            $($(this).parent().parent()).addClass("in");
        }
    });
});