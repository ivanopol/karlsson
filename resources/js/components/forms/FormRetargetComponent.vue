<template>
    <section :class="'block form retargeting-form ' + form_class">
        <div class="form-wrapper with-pre-title">
            <h2 v-html="form_title" v-if="form_title"></h2>
            <p class="pre-title" v-html="form_pre_title" v-if="form_pre_title"></p>
            <form-common :cities="cities"
                         :button_text="button_text"
                         :form_title="form_title"
                         :is_comment="is_comment"
                         :form_id="form_id"
                         :form_type="form_type"
                         :goal="goal"
                         >
            </form-common>
        </div>
    </section>
</template>

<script>
    import FormCommon from './FormCommon.vue';

    export default {
        name: 'FormRetarget',
        props: {
            cities : {
                type: Object
            },
            button_text: {
                default: "Получить лучшие условия",
                type: String
            },
            form_title: {
                default: "<span class=\"c_orange\">Оставьте</span> заявку сейчас",
                type: String
            },
            form_pre_title: {
                default: "",
                type: String
            },
            form_id: {
                default: 'form',
                type: String
            },
            is_comment: {
                default: true,
                type: Boolean
            },
            form_class: {
                default: '',
                type: String
            },
            form_type: {
                default: 1,
                type: Number
            },
            goal: {
                default: '',
                type: String
            }
        },
        components: {
            FormCommon,
        },
    }
</script>

<style lang="scss" scoped>

    .validation-message-wrap {
        height: 52px;
    }
    .retargeting-form {
        margin-bottom: 20px;


        p.form-title {
            color: #000;
            margin-bottom: 30px;
            font-family: PragmaticaLightCBold, Helvetica, sans-serif;
            text-transform: uppercase;
            text-align: center;
            font-size: 24px;
            line-height: 1.3;
        }

        @media only screen and (min-width: 580px) {
            p.form-title {
                color: #fff;
                margin-bottom: 30px;
                font-size: 34px;
            }
        }

        @media only screen and (min-width: 1367px) {

        }

        form {
            margin-top: 0;
            margin-bottom: 0;
        }
        .block-text {
            padding-top: 30px;
            padding-right: 50px;
        }

        .validation-message-wrap {
            height: auto;
        }
    }

    @media only screen and (max-width: 580px) {
        .mobile_white_bg {
            background: rgb(41,41,41);
            background: linear-gradient(90deg, rgba(41,41,41,1) 0%, rgba(83,83,83,1) 100%);
            padding: 7vw 0;
            border-radius: 10px;
            border: 6px solid #fff;
            margin: 3.63vw;

            .with-pre-title {
                h2 {
                    margin-bottom: 0;
                }

                .pre-title {
                    font-family: OpenSansSemiBold, Helvetica, sans-serif;
                    color: #b2b4b3;
                    padding: 0 7.25vw; // 0 30px
                    text-align: left;
                    font-size: 4.5vw;
                    margin-bottom: 20px;
                }
            }

            h2 {
                font-family: OpenSansExtraBold, Helvetica, sans-serif;
                font-size: 6.8vw; // 28px;
                line-height: 1.2;
                text-align: left;
                color: #fff;
                padding: 0 7.25vw; // 0 30px
            }

            .form-wrapper {
                padding: 0;
            }

            form {
                margin-bottom: 0;
            }

            form > * {
                //   width: 100%;
            }
        }
    }

    @media only screen and (min-width: 581px) {
        .mobile_white_bg {
            width: 480px;
            padding: 30px;
            border: 10px solid #fff;
            border-radius: 15px;
            margin: 80px auto;

            .with-pre-title {
                h2 {
                    font-size: 36px;
                    color: #fff;
                    margin-bottom: 0;
                }

                .pre-title {
                    font-family: OpenSansSemiBold, Helvetica, sans-serif;
                    color: #b2b4b3;
                    padding: 0; // 0 30px
                    text-align: left;
                    font-size: 18px;
                    margin-bottom: 20px;
                }
            }
        }
    }
</style>
