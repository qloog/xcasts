@extends('frontend.layouts.master')

@section('styles')
    <style type="text/css">
    .plan-title{
        font-size: 25px;
        text-align: center;
    }

    .feature{
        border: none !important;
        font-size: 20px;
        text-align: center;
    }
    .feature .regular-price{
        position: absolute;
        top: 5px;
        right: 49%;
    }
    .btn-plan{
        padding: 20px !important;
    }
    .plan{
        overflow: hidden;
        -webkit-transition: all .1s ease-in-out;
        -moz-transition: all .1s ease-in-out;
        -ms-transition: all .1s ease-in-out;
        -o-transition: all .1s ease-in-out;
        transition: all .1s ease-in-out;
    }

    .plan:hover{
        -webkit-transform: scale(1.05);
        -moz-transform: scale(1.05);
        -ms-transform: scale(1.05);
        -o-transform: scale(1.05);
        transform: scale(1.05);
        z-index: 1;
    }

    @media screen and (min-width: 767px) {
    .principal{
        transform: scale(1.05);
    }
    .principal:hover {
        transform: scale(1.1);
        z-index: 1;
    }
    }

    .plan-ribbon{
        font-size: 15px;
        text-transform: uppercase;
        color: #fff;
        background-color: #21ba45;
        padding-top: 10px;
        padding-bottom: 10px;
        padding-left: 55px;
        min-width: 200px;
        text-align: center;
        position: absolute;
        top: 0px;
        right: -45px;
        -webkit-transform: rotate(40deg);
        -moz-transform: rotate(40deg);
        -ms-transform: rotate(40deg);
        -o-transform: rotate(40deg);
        transform: rotate(45deg);
        -webkit-box-shadow: 1px 1px 8px rgba(0, 0, 0 0.2);
        -moz-box-shadow: 1px 1px 8px rgba(0, 0, 0 0.2);
        box-shadow: 1px 1px 8px rgba(0, 0, 0 0.2);
        z-index:1;
        line-height: 10px;
    }

    .plan-ribbon.red{
        background-color: #DB2828;
    }
    .plan-ribbon.green{
        background-color: #21BA45;
    }
    .plan-ribbon.yellow{
        background-color: #FBBD08;
    }
    .amount{
        font-size: 45px;
        line-height: 45px;
        font-weight: 600;
    }
    .regular-price{
        text-decoration: line-through;
        font-weight: 100;
        font-size: 16px;
        color: rgb(190, 190, 190);
    }
    </style>
@endsection

@section('content')

    <div class="ui container">
        <div class="ui header center aligned"></div>
        <div class="ui cards four">
            <div class="ui card">
                <div class="content">
                    <div class="header center aligned">Free</div>
                    <div class="meta center aligned">free and unlimited</div>
                    <div class="ui divider horizontal">$0 / month</div>
                    <div class="ui list">
                        <div class="item"><i class="icon checkmark"></i> <div class="content">
                                Do things
                            </div></div>
                        <div class="item"><i class="icon checkmark"></i> <div class="content">
                                <b>25.000</b> of stuff
                            </div></div>
                        <div class="item"><i class="icon checkmark"></i> <div class="content">
                                <b>30</b> days of history
                            </div></div>
                        <div class="item"><i class="icon checkmark"></i> <div class="content">
                                <b>20</b> is just a number
                            </div></div>
                        <div class="item"><i class="icon checkmark"></i> <div class="content">
                                <b>15</b> is another number
                            </div></div>
                        <div class="item"><i class="icon minus"></i> <div class="content">
                                <b>Default</b> Server
                                <br><small>(50 Petaflops/s)</small>
                            </div></div>
                    </div>
                </div>
                <div class="extra content">
                    <button class="ui button fluid grey disabled">Default</button>
                </div>
            </div>
            <div class="ui card raised">
                <div class="content">
                    <a class="ui label left corner blue">
                        <i class="icon plus"></i>
                    </a>
                    <div class="header center aligned">Premium</div>
                    <div class="meta center aligned">prio ressources</div>
                    <div class="ui divider horizontal">$2 / month</div>
                    <div class="ui list">
                        <div class="item"><i class="icon checkmark blue"></i> <div class="content">
                                Do <b>all</b> things
                            </div></div>
                        <div class="item"><i class="icon checkmark blue"></i> <div class="content">
                                <b>60.000</b> of stuff
                            </div></div>
                        <div class="item"><i class="icon checkmark blue"></i> <div class="content">
                                <b>120</b> days of history
                            </div></div>
                        <div class="item"><i class="icon checkmark blue"></i> <div class="content">
                                <b>100</b> is just a number
                            </div></div>
                        <div class="item"><i class="icon checkmark blue"></i> <div class="content">
                                <b>60</b> is another number
                            </div></div>
                        <div class="item"><i class="icon checkmark blue"></i> <div class="content">
                                <b>Awesome</b> Server
                                <br><small>(50 Petaflops/s)</small>
                            </div></div>
                        <div class="item"><i class="icon checkmark blue"></i> <div class="content">
                                <b>Support</b> the development
                            </div></div>
                    </div>
                </div>
                <div class="extra content">
                    <button class="ui button fluid blue">Order now</button>
                </div>
            </div>
            <div class="ui card">
                <div class="content">
                    <div class="header center aligned">Free</div>
                    <div class="meta center aligned">free and unlimited</div>
                    <div class="ui divider horizontal">$0 / month</div>
                    <div class="ui list">
                        <div class="item"><i class="icon checkmark"></i> <div class="content">
                                Do things
                            </div></div>
                        <div class="item"><i class="icon checkmark"></i> <div class="content">
                                <b>25.000</b> of stuff
                            </div></div>
                        <div class="item"><i class="icon checkmark"></i> <div class="content">
                                <b>30</b> days of history
                            </div></div>
                        <div class="item"><i class="icon checkmark"></i> <div class="content">
                                <b>20</b> is just a number
                            </div></div>
                        <div class="item"><i class="icon checkmark"></i> <div class="content">
                                <b>15</b> is another number
                            </div></div>
                        <div class="item"><i class="icon minus"></i> <div class="content">
                                <b>Default</b> Server
                                <br><small>(50 Petaflops/s)</small>
                            </div></div>
                    </div>
                </div>
                <div class="extra content">
                    <button class="ui button fluid grey disabled">Default</button>
                </div>
            </div>
            <div class="ui card raised">
                <div class="content">
                    <a class="ui label left corner blue">
                        <i class="icon plus"></i>
                    </a>
                    <div class="header center aligned">Premium</div>
                    <div class="meta center aligned">prio ressources</div>
                    <div class="ui divider horizontal">$2 / month</div>
                    <div class="ui list">
                        <div class="item"><i class="icon checkmark blue"></i> <div class="content">
                                Do <b>all</b> things
                            </div></div>
                        <div class="item"><i class="icon checkmark blue"></i> <div class="content">
                                <b>60.000</b> of stuff
                            </div></div>
                        <div class="item"><i class="icon checkmark blue"></i> <div class="content">
                                <b>120</b> days of history
                            </div></div>
                        <div class="item"><i class="icon checkmark blue"></i> <div class="content">
                                <b>100</b> is just a number
                            </div></div>
                        <div class="item"><i class="icon checkmark blue"></i> <div class="content">
                                <b>60</b> is another number
                            </div></div>
                        <div class="item"><i class="icon checkmark blue"></i> <div class="content">
                                <b>Awesome</b> Server
                                <br><small>(50 Petaflops/s)</small>
                            </div></div>
                        <div class="item"><i class="icon checkmark blue"></i> <div class="content">
                                <b>Support</b> the development
                            </div></div>
                    </div>
                </div>
                <div class="extra content">
                    <button class="ui button fluid blue">Order now</button>
                </div>
            </div>
        </div>
    </div>

    <div class="ui container">
        <div class="ui three columns stackable grid">
            <div class="column">
                <div class="ui segments plan">
                    <div class="ui top attached segment violet inverted plan-title">
                        <span class="plan-ribbon yellow">Barato</span>
                        <span class="ui header">Produto 1</span>
                    </div>
                    <div class="ui  attached segment feature">
                        <span class="regular-price">De: R$ 50,00</span>
                        <div class="amount">R$ 40,50</div>
                    </div>
                    <div class="ui  attached secondary segment feature">
                        <i class="icon red remove"></i>
                        Item 2
                    </div>
                    <div class="ui  attached segment feature">
                        <i class="icon red remove"></i>
                        Item 3
                    </div>
                    <div class="ui bottom attached violet button btn-plan">
                        <i class="cart icon"></i>
                        Selecionar Pacote
                    </div>

                </div>
            </div>
            <div class="column">
                <div class="ui segments plan principal">
                    <div class="ui top attached segment violet inverted plan-title">
                        <span class="plan-ribbon green">POPULAR</span>
                        <span class="ui header">Produto 2</span>
                    </div>
                    <div class="ui  attached segment feature">
                        <span class="regular-price">De: R$ 50,00</span>
                        <div class="amount">R$ 40,50</div>
                    </div>
                    <div class="ui  attached secondary segment feature">
                        <i class="icon green check"></i>
                        Item 2
                    </div>
                    <div class="ui  attached segment feature">
                        <i class="icon red remove"></i>
                        Item 3
                    </div>
                    <div class="ui bottom attached violet button btn-plan">
                        <i class="cart icon"></i>
                        Selecionar Pacote
                    </div>

                </div>
            </div>
            <div class="column">
                <div class="ui segments plan">
                    <div class="ui top attached segment violet inverted plan-title">
                        <span class="plan-ribbon red">HOT</span>
                        <span class="ui header">Produto 3</span>
                    </div>
                    <div class="ui attached segment feature">
                        <span class="regular-price">De: R$ 50,00</span>
                        <div class="amount">R$ 40,50</div>
                    </div>
                    <div class="ui attached secondary segment feature">
                        <i class="icon green check"></i>
                        Item 2
                    </div>
                    <div class="ui attached segment feature">
                        <i class="icon green check"></i>
                        item 3

                    </div>
                    <div class="ui bottom attached violet button btn-plan">
                        <i class="cart icon"></i>
                        Selecionar Pacote
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection