<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="<?php echo e(asset('/css/style.css')); ?>" rel="stylesheet">
    <title>
        <?php if(isset($title)): ?>
            <?php echo e($title); ?> | Play
        <?php endif; ?>
    </title>
    <?php echo $__env->yieldContent('head'); ?>
    <?php echo $__env->yieldContent('styles'); ?>
</head>

<body>

    <div class="wrapper">
        <?php echo $__env->yieldContent('content'); ?>
    </div>




    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>


    <script>
        const interval = 1000;
        $(() => {
            setInterval(() => {
                location.reload();
            }, interval);
        });
    </script>
</body>

</html>
<?php /**PATH D:\Rayhan\Development\Play-Game\resources\views/layouts/app_public.blade.php ENDPATH**/ ?>