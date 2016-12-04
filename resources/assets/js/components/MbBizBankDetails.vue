<template>
    <div>
        <div class="row">
            <div class="col-sm-6"><strong>{{ bank.name }}</strong></div>
            <div class="col-sm-6"><img :src="bank.logo" :alt="bank.name + ' Logo'"></div>
        </div>
        <div class="row">
            <div class="col-sm-12">{{ bank.profile.bio }}</div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['bank'],
    }
</script>
