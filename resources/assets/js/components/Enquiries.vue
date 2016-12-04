<template>
    <section>
        <div class="panel-group" id="enquiries-vue-component" role="tablist" aria-multiselectable="true" v-if="enquiries.length > 0">
            <div class="row">
                <div class="col-sm-3"><strong>Depositor</strong></div>
                <div class="col-sm-3"><strong>Deadline</strong></div>
                <div class="col-sm-2"><strong>Amount</strong></div>
                <div class="col-sm-2"><strong>Type</strong></div>
                <div class="col-sm-1"><strong>Offers</strong></div>
                <div class="col-sm-1"></div>
            </div>
            <enquiry :csrf_token="csrf_token" :enquiry="enquiry" v-for="enquiry in enquiries"></enquiry>
        </div>

        <div v-else>
            You have not made any enquiries
        </div>
    </section>
</template>

<script>
    export default {
        props: ['csrf_token'],

        data () {
            return {
                enquiries: [],
            };
        },

        mounted () {
            this.fetchEnquiryList();
        },

        methods: {
            fetchEnquiryList() {
                this.$http.get('/api/enquiries')
                    .then(response => {
                        this.enquiries = response.data
                    })
            }
        }
    }
</script>
