@extends('layouts.app2', ['class' => 'bg-gray'])

@section('content')
    <tab-bar :cities='@json($cities)' :models='@json($models)' :phone="'{{$cities['active']['phone']}}'"></tab-bar>
    <header-sticky-component :theme="'light'" :city="'{{$city}}'" ></header-sticky-component>
    <header-component :line="true" :theme="'light'" :city="'{{$city}}'"></header-component>
    <section class="container container-special">
        <div class="car-info-wrap">
            <div class="car-preview-wrap">
               <img src="{{$data['car_preview']->image}}" alt="{{$data['car_preview']->alt}}">
            </div>
            <div class="prices-wrap">
                <div class="model-price-text">
                    <p>от {{number_format($car_attrs[0]['special_price'], 0, ',', ' ')}} руб.</p>
                </div>

                <div class="credit-price-text">
                    <p>В кредит от {{number_format(\App\Helpers\Utilities::getMinimalPayment($car_attrs[0]['price']), 0, ',', ' ')}} руб. / мес.</p>
                </div>
            </div>
        </div>
        <section class="model-details">
            <div class="trigger-wrap">
                <p class="trigger-wrap-text">Осталось <span class="model-count-text">{{$count}}</span> {{$car_model->title}} {{$car_type->title_ru}} по цене лучше, чем на сайте</p>
            </div>

           <steps :brands='@json($brands)'
                   :car_model='@json($car_model)'
                   :car_type='@json($car_type)'
                   :car_attrs='@json($car_attrs)'
                   :cities='@json($cities)'
                   :form_id="'sale__steps_form'"
                   :goal="'fixconditions'"
            ></steps>
        </section>
        <div class="block-note"><p>Предложение ограниченно, подробности в автосалоне</p></div>
        {!! html_entity_decode($cities['active']['begin_script']) !!}
        <scroll-event-handler-component></scroll-event-handler-component>
        <event-handler-component></event-handler-component>
    </section>
@endsection
