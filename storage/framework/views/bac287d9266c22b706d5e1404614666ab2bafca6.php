<?php $__env->startSection('styles'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <main role="main">
        <!--/ Section one Star /-->
        <section id="section_one">
            <div class="container  mt-5">
                <div class="button-container">
                    <button class="gradient-button">
                        <i class="fa-solid fa-gamepad" style="font-size:20px"></i>
                        <?php
                            $random = rand(11111,99999);
                        ?>
                        <?php echo e($random); ?>

                    </button>
                </div>
                <div style="width: 100%">

                    <?php if(count($currentCampaignDurations) > 0): ?>
                        <div class="card my-4 box-shadow mx-auto" style="width: 24rem">
                            <img class="card-img img-fluid game_image"
                                src="<?php echo e(asset($currentCampaignDurations[0]->game->banner)); ?>" alt="Card image cap">
                        </div>
                    <?php endif; ?>
                    <div class="mx-auto" style="width: fit-content">
                        <a href="<?php echo e(route('campaign.campaign-details', $currentCampaignDurations[0]->id)); ?>"
                            class="play-now-button">Play Now</a>
                    </div>
                </div>
            </div>
        </section>

    </main>
<?php $__env->stopSection(); ?>



<?php $__env->startPush('scripts'); ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app_public', ['title' => 'Home'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Rayhan\Development\Play-Game\resources\views/public/home.blade.php ENDPATH**/ ?>