<?php $this->assign('title', $title); ?>
<div id="main">
    <div>
        <h3 style="margin-bottom: 10px;">Điều khoản sử dụng</h3>

        <p>Nhà cung cấp ("chúng tôi", "của chúng tôi", "lotdephong") của dịch vụ cung cấp bởi trang web này (Dịch vụ) không
            chịu trách nhiệm với bất kỳ nội dung nào của thành viên đưa lên (Nội dung). Nội dung được đăng chỉ thể hiện
            quan điểm riêng của người đăng. Chúng tôi không giữ bản quyền và không chịu trách nhiệm bản quyền với bất kỳ
            nội dung nào. Hãy sử dụng mục <?= $this->Html->link(
                'Liên hệ',
                array('controller' => false, 'action' => 'lien-he'))
            ?> để yêu cầu chúng tôi xóa bỏ nội dung vi phạm bản quyền của bạn.</p>

        <p>Bạn phải đồng ý không sử dụng Dịch vụ để đăng, bàn luận hoặc liên kết đến bất kỳ Nội dung có liên quan đến
            chính trị, tôn giáo, đồi trụy, phân biệt vùng miền, phỉ báng, lăng mạ, hận thù, chia rẽ, đe dọa, xúc phạm,
            có chứa thông tin cá nhân của người khác, vi phạm bản quyền, phạm pháp, khuyến khích hành vi phạm pháp, hoặc
            vi phạm tất cả các điều luật khác.</p>

        <p>Bạn phải trên 13 tuổi để sử dụng Dịch vụ này.</p>

        <p>Chúng tôi có quyền xóa, sửa bất kỳ Nội dung nào đăng trên trang web với bất kỳ lý do mà không cần giải thích.
            Yêu cầu xóa bỏ hoặc sửa Nội dung sẽ thực hiện theo quyết định của chúng tôi. Chúng tôi giữ quyền hủy bỏ Dịch
            vụ (xóa tài khoản hoặc cấm) với Dịch vụ của chúng tôi bất kỳ lúc nào.</p>

        <p>Bạn cho phép Chúng tôi quyền sử dụng, tái bản Nội dung của bạn với Dịch vụ vĩnh viễn, không giới hạn và không
            thể thu hồi. Bạn giữ quyền trên toàn Nội dung của mình.</p>

        <p>Tất cả Nội dung bạn gửi lên hoặc tải lên có thể được kiểm duyệt bởi Ban quản trị. Không đăng bất kỳ Nội dung
            nào bạn cho là cá nhân hoặc tối mật.</p>

        <p>Các điều khoản này có thể thay đổi bất kỳ lúc nào mà không cần báo trước.</p>

        <p>Nếu bạn không đồng ý với các điều khoản này, xin hãy dừng việc đăng ký hoặc sử dụng Dịch vụ của chúng tôi.
            Nếu bạn muốn đóng tài khoản của mình, xin hãy dùng mục <?= $this->Html->link(
                'Liên hệ',
                array('controller' => false, 'action' => 'lien-he'))
            ?>.</p>
    </div>

    <?= $this->element('footer'); ?>
</div>