window.Vue = require('vue');
import VModal from 'vue-js-modal';

Vue.use(VModal);

Vue.component('tab-bar', require('./components/elements/TabBar').default);
Vue.component('header-sticky-component', require('./components/elements/HeaderStickyComponent').default);
Vue.component('header-component', require('./components/elements/HeaderComponent').default);
Vue.component('banner-component', require('./components/elements/BannerComponent').default);
Vue.component('advantages-component', require('./components/AdvantagesComponent').default);
Vue.component('form-component', require('./components/forms/FormComponent.vue').default);
Vue.component('car-logos', require('./components/service/CarLogos').default);
Vue.component('our-services', require('./components/service/OurServices').default);
Vue.component('trust-us', require('./components/service/TrustUs').default);
Vue.component('review-service', require('./components/service/ReviewService').default);
Vue.component('form-retarget-component', require('./components/forms/FormRetargetComponent.vue').default);
Vue.component('footer-component', require('./components/elements/FooterComponent').default);
Vue.component('scroll-event-handler-component', require('./components/ScrollEventHandlerComponent').default);
Vue.component('event-handler-component', require('./components/EventHandlerComponent').default);
Vue.component('form-buy2-component', require('./components/forms/FormBuy2Component.vue').default);
Vue.component('yandex-map-component', require('./components/YandexMapComponent').default);

const app = new Vue({
    el: '#app'
});
