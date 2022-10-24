<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Autenticação Grupo</title>
    <link rel="stylesheet"><link rel="stylesheet" href="../css/login.css">
</head>
    <body>

    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="/tccentralizer/index.php">TCCentralizer</a>
            </div>
            <ul class="nav navbar-nav">
                <li class="active"><a href="escolha_login.php">Login</a></li>
                <li><a href="escolha_cadastro.php">Cadastro</a></li>
            </ul>
        </div>
    </nav>
    
    <div  class="align">
        <div class="grid">
            <form action="../php/teste_login.php" method="POST" class="form login">

                <div class="form__field">
                    <label for="nomeGrupo"><svg class="icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#user"></use></svg><span class="hidden">Nome do grupo</span></label>
                    <input id="nomeGrupo" type="text" name="nomeGrupo" class="form__input" placeholder="Nome do grupo" required="">
                </div>

                <div class="form__field">
                    <label for="senhaGrupo"><svg class="icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#lock"></use></svg><span class="hidden">Senha</span></label>
                    <input id="senhaGrupo" type="password" name="senhaGrupo" class="form__input" placeholder="Senha" required="">
                </div>

                <div class="form__field">
                    <input type="submit" name="submitGrupo" value="Entrar">
                </div>

            </form>

            <p class="text--center">Não Possui cadastro? <a href="cadastro_orientador.php">Realize o cadastro agora</a> <svg class="icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="assets/images/icons.svg#arrow-right"></use></svg></p>
        </div>
    </div>
    <svg xmlns="http://www.w3.org/2000/svg" class="icons"><symbol id="arrow-right" viewBox="0 0 1792 1792"><path d="M1600 960q0 54-37 91l-651 651q-39 37-91 37-51 0-90-37l-75-75q-38-38-38-91t38-91l293-293H245q-52 0-84.5-37.5T128 1024V896q0-53 32.5-90.5T245 768h704L656 474q-38-36-38-90t38-90l75-75q38-38 90-38 53 0 91 38l651 651q37 35 37 90z"></path></symbol><symbol id="lock" viewBox="0 0 1792 1792"><path d="M640 768h512V576q0-106-75-181t-181-75-181 75-75 181v192zm832 96v576q0 40-28 68t-68 28H416q-40 0-68-28t-28-68V864q0-40 28-68t68-28h32V576q0-184 132-316t316-132 316 132 132 316v192h32q40 0 68 28t28 68z"></path></symbol><symbol id="user" viewBox="0 0 1792 1792"><path d="M1600 1405q0 120-73 189.5t-194 69.5H459q-121 0-194-69.5T192 1405q0-53 3.5-103.5t14-109T236 1084t43-97.5 62-81 85.5-53.5T538 832q9 0 42 21.5t74.5 48 108 48T896 971t133.5-21.5 108-48 74.5-48 42-21.5q61 0 111.5 20t85.5 53.5 62 81 43 97.5 26.5 108.5 14 109 3.5 103.5zm-320-893q0 159-112.5 271.5T896 896 624.5 783.5 512 512t112.5-271.5T896 128t271.5 112.5T1280 512z"></path></symbol></svg>
    
    
    
    <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-80520768-2" type="text/javascript" style="display: none !important;"></script>
    <script type="text/javascript">
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
    
      gtag('config', 'UA-80520768-2');
    </script>
    
    
    </body>
    </html>
