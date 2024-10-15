

<?php $__env->startSection('content'); ?>
    <?php if(Session::has('status')): ?>
        <div class="container paymentSuccessAlert">
            <div class="alert d-flex justify-content-between alert-success fade show" role="alert">
                <div class="mt-2">
                    <strong>Payment Success!</strong> <?php echo e(Session::get('message')); ?>

                </div>
                <div class="paymentSuccessAlertCancel">
                    <button class="btn">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="mx-auto text-center container description">
        <img src="<?php echo e(asset($campaignDuration->game->banner)); ?>" alt="" class="my-4 logo" />
        <div>
            <?php if($campaignDuration->start_date_time < $currentDate): ?>
                <?php if(Auth::check()): ?>
                    <input id="GET_MSISDN" class="d-none" value="<?php echo e(Auth::user()->msisdn); ?>" />
                    <input id="GET_CampaignDurationID" class="d-none" value="<?php echo e($campaignDuration->id); ?>" />

                    <?php if($hasAlreadyPayment == false): ?>
                        <button class="btn btn-primary common-btn play_btn" id="bKash_button">
                            Play
                        </button>
                    <?php else: ?>
                        <a href="<?php echo e(route('campaign.play-now',$campaignDuration->id)); ?>"
                            class="btn btn-primary common-btn play_btn">
                            Play Now
                        </a>
                    <?php endif; ?>
                <?php else: ?>
                    <a href="<?php echo e(route('campaign.access', $campaignDuration->id)); ?>"
                        class="btn btn-primary common-btn play_btn">
                        Play
                    </a>
                <?php endif; ?>
            <?php endif; ?>
            <a href="<?php echo e($campaignDuration->gameURL($campaignDuration)); ?>" class="btn btn-primary trail-btn play_btn">
                Play Trail
            </a>
        </div>
        <div class="py-4">
            <?php if($hasAlreadyPayment == true): ?>
                <a href="<?php echo e(route('public.leaderboard', $campaignDuration->id)); ?>" class="btn btn-primary  leaderbord mx-2">
                    <img src="<?php echo e('/web_assets/images/leaderboard.png'); ?>" alt="leaderboard" class="icon">
                    Leaderboard
                </a>
            <?php endif; ?>
            <a href="leaderboard.html" class="btn btn-primary  leaderbord mx-2" data-toggle="modal"
                data-target="#rulesModal">
                <img src="<?php echo e('/web_assets/images/list.png'); ?>" alt="rules" class="icon">
                Rules
            </a>
        </div>
        <img src="<?php echo e($campaignDuration->game->banner); ?>" alt="thumbnail" class="banner my-2" />
    </div>
    <div class="modal fade" id="rulesModal" tabindex="-1" role="dialog" aria-labelledby="rulesModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header modal_header_rules">
                    <h5 class="modal-title text-white" id="rulesModalTitle">Play rules</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ol class="list-group list-group-light list-group-numbered">
                        <li class="list-group-item">You'll be charged To <?php echo e($campaignDuration->amount); ?> (+vat/SD) and participart this campaign.</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('scripts'); ?>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <script src="https://scripts.pay.bka.sh/versions/1.2.0-beta/checkout/bKash-checkout.js"></script>

    <script>
        var msisdn = $("#GET_MSISDN").val();
        var inv_no = Math.floor((Math.random() * 100000) + 1);
        var paymentID = '';
        var campaignDurationID = $("#GET_CampaignDurationID").val();
        bKash.init({
            paymentMode: 'checkout', //fixed value ‘checkout’
            paymentRequest: {
                amount: '01', //max two decimal points allowed
                intent: 'sale'
            },
            createRequest: function(
                request
            ) { //request object is basically the paymentRequest object, automatically pushed by the script in createRequest method
                $.ajax({
                    url: 'https://play.b2m-tech.com/create-payment/' + msisdn + '/' +
                        campaignDurationID,
                    type: 'GET',
                    contentType: 'application/json',
                    success: function(data) {
                        if (data == 'Completed') {
                            window.location.href =
                                "https://www.google.com/?number";
                            return 0;
                        }
                        if (data && data.paymentID != null) {
                            paymentID = data.paymentID;
                            bKash.create().onSuccess(data);
                        } else {
                            bKash.create().onError();
                        }
                    },
                    error: function() {
                        bKash.create().onError();
                    }
                });
            },
            executeRequestOnAuthorization: function() {

                const url = 'https://play.b2m-tech.com/execute-payment/' + msisdn + '/' + paymentID;

                setTimeout(() => {
                    window.location.href = url;
                }, 6000);
            },
            onClose: function() {
                //alert('User has clicked the close button');
            }
        });

        $(document).ready(function() {
            $(".paymentSuccessAlertCancel").click(() => {
                $(".paymentSuccessAlert").addClass('d-none');
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app_public', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/robi.bdgamers.club/resources/views/public/description.blade.php ENDPATH**/ ?>