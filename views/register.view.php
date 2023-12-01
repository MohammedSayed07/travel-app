<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

</head>
<body>
<div class="modal modal-sheet d-block bg-secondary p-4 py-md-5" tabindex="-1" role="dialog" id="modalSignin">
    <div class="modal-dialog" role="document">
        <div class="modal-content rounded-4 shadow">
            <div class="modal-header p-5 pb-4 border-bottom-0">
                <h1 class="fw-bold mb-0 fs-2">Sign up for free</h1>
            </div>

            <div class="modal-body p-5 pt-0">
                <form method="post" action="/register">
                    <?php if (isset($errors['duplicateEmail'])) : ?>
                        <p class="small text-danger"><?= $errors['duplicateEmail'] ?></p>
                    <?php endif; ?>
                    <div class="form-floating mb-3">
                        <input type="email" name="email" class="form-control rounded-3" id="floatingInput" placeholder="name@example.com"
                               value="<?= $old['email'] ?? '' ?>">
                        <label for="floatingInput">Email address</label>
                        <?php if (isset($errors['email'])) : ?>
                            <p class="small text-danger"><?= $errors['email'] ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" name="password" class="form-control rounded-3" id="floatingPassword" placeholder="Password">
                        <label for="floatingPassword">Password</label>
                        <?php if (isset($errors['password'])) : ?>
                            <p class="small text-danger"><?= $errors['password'] ?></p>
                        <?php endif; ?>
                    </div>
                    <button class="w-100 mb-2 btn btn-lg rounded-3 btn-primary" type="submit">Sign up</button>
                    <small class="text-body-secondary">By clicking Sign up, you agree to the terms of use.</small>
                </form>
                <hr class="my-4">
                <h2 class="fs-5 fw-bold mb-3">Or use a third-party</h2>
                <button class="w-100 py-2 mb-2 btn btn-outline-secondary rounded-3" type="submit">
                    <svg class="bi me-1" width="16" height="16"><use xlink:href="#twitter"></use></svg>
                    Login with Twitter
                </button>
                <button class="w-100 py-2 mb-2 btn btn-outline-primary rounded-3" type="submit">
                    <svg class="bi me-1" width="16" height="16"><use xlink:href="#facebook"></use></svg>
                    Login with Facebook
                </button>
                <button class="w-100 py-2 mb-2 btn btn-outline-secondary rounded-3" type="submit">
                    <svg class="bi me-1" width="16" height="16"><use xlink:href="#github"></use></svg>
                    Login with GitHub
                </button>
            </div>
        </div>
    </div>
</div>

<script src="vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
</body>

</html>