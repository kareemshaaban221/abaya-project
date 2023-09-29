<?php if (isset($errors)): ?>
<div class="alert bg-danger text-light bg-opacity-75 alert-dismissible fade show fixed-top w-50 m-auto mt-5" role="alert">
    <table class='m-auto'>
        <?php foreach ($errors as $key => $error): ?>
            <tr>
                <td class="border-start ps-2"><?= $key ?></td>
                <td class='pe-2'><?= $error ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif; ?>