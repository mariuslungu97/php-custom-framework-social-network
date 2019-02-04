<?php require_once APPROOT . '/views/inc/header.php'; ?>

<div class="container">
            <a href="<?php echo URLROOT; ?>/posts" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
            <div class="card card-body bg-light mt-5">
                
                <h2 class="mb-4">Add Post:  </h2>
                <form method="post" action="<?php echo URLROOT; ?>/posts/add">
                    <div class="form-group">
                        <label for="email">Title: </label>
                        <input type="text" value="<?php echo $data['title']; ?>" class="form-control <?php echo (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>" name="title" placeholder="Enter title">
                        <span class="invalid-feedback"><?php echo $data['title_err']; ?></span>
                    </div>
                    
                    <div class="form-group">
                        <label for="body">Body: </label>
                        <textarea rows="3" class="form-control <?php echo (!empty($data['body_err'])) ? 'is-invalid' : ''; ?>" name="body" placeholder="Enter Body"> <?php echo $data['body']; ?> </textarea>
                        <span class="invalid-feedback"><?php echo $data['body_err']; ?></span>
                    </div>

                    <input type="submit" value="Submit" class="btn btn-success" name="add">
                
                </form>
            </div>
            
        
</div>

<?php require_once APPROOT . '/views/inc/footer.php'; ?>
