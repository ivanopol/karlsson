<template>
    <div>
        <hooper group="slideshow"  :centerMode="true">
            <slide >
                <img width="100%" src="/build/images/photos/models/granta/full/1.jpg">
            </slide>
            <slide >
                <img width="100%" src="/build/images/photos/models/granta/full/2.jpg">
            </slide>
            <slide >
                <img width="100%" src="/build/images/photos/models/granta/full/3.jpg">
            </slide>
            <slide >
                <img width="100%" src="/build/images/photos/models/granta/full/4.jpg">
            </slide>
            <slide >
                <img width="100%" src="/build/images/photos/models/granta/full/5.jpg">
            </slide>
        </hooper>
        <div class="car-pictures-wrapper">
            <ul>
                <li>
                    <img src="/build/images/photos/models/granta/preview/1.jpg" alt="" @click="change_slide(0)" data-index="0"/>
                </li>
                <li>
                    <img src="/build/images/photos/models/granta/preview/2.jpg" alt="" @click="change_slide(1)" data-index="1"/>
                </li>
                <li>
                    <img src="/build/images/photos/models/granta/preview/3.jpg" alt="" @click="change_slide(2)" data-index="2"/>
                </li>
                <li>
                    <img src="/build/images/photos/models/granta/preview/4.jpg" alt="" @click="change_slide(3)" data-index="3"/>
                </li>
                <li>
                    <img src="/build/images/photos/models/granta/preview/5.jpg" alt="" @click="change_slide(4)" data-index="4"/>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    import { Hooper, Slide } from 'hooper';
    import 'hooper/dist/hooper.css';

    export default {
        name: 'App',
        components: {
            Hooper,
            Slide
        },
        data: function () {
            return {};
        },
        methods: {
            change_slide: function (index) {
                this.$children[0].slideTo(index);
                return {};
            }
        }
    };
</script>

<style lang="scss">
    @import "./resources/sass/hooper.scss";
</style>
