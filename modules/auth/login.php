<?php
if (!defined('_INCODE')) die('access denied ...');

$data = [
  'pageTitle' => 'Đăng nhập hệ thống'
];

layout('header-login', $data);

if (isPost()) {
    if (!empty(getBody()['email']) && !empty(getBody()['password'])) {
        $email = 'tangocdai13@gmail.com';
        $password = '123456';
        $errors = [];

        if (filter_var(getBody()['email'], FILTER_VALIDATE_EMAIL)) {
            if (getBody()['email'] === $email && getBody()['password'] === $password) {
                echo 'Đăng nhập thành công';
            } else {
                $errors['faild'] = 'Tài khoản hoặc mặt khẩu không chính xác';
            }
        } else {
            $errors['email'] = 'Chưa đúng định dạng email';
        }
    } else {
        $errors['required'] = 'Bạn cần nhập đủ 2 trường';
    }

    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo $error. '<br />';
        }
    }
}
?>

<div class="row">
    <div class="col-6" style="margin: 20px auto;">
        <h3 class="text-center text-uppercase">Đăng nhập hệ thống</h3>

        <form action="" method="post">
            <div class="mb-3">
                <label for="">Email</label>
                <input type="text" name="email" class="form-control" placeholder="Địa chỉ email ...">
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