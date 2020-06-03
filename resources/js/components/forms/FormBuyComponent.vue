<template>
    <section class="block form">
        <div class="block-text">
            <h2 v-html="form_title"></h2>
        </div>
        <form-common :cities="cities"
                     :button_text="button_text"
                     :form_title="form_title"
                     :is_comment="is_comment"
                     :form_id="form_id"
                     :form_type="form_type"
                     :goal="goal"
                     >
        </form-common>
    </section>
</template>

<script>
    import FormCommon from './FormCommon.vue';

    export default {
        name: 'FormBuy',
        props: {
            cities : {
                type: Object
            },
            button_text: {
                default: "Записаться",
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
    .form {
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
                color: #000;
                margin-bottom: 30px;
                font-size: 34px;
            }
        }

        @media only screen and (min-width: 1367px) {

        }

        form {
            margin-bottom: 40px;
        }
        .block-text {
            padding-top: 30px;
            padding-right: 50px;
        }
    }
</style>
