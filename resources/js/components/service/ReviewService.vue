<template>
    <section class="service-review bg-dark">
        <div class="service-review-layer container">
            <div class="swiper-button-prev" slot="button-prev"></div>
            <div class="swiper-button-next" slot="button-next"></div>
            <swiper class="swiper container-2" ref="mySwiper" :options="swiperOptions">
                <swiper-slide v-for="review in reviews" v-bind:key="review.id">
                    <div class="swiper__wrap">
                        <div class="swiper__head">
                            <div class="swiper__head-block with-big-qoute">
                                <div class="swiper__head-block-name">{{review.name}}</div>
                                <div class="swiper__head-block-stars">
                                    <ul>
                                        <li v-for="n in 5" v-bind:class="{'rating-active': checkRating(n, review)}"></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="swiper__text">
                            <span>{{review.text}}</span>
                        </div>
                    </div>
                </swiper-slide>
            </swiper>
        </div>
    </section>
</template>

<script>
    import { Swiper, SwiperSlide, directive } from 'vue-awesome-swiper'
    import 'swiper/css/swiper.css'

    export default {
        name: "ReviewService",
        props: {},
        data: function () {
            return {
                swiperOptions: {
                    autoHeight: true,
                    slidesPerView: 3,
                    spaceBetween: 30,
                    slidesPerGroup: 1,
                    loop: true,
                    loopFillGroupWithBlank: true,
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true
                    },
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev'
                    },
                    breakpoints: {
                        1024: {
                            slidesPerView: 3,
                            spaceBetween: 0
                        },
                        900: {
                            slidesPerView: 3,
                            spaceBetween: 0
                        },
                        580: {
                            slidesPerView: 2,
                            spaceBetween: 0
                        },
                        320: {
                            slidesPerView: 1,
                            spaceBetween: 0
                        }
                    }
                },
                reviews: {
                    0: {
                        id: 1,
                        name: 'Ars Vinogradov',
                        stars: 5,
                        text: 'Уже несколько раз проходил ТО и делают хорошо. Удовольствие жать на газ после Брайт Парка!'
                    },
                    1: {
                        id: 2,
                        name: 'v.nikolashcka',
                        stars: 5,
                        text: 'Менеджер Ксения очень помогла с выбором авто и подобрала хорошие условия по кредиту, мы всем довольны, машинкой нарадоваться не можем,рекомендуем'
                    },
                    2: {
                        id: 3,
                        name: 'Владимир',
                        stars: 5,
                        text: 'Для клиентов созданы Комфортные условия ожидания. Здорово, что есть камеры видеонаблюдения, на которых можно наблюдать. как устанавливают доп.работы мастера. Персонал вежливый и учтивый'
                    },
                }
            };
        },
        methods: {
            checkRating(n, review) {
              return review.stars - n >= 0;
            },
        },
        computed: {
            swiper() {
                return this.$refs.mySwiper.$swiper
            }
        },
        components: {
            Swiper,
            SwiperSlide
        },
        directives: {
            swiper: directive
        },
        mounted() {
        }
    }
</script>

<style scoped lang="scss">
    .swiper-button-prev,
    .swiper-button-next {
        border-color: #FF8351;
        color: #FF8351;
    }

    .service-review-layer {
        position: relative;
    }

    .swiper {
        &__wrap {
            background-color: #fff;
            margin: 0 10px;
            padding: 40px 25px;
            border-radius: 20px;
        }

        &__head {
            &-block {
                height: 60px;
                margin-bottom: 15px;
                &-name {
                    font-size: 18px;
                }

                &-stars {
                    margin-top: 10px;
                    ul {
                        display: flex;
                        justify-content: left;
                        flex-direction: row;
                        li {
                            margin-right: 4px;
                             background: url(/build/images/icons/service/star-off.svg) no-repeat;
                             width: 20px;
                             height: 20px;
                             display: block;

                            &.rating-active {
                                background: url(/build/images/icons/service/star-on.svg) no-repeat;
                            }
                        }
                    }
                }
            }
        }

        &__text {
            font-size: 16px;
            line-height: 1.2;
        }

        &-container {
            width: 90%;
            margin: 60px auto;
        }
    }

    @media only screen and (min-width: 580px) {
        .swiper {
            &__wrap {
                height: 326px;
            }

            &-container {
                margin: 150px auto;
            }
        }
    }

    @media only screen and (max-width: 580px) {
        .swiper-container {
            max-width: 340px;
        }

        .service-review-layer {
            max-width: 380px;
        }

        .swiper-button-next,
        .swiper-container-rtl .swiper-button-prev {
            right: 0;
        }

        .swiper-button-prev,
        .swiper-container-rtl .swiper-button-next {
            left: 0;
        }

        .swiper-button-prev:after,
        .swiper-button-next:after {
            font-size: 26px;
        }
    }
</style>
