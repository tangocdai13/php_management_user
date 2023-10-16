<?php
if (!defined('_INCODE')) die('access denied ...');

$data = [
  'pageTitle' => 'Đăng nhập hệ thống'
];

layout('header-login', $data);
?>

<div class="row">
    <div class="col-6" style="margin: 20px auto;">
        <h3 class="text-center text-uppercase">Đăng nhập hệ thống</h3>

        <form action="" method="post">
            <div class="mb-3">
                <label for="">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Địa chỉ email ...">
            </div>
            <div class="mb-3">
                <label for="">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Địa chỉ Password ...">
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Đăng nhập</button>
            </div>
            <hr>
            <p class="text-center"><a href="?modules=auth&action=forgot">Quên mật khẩu</a></p>
            <p class="text-center"><a href="?modules=auth&action=register">Đăng ký tài khoản</a></p>
        </form>
    </div>
</div>

<?php layout('footer-login', $data); ?>