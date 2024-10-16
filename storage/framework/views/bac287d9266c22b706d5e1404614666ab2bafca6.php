<?php $__env->startSection('styles'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <main role="main">

        <div class="home_container">
            <div class="game_title">
                <h1>Snake Game</h1>
            </div>
            <div class="logo">
                <img src="https://picsum.photos/200/200">
            </div>
            <div class="label_container">
                <div>
                    <img src="<?php echo e(asset('images/playing_hands.png')); ?>">
                    <p>3,900,900</p>
                </div>
                <div>
                    <img src="<?php echo e(asset('images/clock.png')); ?>">
                    <p>2d1h23m</p>
                </div>
            </div>
            <div class="play_btn_container">
                <div>
                    <a href="#" class="play-now-btn">Play now</a>
                </div>
            </div>
        </div>

    </main>
<?php $__env->stopSection(); ?>



<?php $__env->startPush('scripts'); ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app_public', ['title' => 'Home'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Rayhan\Development\Play-Game\resources\views/public/home.blade.php ENDPATH**/ ?>