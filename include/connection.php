<? require 'libs/php/rb.php';
    R::setup('mysql:host=localhost;dbname=todo',
        'root', '');
    session_start();