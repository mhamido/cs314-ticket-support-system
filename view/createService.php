<?php require_once "../model/service.php"; ?>
<?php require_once "../model/service/option.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Service:</title>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://bootswatch.com/5/litera/bootstrap.min.css">
</head>

<body class="container">
    <div class="jumbotron mt-4 col-md-6">
        <h2>Create Service:</h2>
        <form action="../controller/createService.php" method="post">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" required>
            <br><br>
            <label for="price">Price:</label>
            <input type="number" name="price" id="price" required>
            <br><br>
            <label for="description">Description:</label>
            <input type="text" name="description" id="description" required>
            <br><br>
            <label for="parent">Parent:</label>
            <select name="parent" id="parent">
                <option value="0">-</option>
                <?php foreach (Service::fetch() as $service) { ?>
                    <option value="<?php echo $service->id; ?>">
                        <?php echo $service->name; ?>
                    </option>
                <?php } ?>
            </select>
            <br><br>
            <button type="submit">Create Service</button>
        </form>
    </div>
    <br><br><br>

    <div>
        <h2>Add value to service:</h2>
        <form action="../controller/addOption.php" method="post">
            <label for="service">Service:</label>
            <select name="service" id="service">
                <?php foreach (Service::fetch() as $service) { ?>
                    <option value="<?php echo $service->id?>">
                        <?php echo $service->name; ?>
                    </option>
                <?php } ?>
            </select>
            <br><br>
            <label for="option">Option:</label>
            <select name="option" id="option">
                <?php foreach (Option::fetch() as $option) { ?>
                    <option value="<?php echo $option->id ?>">
                        <?php echo $option->name; ?>
                    </option>
                <?php } ?>
            </select>
            <br><br>
            <label for="value">Value:</label>
            <input type="text" name="value" id="value" required>
            <br><br>
            <button type="submit">Add value</button>
        </form>
    </div>

    <br><br><br>
    <div>
        <h2>Create Option:</h2>
        <form action="../controller/createOption.php" method="post">
            <input type="text" name="create_option_name" id="create_option_name" required>
            <select name="create_option_type" id="create_option_type">
                <?php foreach (LookupTable::fetch("type") as $type) { ?>
                    <?php [$id, $name] = $type ?>
                    <option value="<?php echo $id; ?>">
                        <?php echo $name; ?>
                    </option>
                <?php } ?>
            </select><br><br>
            <button type="submit">Create Option</button>
        </form>
    </div>

    <br><br><br>
    <form action="../view/viewall.php" method="post">
        <button type="submit">Homepage</button>
    </form>
</body>

</html>