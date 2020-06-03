@extends('layouts.app')

@section('content')
    <tab-bar :theme="'dark'" :cities='@json($cities)' :models='@json($models)' :phone="'{{$cities['active']['phone']}}'"></tab-bar>
    <header-sticky-component :theme="'light'" :city="'{{$city}}'"></header-sticky-component>
    <header-component :absolute="true"  :theme="'light'" :city="'{{$city}}'" ></header-component>
    <banner-component :cities='@json($cities)'></banner-component>

    <div class="container_bg_dark">
        <div class="container">
            <advantages-component></advantages-component>
        </div>
    </div>
    <div class="container_bg_dark">
        <div class="container">
            <!-- :form_h1="'<span class=\'c_orange\'>Заполните</span> форму'" -->
            <form-component :cities='@json($cities)'
                                     :form_id="'service__form_1'"
                                     :button_text="'Записаться на сервис'"
                                     :form_title="''"
                                     :is_comment='true'
                                     :form_h1="'<span class=\'c_orange\'>Запишись</span> на сервис'"
                                     :form_class="'mobile_white_bg'"
                                     :form_type='2'
            ></form-component>
        </div>
    </div>
    <car-logos></car-logos>
    <our-services :cities='@json($cities)'></our-services>
    <trust-us></trust-us>
    <review-service></review-service>

    <div class="container_bg_dark">
        <div class="container">
            <!-- :form_title="'<span class=\'c_orange\'>Запишись</span> к&nbsp;нам на&nbsp;сервис'" -->
            <form-retarget-component :cities='@json($cities)'
                                     :form_id="'service__form_2'"
                                     :button_text="'Записаться на сервис'"
                                     :form_title="'<span class=\'c_orange\'>Запишись</span> к нам на сервис'"
                                     :form_pre_title="'и получи скидку 5% при визите в день обращения'"
                                     :is_comment='true'
                                     :form_class="'mobile_white_bg'"
                                     :form_type='2'
            ></form-retarget-component>
        </div>
    </div>

    <footer-component :coordinates='@json($data['coordinates'])'
                      :phone='@json($cities['active']['phone'])'
                      :phone_formatted='@json($cities['active']['phone_format'])'
                      :footer_class="'container_bg_dark'"
                      :ym_button='true'
                      :ym_btn_class="'green btn-position'"
                      :cities='@json($cities)'>
    </footer-component>
    {!! html_entity_decode($cities['active']['begin_script']) !!}
    <scroll-event-handler-component></scroll-event-handler-component>
    <event-handler-component></event-handler-component>
@endsection
