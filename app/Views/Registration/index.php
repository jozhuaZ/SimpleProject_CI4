<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
</head>
<body>
    
    <form method="<?= base_url('user/register') ?>" method="post">
        <h1>Register Now!</h1>

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
        <input type="password" name="password" maxlength="8" required>

        <input type="submit" value="Register">
    </form>

</body>
</html>