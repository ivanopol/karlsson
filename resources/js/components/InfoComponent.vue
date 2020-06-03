<template>
    <section class="block-info container" >
        <div class="block-info-text">
            <span class="block-info-text-title">
                <h2 v-html="block.title"></h2>
            </span>
            <span class="block-info-text-text">
                <p v-html="block.text"></p>
            </span>
        </div>
        <div class="trigger" v-if="block.trigger">
            <div class="trigger-wrap2">
                <img src="/build/images/icons/checkbox-green.svg" />
                <p>{{block.trigger}}</p>
            </div>
        </div>
        <div class="pointers_wrap" :id="point_id">
            <div class="pointers_list" :v-if="block.pointers">
                <ul :class="'pointers-' + model + '-' + type + '-' + block.pnum " >
                    <li v-for="n in block.pointers">
                        <span :class="'pointer p' + n" v-on:click="activate"></span>
                    </li>
                </ul>
            </div>
            <div class="block-info-img">
                <picture>
                    <source :srcset="get_source(block.url)" media="(min-width: 580px)">
                    <img :src="block.url" alt="">
                </picture>
            </div>
            <div class="block-info-aside">
                <div class="aside_wrap" >
                    <hooper class="info-aside">
                        <slide v-for="slide in block.slider" :key="slide.id">
                            <picture>
                                <source :srcset="get_source(slide.image)" media="(min-width: 580px)">
                                <img :src="slide.image" alt="">
                            </picture>
                            <p v-text="slide.text"></p>
                        </slide>
                        <hooper-pagination slot="hooper-addons"></hooper-pagination>
                    </hooper>

                    <div class="close" v-on:click="deactivate"></div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    import { Hooper, Slide,  Pagination as HooperPagination } from 'hooper';
    import 'hooper/dist/hooper.css';


    export default {
        name: 'App',
        props : ['block', 'data', 'n', 'model', 'type'],
        data: function () {
            return {}
        },
        components: {
            Hooper,
            Slide,
            HooperPagination
        },
        computed: {
            point_id: function () {
                //if (this.n) {
                    return 'pointer_' + this.n;
               // }
              //  return '';
            }
        },
        methods: {
            get_source: function(path) {
                let new_path = path.replace('mobile/', '');
                return new_path + ', ' + new_path + ' 2x';
            },
            activate: function (event) {
                // Получаем номер слайда из класса нажатого плюса
                let activeSlide = Number (event.target.classList[1].replace('p', ''));
                this.$children[0].slideTo(activeSlide-1);
                let dots = document.querySelectorAll('#pointer_' + this.n + ' ul li span');
                dots.forEach(function(item, i, arr) {
                    item.className += ' is_opacity';
                });
                let aside = document.querySelectorAll('#pointer_' + this.n + ' .block-info-aside');
                aside[0].className += ' show';
                let image = document.querySelectorAll('#pointer_' + this.n + ' .block-info-img');
                image[0].className += ' show';
            },
            deactivate: function (event) {

               let dots = document.querySelectorAll('#pointer_' + this.n + ' ul li span');
                dots.forEach(function(item, i, arr) {
                    item.classList.remove("is_opacity");
                });
                let aside = document.querySelectorAll('#pointer_' + this.n + ' .block-info-aside');
                aside[0].classList.remove("show");
                let image = document.querySelectorAll('#pointer_' + this.n + ' .block-info-img');
                image[0].classList.remove("show");
            }
        },
        mounted: function() {

/*            if ((this.data.model_id === 1 && this.data.type_id === 1) || (this.data.model_id === 1 && this.data.type_id === 2))
            {
                this.triggers.banner_1 = "90% клиентов рады, что выбрали отечественный авто и не переплачивают за обслуживание";
                this.triggers.banner_2 = "Большинство клиентов считает :model лучшим автомобилем по соотношению цена/качество";
                this.triggers.banner_3 = "95% клиентов оставили положительные отзывы о :model";
            }
            console.log(this.data);*/
        }
    };
</script>

<style lang="scss">
    @import "./resources/sass/info.scss";
</style>
