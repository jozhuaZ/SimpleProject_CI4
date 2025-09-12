<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
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
    <?php if(session()->getFlashdata('errors')): ?>
        <ul>
            <?php foreach(session()->getFlashdata('errors') as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach ?>
        </ul>
    <?php endif; ?>


    <h1>Register Now!</h1>
        <form action="<?= base_url('u/register') ?>" method="POST">

        <label for="firstname">First Name</label>
        <input type="text" name="firstname" required>
        
        <label for="middlename">Middle Name</label>
        <input type="text" name="middlename" required>
        
        <label for="lastname">Last Name</label>
        <input type="text" name="lastname" required>
        
        <label for="address">Address</label>
        <input type="text" name="address" required>

        <label for="contact_number">Contact Number</label>
        <input type="text" name="contact_number" maxlength="11" required>

        <label for="username">Username</label>
        <input type="text" name="username" required>

        <label for="email">Email</label>
        <input type="email" name="email" required>
        
        <label for="password">Password</label>
        <input type="password" name="password" minlength="8" required>

        <input type="submit" value="Register">
    </form>
</body>
</html>