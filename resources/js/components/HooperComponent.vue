<template>
    <div class="carcasses-wrap container-max">
        <div class="items-mini_wrap container">
            <hooper class="items-mini" id="items-mini" :settings="hooperSettings" v-on:slide="change_line">
                <slide v-for="slide in data.slides_mini" v-bind:key="slide.id">
                    <a :id="'slide_'+ slide.title" class="event" :href="slide.url" :class="{ current_model : slide.active}">
                        <picture>
                            <source :srcset="get_source(slide.image)" media="(min-width: 580px)">
                            <img :src="slide.image" :alt="slide.alt">
                        </picture>
                        <span v-text="slide.title"></span>
                    </a>
                </slide>
                <!--              <hooper-navigation slot="hooper-addons"></hooper-navigation>
                              <hooper-pagination slot="hooper-addons"></hooper-pagination>
                              <hooper-progress slot="hooper-addons"></hooper-progress>-->
            </hooper>
            <span class="indicator"></span>
        </div>

        <div id="items" class="items">
            <div :class="data.slides.class">
                <div class="items-data">
                    <p class="title" v-text="data.slides.title"></p>
                    <p class="sub_title" v-html="data.slides.subtitle"></p>
                    <a id="purchase_conditions" class="event btn-banner" :href="data.slides.link">Условия покупки</a>
                </div>
                <span class="more_details">
                    <span>Подробнее</span>
                </span>
            </div>
        </div>
    </div>
</template>

<script>
    import {
        Hooper,
        Slide
/*        Progress as HooperProgress,
        Pagination as HooperPagination,
        Navigation as HooperNavigation*/

    } from 'hooper';
    import 'hooper/dist/hooper.css';

    export default {
        name: 'App',
        components: {
            Hooper,
            Slide
/*            HooperProgress,
            HooperPagination,
            HooperNavigation*/
        },
        props : ['data'],
        data () {
            return {
                hooperSettings: {
                    infiniteScroll: this.data.slides_mini.length > 2,
                    itemsToShow: 3,
                    centerMode: true,
                    trimWhiteSpace: false,
                    mouseDrag: false,
                    wheelControl: false,
                    breakpoints: {
                        580: {
                            infiniteScroll: false,
                            itemsToShow: 6,
                            centerMode: false,
                            trimWhiteSpace: true,
                            mouseDrag: true,
                        },
                        800: {
                            infiniteScroll: false,
                            itemsToShow: 6,
                            centerMode: false,
                            trimWhiteSpace: true,
                            mouseDrag: true
                        },
                    }
                }
            };
        },
        mounted: function() {
            if (window.innerWidth < 581) {
                this.$children[0].slideTo(this.data.active);
                this.setIndicatorDefaultPosition();
            } else {
                setTimeout(() => this.setIndicatorPosition(), 300);
            }

            window.addEventListener("resize", this.myEventHandler);
        },
        methods: {
            get_source: function(path) {
                let new_path = path.replace('mobile/', '');
                return new_path + ', ' + new_path + ' 2x';
            },
            change_line: function(event) {
            },
            myEventHandler: function() {
                if (window.innerWidth < 581) {
                    this.$children[0].slideTo(this.data.active);
                    this.setIndicatorDefaultPosition();
                } else {
                    this.$children[0].slideTo(0);
                    this.setIndicatorPosition();
                }
            },
            setIndicatorPosition: function() {
                var model = document.getElementById('items-mini').getElementsByClassName('current_model')[0].getBoundingClientRect();
                var parent = document.getElementById('items-mini').getBoundingClientRect();
                var pos = model.left - parent.left + model.width / 2;

                if (pos) {
                    var indicator = document.getElementsByClassName('indicator')[0];
                    indicator.style.left = pos + 'px';
                }
            },
            setIndicatorDefaultPosition: function() {
                var indicator = document.getElementsByClassName('indicator')[0];
                indicator.style.left = '48%';
            }
        }
    };
</script>

<style lang="scss">
    @import "./resources/sass/hooper.scss";
</style>
