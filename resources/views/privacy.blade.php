@extends('layouts.app2')

@section('content')
    <tab-bar :theme="'dark'" :cities='@json($cities)' :models='@json($models)' :phone="'{{$cities['active']['phone']}}'"></tab-bar>
    <header-sticky-component :theme="'light'" :city="'{{$city}}'"></header-sticky-component>
    <header-component :absolute="true"  :theme="'light'" :city="'{{$city}}'" ></header-component>
    <div class="container p-top-90">
        <div class="stocks-wrapper">
        <h1 class="ad_h1">Политика конфиденциальности</h1>
        <div class="stocks-one">
            <div class="stocks-one-body">
                <p>г.Пермь</p>
                <p>Настоящая  Политика  конфиденциальности  персональных  данных  (далее - Политика   конфиденциальности)   действует  в  отношении  всей  информации, размещенной     на     сайте     в     сети     Интернет     по     адресу: https://brightpark.ru/ (далее - Сайт), которую Администрация Сайта и ООО «ОДАС» (ИНН 5906099710) могут  получить о Пользователе  во  время  использования  Сайта,  его  сервисов,  программ  и продуктов. Использование сервисов Сайта означает безоговорочное согласие Пользователя с настоящей Политикой и указанными в ней условиями обработки его персональной информации. В случае несогласия с этими условиями Пользователь должен воздержаться от использования сервисов.</p>
                <h3>1. ОБЩИЕ ПОЛОЖЕНИЯ</h3>
                <p>
            1.1. В рамках настоящей Политики под персональной информацией Пользователя понимаются:<br>
            1.1.1. Персональная информация, которую Пользователь предоставляет о себе самостоятельно при регистрации (создании учетной записи) или в процессе использования Сервисов, включая персональные данные Пользователя, в том числе имя, отчество, фамилия, номер мобильного или(и) стационарного  телефона Пользователя, адрес электронной почты Пользователя,  id Пользователя социальной сети. Обязательная для предоставления Сервисов информация помечена специальным образом. Иная информация предоставляется Пользователем на его усмотрение.<br>
            1.1.2. Данные, которые автоматически передаются сервисам Сайта в процессе их использования с помощью установленного на устройстве Пользователя программного обеспечения, в том числе IP-адрес, данные файлов cookie, информация о браузере Пользователя (или иной программе, с помощью которой осуществляется доступ к сервисам), технические характеристики оборудования и программного обеспечения, используемых Пользователем, дата и время доступа к сервисам, адреса запрашиваемых страниц и иная подобная информация.<br>
            1.1.3. Настоящая Политика конфиденциальности применяется только к Сайту https://brightpark.ru/. Сайт https://brightpark.ru/ не контролирует и не несет ответственности за сайты третьих лиц, на которые Пользователь может перейти по ссылкам, доступным на Сайте https://brightpark.ru/.<br>
                </p>
                <h3>2. ЦЕЛИ ОБРАБОТКИ ПЕРСОНАЛЬНОЙ ИНФОРМАЦИИ ПОЛЬЗОВАТЕЛЕЙ</h3>
                <p>
            2.1. Предметом деятельности ООО «ОДАС» (ИНН 5906099710) является: торговля розничная легковыми автомобилями и легкими автотранспортными средствами в специализированных магазинах.<br>
            Сайт собирает, обрабатывает и хранит только ту персональную информацию, которая необходима для предоставления сервисов или исполнения соглашений и договоров с Пользователем, за исключением случаев, когда законодательством предусмотрено обязательное хранение персональной информации в течение определенного законом срока.<br>
            2.2. Персональную информацию Пользователя Сайт обрабатывает в следующих целях:<br>
            2.2.1. Идентификации Пользователя, зарегистрированного на Сайте.<br>
            2.2.2. Предоставления Пользователю доступа к персонализированным ресурсам Сайта.<br>
            2.2.3. Установления с Пользователем обратной связи, включая направление уведомлений, запросов, касающихся использования Сайта, обработку запросов и заявок от Пользователя на услуги, товары ООО «ОДАС» (ИНН 5906099710).<br>
            2.2.4. Определения места нахождения Пользователя для обеспечения безопасности, предотвращения мошенничества.<br>
            2.2.5. Подтверждения достоверности и полноты персональных данных, предоставленных Пользователем.<br>
            2.2.6. Предоставления Пользователю эффективной клиентской и технической поддержки при возникновении проблем, связанных с использованием Сайта.<br>
                <p>
                <h3>3. УСЛОВИЯ ОБРАБОТКИ ПЕРСОНАЛЬНОЙ ИНФОРМАЦИИ ПОЛЬЗОВАТЕЛЕЙ</h3>
            <p>И ЕЕ ПЕРЕДАЧИ ТРЕТЬИМ ЛИЦАМ<br>
            3.1. Сайт хранит персональную информацию Пользователей в соответствии с внутренними регламентами конкретных сервисов.<br>
            3.2. В отношении персональной информации Пользователя сохраняется ее конфиденциальность, кроме случаев добровольного предоставления Пользователем информации о себе для общего доступа неограниченному кругу лиц. При использовании отдельных сервисов Пользователь соглашается с тем, что определенная часть его персональной информации становится общедоступной.<br>
            3.3. Сайт вправе передать персональную информацию Пользователя третьим лицам в одном из следующих случаев:<br>
            3.3.1. Пользователь выразил согласие на такие действия.<br>
            3.3.2. Передача необходима для использования Пользователем определенного сервиса либо для исполнения определенного соглашения или договора с Пользователем.<br>
            3.3.4. Передача предусмотрена российским или иным применимым законодательством в рамках установленной законодательством процедуры.<br>
            3.3.5. В случае продажи Сайта к приобретателю переходят все обязательства по соблюдению условий настоящей Политики применительно к полученной им персональной информации.<br>
            3.4. Обработка персональных данных Пользователя осуществляется без ограничения срока любым законным способом, в том числе в информационных системах персональных данных с использованием средств автоматизации или без использования таких средств. Обработка персональных данных Пользователей осуществляется в соответствии с Федеральным законом от 27.07.2006 № 152-ФЗ «О персональных данных».<br>
            3.5. Администрация Сайта принимает необходимые организационные и технические меры для защиты персональной информации Пользователя от неправомерного или случайного доступа, уничтожения, изменения, блокирования, копирования, распространения, а также от иных неправомерных действий третьих лиц.<br>
            3.6. Администрация Сайта совместно с Пользователем принимает все необходимые меры по предотвращению убытков или иных отрицательных последствий, вызванных утратой или разглашением персональных данных Пользователя.<br>
            </p>
            <h3>4. ОБЯЗАТЕЛЬСТВА СТОРОН</h3>
            <p>4.1. Пользователь обязан:<br>
            4.1.1. Предоставить информацию о персональных данных, необходимую для пользования Сайтом.<br>
            4.1.2. Обновлять, дополнять предоставленную информацию о персональных данных в случае изменения данной информации.<br>
            4.2. Администрация Сайта обязана:<br>
            4.2.1. Использовать полученную информацию исключительно для целей, указанных в настоящей Политике конфиденциальности.<br>
            4.2.2. Обеспечить хранение конфиденциальной информации в тайне, не разглашать без предварительного письменного разрешения Пользователя, а также не осуществлять продажу, обмен, опубликование либо разглашение иными возможными способами переданных персональных данных Пользователя, за исключением предусмотренных настоящей Политикой конфиденциальности.<br>
            4.2.3. Принимать меры предосторожности для защиты конфиденциальности персональных данных Пользователя согласно порядку, обычно используемому для защиты такого рода информации в существующем деловом обороте.<br>
            4.2.4. Осуществить блокирование персональных данных, относящихся к соответствующему Пользователю, с момента обращения или запроса Пользователя или его законного представителя либо уполномоченного органа по защите прав субъектов персональных данных на период проверки в случае выявления недостоверных персональных данных или неправомерных действий.<br>
            </p>
            <h3>5. ОТВЕТСТВЕННОСТЬ СТОРОН</h3>
            <p>5.1. Администрация Сайта, не исполнившая свои обязательства, несет ответственность, в соответствии с законодательством Российской Федерации.  <br>
            5.2. В случае утраты или разглашения конфиденциальной информации Администрация Сайта не несет ответственности, если данная конфиденциальная информация:<br>
            5.2.1. Является публичной (общедоступной).<br>
            5.2.2. Была получена от третьей стороны до момента ее получения Администрацией Сайта.<br>
            5.2.3. Была разглашена с согласия Пользователя.<br>
            </p>
                <h3>6. РАЗРЕШЕНИЕ СПОРОВ</h3>
            <p>6.1. До обращения в суд с иском по спорам, возникающим из отношений между Пользователем и Администрацией Сайта, ООО «ОДАС» (ИНН 5906099710) обязательным является предъявление претензии (письменного предложения о добровольном урегулировании спора).<br>
            6.2. Получатель претензии в течение 15 (пятнадцати) календарных дней со дня получения претензии письменно уведомляет заявителя претензии о результатах рассмотрения претензии.<br>
            6.3. При недостижении соглашения спор будет передан на рассмотрение в суд в соответствии с действующим законодательством Российской Федерации.<br>
            6.4. К настоящей Политике конфиденциальности и отношениям между Пользователем и Администрацией Сайта применяется действующее законодательство Российской Федерации.<br>
            </p>
                <h3>7. ДОПОЛНИТЕЛЬНЫЕ УСЛОВИЯ</h3>
            <p>
                7.1. Администрация Сайта вправе вносить изменения в настоящую Политику конфиденциальности без согласия Пользователя.<br>
            7.2. Новая Политика конфиденциальности вступает в силу с момента ее размещения на Сайте, если иное не предусмотрено новой редакцией Политики конфиденциальности.<br>
            7.3. Все предложения или вопросы по настоящей Политике конфиденциальности следует сообщать по электронному адресу: info@brightpark.ru.<br>
            7.4. Действующая Политика конфиденциальности размещена на странице по адресу: https://brightpark.ru/.<br>
            7.5. Настоящая Политика конфиденциальности является неотъемлемой частью Соглашения об использовании Сайта, размещенного на странице по адресу: https://brightpark.ru/.<br>
            </p>
            </div>
        </div>
    </div>
    {!! html_entity_decode($cities['active']['begin_script']) !!}
    <scroll-event-handler-component></scroll-event-handler-component>
    <event-handler-component></event-handler-component>
@endsection
