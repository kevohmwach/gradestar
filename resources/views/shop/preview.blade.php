<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
    <?php
        header("Content-type:application/pdf"); //for pdf file
        if (file_exists($complete_path)) {
            //readfile($complete_path);
            //exit;

            $fp = fopen($complete_path, "r");

            while (!feof($fp))
            {
             echo fread($fp, 65536);
             flush(); // this is essential for large downloads
            } 
            fclose($fp);
            exit; //has to be there to display readable file

      
      }else{
        echo 'Sorry, the requested book is not found';
        //Yii::$app->response->redirect(Url::to(['site/index'], true)); 
      }
      ?>
    
</body>
</html>
