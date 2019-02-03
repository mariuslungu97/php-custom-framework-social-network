<?php require_once APPROOT . '/views/inc/header.php'; ?>

<div class="container">
    <div class="row justify-content-sm-center">
        <div class="col-sm-6">
            <div class="card card-body bg-light mt-5">
                <?php flash('register_success'); ?>
                <?php flash('logout-success'); ?>
                <h2 class="mb-4">Login: </h2>
                <form method="post" action="<?php echo URLROOT; ?>/users/login">
                    <div class="form-group">
                        <label for="email">Email address: </label>
                        <input type="email" value="<?php echo $data['email']; ?>" class="form-control <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" name="email" placeholder="Enter email">
                        <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
                    </div>
                    
                    <div class="form-group">
                        <label for="pass">Password: </label>
                        <input type="password" value="<?php echo $data['password']; ?>" class="form-control <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>" name="pass" placeholder="Password">
                        <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
                    </div>
                    
                    <div class="row my-4">
                        <div class="col">
                            <button type="submit" name="submit" class="btn btn-success btn-block">Login</button>
                        </div>
                        <div class="col">
                            <a href="<?php echo URLROOT; ?>/users/register" class="btn btn-light btn-block">No Account? Register!</a>
                        </div>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
    

</div>

<?php require_once APPROOT . '/views/inc/footer.php'; ?>