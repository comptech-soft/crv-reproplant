<template>
    <div 
        class="m-grid__item m-grid__item--fluid m-grid m-grid--center m-grid--hor m-grid__item--order-tablet-and-mobile-1	m-login__content m-grid-item--center" 
        :style="'background-image: url(' + $app.url + '/img/backgrounds/thinkstockphotos-514570178.jpg)'"
    >
        <div class="m-grid__item" style="width: 75%; margin:0px auto">
            <h3 class="m-login__welcome">
                {{ __('Folosiți platforma noastră') }}
            </h3>
            <p class="m-login__msg">
                {{ __('CRV este un lider orientat spre necesitatile fermierului si  ameliorarea bovinelor, cu un obiectiv clar, constind in adăugarea de  valoare atat genetica cat si financiara, finalizata in cresterea  profitabilitatii fermei') }}<br/><br/>
                {{ __('O vacă sănătoasă şi longevivă, care să ofere contribuţia optimă profitului fermei dvs') }}
            </p>
        </div>
    </div>
</template>
