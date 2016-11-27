<template>
    <div class="panel-group" id="offerChances" role="tablist" aria-multiselectable="true">
        <!-- Output the column headings (if appropriate) -->
        <div class="row" v-if="showColHeadings">
            <div class="col-sm-3"><strong>Bank</strong></div>
            <div class="col-sm-3"><strong>Interest</strong></div>
            <div class="col-sm-2"><strong>Amount</strong></div>
            <div class="col-sm-2"><strong>Deadline</strong></div>
            <div class="col-sm-2"></div>
        </div>

        <!-- Output the list of offer-chances -->
        <offer-chance :offerChance="offerChance" v-for="offerChance in offerChances" v-if="offerChance.state != 'accepted'"></offer-chance>
    </div>
</template>

<script>
    export default {
        props: ['offerChances', 'showColHeadings'],
    }
</script>
