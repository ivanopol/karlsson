<template>
    <section class="container trust-us">
        <h2><span class="c_orange">Нам</span> доверяют</h2>
        <div class="resp-double-columns">
            <div class="resp-row" v-for="service in ratings" v-bind:key="service.id">
                <div class="resp-left-column"><img :src="service.path" :alt="service.alt"></div>
                <div class="resp-right-column">
                    <span class="trust-us-rating-value">{{service.rating}}</span>
                    <span class="trust-us-rating-stars">
                        <ul>
                             <li v-for="n in 5" v-bind:class="{'rating-active': checkRating(n, service)}"></li>
                        </ul>
                    </span>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        name: "TrustUs",
        props: {},
        data: function () {
            return {
                ratings: {
                    google: {
                        id: 1,
                        alt: 'Брайт Парк: нам доверяют в Google',
                        path: '/build/images/google.jpg',
                        rating: '4,6',
                        stars: 4,
                    },
                    yandex: {
                        id: 2,
                        alt: 'Брайт Парк: нам доверяют в Яндексе',
                        path: '/build/images/yandex.jpg',
                        rating: '4,6',
                        stars: 4,
                    },
                    flamp: {
                        id: 3,
                        alt: 'Брайт Парк: нам доверяют на Flamp',
                        path: '/build/images/flamp.jpg',
                        rating: '4,8',
                        stars: 5,
                    },
                },
            }
        },
        methods: {
            checkRating(n, rating) {
                return rating.stars - n >= 0;
            },
        },
        computed: {
        },
        mounted() {
        }
    }
</script>

<style scoped lang="scss">
    .trust-us {
        margin-bottom: 40px;
        h2 {
            text-align: center;
            margin: 60px auto;
            span {
                display: inline-block;
            }
        }

        @media only screen and (min-width: 580px) {
            h2 {
                margin: 80px auto;
            }
        }

        &-rating-value {
            font-size: 26px;
            display: block;
            text-align: center;
        }

        &-rating-stars {
            ul {
                max-width: 125px;
                margin: 10px auto 0;
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

    .resp-double-columns  {
        display: flex;
        flex-direction: column;
        justify-content: center;
        margin: 0 30px;
    }

    .resp-row {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        max-width: 320px;
        margin: 0 auto 30px;
    }

    @media only screen and (min-width: 900px) {
        .resp-double-columns  {
            flex-direction: row;
            margin: 0;
        }

        .resp-row {
            margin: 0 30px 30px 0;
        }

        .resp-row:last-child {
            margin-right: 0;
        }
    }

    .resp-left-column,
    .resp-right-column {
        width: 40%;
    }

    .resp-right-column {
    }

    .resp-left-column {
        img {
            width: 100%;
        }
    }
</style>
