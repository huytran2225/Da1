<?php if(isset($_SESSION['message'])): ?>
<div class="alert alert-success alert-dismissible fade show">
    <?= $_SESSION['message'] ?>
    <button type="button" class="close" data-dismiss="alert">
        <span>&times;</span>
    </button>
</div>
<?php unset($_SESSION['message']); endif; ?>

<?php if(isset($_SESSION['error'])): ?>
<div class="alert alert-danger alert-dismissible fade show">
    <?= $_SESSION['error'] ?>
    <button type="button" class="close" data-dismiss="alert">
        <span>&times;</span>
    </button>
</div>
<?php unset($_SESSION['error']); endif; ?>