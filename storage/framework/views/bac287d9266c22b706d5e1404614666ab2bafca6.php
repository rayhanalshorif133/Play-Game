

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
                    <p class="leaderboad_btn">Leaderboad</p>
                </div>
                <div>
                    <p class="tournament_rules_btn">Tournament Rules</p>
                </div>
            </div>
            <?php if(count($currentCampaignDurations) > 0): ?>
                <div class="play_btn_container">
                    <div class="btn_primary">
                        <?php if($hasAlreadySubs): ?>
                            <?php
                                $game = $currentCampaignDurations[0]->gameURL($currentCampaignDurations[0]);
                            ?>
                            <a class="btn" href="<?php echo e($game); ?>">
                                Play now

                            </a>
                        <?php else: ?>
                            <a class="btn"
                                href="<?php echo e(route('campaign.campaign-details', $currentCampaignDurations[0]->id)); ?>">
                                Play now
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>



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