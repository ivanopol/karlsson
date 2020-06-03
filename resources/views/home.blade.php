@extends('layouts.app2')

@section('content')
    <tab-bar :theme="'dark'" :cities='@json($cities)' :models='@json($models)' :phone="'{{$cities['active']['phone']}}'"></tab-bar>
    <header-sticky-component :theme="'light'" :city="'{{$city}}'"></header-sticky-component>
    <header-component :absolute="true"  :theme="'light'" :city="'{{$city}}'" ></header-component>
    <section class="main-screen">
        <main-hooper-component :city="'{{$city}}'"></main-hooper-component>
    </section>
    <div class="event-scroll">
        <div class="container">
            <div id="advantages" class="advantages_wrap">
                <h2>Брайт Парк</h2>
                <p>Мы - федеральный дилер LADA, работающий в {{$cities['active']['dative']}} и ещё 5 регионах с 2008 года.</p>
                <ul>
                    <li>
                        <div class="advantage">
                            <span class="value">12</span>
                            <span class="text">банков-<br>﻿партнеров</span>
                        </div>
                    </li>
                    <li>
                        <div class="advantage">
                            <span class="value">15 мин.</span>
                            <span class="text">на одобрение по кредиту</span>
                        </div>
                    </li>
                    <li>
                        <div class="advantage">
                            <span class="value">1 час</span>
                            <span class="text">обмен авто на новенькую LADA</span>
                        </div>
                    </li>
                    <li>
                        <div class="advantage">
                            <span class="value">500</span>
                            <span class="text">авто с ПТС в наличии</span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <buttons-component :cities='@json($cities)'></buttons-component>

        <section id="models" class="models_wrap">
            <div class="container">
                <h2>Модели</h2>
                <ul>
                    @foreach ($models as $model)
                        <li>
                            <a id="main_models_{{$model->slug}}" class="event" href="{{ route('model', ['city' => $city, 'car_model' => $model->slug, 'car_type' => $model->types_preview[0]->slug])}}">
                                <div class="img_wrap">
                                    <img src="{{ $model->preview }}" alt="{{ $model->title }}">
                                </div>
                                <div class="title">{{ $model->title }}</div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>

        <banks-component :cities='@json($cities)'></banks-component>

        <footer-component :coordinates='@json($data['coordinates'])'
                          :phone='@json($cities['active']['phone'])'
                          :phone_formatted='@json($cities['active']['phone_format'])'
                          :cities='@json($cities)'>
        </footer-component>
        <event-handler-component></event-handler-component>
        <scroll-event-handler-component></scroll-event-handler-component>
        {!! html_entity_decode($cities['active']['begin_script']) !!}
    </div>
@endsection
