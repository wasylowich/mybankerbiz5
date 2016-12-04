
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the body of the page. From here, you may begin adding components to
 * the application, or feel free to tweak this setup for your needs.
 */

Vue.component('example', require('./components/Example.vue'));
Vue.component('enquiry', require('./components/Enquiry.vue'));
Vue.component('enquiries', require('./components/Enquiries.vue'));
Vue.component('offer-chance', require('./components/OfferChance.vue'));
Vue.component('offer-chances', require('./components/OfferChances.vue'));
Vue.component('offer', require('./components/Offer.vue'));
Vue.component('offers', require('./components/Offers.vue'));
Vue.component('mbbiz-offer-details', require('./components/MbBizOfferDetails.vue'));
Vue.component('mbbiz-bank-details', require('./components/MbBizBankDetails.vue'));

const app = new Vue({
    el: '#app'
});
