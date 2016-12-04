<template>
    <div>
        <div class="row">
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-6"><strong>Offer</strong></div>
                    <div class="col-sm-6"></div>
                </div>
                <div class="row">
                    <div class="col-sm-6">Offered interest rate</div>
                    <div class="col-sm-6">{{ offer.interest }}</div>
                </div>
                <div class="row">
                    <div class="col-sm-6">Interest amount</div>
                    <div class="col-sm-6">{{ offer.amount }}</div>
                </div>
                <div class="row">
                    <div class="col-sm-6">Can payout early</div>
                    <div class="col-sm-6">TODO: No</div>
                </div>
                <div class="row">
                    <div class="col-sm-6">Interest Convention</div>
                    <div class="col-sm-6">{{ offer.bank.interest_convention }}</div>
                </div>
                <div class="row">
                    <div class="col-sm-6">Interest Accrual</div>
                    <div class="col-sm-6">TODO: some text</div>
                </div>
                <div class="row">
                    <div class="col-sm-6">Offer expires</div>
                    <div class="col-sm-6">{{ offer.deadline }}</div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-6"><strong>Enquiry</strong></div>
                    <div class="col-sm-6"></div>
                </div>
                <div class="row">
                    <div class="col-sm-6">Amount</div>
                    <div class="col-sm-6">{{ enquiry.amount }}</div>
                </div>
                <div class="row">
                    <div class="col-sm-6">Period from</div>
                    <div class="col-sm-6">{{ enquiry.fixation_period_start_date }}</div>
                </div>
                <div class="row">
                    <div class="col-sm-6">until</div>
                    <div class="col-sm-6">{{ enquiry.fixation_period_end_date }}</div>
                </div>
                <div class="row">
                    <div class="col-sm-6">Enquiry ID</div>
                    <div class="col-sm-6">{{ enquiry.id }}</div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['enquiry', 'offer'],
    }
</script>
