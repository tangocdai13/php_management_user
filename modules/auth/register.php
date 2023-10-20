<?php
if (!defined('_INCODE')) die('access denied ...');

$data = [
    'pageTitle' => 'Đăng ký tài khoản'
];

layout('header-login', $data);

if (isPost()) {
    $body = getBody();
    $errors = [];

    //Họ tên : required, 5 kí tự trở lên
    if (empty(trim($body['name']))) {
        $errors['name']['required'] = 'Name bắt buộc phải nhập';
    } else {
        if (mb_strlen(trim($body['name'])) < 5) {
            $errors['name']['min'] = 'Name ít nhất là 5 ký tự';
        }
    }

    //sdt : required, định dạng số điện thoại, bắt đầu bằng số 0, nối tiếp 9 số

    if (empty(trim($body['phone']))) {
        $errors['phone']['required'] = 'Phone bắt buộc phải nhập';
    } else {
        if (! isPhone(trim($body['phone']))) {
            $errors['phone']['type'] = 'Phone không đúng định dạng';
        }
    }

    //email : required, email, unique email

    if (empty(trim($body['email']))) {
        $errors['email']['required'] = 'Email bắt buộc phải nhập';
    } else {
        if (! filter_var(trim($body['email']), FILTER_VALIDATE_EMAIL)) {
            $errors['email']['email'] = 'Chưa đúng định dạng email';
        } else {
            $email = trim($body['email']);

            if (getRows("SELECT * FROM users WHERE email = '$email'") > 0) {
                $errors['email']['unique'] = 'Email này đã được đăng ký';
            }
        }
    }

    //Validate password " required, >= 3 ký tự
    if (empty(trim($body['password']))) {
        $errors['password']['required'] = 'Password  bắt buộc phải nhập';
    } else {
        if (strlen(trim($body['password'])) < 3) {
            $errors['password']['min'] = 'Password ít nhất là 3 ký tự';
        }
    }

    //Validate re-password
    if (empty(trim($body['re-password']))) {
        $errors['re-password']['required'] = 'Re-password bắt buộc phải nhập';
    } else {
        if (trim($body['password']) != trim($body['re-password'])) {
            $errors['re-password']['match'] = 'Re-password không match với mật khẩu';
        }
    }

    if (empty($errors)) {
        setFlashSession('msg', 'Validate thành công');
        setFlashSession('msg_type', 'success');

        echo 'Đăng nhập thành công';
    } else {
        setFlashSession('msg', 'Vui lòng kiểm tra dữ liệu nhập vào');
        setFlashSession('msg_type', 'danger');
    }

    $msg = getFlashSession('msg');
    $msgType = getFlashSession('msg_type');

    echo '<pre>';
    print_r($msg, $msgType);
    echo '</pre>';
}

?>

    <div class="row">
        <div class="col-6" style="margin: 20px auto;">
            <h3 class="text-center text-uppercase">Đăng ký tài khoản</h3>
            <?php
                if (!empty($msg) && !empty($msgType)) {
                    getMsg($msg, $msgType);
                }
            ?>
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
                    <input type="text" name="email" class="form-control" placeholder="Địa chỉ email ...">
                </div>
                <div class="mb-3">
                    <label for="">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Password ...">
                </div>
                <div class="mb-3">
                    <label for="">Confirm Password</label>
                    <input type="password" name="re-password" class="form-control" placeholder="Confirm Password ...">
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