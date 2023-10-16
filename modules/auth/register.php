<?php
if (!defined('_INCODE')) die('access denied ...');

$data = [
    'pageTitle' => 'Đăng ký tài khoản'
];

layout('header-login', $data);
?>

    <div class="row">
        <div class="col-6" style="margin: 20px auto;">
            <h3 class="text-center text-uppercase">Đăng ký tài khoản</h3>

            <form action="" method="post">
                <div class="mb-3">
                    <label for="">Họ và tên</label>
                    <input type="text" name="name" class="form-control" placeholder="Name ...">
                </div>
                <div class="mb-3">
                    <label for="">Số điện thoại</label>
                    <input type="text" name="phone" class="form-control" placeholder="Phone ...">
                </div>
                <div class="mb-3">
                    <label for="">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Địa chỉ email ...">
                </div>
                <div class="mb-3">
                    <label for="">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Địa chỉ Password ...">
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Đăng ký</button>
                </div>
                <hr>
                <p class="text-center"><a href="?modules=auth&action=login">Đăng nhập hệ thống</a></p>
            </form>
        </div>
    </div>

<?php layout('footer-login', $data); ?>