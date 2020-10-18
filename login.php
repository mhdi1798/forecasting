<div class="page-header">
    <h1>Login</h1>
</div>
<div class="row">
    <div class="col-md-4">
        <?php if ($_POST) include 'aksi.php' ?>
        <form method="post">
            <div class="form-group">
                <input class="form-control" type="text" placeholder="Username" name="user" focus />
            </div>
            <div class="form-group">
                <input class="form-control" type="password" placeholder="Password" name="pass" />
            </div>
            <div class="form-group">
                <button class="btn btn-primary"><span class="glyphicon glyphicon-log-in"></span> Login</button>
            </div>
        </form>
    </div>
</div>