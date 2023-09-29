<?php if (request('done')): ?>
<div class="alert bg-success text-light bg-opacity-75 alert-dismissible fade show fixed-top w-50 m-auto mt-5 text-center" role="alert">
    <div class='m-auto fw-bolder'>
        <?= request('done') ?>
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif; ?>