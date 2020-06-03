<template>

</template>

<script>
    import axios from "axios";

    export default {
        name: "EventHandlerComponent",
        data: () => ({
            elements: [],
            events: []
        }),
        methods: {
            async sendData(data, href) {
                axios({
                    method: 'post',
                    url: '/api/write_event',
                    data: data
                }).then((response) => {
                    if (href !== '#' && href !== null) {
                        window.location = href;
                    }
                });
            }
        },

        mounted() {
            let self = this;

            this.elements = document.getElementsByClassName("event");

            let handle = async function (event) {
                event.preventDefault();

                let data = {
                    'btn_id': this.getAttribute("id"),
                    'href': this.getAttribute("href"),
                    'location': window.location.pathname,
                    'timestamp': new Date().toISOString(),
                    'event_type': 'button'
                };

                await self.sendData(data, this.getAttribute('href'));
            };

            for (let i = 0; i < this.elements.length; i++) {
                this.elements[i].addEventListener('click', handle, false);
            }
        },

        destroyed() {
            for (let i = 0; i < this.events.length; i++) {
                this.sendData(this.events[i]);
            }
        }
    }
</script>

<style scoped>

</style>
