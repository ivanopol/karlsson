<template>
    <section :class="'block form inline-form ' + form_class">
        <h2 v-html="form_h1" v-if="form_h1"></h2>

        <div class="form-wrapper">
            <p class="note_1" v-if="form_title">{{form_title}}</p>
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
        name: 'FormInline',
        props: {
            cities : {
                type: Object
            },
            button_text: {
                default: "Записаться",
                type: String
            },
            form_h1: {
                default: "<span class=\"c_orange\">Попробуйте</span> сами",
                type: String
            },
            form_title: {
                default: "Расширенный тест-драйв в Брайт парке",
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

<style lang="scss" >
    .inline-form {
        p.form-title {
            color: #fff;
            margin-bottom: 30px;
            font-family: OpenSansExtraBold, Helvetica, sans-serif;
            text-transform: uppercase;
            text-align: center;
            font-size: 24px;
            line-height: 1.3;
        }

        @media only screen and (min-width: 580px) {
            p.form-title {
                color: #000;
                margin-bottom: 30px;
                font-size: 34px;
            }
        }

        @media only screen and (min-width: 1367px) {

        }

        form {
           // margin-bottom: 40px;
        }

        .block-text {
            padding-top: 30px;
            padding-right: 50px;
        }
    }

    @media only screen and (max-width: 580px) {
        .mobile_white_bg {
            background: rgb(41,41,41);
            background: linear-gradient(90deg, rgba(41,41,41,1) 0%, rgba(83,83,83,1) 100%);
            padding: 9vw 0 7vw;
            border-radius: 10px;
            border: 6px solid #fff;
            margin: 3.63vw;

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
            width: 50%;
            padding: 30px;
            border: 10px solid #fff;
            border-radius: 15px;
            margin: 0 auto;

            h2 {
                font-size: 36px;
            }
        }
    }
</style>
