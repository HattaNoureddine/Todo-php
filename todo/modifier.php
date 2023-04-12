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
    <?php
    if(!isset($_POST['id'])){
        header('Location:index.php');
    }
    require_once 'include/database.php';
    require_once 'include/nav.php';

    $id = $_POST['id'];
    $sqlStatement = $pdo->prepare('SELECT * FROM items WHERE id=?');
    $sqlStatement->execute([$id]);
    $item = $sqlStatement->fetch(PDO::FETCH_OBJ);

    if(isset($_POST['modifierr'])){
        $title = htmlspecialchars($_POST['title']);
        if(!empty($title)){
            $sqlState = $pdo->prepare("UPDATE items SET title=? WHERE id=?");
            $result = $sqlState->execute([$title,$id]);

            if($result == true){
                header('Location:index.php');
            }
       }else{
        ?>
        <div class="alert alert-danger" role="alert">The title is required !</div>
        <?php
       }
    }
    ?>


<div class="container">
        <div class="row g-3 align-items-center">
        <div class="border border-primary p-2 my-5 mx-auto w-75">

        <h4>modifier tache :</h4>
        <form  method="POST">
            <input type="hidden" value="<?php echo $item->id ?>" name="id">
                <div class="col-auto">
                    <label for="title" class="col-form-label">Title
                        <span class="required">*</span>
                    </label>
                </div>
                <div class="col-auto">
                    <input type="text" name="title" value="<?php echo  $item->title ?>" id="title" class="form-control">
                </div>
                <div class="col-auto">
                    <span id="titleHelpInline" class="form-text">
                        Le titre de la tache
                    </span>
                </div>
                <div class="con-auto">
                    <input type="submit" name="modifierr" value="modifer" class="btn btn-primary rounded-3 my-2">
                </div>
        </div>
        </form>
        </div>
</body>
</html>