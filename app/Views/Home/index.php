<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
</head>
<body>
    <?php if(session()->getFlashdata('success')): ?>
        <h3 style="color: green;">
            <?= session()->getFlashdata('success') ?>
        </h3>
    <?php endif; ?>

    <?php if(session()->getFlashdata('error')): ?>
        <h3 style="color: red;">
            <?= session()->getFlashdata('error') ?>
        </h3>
    <?php endif; ?>
    
    <h1>Home Page</h1>
    <p>Hello <?php echo $user['firstname'] . " " . $user['middlename'] . " " . $user['lastname']?></p>

    <a href="<?= base_url('u/logout') ?>">Logout</a>
</body>
</html>