@extends('layouts.app2')

@section('content')
    <tab-bar :theme="'dark'" :cities='@json($cities)' :models='@json($models)' :phone="'{{$cities['active']['phone']}}'"></tab-bar>
    <header-sticky-component :theme="'light'" :city="'{{$city}}'"></header-sticky-component>
    <header-component :absolute="true"  :theme="'light'" :city="'{{$city}}'" ></header-component>
    <section class="main-screen">
        <retargeting-component :city="'{{$city}}'" :offer='@json($offer)'></retargeting-component>
    </section>
    <div class="container">
        <div id="advantages" class="advantages_wrap retargeting_wrap">
            <h1><span class="c_orange">Преимущества</span> покупки сейчас</h1>
            <ul>
                <li>
                    <div class="advantage">
                        <span class="icon"><img src="/build/images/icons/retargeting/pervonchalnyj_vznos.svg" alt="Брайт Парк: 0% первоначальный взнос"></span>
                        <span class="text">0% первоначальный взнос</span>
                    </div>
                </li>
                <li>
                    <div class="advantage">
                        <span class="icon"><img src="/build/images/icons/retargeting/vygoda_v_kredit.svg" alt="Брайт Парк: 10% выгода в кредит"></span>
                        <span class="text">10% выгода<br>в кредит</span>
                    </div>
                </li>
                <li>
                    <div class="advantage">
                        <span class="icon"><img src="/build/images/icons/retargeting/doplata.svg" alt="Брайт Парк: Доплатим 40000 р. при обмене вашего авто"></span>
                        <span class="text">Доплатим 40&nbsp;000 р.<br><span class="text-small">при обмене вашего авто</span></span>
                    </div>
                </li>
                <li>
                    <div class="advantage">
                        <span class="icon"><img src="/build/images/icons/retargeting/stavka.svg" alt="Брайт Парк: Ставка по кредиту от 3,5%"></span>
                        <span class="text">Ставка по кредиту от&nbsp;3,5%</span>
                    </div>
                </li>
            </ul>
        </div>
        <steps :brands='@json($brands)'
               :cities='@json($cities)'
               :form_id="'retarget__steps_form'"
               :goal="'fixconditions'"
        ></steps>
        <baraban :cities='@json($cities)'></baraban>
        <modal-retarget-component></modal-retarget-component>
        <form-retarget-component :cities='@json($cities)'
                                 :form_id="'retarget__form'"
                                 :button_text="'Получить лучшие условия'"
                                 :form_title="'<span class=\'c_orange\'>Оставьте</span> заявку сейчас'"
                                 :goal="'specialoffer'">
        </form-retarget-component>
        <div class="block-note"><p>*Предложение ограниченно, подробности в автосалоне</p></div>
    </div>
    {!! html_entity_decode($cities['active']['begin_script']) !!}
    <scroll-event-handler-component></scroll-event-handler-component>
    <event-handler-component></event-handler-component>
@endsection
