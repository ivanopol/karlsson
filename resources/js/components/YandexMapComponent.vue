<template>
    <section>
        <div class="route-button-wrap" v-if="button">
            <a id="create_route" :class="'btn event ' + btn_class" v-on:click="createRoute">Проложить маршрут</a>
        </div>
        <div class="map-wrapper">
            <div id="map" class="map"></div>
        </div>
    </section>
</template>

<script>
    export default {
        name: "YandexMapComponent",
        mixins: ['sendEvent'],
        props: {
            coordinates: {
                default: {
                    0: 57.997388,
                    1: 56.306636
                },
                type: Array
            },
            button: {
                default: false,
                type: Boolean
            },
            btn_class: {
                default: '',
                type: String
            },
        },
        data: () => ({
            geolocation: null,
            userLocation: null,
            brightParkLocation: null,
            map: null,
            routeExist: false
        }),
        methods: {
            createRoute() {
                if (!this.routeExist) {
                    let _self = this;

                    function success(position) {
                        const latitude = position.coords.latitude;
                        const longitude = position.coords.longitude;
                        localStorage.setItem("latitude", latitude);
                        localStorage.setItem("longitude", longitude)
                        localStorage.setItem("coords_expire", (Date.now() + (60 * 60 * 1000)).toString())
                        addUserLocation([latitude, longitude])
                    }
                        async function error(e) {

                        const res = await fetch('https://location.services.mozilla.com/v1/geolocate?key=test').then(el => el.json());
                        const point = [res.location.lat, res.location.lng];

                        addUserLocation(point);
                    }

                    if (navigator.geolocation) {
                        let lat = localStorage.getItem("latitude");
                        let lon = localStorage.getItem("longitude");
                        let coords_expire = localStorage.getItem("coords_expire")

                        if (lat !== null && lat !== ""
                            && lon !== "" && lon !== null
                            && parseInt(coords_expire) > (Date.now() + (60 * 60 * 1000))) {
                            success({coords: {latitude: lat, longitude: lon}})
                        } else {
                            navigator.geolocation.getCurrentPosition(success, error);
                        }
                    }

                    function addUserLocation(coords) {
                        let userLocation = new ymaps.GeoObject({
                            geometry: {
                                type: "Point",
                                coordinates: coords
                            },
                        }, {
                            draggable: true
                        });

                        let Route = new ymaps.multiRouter.MultiRoute({
                                referencePoints: [userLocation,
                                    _self.brightParkLocation
                                ],
                                params: {
                                    routingMode: 'driving',
                                    reverseGeocoding: true
                                }
                            },
                            {
                                boundsAutoApply: true
                            }
                        );

                        _self.map.geoObjects.add(Route);
                        _self.map.geoObjects.remove(_self.brightParkLocation);
                        _self.routeExist = true;
                    }
                }
            },
        },

        created() {
            ymaps.ready(() => {
                let geolocation = ymaps.geolocation,
                    myMap = new ymaps.Map('map', {
                        center: this.coordinates,
                        zoom: 15,
                        controls: ['geolocationControl', 'zoomControl']
                    }, {
                        searchControlProvider: 'yandex#search'
                    }),
                    brightParkLocation = new ymaps.GeoObject({
                        geometry: {
                            type: "Point",
                            coordinates: this.coordinates
                        },
                        properties: {}
                    }, {
                        draggable: false
                    });

                myMap.geoObjects.add(brightParkLocation);

                this.brightParkLocation = brightParkLocation;
                this.geolocation = geolocation;
                this.map = myMap;
            });
        },
    }
</script>

<style lang="scss">
    .route-button-wrap {
        padding: 0 30px 50px;
        text-align: center
    }

    .map {
        width: 100%;
        height: 100%;
    }

    .map-wrapper {
        width: 100%;
        height: 300px;
    }

    @media only screen and (min-width: 580px) {
        .map-wrapper {
            width: 100%;
            height: 450px;
        }
    }

    @media only screen and (min-width: 1367px) {
        .map-wrapper {
            width: 100%;
            margin: 0 auto;
            height: 550px;
        }
    }


</style>
