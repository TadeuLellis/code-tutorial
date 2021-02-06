<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Login</title>
    <style>
        body {
            background-color: #EEE;
        }
        #form {
            position: relative;
            padding-top: 20%;
            width: 300px;
            margin: 0 auto;
        }
        label {
            display: block;
            text-align: center;
            margin-right: 10px;
        }
        input[type=text], input[type=password] {
            width: 100%;
            font-size: 12pt;
            padding: 5px 0 5px 0;
        }
        input[type=submit] {
            width: 100%;
            color: #FFF;
            font-size: 14pt;
            border: 1px solid #000;
            padding: 10px;
            background-color: #000;
        }
        h1 {
            text-align: center;
        }
    </style>
</head>
<body>
    <?php   // início do script em PHP
    // se houve envio (submissão) de formulário
    echo '
    <div id="form">
        <form method="POST" action="/token">
            <fieldset>
                <legend><h2>Formulário de Login</h2></legend>
                <p><label>Nome de usuário</label></p>
                <p><input type="text" name="username" placeholder="Nome de usuário (E-mail)" required /></p>
                <p><label>Senha de usuário</label></p>
                <p><input type="password" name="password" placeholder="Sua senha" required /></p>
                <p><input type="submit" value="Entrar" /></p>
            </fieldset>
        </form>
    </div>
    ';
    ?>  <!-- fim do script em PHP -->
    <h1>ATENÇÃO!</h1>
    <h1>Pode ser quaisquer dados de auteticação no formulário para usuário e senha, pois não tem um usuário definido.</h1>
    <h1>Vê dicas de blindagem de sites para a $_SESSION para proteger a sessão contra os ataques maliciosos da Web.</h1>
</body>
</html>