<?php

declare(strict_types=1);

namespace App\Controller;
use App\Infra\Memory\DbSelector;
?>

<html>
    <head>
        <link rel="stylesheet" href="../style/style.css">
    </head>
    <body>
        <header> 
            <h1>Bienvenu sur Motus</h1>
        </header>
        <section>
        <form action="<?php $_PHP_SELF ?>" method="GET">
            <p>Rentrer 7 lettres</p>
            <input type="text" name="userWord" maxlength="7" minlength="7"/>
            <button>valider</button>
            <br>
        </form>
        <p>Nombre de tentative restante : </p>
        
        <p>Votre mot : 
            <?php if(!isset($_GET["userWord"])){
                echo '';
            }
            else{
                echo strtoupper($_GET["userWord"]);
            }
        ?>
        </p>
        <p>

        <?php if(!isset($_GET["userWord"])){
                echo '';
            }else if(strtoupper($_GET["userWord"]) == $_COOKIE['word']){
                echo 'Bravo vous avez gagné';
            }else {
                echo 'Perdu essayez encore';
            }
        ?>
        </p>
        </section>
        <footer></footer>
    </body>
    
</html>

<?php
class Welcome implements Controller
{
    public function render()
    {

        try {
            DbSelector::getConnector()::findWord();
        } catch (\RuntimeException $e) {
            echo $e->getMessage();
            return;
        }

    }
}
?>