<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Handle User</title>
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
    <?php if (!empty($users)): ?>
        <h1>Users</h1>
        <table cellpadding="5" border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Last Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Contact Number</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= esc($user['id']) ?></td>
                        <td><?= esc($user['firstname']) ?></td>
                        <td><?= esc($user['middlename']) ?></td>
                        <td><?= esc($user['lastname']) ?></td>
                        <td><?= esc($user['username']) ?></td>
                        <td><?= esc($user['email']) ?></td>
                        <td><?= esc($user['contact_number']) ?></td>
                        <td><?= esc($user['address']) ?></td>
                        <td>
                            <!-- <form action="<?= base_url('a/user-record/delete/' . $user['id']) ?>" method="post" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                <button type="submit">Edit</button>
                            </form> -->
                            <form action="<?= base_url('a/user-record/delete/' . $user['id']) ?>" method="post" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                <button type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <h1>No User Record Found</h1>
    <?php endif; ?>
</body>
</html>