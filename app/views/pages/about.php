<?php require_once APPROOT . '/views/inc/header.php'; ?>
<div class="container">
    <div class="card">
        <img src="../img/about-banner.jpg" class="card-img-top card-img" alt="About Banner">
        <div class="card-body">
            <h5 class="card-title display-5 "><?php echo $data['title']; ?></h5>
            <p class="card-text"><?php echo $data['description']; ?></p>
            <p class="card-text">Further Information: </p>
        </div>
       
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Version: <strong> <?php echo $data['version']; ?> </strong></li>
            <li class="list-group-item">Technology Stack: <strong> <?php echo $data['technologyStack']; ?> </strong></li>
            
        </ul>
    </div>
</div>
<?php require_once APPROOT . '/views/inc/footer.php'; ?>
