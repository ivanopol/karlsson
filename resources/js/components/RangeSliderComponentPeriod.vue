<template>
    <vue-slider v-model="value"  :interval="1" :marks="marks" :drag-on-click="true" :min="12" :max="60"/>
</template>

<script>
    import VueSlider from 'vue-slider-component'
    import 'vue-slider-component/theme/antd.css'

    export default {
        components: {
            VueSlider
        },
        data () {
            return {
                value: 12,
                marks: [12, 60]
            }
        }
    }
</script>

<style lang="scss">
    .vue-slider-process {
        background-color: #ff8351;
        border-radius: 15px;
        transition: background-color 0.3s;
    }
    .vue-slider:hover .vue-slider-process {
        background-color: #ff8351;
    }

    .vue-slider-dot-handle {
        cursor: pointer;
        width: 100%;
        height: 100%;
        border-radius: 50%;
        background-color:
            #ff8351;
        border: 2px solid  #ff8351;
        box-sizing: border-box;
        -webkit-transition: box-shadow 0.3s, border-color 0.3s;
        transition: box-shadow 0.3s, border-color 0.3s;
    }

    .vue-slider:hover .vue-slider-dot-handle:hover {
        border-color:
            #ff8351;
    }

    .vue-slider:hover .vue-slider-dot-handle {
        border-color:
            #ff8351;
    }

    .vue-slider-dot-handle-focus{
        box-shadow: #ff8351;
    }

    .vue-slider:hover .vue-slider-mark-step-active {
        box-shadow: 0 0 0 2px
        #ff8351;
    }

    .vue-slider .vue-slider-mark-step-active {
        box-shadow: 0 0 0 2px
        #ff8351;
    }

    .vue-slider-mark-step {
        box-shadow: 0 0 0 2px
        #ff8351;
    }

</style>
