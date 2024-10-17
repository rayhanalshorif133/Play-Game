<?php $__env->startSection('styles'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <main role="main">

        <div class="home_container">
            <div class="game_title">
                <img src="<?php echo e(asset('images/game_title.png')); ?>">
            </div>
            <div class="logo">
                <img src="<?php echo e(asset('images/snake_avater.png')); ?>">
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
            <div class="leaderBoard_tournament_container">
                <div>
                    <p>Leaderboad</p>
                </div>
                <div>
                    <p>Tournament Rules</p>
                </div>
            </div>
            <?php if(count($currentCampaignDurations) > 0): ?>
                <div class="play_btn_container">
                    <div>
                        <a href="<?php echo e(route('campaign.campaign-details', $currentCampaignDurations[0]->id)); ?>" class="play-now-btn">
                            Play now
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>

    </main>
<?php $__env->stopSection(); ?>



<?php $__env->startPush('scripts'); ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app_public', ['title' => 'Home'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Rayhan\Development\Play-Game\resources\views/public/home.blade.php ENDPATH**/ ?>