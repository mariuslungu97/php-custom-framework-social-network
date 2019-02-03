<?php require_once APPROOT . '/views/inc/header.php'; ?>

<!-- Check to see if user has been logged in, in order to display posts -->

<?php #if(isset($_SESSION['user_id'])): ?>
<!-- User is Logged In -->
<div class="container">
    <div class="row">
        <div class="col-md-6 posts-col" style="padding : 0;">
            <h2 class="display-4 mb-3">Posts: </h2>
            
        </div>
        <div class="col-md-6 posts-col" style="padding : 0;">
            <a href="<?php echo URLROOT; ?>/posts/add" class="btn btn-primary float-right">
                <i class="fas fa-pencil-alt"></i> Add Post
            </a>
        </div>
        <?php foreach($data['posts'] as $post): ?>
                <div class="card card-body mb-3">
                    <h4 class="card-title"><?php echo $post->title ?></h4>
                    <div class="bg-light p-2 mb-3">
                        Written by <?php echo $data['name']; ?> on <?php echo $post->created_at; ?>
                    </div>
                    <p class="card-text"><?php echo $post->body; ?></p>
                    <a class="btn btn-dark" href="<?php echo URLROOT; ?>/posts/show/<?php echo $_SESSION['user_id']; ?>">More</a>
                </div>
        <?php endforeach; ?>
    </div>
</div>

<?php #else: ?>
<!-- User is Not Logged In -->

    <!-- <div class="jumbotron jumbotron-fluid">
        <div class="container text-center">
            <h1 class="display-3">You should start by logging in before viewing posts.</h1>
            
        </div>
    </div> -->

<?php #endif; ?>

<?php require_once APPROOT . '/views/inc/footer.php'; ?>





