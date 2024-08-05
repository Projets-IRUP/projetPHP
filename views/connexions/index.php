<div class="container connexion">
    <div class="row">
        <div class="col-md-12 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="text-center">
                        <img src="/webroot/img/logo.png" alt="logo" >
                        <h2 class="text-center">Connexion</h2>
                        <p>Se connecter à l'intranet</p>
                        <p class="erreur"></p>
                        <form id="register-form" role="form" autocomplete="off" class="form" method="post" action="/connexions/login">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                    <input id="login" name="login" placeholder="Identifiant" class="form-control" type="text" required>
                                </div>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                    <input id="password" name="password" placeholder="Mot de passe" class="form-control" type="password" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <input name="envoyer" class="btn btn-lg btn-primary btn-block btnForget" value="Valider" type="submit">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
