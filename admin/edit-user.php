<?php
    include(__DIR__ . "/../auth/check-auth.php");
    if(!CheckRight('user','admin')) {
        die('Ви не маєте права на виконання цієї операції!');
    }

    if ($_POST) {
        //шукаємо користувача
        require '../data/declare-users.php';
        foreach($data['users'] as $key=>$user) {
            if($user['name'] == $_POST['user_name']) {
                break;
            }
        }
        //формуємо рядок прав доступу
        $rights = "";
        for($i=0; $i<9; $i++) {
            if($_POST['right' . $i]) {
                $rights .= "1";
            } else {
                $rights .= "0";
            }
        }
        //замінюємо в масиві відповідного користувача
        $data['users'][$key] = array(
            'name' => $_POST['user_name'],
            'pwd' => $_POST['user_pwd'],
            'rights' => $rights."\r\n",                                                 /*?*/
        );
        //записуємо масив користувачів у файл
        $f = fopen("../data/users.txt", "w");
        foreach($data['users'] as $user) {
            $authArr = array($user['name'], $user['pwd'], $user['rights'],);            /*?*/
            $authStr = implode(";", $authArr);  
            fwrite($f, $authStr);
        }
        fclose($f);
        header('Location: index.php');                                                  /*?*/
    }

    //читаємо користувачів та визначаємо необхідного
    require '../data/declare-users.php';
    foreach($data['users'] as $user) {
        if($user['name'] == $_GET['username']) {
            break;
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Редагування користувача</title>
        <link rel="stylesheet" type="text/css" href="admin.css">
    </head>
    <body>
        <a href="index.php">До списку користувачів</a>
        <form name='edit-user' method='post'>
            <div class='tbl'>
                <div>
                    <label for='user_name'>Username: </label>
                    <input readonly type="text" name="user_name" value='
                        <?php echo $user['name']; ?>'>
                </div>
                <div>
                    <label for='user_pwd'>Password: </label>
                    <input type="text" name="user_pwd" value='
                        <?php echo $user['pwd']; ?>'>
                </div>
            </div>

            <div><p>Автор:</p>
                <input type="checkbox" <?php echo ("1" == $user['rights'][0])?"checked":""; ?> 
                    name="right0" value="1"><span>перегляд</span>
                <input type="checkbox" <?php echo ("1" == $user['rights'][1])?"checked":""; ?> 
                    name="right1" value="1"><span>створення</span>
                <input type="checkbox" <?php echo ("1" == $user['rights'][2])?"checked":""; ?> 
                    name="right2" value="1"><span>редагування</span>
                <input type="checkbox" <?php echo ("1" == $user['rights'][3])?"checked":""; ?> 
                    name="right3" value="1"><span>видалення</span>
            </div>

            <div><p>Книга:</p>
                <input type="checkbox" <?php echo ("1" == $user['rights'][4])?"checked":""; ?> 
                    name="right4" value="1"><span>перегляд</span>
                <input type="checkbox" <?php echo ("1" == $user['rights'][5])?"checked":""; ?> 
                    name="right5" value="1"><span>створення</span>
                <input type="checkbox" <?php echo ("1" == $user['rights'][6])?"checked":""; ?> 
                    name="right6" value="1"><span>редагування</span>
                <input type="checkbox" <?php echo ("1" == $user['rights'][7])?"checked":""; ?> 
                    name="right7" value="1"><span>видалення</span>
            </div>

            <div><p>Користувачі:</p>
                <input type="checkbox" <?php echo ("1" == $user['rights'][8])?"checked":""; ?> 
                    name="right8" value="1"><span>адміністрування</span>
            </div>

            <div><input type="submit" name="ok" value="змінити"></div>
        </form>
    </body>
</html>