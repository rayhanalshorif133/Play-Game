<?php $__env->startSection('styles'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <main role="main">

        <div class="home_container">
            <div class="game_title mt-5">
                <?php echo e($game->title); ?>

            </div>
            <div class="logo">
                <img src="<?php echo e(asset($game->banner)); ?>">
            </div>
            <div class="label_container">
                <div>
                    <img src="<?php echo e(asset('images/playing_hands.png')); ?>">
                    <p><?php echo e($subscription); ?></p>
                </div>
                <div>
                    <img src="<?php echo e(asset('images/clock.png')); ?>">

                    <?php if($campaign && $campaign->type == 'expired'): ?>
                    <p>Expired</p>
                    <?php elseif($campaign && $campaign->type == 'upcoming'): ?>
                    <p>Start in
                        <span class="time">
                            <?php echo e($campaign->duration); ?>

                        </span>
                    </p>
                    <?php else: ?>
                    <p>Expired in
                        <span class="time">
                            <?php echo e($campaign && $campaign->duration); ?>

                        </span>
                    </p>
                    <?php endif; ?>

                </div>
            </div>
            <div class="leaderBoard_tournament_container">
                <div>
                    <p class="leaderboad_btn">Leaderboad</p>
                </div>
                <div>
                    <p class="tournament_rules_btn">Tournament Rules</p>
                </div>
            </div>
            <?php if($campaign): ?>
                <?php
                    $game_url = $game->URL($game);
                ?>
                <div class="play_btn_container mb-4">
                    <div class="btn_primary">
                        <?php if($hasAlreadySubs): ?>
                            <a class="btn" href="<?php echo e($game_url); ?>">
                                Play now
                            </a>
                        <?php else: ?>
                            <a class="btn"
                                href="<?php echo e(route('campaign.campaign-details', $campaign->id)); ?>">
                                Play now
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>


            <footer class="mt-4">
                <div class="lottie_banner">
                    <lottie-player class="lottie-player" src="<?php echo e(asset('images/banner.json')); ?>" background="transparent"
                        speed="1" loop autoplay>
                    </lottie-player>
                </div>
            </footer>

        </div>

        <?php echo $__env->make('public.modals', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </main>
<?php $__env->stopSection(); ?>



<?php $__env->startPush('scripts'); ?>
    <script>
        var paymentSuccessModal = new bootstrap.Modal(document.getElementById('paymentSuccessModal'), {
            keyboard: false
        });

        var paymentFailedModal = new bootstrap.Modal(document.getElementById('paymentFailedModal'), {
            keyboard: false
        });

        var leaderboadModal = new bootstrap.Modal(document.getElementById('leaderboadModal'), {
            keyboard: false
        });


        var tournamentRulesModal = new bootstrap.Modal(document.getElementById('tournamentRulesModal'), {
            keyboard: false
        });


        let url = window.location.href;
        if (url.includes("?status=success")) {
            paymentSuccessModal.show();
        }

        if (url.includes("?status=failure")) {
            paymentFailedModal.show();
        }


        $(".payment_try_again_btn").click(() => {
            axios.post('/api/payment-create')
                .then((response) => {
                    const url = response.data.data;
                    window.location.href = url;
                });
        });

        $(".leaderboad_btn").click(() => {
            leaderboadModal.show();
        });

        $(".tournament_rules_btn").click(() => {
            tournamentRulesModal.show();
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app_public', ['title' => 'Home'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Rayhan\Development\Play-Game\resources\views/public/home.blade.php ENDPATH**/ ?>