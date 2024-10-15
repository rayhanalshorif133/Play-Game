<?php $__env->startSection('styles'); ?>
    <style>
        .game_image {
            width: 100% !important;
            border-radius: 3% !important;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <main role="main">
        <!--/ Section one Star /-->
        <section id="section_one">
            <div class="container  mt-5">
                <div class="wrap-one  d-flex justify-content-between">
                    <div class="title-box">
                        <h3 class="title-a">Current Campaign</h3>
                    </div>
                </div>
                <div class="row">
                    <?php if(count($currentCampaignDurations) == 0): ?>
                        <div class="mx-auto text-center">
                            <div class="alert alert-success" role="alert">
                                No Campaign Available, Please Wait for the Next Campaign.
                            </div>
                        </div>
                    <?php else: ?>
                        <?php $__currentLoopData = $currentCampaignDurations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $campaignDuration): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-4 col-sm-12">
                                <div class="card my-4 box-shadow">
                                    <img class="card-img img-fluid game_image"
                                        src="<?php echo e(asset($campaignDuration->game->banner)); ?>" alt="Card image cap">
                                    <div class="card-body" style="padding-left: 10px;padding-bottom: 10px;">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="btn-group" style="display: block !important;">
                                                <h4 class="font-bold" style="font-size: 1.2rem;font-weight: bold;">
                                                    <?php echo e($campaignDuration->campaign->title); ?> <br />
                                                    (<?php echo e($campaignDuration->name); ?>)
                                                </h4>
                                                <p class="card-text" style="color: red;">
                                                    Time Remains:
                                                    <?php echo e($campaignDuration->duration); ?></p>
                                            </div>
                                            <a type="btn" class="btn  btn-outline-secondary text-white common-btn"
                                                style="width: 150px"
                                                href="<?php echo e(route('campaign.campaign-details', $campaignDuration->id)); ?>">Play
                                                now</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>

                </div>
            </div>
        </section>
        <!--/ Section one End /-->
        <!--/ Section two Star /-->
        <section id="section_two" style="margin-bottom: 30%;">
            <div class="container">
                <div class="wrap-one  d-flex justify-content-between">
                    <div class="title-box">
                        <h3 class="title-a my-2">Upcoming Campaign</h3>
                    </div>
                </div>
                <div class="row">
                    <?php if(count($upcomingCampaignDurations) == 0): ?>
                        <div class="mx-auto text-center my-5">
                            <div class="alert alert-info" role="alert">
                                Currently, there are no upcoming campaigns available. Please stay tuned for future campaigns.
                            </div>
                        </div>
                    <?php else: ?>
                        <?php $__currentLoopData = $upcomingCampaignDurations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $upcomingCampaign): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-4 col-sm-12 mt-2">
                                <div class="campain-body">
                                    <div class="row row-cols-1 row-cols-sm-2">
                                        <div class="col-6">
                                            <figure style="margin: 0px;">
                                                <img class="card-img img-fluid"
                                                    src="<?php echo e(asset($upcomingCampaign->game->banner)); ?>" alt="Card image"
                                                    style="height: 200px" />
                                            </figure>
                                        </div>
                                        <div class="col-6" style="margin-top: 6%;">
                                            <div class="card-body-right">
                                                <h4 class="card-title font-bold"
                                                    style="font-weight: bold; font-size: 1.3rem;">
                                                    <?php echo e($upcomingCampaign->campaign->title); ?> <br />
                                                    (<?php echo e($upcomingCampaign->name); ?>)
                                                </h4>
                                                <p class="card-text " style="color: green;">Start after:
                                                    <?php echo e($upcomingCampaign->duration); ?></p>
                                                <a href="<?php echo e(route('campaign.campaign-details', $upcomingCampaign->id)); ?>"
                                                    class="btn btn-primary  common-btn">Explore now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>

                </div>
            </div>
        </section>
        <!--/ Section one End /-->

    </main>
<?php $__env->stopSection(); ?>



<?php $__env->startPush('scripts'); ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app_public', ['title' => 'Home'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Rayhan\Development\Play-Game\resources\views/public/home.blade.php ENDPATH**/ ?>