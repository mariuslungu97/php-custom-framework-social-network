<?php require_once APPROOT . '/views/inc/header.php'; ?>

<div class="container">
    <a href="<?php echo URLROOT; ?>/posts" class="btn btn-light my-3"><i class="fa fa-backward"></i> Back</a>
    <br>
    <h1><?php echo $data['post']->title; ?></h1>
    <div class="bg-secondary text-white p-2 my-3">
        Written by <?php echo $data['user']->name; ?> on <?php echo $data['post']->created_at; ?> 
    </div>
    <p><?php echo $data['post']->body; ?></p>
    <hr>
    <a class="btn btn-dark" href="<?php echo URLROOT; ?>/posts/edit/<?php echo $data['post']->id; ?>">Edit</a>
    <form class="float-right" action="<?php echo URLROOT; ?>/posts/delete/<?php echo $data['post']->id; ?>" method="POST">
        <input type="submit" value="delete" class="btn btn-danger">
    </form>
</div>

<?php require_once APPROOT . '/views/inc/footer.php'; ?>
