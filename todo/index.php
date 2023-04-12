<?php require_once 'include/database.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TODO</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include_once 'include/nav.php' ?>
    <div class="container">
        <div class="row g-3 align-items-center">
        <div class="border border-primary p-2 my-5 mx-auto w-75">
            <?php 
            if(isset($_POST['ajouter'])){
                $title = htmlspecialchars($_POST['title']);
                if(!empty($title)){
                    $sqlStatement = $pdo->prepare("INSERT INTO items value(null,?)");
                    $result = $sqlStatement->execute([$title]);
                    if($result == true){
                        ?>
                        <div class="alert alert-success" role="alert">The title is added !</div>
                        <?php
                    }
                }else{
                    ?>
                    <div class="alert alert-danger" role="alert">The title is required !</div>
                    <?php
                }
            }
            ?>
        <h4>Ajouter tache :</h4>
        <form action="index.php" method="POST">
                <div class="col-auto">
                    <label for="title" class="col-form-label">Title
                        <span class="required">*</span>
                    </label>
                </div>
                <div class="col-auto">
                    <input type="text" name="title" id="title" class="form-control">
                </div>
                <div class="col-auto">
                    <span id="titleHelpInline" class="form-text">
                        Le titre de la tache
                    </span>
                </div>
                <div class="con-auto">
                    <input type="submit" name="ajouter" value="Ajouter" class="btn btn-primary rounded-3 my-2">
                </div>
        </div>
        </form>
        </div>

        <?php
        $sqlStatement = $pdo->query("SELECT * FROM todo.items");
        $items = $sqlStatement->fetchAll(PDO::FETCH_OBJ);
        ?>
        <div class="container">
        <table class="table">
            <tbody>
                <?php
                foreach($items as $key => $item){
                    ?>
                    <tr>
                        <td>
                           <span class="badge rounded-pill bg-primary"><?php echo $key+1 ?></span> 
                        </td>
                        <td><?php echo $item->title ?></td>
                        <td>
                            <form method="post">
                                <input type="hidden" name="id" value="<?php echo $item->id ?>">
                                <input formaction="modifier.php" class="btn btn-primary" type="submit" value="&#9999;" name="modifier">
                                <input formaction="supprimer.php" class="btn btn-danger" type="submit" value="&#10008;" name="supprimer">
                            </form>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        </div>
    </div>



    <?php include_once 'include/footer.php' ?>
</body>
</html>