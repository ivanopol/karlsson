<template>
    <section id="buttons_other" class="buttons_other mt-40">
        <div class="container">
            <div class="item-buttons-other">
                <a id="from_test_drive" href="#" class="btn btn-primary event" v-on:click.prevent="show('Записаться на тест-драйв', 'main__modal_test-drive')">Записаться на тест-драйв</a>
                <a id="form_service" href="#" class="btn btn-secondary event" v-on:click.prevent="show('Записаться на сервис', 'main__modal_service')">Записаться на сервис</a>
            </div>
            <modal name="form-callback" height="auto" :adaptive="true">
                <div class="close" @click="hide"></div>
                <form-buy2-component :cities="cities" :form_title="form_title" :form_id="form_id"></form-buy2-component>
            </modal>
        </div>
    </section>
</template>

<script>
   // import {  } from 'hooper';
   // const MODAL_WIDTH = 300;
    import axios from "axios";

   export default {
        name: "App",
        props: ['cities'],
        data () {
           return {
               modalWidth: window.innerWidth -20,
               form_id: '',
               form_title: '',
           }
        },
        methods: {
            show (title, form_id) {
                this.form_title = title;
                this.form_id = form_id;
                this.$modal.show('form-callback');
                () => {
                    callibriInit();
                }
            },
            hide () {
                this.$modal.hide('form-callback');
            },
        },
       created () {
           this.modalWidth = window.innerWidth -20
       },
    }
</script>

<style lang="scss">
    .buttons_other {
        .item-buttons-other {
            margin-bottom: 40px;
            text-align: center;

            & > a {
                margin-bottom: 15px;
            }

            .btn {
                font-family: PragmaticaLightC, Helvetica, sans-serif;
                width: 85%;
                border-radius: 50px;
                padding: 14px 15px 10px;
            }

            .btn-primary {
                border: 2px solid #FF8351;
                color: #fff;
                background-color: #FF8351;
            }

            .btn-secondary {
                border: 2px solid #000;
                color: #000;
                background-color: transparent;
            }
        }
    }


    @media only screen and (min-width: 576px) {
        .buttons_other {
            .item-buttons-other {
                .btn {
                    width: auto;
                    margin-left: 5px;
                    margin-right: 5px;
                }
            }
        }
    }

</style>
