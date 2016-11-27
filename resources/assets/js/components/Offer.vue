<template>
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" :id="'heading-offer' + offer.id">
            <h4 class="panel-title">
                <div class="row">
                    <div class="col-sm-3">{{ offer.bank.name }}</div>
                    <div class="col-sm-3">{{ offer.interest }}%</div>
                    <div class="col-sm-2">{{ offer.amount }}</div>
                    <div class="col-sm-2">TODO: Offer Deadline</div>
                    <div class="col-sm-2">
                        <a class="collapsed btn btn-default btn-xs" role="button" data-toggle="collapse" data-parent="#offers" :href="'#collapse-offer' + offer.id" aria-expanded="false" :aria-controls="'collapse-offer' + offer.id">
                            Show bank
                        </a>
                    </div>
                </div>
            </h4>
        </div>

        <div :id="'collapse-offer' + offer.id" class="panel-collapse collapse" role="tabpanel" :aria-labelledby="'heading-offer' + offer.id">
            Details for bank ({{ offer.bank.name }}) associated with the Offer
        </div>
    </div>
</template>

<script>
    export default {
        props: ['offer'],
    }
</script>
