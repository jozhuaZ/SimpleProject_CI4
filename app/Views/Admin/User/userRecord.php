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
    <?php if(session()->getFlashdata('errors')): ?>
        <ul>
            <?php foreach(session()->getFlashdata('errors') as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach ?>
        </ul>
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
                            <button onclick="openEdit(<?= htmlspecialchars(json_encode($user)) ?>)">
                                Edit
                            </button>
                            <form action="<?= base_url('a/user-record/delete/' . $user['id']) ?>" method="post" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                <button type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Hidden Edit Form Modal -->
        <div id="editForm" style="display:none; border:1px solid #ccc; padding:20px;">
            <h4 style="cursor: pointer;" onclick="document.getElementById('editForm').style.display='none'">X</h4>
            <form id="editUserForm" method="post">
                <input type="hidden" name="id" id="userId">

                <label>First Name</label>
                <input type="text" name="firstname" id="firstname" required>

                <label>Middle Name</label>
                <input type="text" name="middlename" id="middlename" required>

                <label>Last Name</label>
                <input type="text" name="lastname" id="lastname" required>

                <label>Username</label>
                <input type="text" name="username" id="username" required>
                
                <label>Email</label>
                <input type="email" name="email" id="email" required>
                
                <label>Address</label>
                <input type="text" name="address" id="address" required>

                <label>Contact Number</label>
                <input type="text" name="contact_number" id="contact_number" maxlength="11" required>

                <label for="password">Password</label>
                <input type="password" name="password" id="password" minlength="8">

                <button type="submit" onclick="<?= base_url('a/user-record/update/' . $user['id']) ?>">Save</button>
                <button type="button" onclick="document.getElementById('editForm').style.display='none'">Cancel</button>
            </form>
        </div>

        <script>
        function openEdit(user) {
            document.getElementById('editForm').style.display = 'block';
            document.getElementById('editUserForm').action = "<?= base_url('a/user-record/update') ?>/" + user.id;
            document.getElementById('userId').value = user.id;
            document.getElementById('firstname').value = user.firstname;
            document.getElementById('middlename').value = user.middlename;
            document.getElementById('lastname').value = user.lastname;
            document.getElementById('email').value = user.email;
            document.getElementById('username').value = user.username;
            document.getElementById('address').value = user.address;
            document.getElementById('contact_number').value = user.contact_number;
        }
        </script>
    <?php else: ?>
        <h1>No User Record Found</h1>
    <?php endif; ?>
</body>
</html>