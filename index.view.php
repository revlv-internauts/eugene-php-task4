<html>
<head>
    <title>4th PHP Task</title>
</head>
<style>
    tb, th, td {
        border: 1px solid black;
        border-collapse: collapse;
    }
</style>
<body>
    <center><h2>Fourth PHP Task</h2></center>
     <h2>Please Enter Student Information</h2>
    <form action="/index.php" method="POST">
        <label for="first_name"><h4>First Name:</h4></label>
        <input type="text" name="first_name" required><br>
        <label for="last_name"><h4>Last Name:</h4></label>
        <input type="text" name="last_name" required><br>
        <label for="middle_name"><h4>Middle Name:</h4></label>
        <input type="text" name="middle_name" required><br>
        <label for="age"><h4>Age:</h4></label>
        <input type="number" name="age" required><br><br>   
        <button type="submit">Submit</button>
    </form>

    

    <?php foreach ($detailDatas as $information) : ?>
            <table style="width: 100%; text-align: center;">
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Middle Name</th>
                    <th>Age</th>
                    <th>Created At</th>
                    <th>Update/Delete</th>
                </tr>
                <tr>
                    <td><?= $information->first_name; ?></td>
                    <td><?= $information->last_name; ?></td>
                    <td><?= $information->middle_name; ?></td>
                    <td><?= $information->age; ?></td>
                    <td><?= $information->created_at; ?></td>
                    <td>    
                            <form action="/index.php" method="POST" style="display: inline;">
                                <input type="hidden" name="updateUser" value="<?= $information->id; ?>">
                                <input type="text" name="first_name" value="<?= $information->first_name; ?>">
                                <input type="text" name="last_name" value="<?= $information->last_name; ?>">
                                <input type="text" name="middle_name" value="<?= $information->middle_name; ?>">
                                <input type="number" name="age" value="<?= $information->age; ?>"> 
                                <td><button type="submit">Update</button></td>
                            </form>
                           <form action="/index.php" method="GET" style="display: inline;">
                                <input type="hidden" name="removeID" value="<?= $information->id; ?>">
                                <td><button type="submit" name="removeBTN">Remove</button></td>
                            </form>    
                    </td>

                    
                </tr>
            </table>
        <?php endforeach; ?>
</body>
</html>