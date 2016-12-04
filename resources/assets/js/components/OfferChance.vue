<template>
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" :id="'heading-offer-chance' + offerChance.id">
            <h4 class="panel-title">
                <div class="row">
                    <div class="col-sm-3">{{ offerChance.bank.name }}</div>
                    <div class="col-sm-3"></div>
                    <div class="col-sm-2"></div>
                    <div class="col-sm-2"></div>
                    <div class="col-sm-2">
                        {{ offerChance.state }}
                    </div>
                </div>
            </h4>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['enquiry', 'offerChance'],
    }
</script>
