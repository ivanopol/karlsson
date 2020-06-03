<template>
    <section class="block block_4 container">
        <div class="block-text">
            <h2><span class="c_orange">Эксперты</span> о {{model_name}}</h2>
        </div>
        <div class="opinions-wrap">
            <hooper class="opinions" :wheelControl="false">
                <slide v-for="review in reviews" :key="reviews.key">
                    <blockquote :cite="review.url">
                        <p v-html="review.quote"></p>
                        <footer v-html="review.author"></footer>
                    </blockquote>
                </slide>
                <hooper-pagination slot="hooper-addons"></hooper-pagination>
            </hooper>
        </div>
        <div class="block-info">
            <div class="trigger">
                <div class="trigger-wrap2">
                    <img src="/build/images/icons/checkbox-green.svg" />
                    <p>98% клиентов оставили положительные отзывы о&nbsp;{{model_name}}</p>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    import {
        Hooper,
        Slide,
        Pagination as HooperPagination
    } from 'hooper';
    import 'hooper/dist/hooper.css';

    export default {
        name: 'App',
        props : ['reviews', 'model_name'],
        components: {
            Hooper,
            Slide,
            HooperPagination
        }
    }
</script>

<style lang="scss">

    .opinions-wrap {
        width: 100%;
        margin: 0 auto;
    }

    @media only screen and (min-width: 580px) {
        .opinions-wrap {
            width: 80%;
        }
    }

    @media only screen and (min-width: 800px) {
        .opinions-wrap {
            width: 60%;
        }
    }

    .opinions {
        margin-bottom: 45px;
        margin-top: 45px;

        ul {
            margin-bottom: 15px;

            li {
                width: 375px;
                display: inline-block;

                blockquote {
                    margin: 0 30px;

                    p {
                        font-family: PragmaticaLightCBold, Helvetica, sans-serif;
                        font-size: 18px;

                        &::after {
                             content: '»';
                        }

                        &::before {
                             content: '«';
                        }
                    }

                    @media only screen and (min-width: 1000px) {
                        p {
                            font-size: 22px;
                            line-height: 1.3;
                            text-align: center;
                        }
                    }

                    footer {
                        font-weight: bold;
                        text-align: right;
                        padding-bottom: 20px;
                    }
                }
            }
        }

        .hooper-pagination {
            bottom: -26px;

            .hooper-indicator:hover, .hooper-indicator.is-active {
                background-color: #666;
                border-color: #666;
            }

            ol {
                li {
                    .hooper-indicator {
                        width: 7px;
                        height: 7px;
                        border: 1px solid #ccc;
                        background-color: #ccc;
                        border-radius: 6px;
                        margin: 0 4px;
                        -webkit-transition: all ease-out 0.3s;
                        -moz-transition: all ease-out 0.3s;
                        -o-transition: all ease-out 0.3s;
                        transition: all ease-out 0.3s;
                    }
                }
            }
        }
    }
</style>
