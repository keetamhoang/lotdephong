<footer>
    <hr>
    <div class="text-center">
        <ul class="list-inline">
            <li>
                <?= $this->Html->link(
                    'Liên hệ',
                    array('controller' => false, 'action' => 'lien-he'),
                    array('class' => 'text-muted')
                    )
                ?>
            </li>
            <li>
                <?= $this->Html->link(
                    'Điều khoản',
                    array('controller' => false, 'action' => 'dieu-khoan'),
                    array('class' => 'text-muted')
                )
                ?>
            </li>
        </ul>
        <p class="text-muted">
            © 2015 <a href="https://www.facebook.com/pages/Nóng-là-hóng/116476155369167"><span class="text-muted">Nóng là Hóng</span></a>
        </p>
    </div>
</footer>