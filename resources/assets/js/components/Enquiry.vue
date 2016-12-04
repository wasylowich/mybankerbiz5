<template>
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" :id="'heading-enquiry' + enquiry.id">
            <h4 class="panel-title">
                <div class="row">
                    <div class="col-sm-3">{{ enquiry.depositorProfile.name }}</div>
                    <div class="col-sm-3">{{ enquiry.offers_deadline }}</div>
                    <div class="col-sm-2">{{ enquiry.amount }}</div>
                    <div class="col-sm-2" v-if="enquiry.depositType.name === 'pension'">pension</div>
                    <div class="col-sm-2" v-else>{{ enquiry.fixation_period}} days</div>
                    <div class="col-sm-1">{{ enquiry.offers.length }}</div>
                    <div class="col-sm-1">
                        <a class="collapsed btn btn-default btn-xs" role="button" data-toggle="collapse" data-parent="#enquiries-vue-component" :href="'#collapse-enquiry' + enquiry.id" aria-expanded="false" :aria-controls="'collapse-enquiry' + enquiry.id">
                            Show offers
                        </a>
                    </div>
                </div>
            </h4>
        </div>

        <!-- Output the list of offers and offer-chances -->
        <div :id="'collapse-enquiry' + enquiry.id" class="panel-collapse collapse" role="tabpanel" :aria-labelledby="'heading-enquiry' + enquiry.id">
            <offers        :csrf_token="csrf_token" :enquiry="baseEnquiry" :offers="enquiry.offers"             :showColHeadings="showColHeadingsOffers"></offers>
            <offer-chances :csrf_token="csrf_token" :enquiry="baseEnquiry" :offerChances="enquiry.offerChances" :showColHeadings="showColHeadingsOfferChances"></offer-chances>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['csrf_token', 'enquiry'],

        computed: {
            showColHeadingsOffers: function () {
                // The offers component should show the column headings if
                // there is at least 1 offer
                return this.enquiry.offers.length > 0
            },

            showColHeadingsOfferChances: function () {
                // The offers component should show the column headings if
                // there are no offers, but there is at least 1 offerChance
                return this.enquiry.offers.length == 0 && this.enquiry.offerChances.length > 0
            },

            baseEnquiry: function () {
                var baseEnquiry = JSON.parse(JSON.stringify(this.enquiry))

                delete baseEnquiry.offerChances
                delete baseEnquiry.offers

                return baseEnquiry
            },
        },

        ready() {
            console.log('Enquiry component ready.');
        },

        mounted() {
            console.log('Enquiry component mounted.');
        },

        created() {
            console.log('Enquiry component created.');
        },
    }
</script>
