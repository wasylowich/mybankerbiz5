<template>
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" :id="'heading-offer' + offer.id">
            <h4 class="panel-title">
                <div class="row">
                    <div class="col-sm-3">{{ offer.bank.name }}</div>
                    <div class="col-sm-3">{{ offer.interest }}%</div>
                    <div class="col-sm-2">{{ offer.amount }}</div>
                    <div class="col-sm-2">TODO: Offer Deadline</div>
                    <div class="col-sm-2" v-if="offer.state != 'active'">
                        {{ offer.state }}
                    </div>
                    <div class="col-sm-2" v-if="offer.state == 'active'">

                        <form method="POST" :action="'http://mybiz5.dev/customer/offers/' + offer.id + '/accept'" accept-charset="UTF-8" class="form-inline">
                            <input name="_token" type="hidden" :value="csrf_token">

                            <!-- The accept button (submits the form) -->
                            <button type="submit" class="btn btn-success btn-xs"><i class="fa fa-check"></i> Accept</button>

                            <!-- The info button -->
                            <a class="collapsed btn btn-default btn-xs" role="button" data-toggle="collapse" data-parent="#offers" :href="'#collapse-offer' + offer.id" aria-expanded="false" :aria-controls="'collapse-offer' + offer.id">
                                Info
                            </a>
                        </form>
                    </div>
                </div>
            </h4>
        </div>

        <div :id="'collapse-offer' + offer.id" class="panel-collapse collapse" role="tabpanel" :aria-labelledby="'heading-offer' + offer.id">
            <mbbiz-offer-details :enquiry="enquiry" :offer="offer"></mbbiz-offer-details>

            <hr />

            <h3>About the financial institution:</h3>

            <mbbiz-bank-details :bank="offer.bank"></mbbiz-bank-details>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['csrf_token', 'enquiry', 'offer'],
    }
</script>
