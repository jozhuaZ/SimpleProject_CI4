<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>
<body>
    <?php if(session()->getFlashdata('success')): ?>
        <h3 style="color: green;">
            <?= session()->getFlashdata('success') ?>
        </h3>
    <?php elseif(session()->getFlashdata('error')): ?>
        <h3 style="color: red;">
            <?= session()->getFlashdata('error') ?>
        </h3>
    <?php endif; ?>

    <h1>Login Page</h1>
    
    <form action="<?= base_url('u/login') ?>" method="post">
        <label for="email">Email/Username</label>
        <input type="email" name="email" required>

        <label for="password">Password</label>
        <input type="password" name="password" required>

        <input type="submit" value="Login">
    </form>
</body>
</html>