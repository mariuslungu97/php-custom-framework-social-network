<?php require_once APPROOT . '/views/inc/header.php'; ?>

<div class="container">
    <div class="row justify-content-sm-center">
        <div class="col-sm-6">
            <div class="card card-body bg-light mt-5">
                <h2 class="mb-4">Create An Account: </h2>
                <form method="post" action="<?php echo URLROOT; ?>/users/register">
                    <div class="form-group">
                        <label for="email">Email address: </label>
                        <input type="email" value="<?php echo $data['email']; ?>" class="form-control <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" name="email" placeholder="Enter email">
                        <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="name">Name: </label>
                        <input type="text" value="<?php echo $data['name']; ?>" class="form-control <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>" name="name" placeholder="Enter your name">
                        <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="pass">Password: </label>
                        <input type="password" value="<?php echo $data['password']; ?>" class="form-control <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>" name="pass" placeholder="Password">
                        <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="confirm-pass">Confirm Password: </label>
                        <input type="password" value="<?php echo $data['confirm_password']; ?>" class="form-control <?php echo (!empty($data['confirm_password_err'])) ? 'is-invalid' : ''; ?>" name="confirm-pass" placeholder="Password">
                        <span class="invalid-feedback"><?php echo $data['confirm_password_err']; ?></span>
                    </div>
                    <div class="row my-4">
                        <div class="col">
                            <button type="submit" name="submit" class="btn btn-success btn-block">Register</button>
                        </div>
                        <div class="col">
                            <a href="<?php echo URLROOT; ?>/users/login" class="btn btn-light btn-block">Have an account? Login!</a>
                        </div>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
    

</div>

<?php require_once APPROOT . '/views/inc/footer.php'; ?>