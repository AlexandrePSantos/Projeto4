<!-- BASE HEADER -->
<meta charset="utf-8"/>
<!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
<!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
<link rel="shortcut icon" type="image/png" href="/img/favicon.png"/>
<link rel="stylesheet" href="/css/bootstrap.min.css">

<link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,700">
<link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oswald:400,700,300">

<!--<link rel="stylesheet" href="/css/font-awesome.min.css">-->

<!--<script src="https://kit.fontawesome.com/20df1a1798.js" crossorigin="anonymous"></script>-->
<script src="/js/fontawesome.js"></script>


<link href="/js/vendors/DataTables/media/css/jquery.dataTables.css" rel="stylesheet" type="text/css">
<link href="/js/vendors/DataTables/media/css/dataTables.bootstrap.css" rel="stylesheet" type="text/css">

<link type="text/css" rel="stylesheet" href="/css/style-responsive.css">
<link type="text/css" rel="stylesheet" href="/css/orange-blue.css">
<link rel="stylesheet" type="text/css" href="/css/gesautarquia.css">
<link rel="stylesheet" type="text/css" href="/css/gesfaturacao.css">

<link type="text/css" rel="stylesheet" href="/js/vendors/iCheck/skins/all.css">
<link type="text/css" rel="stylesheet" href="/js/vendors/sco.message/sco.message.css">

<!-- STYLES POS -->
<style type="text/css">
    :root {
        --dark-red-color: #a52a2a;
        --red-color: #cd0c0d;
        --soft-red-color: #bf4346;
        --error-color: tomato;
        --blue-color: #337ab7;
        --green-color: #488c6c;
        --orange-color: #f79c1d;
        --yellow-color: #f7d31d;
        --light-blue: #f1f8ff;
        --light-grey: #f3f0f0;
        --grey--color: grey;
        --light-black-color: #393e46;
        --light-purple-color: #7269ae;
        --dark-soft-color: #202224;
        /*--main-color: #e86646;
        --secondary-color: #ba4d34;*/
        --info-blue-color: #5bc0de;
        --table-background-hover : #151B31FF;
        --dark-blue-color : #34495e;

        --out-color: #f7d31d;
        --in-color: #488c6c;

        /*black*/
       /* --main-color: #2b2b2b;
		--secondary-color: #393939;*/

        /*blue*/
         /*--main-color: #3078bf;
		 --secondary-color: #1f4f7e;*/

        /*green*/
        /*--main-color: #43a24d;
        --secondary-color: #378341;*/

        /*red*/
        /*--main-color: #ba2020;
        --secondary-color: #9b1a1a;*/

        --text-color : whitesmoke
    }

    body {
        /*background-color: #2f363b !important;*/
       /* color: #FFFFFF;*/
        height: 100% !important;
    }

    .main-color{
        color: var(--text-color);
        background-color:  var(--main-color) !important;
        font-weight: bold;
    }
    .span-name-cliente,.name-category,.icon-category,.tab-room-pagina, .tab-pagina,.product-price-tag, .product-price-tag-attribute ,.partial-payment{
        color: var(--text-color);
        font-weight: bold;
    }

    .name-product,#tableEntry,#date_time,#table-clientes,.display-total{
        font-weight: bold;
    }

    .display-total{
        vertical-align:center;
        background-color: var(--light-black-color);
        color: white;
    }

    .no-padding-right {
        padding-right: 0px !important;
    }

    .padding-right-5 {
        padding-right: 5px !important;
    }

    .padding-right-2 {
        padding-right: 2px !important;
    }

    .no-padding-left {
        padding-left: 0px !important;
    }

    /* #panelMainContent{overflow-y: scroll !important; height: 92vh !important; padding-bottom: 8vh !important;} */
    #panelMainContent {
        overflow: hidden !important;
        height: 91.3vh !important;
        padding-bottom: 8vh !important;
        border-radius: 10px;
    }

    #panelMainContent {
        -ms-overflow-style: none !important;
        overflow: -moz-scrollbars-none !important;
    }

    #panelMainContent::-webkit-scrollbar {
        display: none !important;
    }

    #loadingMsgField {
        color: #555 !important;
        font-size: 16px !important;
        font-weight: bolder !important;
        text-align: center !important;
    }

    .panel > .panel-heading.panel-head-special {
        padding: 0px !important;
    }

    .left-items-head {
        border-right: 2px solid #fff !important;
    }

    .right-items-head {
        border-left: 2px solid #fff !important;
    }

    /* ====== MAIN PAGE CONTAINERS ====== */
    #categoriesContainer {
        overflow-x: scroll !important;
       /* background-color: var(--main-color) !important;*/

        width: 100% !important;
        height: 100px !important;
        /*overflow-x: hidden !important;*/
        overflow-y: hidden !important;
        margin: 0 auto !important;
        white-space: nowrap !important;
       /* border: 2px solid var(--secondary-color) !important;*/
       /* border-right: 2px solid var(--secondary-color);
        border-bottom: 2px solid var(--secondary-color) ;
        border-left: 2px solid var(--secondary-color);*/
    }

    #categoriesContainer {
        -ms-overflow-style: none !important;
        -ms-overflow-style: -ms-autohiding-scrollbar !important;
        overflow: -moz-scrollbars-none !important;
    }

    #categoriesContainer::-webkit-scrollbar {
        display: none !important;
    }

    .category_item {
        text-align: center !important;
        width: 100px !important;
        height: 100px !important;
        display: inline-block !important;
        background-color: var(--main-color) !important;
      /*  border-right: 2px solid var(--secondary-color) !important;*/
        cursor: pointer !important;
        color: #fff !important;
        padding-right: 5px !important;
        padding-left: 5px !important;
        margin-left: 1px;
        margin-right: 1px;
    }

    .category_item:first-child {
        margin-left: 0px;
    }

    .category_item:last-child {
        /*border-right: 0px solid var(--secondary-color) !important;*/
    }

    /*.category_item:hover, .category_item:focus { background-color: #ba4d34 !important; }*/
    .category_item:hover {
        background-color: var(--secondary-color) !important;
    }

    .active_category {
        background-color: var(--secondary-color) !important;
    }

    .icon-category {
        margin-top: 15px !important;
        margin-bottom: 10px !important;
    }

    .category_item div{
        text-transform: capitalize;
    }

    .name-category {
        height: 30px !important;
        width: 90px !important;
        overflow: hidden !important;
        text-overflow: ellipsis !important;

    }




    .product_wrapper,.product_wrapper_attributes  {
        text-align: center !important;
        width: 170px !important;
        height: 150px !important;
        cursor: pointer !important;
        float: left !important;
        padding: 0px 5px 0px 0px !important;
        margin-bottom: 10px !important;
        position: relative;
    }

    .product_item {
        text-align: center !important;
        width: 100% !important;
        height: 139px !important; /*display: inline-block !important;*/
        border: 1px solid #777 !important;
        cursor: pointer !important;
        -webkit-box-shadow: 0 5px 10px 0 #666666 !important;
        box-shadow: 0 5px 10px 0 #666666 !important;
    }

    .product_item:nth-child(5n+0) {
        margin-right: 0px !important;
    }

    /*.product_item:hover, .product_item:focus { opacity: 0.6 !important; filter: alpha(opacity=50); }*/
    .active_product {
        opacity: 0.5 !important;
        filter: alpha(opacity=50);
    }

    .image-product {
        width: 100% !important;
        margin: auto !important;
        text-align: center !important;
       /* height: 100px !important;*/
        overflow: hidden !important;
        height: 100% !important;
    }

    .imagePos {
        /*max-width: 100% !important;*/
       /* height: 100% !important;
        margin: auto !important;
        text-align: center !important;
        display: block !important;*/
        height: 100% !important;
        margin: auto !important;
        text-align: center !important;
        display: block !important;
    }

    .name-product {
        /*color: #fff !important;
        height: 37px !important;
        !*height: 50px !important;*!
        width: 100% !important;
        background-color: #2f363b !important;
        word-wrap: break-word !important;
        -ms-word-break: break-all !important;
        word-break: break-all !important;
        word-break: break-word !important;
        overflow: hidden !important;
        padding-top: 10px !important;
        padding-left: 5px !important;
        padding-right: 5px !important;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;*/

        color: #fff !important;
        height: 37px !important;
        width: -moz-available;
        width: -webkit-fill-available;
        background-color: #2f363b75 !important;
        word-wrap: break-word !important;
        -ms-word-break: break-all !important;
        word-break: break-all !important;
        word-break: break-word !important;
        overflow: hidden !important;
        padding-top: 10px !important;
        padding-left: 5px !important;
        padding-right: 5px !important;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        margin-right: 3px !important;

        position: absolute;
        top: 102px;
    }

    @-moz-document url-prefix() {

        .name-product {
            margin-right: 2px !important;
        }
    }

    #wrapperCategoriesArrows {
        width: 100% !important;
        height: 100px !important;
      /*  border: 2px solid var(--secondary-color) !important;*/
        /*border-left: 0px !important;*/
        background-color: var(--main-color) !important;
    }

    .no-border-right{
        border-right: 0 !important;
    }

    .cat_arrow_left {
       /* height: 96px !important; padding-right: 3px !important;*/
        height: 100%;
        padding: 2px !important;
    }

    .cat_arrow_right {
      /*  height: 96px !important;
        padding-left: 3px !important;*/
        height: 100%;
        padding: 2px !important;
    }

    .cat_arrow_left p {
        background-color: #fff !important;
       /* height: 96px !important;*/
        height: 100%;
        padding-top: 35px !important;
    }

    .cat_arrow_right p {
        background-color: #fff !important;
      /*  height: 96px !important;*/
        height: 100%;
        padding-top: 35px !important;
    }

    .prod_arrow_up p,.prod_arrow_down p {
        background-color: #fff !important;
    }

    .arrow_clicker {
        cursor: pointer !important;
    }

    #sidebarSellContainer {
        overflow-y: hidden !important;
        border-left: 3px solid var(--main-color);
        /* height: -webkit-calc(82vh - 10px) !important;
        height: expression(82vh - 10px) !important;
        height: -moz-calc(82vh - 10px) !important;
        height: -o-calc(82vh - 10px) !important;
        height: calc(82vh - 10px) !important;   */
       /* height: 84vh !important;*/
        height: 80vh !important;
        padding-left: 12px !important;
        padding-right: 12px !important;
        position: relative;
    }

    #productsContainer {
        overflow-y: hidden !important;
        /* height: -webkit-calc(82vh - 10px) !important;
        height: expression(82vh - 10px) !important;
        height: -moz-calc(82vh - 10px) !important;
        height: -o-calc(82vh - 10px) !important;
        height: calc(82vh - 10px) !important;  */
        position: relative;
        height: 84vh !important;
        overflow-x: hidden;
        z-index: 1;
    }

    #productsContainerDisplay {
        padding-right: 0px !important;
        margin-top: 5px !important;
        overflow-y: auto !important;
        /* height: -webkit-calc(82vh - 125px) !important;
        height: expression(82vh - 125px) !important;
        height: -moz-calc(82vh - 125px) !important;
        height: -o-calc(82vh - 125px) !important;
        height: calc(82vh - 125px) !important;  */
        height: 73.5vh !important;

    }

    /*#productsContainerDisplay::-webkit-scrollbar,#tableClientes::-webkit-scrollbar {
        width: 12px !important;
        height: 20px !important;
        border-right: 0px solid #fff !important;
    }

    #productsContainerDisplay::-webkit-scrollbar-track ,#tableClientes::-webkit-scrollbar-track{
        background-color: #2f363b !important;
        border-right: 0px solid #fff !important;
    }

    #productsContainerDisplay::-webkit-scrollbar-thumb ,#tableClientes::-webkit-scrollbar-thumb {
        background-color: var(--main-color) !important;
        border-right: 0px solid #fff !important;
    }

    #productsContainerDisplay::-webkit-scrollbar-thumb:hover,#tableClientes::-webkit-scrollbar-thumb:hover {
        background-color: var(--secondary-color) !important;
        border-right: 0px solid #fff !important;
    }*/

    /*#productsContainerDisplay::-webkit-scrollbar-track-piece {
        background-color: #2f363b !important;
        border: 1px solid #ba4d34 !important;
    }*/
    /* ====== ./MAIN PAGE CONTAINERS ====== */
    .fullscreen {
        filter: alpha(opacity=8) !important;
        -khtml-opacity: 0.8 !important;
        -moz-opacity: 0.8 !important;
        opacity: 0.8 !important;
    }

    .fullscreen i {
        color: #555 !important;
    }

    .special_pos_footer {
        position: fixed !important;
        background: transparent !important;
    }

    .special_pos_footer .container {
        padding: 0px !important;
        max-width: 1140px !important;
    }

    .page-content {
        padding: 0px;
        padding-top: 20px !important;
        padding-bottom: 20px !important;
        min-height: 90vh !important;
        clear: both;
    }

    .panel.panel-blue-depth {
        border: 0;
        border-color: #252525;
        min-height: 92vh !important;
        max-height: 92vh !important;
        overflow-y: hidden !important;
        background-color: transparent;
    }

    .numpadWrpClass {
        background-color: #d9d9d9 !important;
    }

    .bg-geral-one {
        background-image: url('/gesfaturacao/base/bg_geral_01.png');
        background-repeat: no-repeat;
        background-size: cover;
    }

    /*.bg-geral-two {
        background-image: url('/gesfaturacao/base/bg_geral_02.png');
        background-repeat: no-repeat;
        background-size: cover;
    }*/

    .bg-geral-two{
        border: none !important;
    }

    .breadcrumb {
        background: transparent !important;
        min-height: 40px !important;
        /*padding: 5px 0px !important;*/
        line-height: 40px;
        text-align: center;
       /* padding-left: 70px;*/
    }

    .breadcrumb .active {
        color: #FFF !important;
    }

    .options-bar {
        line-height: 40px !important;
    }

    .options-bar .only-ic {
        font-size: 35px !important;
    }

   /* .options-bar .only-ic:hover {
        filter: alpha(opacity=8) !important;
        -khtml-opacity: 0.8 !important;
        -moz-opacity: 0.8 !important;
        opacity: 0.8 !important;
        color: #ffffff !important;
    }*/

   /* .only-ic:hover{
        filter: brightness(100);
    }*/

    .options-bar .only-ic.username-smaller {
        font-size: 20px !important;
    }

    .right-options-wrapper {
        line-height: 40px !important;
        visibility: hidden;
    }

    .right-options-pos-wrapper {
        line-height: 40px !important;
    }

    .space-right {
        margin-right: 10px;
    }

    .space-right-big {
        margin-right: 30px;
    }

    .special_menu {
        max-height: 175px !important;
        overflow: hidden !important;
    }

    img.logo-pos-topo {
        max-height: 40px !important;
    }

    .modulo-item {
        white-space: nowrap !important;
        overflow: hidden !important;
        text-overflow: ellipsis !important;
        border-color: #FFFFFF;
        color: #FFFFFF;
    }

    .bg-white {
        background-color: #ffffff;
        color: #2d3338;
    }

    .bg-grey {
        background-color: #2f363b;
        color: #ffffff;
    }

    em.invalid {
        display: none !important;
    }

    .pad-box {
        padding: 4px;
        line-height: 38px !important;
    }

    .pad-box .label-txt {
        font-size: 16px;
    }

    .pad-box .label-txt i {
        line-height: 38px !important;
    }

    .pad-box-input {
        padding: 0px;
    }

    .pad-box-input input {
        border-color: #ffffff;
        height: 65px !important;
        font-size: 20px !important;
    }

    .pad-box-input input[readonly] {
        background-color: #ffffff
    }

    .pad-box-button button {
        height: 46px !important;
    }

    .pad-box-button .pad-box-button .btn:focus {
        color: #ffffff;
    }

    .pad-box-small {
        padding: 2px;
        line-height: 30px !important;
    }

    .pad-box-small .label-txt {
        font-size: 12px;
    }

    .pad-box-numpad {
        text-align: center !important;
        border-color: #ffffff !important;
        border: 1px solid;
        padding: 0px !important;
    }

    .pad-box-numpad button {
        height: 46px !important;
        background-color: #d9d9d9;
        font-size: 20px;
        font-weight: bolder;
        color: #2d3338
    }

    .pad-box-numpad button i {
        font-size: 20px;
        font-weight: bolder;
    }

    .pad-box-confirm {
        padding: 0px !important;
    }

    .pad-box-confirm button {
        height: 46px !important;
        font-size: 16px;
    }

    .pad-box-confirm a.btn {
        height: 46px !important;
        line-height: 32px;
        font-size: 16px;
    }

    .pad-box-confirm.leftbtn {
        padding-right: 5px !important;
    }

    .pad-box-confirm.rightbtn {
        padding-left: 5px !important;
    }

    .img_user_circle {
        border: 3px solid #efefef;
        box-shadow: 0 2px 3px rgba(0, 0, 0, 0.30);
        max-height: 150px;
    }

    .img_user_circle_small {
        border: 3px solid #efefef;
        box-shadow: 0 2px 3px rgba(0, 0, 0, 0.30);
        max-height: 140px;
    }

    /* .pad-main{
        height: 56px !important;
        vertical-align: middle !important;
        padding: 0px !important;
    }  */
    .numpad-btn {
        height: 100% !important;
    }

    .pad-main-double {
        height: 96px;

    }

    #search-input {
        /*color: #2d3338;
        transform: translate(-155px);
        margin-left: 0px;
        border-radius: 50px;
        position:absolute;
        padding: 5.5px 5px; */

        /*margin-top:2px;*/
    }

    .line-height {
        line-height: 30px;
    }

    .button-pressed {
        background-color: var(--main-color);
    }

    #burger-create-menu,#burger-rooms-menu {
        background-color: #2f363b;
        width: 300px;
        padding: 4px 3px;
        position: absolute;
        z-index: 600;
        margin-top: 0px;
        border-top: 1px solid #393e46;
       /* margin-left: 206px;
        top:115px*/
        right: 186px;
        top:81px
    }

    #burger-rooms-menu {
        right: 434px;
        top:81px
    }

    /*
        #burger-button{
            display: inline !important;
        }

        #burger-icon{
            display: inline !important;
        }
        #burger-wrapper{
            text-align: center !important;
            padding: 5px 2px !important;
            height: 35px !important;
            width: 40px !important;
        } */


    #burger-menu-wrapper {
        background-color: #2f363b;
        width: 300px;
        padding: 4px 3px;
        position: absolute;
        z-index: 600;
        margin-top: 5px;
        border-top: 1px solid var(--light-black-color);
    }

    #burger-menu-wrapper-caixa {
        background-color: #2f363b;
        width: 300px;
        padding-bottom: 4px;
        padding-top: 0px;
        padding-left: 0px;
        padding-right: 1px;
        position: absolute;
        z-index: 600;
        margin-left: 295px;
        margin-top: 290px;
    }

    #burger-menu-wrapper-impressao {
        background-color: #2f363b;
        width: 300px;
        padding-bottom: 0px;
        padding-top: 4px;
        padding-left: 0px;
        padding-right: 1px;
        position: absolute;
        z-index: 600;
        margin-left: 295px;
        margin-top: 44px;
        border-top: 1px solid var(--light-black-color);
    }

    #burger-menu-wrapper-documentos {
        background-color: #2f363b;
        width: 300px;
        padding-bottom: 0px;
        padding-top: 0px;
        padding-left: 0px;
        padding-right: 1px;
        position: absolute;
        z-index: 600;
        margin-left: 295px;
        margin-top: 148;
        border-top: 1px solid var(--light-black-color);
    }

    .menu-item {
        background-color: #131313;
        margin: 5px;
        vertical-align: middle;
        text-align: center;
        font-size: 16px;
        font-weight: bolder;
    }

    .menu-item > button {
        padding: 20px;
        font-size: 16px;
        font-weight: bolder;
    }


    .menu-item-active > .btn.with-submenu.focus, .menu-item-active > .btn.with-submenu:focus, .menu-item-active > .btn.with-submenu:hover {
        color: white !important;
    }

    .btn-dropdown-menu {
        background-color: inherit;
        padding: 0;
        font-size: 2rem;
    }


    .menu-item-active {
        background-color: var(--main-color);
        color: white;
    }

    .menu-item button:hover {
        background: #131313;
    }

    .menu-ul {
        list-style-type: none;
        padding: 0px;
        color: black;
        text-align: center;
        font-weight: 400;
        font-size: 1.8rem;
    }

    .center {
        margin: auto;
        width: 100%;
    }

    .arrow-right-burger {
        vertical-align: middle;
        padding: 0px !important;
        display: inline-block;
    }

    a {
        text-decoration: none;
        color: inherit;
    }

    a:hover {
        text-decoration: none;
    }

    .text-burger-span {
        display: inline-block;
        margin: 0px;
        padding: 0px;
    }

    .burger-button:hover {
        color: black;
    }

    .burger-button:visited {
        color: black;
    }

    .low-bright {
        filter: brightness(50%);
    }

    .table-posto {
        /* border: 2px solid #2f363b; */
        border-collapse: collapse;
        margin: 0;
        padding: 0;
        /* width: 352px !important; */
        width: 100%;
        table-layout: fixed !important;
        color: black;
        font-size: 1.4rem;

        border: 0px !important;
        border-bottom: 1px solid black;
        max-height: 324px;
        display: inline-block;
        overflow-y: scroll;
    }

    .table-bigger {
        max-height: 520px !important;
    }

    .table-biggest {
        max-height: 70% !important;
    }

    .table-posto thead {
        position: fixed;
        margin-bottom: 28px;
    }

    .table-posto tbody tr:first-child td {
        padding-top: 42px !important;
    }

    .table-posto tbody tr:first-child td:last-child {
        padding-top: 35px !important;
    }

    .numpadMainWrapper {
        width: 389px !important;
    }

    .table-posto tr {
        background-color: white;
        border: 2px solid #2f363b;
        padding-top: .35em;
    }

    .table-posto th,
    .table-posto td {
        padding-top: 1em;
        padding-bottom: 1em;
        padding-left: 0px;
        padding-right: 0px;
        text-align: center;
    }

    .table-posto th {
        font-size: .85em;
        letter-spacing: .1em;
    }

    .table-posto thead tr th {
        padding: 5px;
    }

    /* .table-posto tbody tr:first-child{
      background-color: var(--light-black-color;
      color: white;
    } */
    .article-clicked {
        background-color: var(--light-black-color) !important;
        color: white !important;
    }

    .article-not-clicked {
        background-color: white !important;
        color: black !important;
    }

    .table-posto tbody td:last-child {
        background-color: var(--main-color);
        color: white;
        text-transform: uppercase;
        padding: 0px;
        font-size: 2rem;
        font-weight: bold;
    }

    .table-posto thead th:last-child {
        width: 50px;
    }

    .exit-product {
        text-decoration: none;
        color: white;
    }

    #col-qtd {
        width: 90px;
    }

    #col-produto {
        width: 100px
    }

    #button-header-cliente{
        background-color: var(--main-color);
    }

    #final-nif-val,#button-header-cliente-nif{
        background-color: var(--blue-color);
        cursor: pointer;
    }

    .client-header {
        text-align: center;
        background-color: var(--secondary-color);
        /*  background-image: linear-gradient(to bottom right, #e9662c, #ba4d34);*/
        font-size: 1.5rem;
        color: white;
        padding: 10px;
        margin-bottom: 8px;
        vertical-align: middle;
        width: 100%;
    }

    .numpad-btn {
        width: 100% !important;
        margin: 0px !important;
    }

    .numpad-active {
        background-color: var(--main-color) !important;
        color: white !important;
    }

    .numpadMainWrapper {
        position: fixed;
        width: 348px;
        bottom: 75px;
    }

    .priceLabelPos{
	    display: none;
    }

    table::-webkit-scrollbar {
        width: 0 !important;
    }

    .table-scroll {
        max-height: 300px;
        overflow-y: scroll;
        overflow-x: hidden;
        display: block;
        border: 0px !important;
        text-align: left;
        table-layout: fixed;
    }


    #pagamento {
        -webkit-box-shadow: 4px 4px 13px -7px rgba(0, 0, 0, 0.75);
        -moz-box-shadow: 4px 4px 13px -7px rgba(0, 0, 0, 0.75);
        box-shadow: 4px 4px 13px -7px rgba(0, 0, 0, 0.75);
    }

    #seta {
        -webkit-box-shadow: 4px 4px 13px -7px rgba(0, 0, 0, 0.75);
        -moz-box-shadow: 4px 4px 13px -7px rgba(0, 0, 0, 0.75);
        box-shadow: 4px 4px 13px -7px rgba(0, 0, 0, 0.75);
    }

    #confirmar-button {
        -webkit-box-shadow: 4px 4px 13px -7px rgba(0, 0, 0, 0.75);
        -moz-box-shadow: 4px 4px 13px -7px rgba(0, 0, 0, 0.75);
        box-shadow: 4px 4px 13px -7px rgba(0, 0, 0, 0.75);
    }

    .total-wrapper {
        width: 730px;
        background-color: var(--light-black-color);
        color: white;
        font-size: 2.5rem;
    }

    .total-div {
        display: inline-block;
        margin: auto 25px;
        transform: translate(0, -15px);
    }

    .uni-wrapper {
        display: inline-block;
        text-align: right;
        margin-left: 420px;
        padding: 10px;
    }

    #total-title {
        font-weight: bold;
    }

    #totalPrice {
        margin-bottom: 1px;
        margin-top: 10px;
        font-size: 2rem;
    }

    .recebido-troco-wrapper {
        margin-top: 45px;
        width: 730px;

    }

    .nif-wrapper {
        margin-top: 45px;
        padding: 23px;
        background-color: #d9d9d9;
        font-size: 2rem;
        position: relative;

        -webkit-box-shadow: 4px 4px 13px -7px rgba(0, 0, 0, 0.75);
        -moz-box-shadow: 4px 4px 13px -7px rgba(0, 0, 0, 0.75);
        box-shadow: 4px 4px 13px -7px rgba(0, 0, 0, 0.75);
    }

    /* #calc-nif {
        position: absolute;
        right: 0;
        top:0;
        height: 74px !important;
    } */
    /* #calc-desc-f {
        position: absolute;
        right: 0;
        top:0;
    } */

    .recebido-wrapper {
        margin-right: -4 !important;
        padding: 23px;
        display: inline-block;
        width: 270px;
        background-color: #d9d9d9;
        font-size: 2rem;
        z-index: 700;
    }

    /* #recebido-dinheiro {
        font-weight: bold;
        margin-left: 30px;
        display: inline-block;
        text-align: right !important;
        width: 100px;
    } */

    /* #troco-dinheiro {
        display: inline-block;
        text-align: right !important;
        width: 100px;
        margin-left: 120px;
        font-weight: bold;
    } */

    /* .calculator {
        margin-right: -4 !important;
        width: 90px;
        background-color: #e9662c;
        display: inline-block;
        text-align: center;
        height:74px;
        padding: 22px;
        background-image: linear-gradient(to bottom right, #e9662c, #ba4d34);
    } */

    .troco-wrapper2 {
        position: absolute;
        top: 0;
        right: 0;
        width: 45%;
        height: 20%;
        font-size: 2rem;
        text-align: left;
        background-color: var(--green-color);
        color: white;
        border: none;
    }

    #recebido-dinheiro {
        font-weight: bold;
        margin-left: 2%;
    }

    .fa-calculator {
        color: white;
    }

    .troco-wrapper {
        margin-left: 19px;
        padding: 23px;
        display: inline-block;
        width: 350px;
        background-color: #5b8940;
        color: white;
        font-size: 2rem;
    }

    #pagamento {
        margin-top: 45px;
        width: 730px;
        background-color: var(--main-color);
    }

    .pagamento {
        margin-right: -4;
        background-color: #d9d9d9;
        width: 640px;
        padding: 23px;
        display: inline-block;
        font-size: 2rem;
    }

    .arrow-down {
        width: 90px;
        padding: 22px;
        display: inline-block;
        background-color: var(--main-color);
        height: 74px;
        transform: translate(0, 1px);
        background-image: linear-gradient(to bottom right, var(--main-color), var(--secondary-color));
    }

    #down-arrow-icon {
        transform: translate(9px);
        color: white;
    }

    #confirmar-button {
        text-align: center;
        /* width: 100%;  */
        background-color: var(--main-color);
        padding: 15px;
        /* margin-top: 385px; */
        position: absolute;
        bottom: 0;
        right: 1.5%;
        left: 1.5%;
        font-size: 2rem;
        color: white;
        background-image: linear-gradient(to bottom right, var(--main-color), var(--secondary-color));
    }

    .fechar-button-wrapper {
        text-align: center;
        background-color: var(--main-color);
        padding: 15px;
        font-size: 2rem;
        color: white;
        position: absolute;
        bottom: 0;
        width: 94.5%;
    }

    .fa-trash {
        color: white !important;
    }


    .numpad-recebido {
        background-color: var(--light-black-color) !important;
        color: white !important;
    }

    .numpad-desc {
        background-color: var(--light-black-color) !important;
        color: white !important;
    }

    .table-x-finalizar {
        background-color: white !important;
        color: black !important;
    }

    #finalizar-dinheiro-mb {
        color: black;
        font-weight: bold;
    }

    #finalizar-container {
        position: relative;
    }

    .numpad-center-container {
        /* width: 300px;  */
        width: 40%;
        /* height: 300px;  */
        position: absolute;
        z-index: 600;
        top: 20vh;
        /* left: 40vw;  */
        left: 50%;
        margin-left: -20%;
        z-index: 600;
    }


    .dropdown-pagamento {
        width: 250px;
        background-color: var(--light-black-color);
        position: absolute;
        right: 0;
        top: 74;
        color: white;
        font-size: 2rem;
        z-index: 100;
    }

    #ul-dropdown-pagamento {
        margin-bottom: 0;
        list-style-type: none;
        padding: 0;
    }

    #ul-dropdown-pagamento li {
        padding: 10px;
        background-color: #c5c5c5;
        color: black;
    }

    .dropdown-active-item {
        background-color: var(--light-black-color) !important;
        color: white !important;
    }

    .product-price-tag , .product-price-tag-attribute {
        padding: 5px;
        background-color: var(--main-color);
        position: absolute;
        /*right: 5px;
        top: 20px;*/
        right: 1px;
        top: 5px;
    }

    #clientesWrapper {
        padding: 5px 15px;
    }

    .novo-cliente-wrapper {
        /*position: absolute;
        top: 35vh;
        left: 45vw;
        margin-left: -150px;
        margin-top: -150px;
        background-color: white;
        padding: 30px;
        padding-bottom: 20px !important;
        font-size: 2rem;
        width: 30%;
        z-index: 600;
        transition: all 5s ease-in-out;*/
        z-index: 1050;
    }


    @media (max-width: 1026px) {
        .novo-cliente-wrapper {
            width: 50%;
        }
    }

    #adicionar-cliente {
        margin: 0;
    }

    .novo-cliente-wrapper input {
        padding: 20px 10px;
        font-size: 1.5rem;
    }

    .header-clientes {
        position: sticky;
        top: 5px;
        background-color: white;
        vertical-align: middle;
    }

    .filter-dates{
        width: 50% !important;
        height: 100% !important;
        padding-left: 15px !important;
        padding-right: 15px !important;
    }

    .btn-clientes-window,.btn-movimentos-window{
        min-width: 231px;
    }

    .btn-clientes-window, .btn-movimentos-window, .btn-mesas-window, .btn-def-window {
        font-size: 2rem;
        color: white;
    }

    .btn-clientes-black, .btn-movimentos-black, .btn-mesas-black, .btn-def-black {
        background-color: var(--light-black-color);
        border: black;
        padding: 15px 60px;
    }

    .btn-add-cliente {
        background-color: #5b8940;
        border: 1px solid #5b8940;
        font-size: 2rem !important;
        padding: 10px 15px !important;
        margin-top: 3%;
    }

    .btn-clientes-check {
        background-color: #5b8940;
        border: 1px solid #5b8940;
        /* padding: 18px 45px; */
        padding: 15px 35px;
        font-size: 2rem;
        margin-left: 8%;
    }

    .btn-clientes-green {
        background-color: var(--green-color);
        border: 1px solid var(--green-color);
        padding: 15px 35px !important;
        position: absolute;
        right: 0;
    }

    .input-search-cliente, .input-search-movimentos {
        display: inline-block;
        margin-left: 6%;
        width: 60%;
    }

    .input-search-cliente input, .input-search-movimentos input {
        padding: 15px 20px;
        /* width: 450px; */
      /*  width: 100%;*/
        font-size: 2rem;
        border: 1px solid black;
        background: url('../../images/lupa.png');
    }

    .hr-clientes {
        border: 1px solid var(--light-black-color);
        position: sticky;
        top: 80px;
    }

    .hr-vendas {
        border: 1px solid var(--light-black-color);
    }

    .table-clientes-wrapper, .table-movimentos-wrapper {
        /*z-index: -10;
        overflow-y: scroll; */
        /* max-height: 650px; */
        max-height: 87%;
        /*display: block;*/
    }

    .table-clientes-wrapper-smaller {
        max-height: 65% !important;
    }

    .table-clientes-wrapper::-webkit-scrollbar {
        display: none !important;
    }

    .table-clientes-wrapper::-webkit-scrollbar-thumb {
        background-color: #e86646 !important;
        border-right: 0px solid #fff !important;
    }

    .table-clientes-wrapper::-webkit-scrollbar-track {
        background-color: #2f363b !important;
        border-right: 0px solid #fff !important;
    }

    .table-clientes-wrapper::-webkit-scrollbar {
        width: 12px !important;
        height: 20px !important;
        border-right: 0px solid #fff !important;
    }

    .table-vendas-wrapper-smaller {
        max-height: 500px !important;
    }

    .table-vendas-wrapper::-webkit-scrollbar {
        display: none !important;
    }

    .table-vendas-wrapper::-webkit-scrollbar-thumb {
        background-color: #e86646 !important;
        border-right: 0px solid #fff !important;
    }

    .table-vendas-wrapper::-webkit-scrollbar-track {
        background-color: #2f363b !important;
        border-right: 0px solid #fff !important;
    }

    .table-vendas-wrapper::-webkit-scrollbar {
        width: 12px !important;
        height: 20px !important;
        border-right: 0px solid #fff !important;
    }

    #table-clientes, #table-movimentos {
        color: black;
        width: 100%;
        font-size: 2rem;
    }

    #table-clientes thead, #table-movimentos thead {
        background-color: var(--light-black-color);
        color: white;
    }

    .thead-wrapper {
        position: relative;
    }

    #table-clientes tbody, #table-movimentos tbody {
        background-color: #F5F5F5;
    }

    #table-clientes tbody tr:nth-child(odd) {
        background-color: #d9d9d9;
    }

    #table-clientes thead tr th,
    #table-clientes tbody tr td,
    #table-movimentos thead tr th,
    #table-movimentos tbody tr td {
        padding: 15px;
        font-weight: normal !important;
    }

    #table-clientes thead tr th:first-child {
        width: 70%;
    }

    /*  .table-vendas-wrapper {
          padding: 15px;
      }*/

    #table-vendas {
        color: black;
        width: 100%;
        font-size: 2rem;
    }

    #table-vendas thead {
        background-color: var(--light-black-color);
        color: white;
    }

    #table-vendas tbody {
        background-color: #F5F5F5;
    }

    #table-vendas tbody tr:nth-child(odd) {
        background-color: #d9d9d9;
    }

    #table-vendas thead tr th,
    #table-vendas tbody tr td {
        padding: 15px;
        font-weight: normal !important;
    }

    #table-vendas thead tr th:first-child {
        width: 40%;
    }

    .eye-button,.pencil-button,.delete-art {
        /*  background-color: whitesmoke;*/
        text-align: center;
        cursor: pointer;
    }


    /* #table-clientes tbody tr:nth-child(odd) .eye-button {
         background-color: #d9d9d9;
     }

     #table-clientes tbody tr:nth-child(odd) .pencil-button {
         background-color: #d9d9d9;

     }*/

    /*   #table-vendas tbody tr:nth-child(odd) .eye-button {
           background-color: #248ea9;
       }*/



    .cliente-details-wrapper {
        padding: 0px 0px 20px 0px;
        position: relative;
    }

    .cliente-details-wrapper p span {
        font-weight: normal;
    }

    .cliente-details-wrapper h1 {
        font-weight: bold;
    }

    .cliente-details-wrapper p {
        font-size: 1.5rem;
        font-weight: bold;
    }

    .cliente-details-button-wrapper {
        position: absolute;
        right: 0;
        top: 10px;
    }

    .chevron-up-wrapper {
        position: absolute;
        left: 50%;
        top: 80%;
    }

    .fa-chevron-up {
        color: var(--main-color);
    }

    .cliente-details-button-wrapper button {
        display: block;
    }

    .btn-desativar {
        padding: 15px 10px;
        background-color: var(--red-color);
        border: 1px solid var(--red-color);;
        margin-bottom: 10px;
        font-size: 2rem;
        color: white !important;
    }

    .btn-vendas {
        padding: 15px 8px;
        background-color: var(--orange-color);
        border: 1px solid var(--orange-color);
        font-size: 2rem;
        color: white !important;
    }

    .header-vendas h1, .header-movimentos h1 {
        margin: 0;
        font-weight: 500;
    }

    /*  .header-vendas button, .header-movimentos button {
          margin-left: 15px;
      }*/

    .header-vendas, .header-movimentos {
        position: sticky;
        top: 5px;
        /* text-align: center; */
    }

    .table-vendas-wrapper {
        /*  overflow-y: scroll;*/
        max-height: 90%;
        display: block;
    }

    /*#nif-cliente::placeholder {
        color: red;
    }*/

    .venda-cliente-wrapper {
        /*	position: absolute;
             top: 15vh;
            !*left: 15vw; *!
            left: 50%;
            margin-left: -260px;

            padding: 0;
            background-color: white;
            color: black;
            z-index: 600;
            max-height: 50%;
            overflow-y: scroll;*/

    }

    #table-cliente-venda,#table-products-exchange {
        width: 100%;
    }

    .venda-cliente-wrapper table tbody tr td:first-child,
    .venda-cliente-wrapper table thead tr th:first-child,
    .exchange-receipt-wrapper table tbody tr td:first-child,
    .exchange-receipt-wrapper table tbody tr th:first-child {
        /*   width: 65%;*/
    }

    .venda-cliente-wrapper table tbody tr td:last-child,
    .venda-cliente-wrapper table thead tr th:last-child,
    .exchange-receipt-wrapper table tbody tr td:last-child,
    .exchange-receipt-wrapper table tbody tr th:last-child{
        width: 20%;
        padding-left: 10px;
    }

    .venda-cliente-wrapper table tbody tr td:nth-child(2),
    .venda-cliente-wrapper table thead tr th:nth-child(2),
    .exchange-receipt-wrapper table tbody tr td:nth-child(2),
    .exchange-receipt-wrapper table tbody tr th:nth-child(2) {
        /*  width: 20%;*/
        padding-left: 10px;
    }

    .venda-cliente-wrapper table,.exchange-receipt table,
    .exchange-receipt-wrapper table,.exchange-receipt table{
        /*color: whitesmoke !important;*/
    }

    .venda-cliente-wrapper table thead,.exchange-receipt table thead,
    .exchange-receipt-wrapper table thead,.exchange-receipt table thead{
        background-color: #2f363b;
        color: white !important;
    }

    .venda-cliente-wrapper table tbody tr:nth-child(odd),.exchange-receipt-wrapper table tbody tr:nth-child(odd){
        background-color: #d9d9d9;
        color: black;
    }

    .venda-cliente-wrapper table tbody tr:nth-child(2n),.exchange-receipt-wrapper table tbody tr:nth-child(2n){
        background-color: #e5e9ec;
        color: black;
    }

    .venda-cliente-wrapper table td,
    .venda-cliente-wrapper table th,
    .exchange-receipt-wrapper table td,
    .exchange-receipt-wrapper table th{
        padding: 10px 5px;
    }

    .venda-cliente-wrapper-wrapper-smaller {
        max-height: 500px !important;
    }

    .venda-cliente-wrapper::-webkit-scrollbar {
        display: none !important;
    }

    .venda-cliente-wrapper::-webkit-scrollbar-thumb,
    .exchange-receipt-wrapper::-webkit-scrollbar-thumb{
        background-color: var(--main-color) !important;
        border-right: 0px solid #fff !important;
    }

    .venda-cliente-wrapper::-webkit-scrollbar-track,
    .exchange-receipt-wrapper::-webkit-scrollbar-track{
        background-color: #2f363b !important;
        border-right: 0px solid #fff !important;
    }

    .venda-cliente-wrapper::-webkit-scrollbar,
    .exchange-receipt-wrapper::-webkit-scrollbar {
        width: 12px !important;
        height: 20px !important;
        border-right: 0px solid #fff !important;
    }

    .desconto {
       /* position: absolute;
        top: 0;
        left: 0;
        background-color: var(--main-color);
        color: white;
        font-size: 1.1rem;
        padding: 0 3px;*/

        position: absolute;
        top: -49px;
        left: 0px;
        background-color: var(--main-color);
        color: white;
        font-size: 1.1rem;
        padding: 0 3px;
    }

    #table-sidebar tbody tr:first-child .desconto {
        top: 27px !important;
    }

    #table-sidebar thead {
        z-index: 200;
    }

    /* TAB PAGES */
    .tab-pages-wrapper {
        display: inline-block;
        /*max-width: 159px; */
        width: 49%;
    }

    .tab-pagina {
        background-color: var(--main-color);
        /*	display: inline-block; */
        padding: 0 15px;
        font-size: 2rem;
        /*transform: translate(0, -3px);
        margin-bottom: -10px !important;*/
        width: 100%;
       /* display: inline-block;*/
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        -o-text-overflow: ellipsis;
        max-width: 100%;
        font-size: 1.5rem;
        padding:5px;
    }

    .tab-room-pagina {
        background-color: var(--secondary-color);
        display: inline-block;
        padding: 0 15px;
        font-size: 2rem;
       /* transform: translate(0, -3px);
        margin-bottom: -10px !important;*/
        width: 100%;
        display: inline-block;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        -o-text-overflow: ellipsis;
        max-width: 100%;
        font-size: 1.5rem;
        padding:5px;
    }

    .tab-pages-wrapper::-webkit-scrollbar {
        /* display: none !important;  */
        /* height: -15px; */
        margin-top: -15px !important;
    }

    .page-active {
        background-color: var(--light-black-color) !important;
    }

    .page-room-active {
        background-color: var(--light-black-color) !important;
    }

    .fa-angle-up {
        transform: rotate(180deg);
    }

    .numpad-closed {
        transform: rotate(360deg) !important;
    }

    .mesas-header {
        padding: 15px;
    }

    .new-table-form, .new-room-form, .edit-table-form, .venda-cliente-wrapper {
        /* position: fixed;
         top: 0;
         right: 0;
         bottom: 0;
         left: 0;*/
        z-index: 1050;
        /* outline: 0;*/
    }

    .new-table-form input, .new-room-form input, .edit-table-form input {
        font-size: 2rem;
        margin-bottom: 10px;
        height: 45px;
    }

    .new-table-form select, .new-room-form select, ..edit-table-form select {
        font-size: 2rem;
        height: 45px;
        margin-bottom: 10px;
    }

    .new-line-form {
        /*position: absolute;
        top: 15vh;
        !* left: 15vw; *!
        left: 50%;
        margin-left: -200px;
        background-color: black;
        padding: 15px;
        font-size: 2rem;
        width: 400px;
        z-index: 800;*/
        z-index: 1050;
    }

    .new-line-form input {
        font-size: 2rem;
        margin-bottom: 10px;
        height: 45px;
    }

    .new-line-form select {
        font-size: 2rem;
        height: 45px;
        margin-bottom: 10px;
    }

    .new-label-form {
        /*	position: absolute;
            top: 15vh;
            !* left: 35vw; *!
            left: 50%;
            margin-left: -200px;
            background-color: black;
            padding: 15px;
            font-size: 2rem;
            width: 400px;
            z-index: 800;*/
        z-index: 1050;
    }

    .new-label-form input {
        font-size: 2rem;
        margin-bottom: 10px;
        height: 45px;
    }

    .new-label-form select {
        font-size: 2rem;
        height: 45px;
        margin-bottom: 10px;
    }

    .new-table-color {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: inline-block;
        margin-right: 5px;
    }

    .new-line-color {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: inline-block;
        margin-right: 5px;
    }

    .new-label-color {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: inline-block;
        margin-right: 5px;
    }

    .table-drag {
        text-align: center !important;
        vertical-align: middle !important;
        font-size: 2rem !important;
        font-weight: bold !important;
        margin: auto 0;

        position: absolute;
        width: 150px;
        height: 150px;
        border-radius: 5px;
    }

    .label {
        text-align: center !important;
        vertical-align: middle !important;
        font-size: 2rem !important;
        font-weight: bold !important;
        margin: auto 0;
    }


    .table-orange {
        /* background-color: #e9662c !important; */
        opacity: 1 !important;
        /*background: url('../../img/pos/table-orange.jpg') !important;*/

        background-color: #e5e5f7;
        background-image:  repeating-linear-gradient(45deg, #e5950f 25%, transparent 25%, transparent 75%, #e5950f 75%, #e5950f), repeating-linear-gradient(45deg, #e5950f 25%, #e5e5f7 25%, #e5e5f7 75%, #e5950f 75%, #e5950f);
        background-position: 0 0, 10px 10px;
        background-size: 20px 20px;
    }

    .table-red {
        /* background-color: red !important; */
        opacity: 1 !important;
       /* background: url('../../img/pos/table-red.jpg') !important;*/


        background-color: #e5e5f7;
        background-image:  repeating-linear-gradient(45deg, #d05050  25%, transparent 25%, transparent 75%, #d05050  75%, #d05050 ), repeating-linear-gradient(45deg, #d05050  25%, #e5e5f7 25%, #e5e5f7 75%, #d05050  75%, #d05050 );
        background-position: 0 0, 10px 10px;
        background-size: 20px 20px;
    }

    .table-blue {
        /* background-color: #488c6c !important; */
        opacity: 1 !important;
       /* background: url('../../img/pos/table-blue.png') !important;*/

        background-color: #e5e5f7;
        background-image:  repeating-linear-gradient(45deg, #2184bb 25%, transparent 25%, transparent 75%, #2184bb 75%, #2184bb), repeating-linear-gradient(45deg, #2184bb 25%, #e5e5f7 25%, #e5e5f7 75%, #2184bb 75%, #2184bb);
        background-position: 0 0, 10px 10px;
        background-size: 20px 20px;
    }

    .table-pink {
        /* background-color: #ff78ae !important; */
        opacity: 1 !important;
       /* background: url('../../img/pos/table-pink3.jpg') !important;*/
        background-color: #e5e5f7;
        background-image:  repeating-linear-gradient(45deg, #a056bf 25%, transparent 25%, transparent 75%, #a056bf 75%, #a056bf), repeating-linear-gradient(45deg, #a056bf 25%, #e5e5f7 25%, #e5e5f7 75%, #a056bf 75%, #a056bf);
        background-position: 0 0, 10px 10px;
        background-size: 20px 20px;
    }

    .table-pink-grid{
        /* background-color: #ff78ae !important; */
       /* opacity: 1 !important;
        background: #a056bf !important;*/

        background-color: #e5e5f7;
        opacity: 1;
        background-image:  linear-gradient(#a056bf 2px, transparent 2px), linear-gradient(90deg, #a056bf 2px, transparent 2px), linear-gradient(#a056bf 1px, transparent 1px), linear-gradient(90deg, #a056bf 1px, #fff 1px);
        background-size: 50px 50px, 50px 50px, 10px 10px, 10px 10px;
        background-position: -2px -2px, -2px -2px, -1px -1px, -1px -1px;
    }

    .table-red-grid{
        /* background-color: #ff78ae !important; */
       /* opacity: 1 !important;
        background: #d51a1a !important;*/

        background-color: #e5e5f7;
        opacity: 1;
        background-image:  linear-gradient(#d05050  2px, transparent 2px), linear-gradient(90deg, #d05050  2px, transparent 2px), linear-gradient(#d05050  1px, transparent 1px), linear-gradient(90deg, #d05050  1px, #fff 1px);
        background-size: 50px 50px, 50px 50px, 10px 10px, 10px 10px;
        background-position: -2px -2px, -2px -2px, -1px -1px, -1px -1px;
    }

    .table-green-grid{
        /* background-color: #ff78ae !important; */
        /*opacity: 1 !important;
        background: #43a61d !important;*/

        background-color: #e5e5f7;
        opacity: 1;
        background-image:  linear-gradient(#43a61d 2px, transparent 2px), linear-gradient(90deg, #43a61d 2px, transparent 2px), linear-gradient(#43a61d 1px, transparent 1px), linear-gradient(90deg, #43a61d 1px, #fff 1px);
        background-size: 50px 50px, 50px 50px, 10px 10px, 10px 10px;
        background-position: -2px -2px, -2px -2px, -1px -1px, -1px -1px;
    }

    .table-blue-grid{
        /* background-color: #ff78ae !important; */
       /* opacity: 1 !important;
        background: #2184bb !important;*/

        background-color: #e5e5f7;
        opacity: 1;
        background-image:  linear-gradient(#2184bb 2px, transparent 2px), linear-gradient(90deg, #2184bb 2px, transparent 2px), linear-gradient(#2184bb 1px, transparent 1px), linear-gradient(90deg, #2184bb 1px, #fff 1px);
        background-size: 50px 50px, 50px 50px, 10px 10px, 10px 10px;
        background-position: -2px -2px, -2px -2px, -1px -1px, -1px -1px;
    }

    .table-orange-grid{
        /* background-color: #ff78ae !important; */
       /* opacity: 1 !important;
        background: #e5950f !important;*/

        background-color: #e5e5f7;
        opacity: 1;
        background-image:  linear-gradient(#e5950f 2px, transparent 2px), linear-gradient(90deg, #e5950f 2px, transparent 2px), linear-gradient(#e5950f 1px, transparent 1px), linear-gradient(90deg, #e5950f 1px, #e5e5f7 1px);
        background-size: 50px 50px, 50px 50px, 10px 10px, 10px 10px;
        background-position: -2px -2px, -2px -2px, -1px -1px, -1px -1px;
    }

    .table-orange-iso{
        background-color: #e5e5f7;
        opacity: 1;
        background-image:  linear-gradient(30deg, #e5950f 12%, transparent 12.5%, transparent 87%, #e5950f 87.5%, #e5950f), linear-gradient(150deg, #e5950f 12%, transparent 12.5%, transparent 87%, #e5950f 87.5%, #e5950f), linear-gradient(30deg, #e5950f 12%, transparent 12.5%, transparent 87%, #e5950f 87.5%, #e5950f), linear-gradient(150deg, #e5950f 12%, transparent 12.5%, transparent 87%, #e5950f 87.5%, #e5950f), linear-gradient(60deg, #e5950f77 25%, transparent 25.5%, transparent 75%, #e5950f77 75%, #e5950f77), linear-gradient(60deg, #e5950f77 25%, transparent 25.5%, transparent 75%, #e5950f77 75%, #e5950f77);
        background-size: 20px 35px;
        background-position: 0 0, 0 0, 10px 18px, 10px 18px, 0 0, 10px 18px;
    }

    .table-green-iso{
        background-color: #e5e5f7;
        opacity: 1;
        background-image:  linear-gradient(30deg, #43a61d 12%, transparent 12.5%, transparent 87%, #43a61d 87.5%, #43a61d), linear-gradient(150deg, #43a61d 12%, transparent 12.5%, transparent 87%, #43a61d 87.5%, #43a61d), linear-gradient(30deg, #43a61d 12%, transparent 12.5%, transparent 87%, #43a61d 87.5%, #43a61d), linear-gradient(150deg, #43a61d 12%, transparent 12.5%, transparent 87%, #43a61d 87.5%, #43a61d), linear-gradient(60deg, #43a61d77 25%, transparent 25.5%, transparent 75%, #43a61d77 75%, #43a61d77), linear-gradient(60deg, #43a61d77 25%, transparent 25.5%, transparent 75%, #43a61d77 75%, #43a61d77);
        background-size: 20px 35px;
        background-position: 0 0, 0 0, 10px 18px, 10px 18px, 0 0, 10px 18px;
    }

    .table-red-iso{
        background-color: #e5e5f7;
        opacity: 1;
        background-image:  linear-gradient(30deg, #d05050  12%, transparent 12.5%, transparent 87%, #d05050  87.5%, #d05050 ), linear-gradient(150deg, #d05050  12%, transparent 12.5%, transparent 87%, #d05050  87.5%, #d05050 ), linear-gradient(30deg, #d05050  12%, transparent 12.5%, transparent 87%, #d05050  87.5%, #d05050 ), linear-gradient(150deg, #d05050  12%, transparent 12.5%, transparent 87%, #d05050  87.5%, #d05050 ), linear-gradient(60deg, #d0505077 25%, transparent 25.5%, transparent 75%, #d0505077 75%, #d0505077), linear-gradient(60deg, #d0505077 25%, transparent 25.5%, transparent 75%, #d0505077 75%, #d0505077);
        background-size: 20px 35px;
        background-position: 0 0, 0 0, 10px 18px, 10px 18px, 0 0, 10px 18px;
    }

    .table-blue-iso{
        background-color: #e5e5f7;
        opacity: 1;
        background-image:  linear-gradient(30deg, #2184bb 12%, transparent 12.5%, transparent 87%, #2184bb 87.5%, #2184bb), linear-gradient(150deg, #2184bb 12%, transparent 12.5%, transparent 87%, #2184bb 87.5%, #2184bb), linear-gradient(30deg, #2184bb 12%, transparent 12.5%, transparent 87%, #2184bb 87.5%, #2184bb), linear-gradient(150deg, #2184bb 12%, transparent 12.5%, transparent 87%, #2184bb 87.5%, #2184bb), linear-gradient(60deg, #2184bb77 25%, transparent 25.5%, transparent 75%, #2184bb77 75%, #2184bb77), linear-gradient(60deg, #2184bb77 25%, transparent 25.5%, transparent 75%, #2184bb77 75%, #2184bb77);
        background-size: 20px 35px;
        background-position: 0 0, 0 0, 10px 18px, 10px 18px, 0 0, 10px 18px;
    }

    .table-purple-moon{
        background-color: #e5e5f7;
        opacity: 1;
        background-image: radial-gradient( ellipse farthest-corner at 10px 10px , #444cf7, #444cf7 50%, #e5e5f7 50%);
        background-size: 10px 10px;
    }

    .table-red-linha {
        background-color: var(--red-color) !important;
        opacity: 1 !important;

    }

    .table-green-linha {
        background-color: var(--green-color) !important;
        opacity: 1 !important;

    }

    .table-pink-linha {
        background-color: #ff78ae !important;
        opacity: 1 !important;

    }

    .table-orange-linha {
        background-color: #e9662c !important;
        opacity: 1 !important;

    }

    .table-red-label {
        background-color: red !important;
        opacity: 1 !important;

    }

    .table-green-label {
        background-color: var(--green-color) !important;
        opacity: 1 !important;

    }

    .table-pink-label {
        background-color: #ff78ae !important;
        opacity: 1 !important;

    }

    .table-orange-label {
        background-color: #e9662c !important;
        opacity: 1 !important;

    }

    .color-active {
        border: 1px solid yellow;
    }

    .mesa-circular {
        border-radius: 50%;
    }

    .Horizontal {
        height: 15px !important;
        max-height: 15px !important;
        width: 200px;
    }

    .Vertical {
        height: 200px;
        max-width: 15px !important;
        width: 15px !important;
    }

    .btn-table {
        background-color: var(--green-color) !important;
        padding: 5px;
        border: none;
        margin-right: 10px;
    }

    .yellow {
        background-color: #f79c1d !important;
    }

    .orange {
        background-color: #e9662c !important;
    }

    .blue {
        background-color: #248ea9 !important;
    }

    .mesas-label {
        padding: 5px;
        text-align: center;
    }

    .wood-background {
        background: url('../../img/pos/wood-background2.jpg') !important;
    }

    .pages-mesas {
        margin-right: 5px;
    }

    .container {
        width: 100% !important;
    }

    /*#numpadwrapper {
        position: absolute !important;
        bottom: 0 !important;
        width: 96.1% !important;
    }*/

    .table-sidebar-wrapper2 {
        margin-top: 2.5%;
        max-height: 47.5%;
        overflow-y: auto;
       /* border: 1px solid black;*/
    }

    .table-sidebar-big {
        max-height: 67% !important;
    }

    #table-sidebar2 {
        color: black;
        width: 100%;
       /* border: 1px solid black;*/
        border-collapse: collapse;
        overflow: hidden;
    }

    #table-sidebar2 thead {
       /* border: 1px solid black;*/
        position: sticky;
        top: -5px;
        background-color: #e5e9ec !important;
        z-index: 1;
        overflow: hidden;
    }

    #table-sidebar2 thead th {
        position: sticky;
        top: -1px;
        background-color: #e5e9ec !important;
        /* color: white !important; */
        /* z-index: 800; */
        border-bottom: 1px solid black !important;
        z-index: 100;
    }

    #table-sidebar2 thead tr {
        border-bottom: 1px solid black;
        z-index: 1000;
        background-color: #DCDCDC !important;
    }

    .monitor-head {
        overflow: hidden;
    }

    #table-sidebar2 td {
        padding: 15px;
    }

    #table-sidebar2 th {
        /*padding: 10px 15px;*/
        padding: 0px 15px;
    }

    #table-sidebar2 td:nth-child(2),
    #table-sidebar2 th:nth-child(2) {
        /*width: 50%;*/
        text-align: left !important;
    }

    /*
    #table-sidebar2 td:nth-child(2),
    #table-sidebar2 th:nth-child(2) {
        width: 10%;
    }
    */

    #table-sidebar2 td,
    #table-sidebar2 th {
        text-align: center;
    }

    #table-sidebar2 td:nth-child(5) {
      /*  background-color: var(--red-color);*/
        padding: 0;
    }

    .remove-article-cart {
        color: var(--red-color);
        height: 100%;
        justify-content: center;
        display: flex;
        align-content: center;
        align-items: center;
        border-radius: 0px;
        margin: 0px;
    }

    .preco.money.autonumeric-money-total{
        text-align: end !important;
    }

    .monitor-head > .price {
        text-align: end !important;
    }

    /*#table-sidebar2 tbody tr td{
        border-bottom: 1px solid black !important;
    }*/

    /*.table-sidebar-wrapper2::-webkit-scrollbar {
        width: 12px !important;
        height: 20px !important;
        border-right: 0px solid #fff !important;
    }

    .table-sidebar-wrapper2::-webkit-scrollbar-track {
        background-color: #2f363b !important;
        border-right: 0px solid #fff !important;
    }

    .table-sidebar-wrapper2::-webkit-scrollbar-thumb {
        background-color: var(--main-color) !important;
        border-right: 0px solid #fff !important;
    }

    .table-sidebar-wrapper2::-webkit-scrollbar-thumb:hover {
        background-color: var(--secondary-color) !important;
        border-right: 0px solid #fff !important;
    }

    .table-sidebar-wrapper2 {
        -ms-overflow-style: none !important;
        -ms-overflow-style: -ms-autohiding-scrollbar !important;
        overflow: -moz-scrollbars-none !important;
    }

    .table-sidebar-wrapper2::-webkit-scrollbar {
        display: none !important;
    }*/


    #finalizar {
        background-color: var(--green-color) ;
        color: white;
    }

    .finalizar-total2 {
        position: absolute;
        top: 0;
        left: 1.5%;
        width: 45%;
        /* height: 500px; */
        height: 60%;
        background-color: #2f363b;
        color: white;
        padding: 2%;
    }

    .finalizar-buttons {
        position: absolute;
        top: 0;
        right: 1.5%;
        width: 45%;
        height: 60%;
        /* background-color: yellow; */
    }

    #total2 {
        font-size: 3.5rem;
    }

    #total-price-finalizar {
        font-size: 3.5rem;
    }

    .prods-uni-wrapper {
        position: absolute;
        top: 3%;
        right: 3%;
        text-align: right;
    }

    #produtos-unidades {
        font-size: 1.5rem;
        display: block;
        padding: auto;
        transform: translate(-5px, -5px);
    }

    .resto-totais {
        font-size: 2rem;
        padding: 0 !important;
    }

    #results-span {
        /* margin-left: 30%; */
        right: 5%;
    }

    .right-items {
        text-align: right;
    }

    .btn-recebido2 {
        position: absolute;
        width: 45%;
        height: 20%;
        font-size: 2rem;
        text-align: left;
        box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(155, 194, 207, 0.1);
        border-radius: 4px;
        background-image: linear-gradient(to bottom right, #f6fbfc, #deeff5);
        font-family: inherit;
    }

    .btn-finalizar {
        top: 0;
        left: 0;
    }

    .btn-pagamento {
        top: 40% !important;
        left: 0;
    }

    .btn-nif2 {
        top: 40% !important;
        right: 0 !important;
    }

    .btn-parcial {
        bottom: 0;
        left: 0;
    }

    .btn-desconto {
        bottom: 0;
        right: 0;
    }

    .partial-modal,.partial-divider-modal {
        position: absolute;
        width: 80vw;
        height: 85vh;
        top: 50% !important;
        left: 50vw;
        /* margin-top: -25vh;
         margin-left: -32.5vw;*/
        background-color: black !important;
        z-index: 3000;
        color: white;
    }

    .total-table {
        width: 100%;
        color: black;
        border-collapse: collapse;
    }

    #table-total thead {
        position: sticky;
        top: 0;
        background-color: #2f363b;
    }

    #table-total thead th {
        position: sticky;
        top: 0;
        background-color: #2f363b;
        z-index: 100;
    }

    #table-total thead tr {
        border-bottom: 1px solid black;
        background-color: #2f363b;
    }

    .total-table-wrapper {
        position: absolute;
        top: 15%;
        left: 2%;
        bottom: 10%;
        background-color: white;
        width: 47.5%;
        overflow-y: auto;
        border: 1px solid black;
    }

    .total-table-wrapper::-webkit-scrollbar {
        width: 12px !important;
        height: 20px !important;
        border-right: 0px solid #fff !important;
    }

    .total-table-wrapper::-webkit-scrollbar-track {
        background-color: #2f363b !important;
        border-right: 0px solid #fff !important;
    }

    .total-table-wrapper::-webkit-scrollbar-thumb {
        background-color: var(--main-color) !important;
        border-right: 0px solid #fff !important;
    }

    .total-table-wrapper::-webkit-scrollbar-thumb:hover {
        background-color: var(--secondary-color) !important;
        border-right: 0px solid #fff !important;
    }

    .total-table-wrapper {
        -ms-overflow-style: none !important;
        -ms-overflow-style: -ms-autohiding-scrollbar !important;
        overflow: -moz-scrollbars-none !important;
    }

    .total-table-wrapper::-webkit-scrollbar {
        display: none !important;
    }

    .partial-table-wrapper {
        position: absolute;
        top: 15%;
        right: 2%;
        bottom: 10%;
        background-color: white;
        width: 47.5%;
        overflow-y: auto;
        border: 1px solid black;
    }

    .partial-table-wrapper::-webkit-scrollbar {
        width: 12px !important;
        height: 20px !important;
        border-right: 0px solid #fff !important;
    }

    .partial-table-wrapper::-webkit-scrollbar-track {
        background-color: #2f363b !important;
        border-right: 0px solid #fff !important;
    }

    .partial-table-wrapper::-webkit-scrollbar-thumb {
        background-color: var(--main-color) !important;
        border-right: 0px solid #fff !important;
    }

    .partial-table-wrapper::-webkit-scrollbar-thumb:hover {
        background-color: var(--secondary-color) !important;
        border-right: 0px solid #fff !important;
    }

    .partial-table-wrapper {
        -ms-overflow-style: none !important;
        -ms-overflow-style: -ms-autohiding-scrollbar !important;
        overflow: -moz-scrollbars-none !important;
    }

    .partial-table-wrapper::-webkit-scrollbar {
        display: none !important;
    }

    .total-title {
        position: absolute;
        top: 8%;
        left: 21%;
        font-size: 3.5rem;
    }

    .partial-title {
        position: absolute;
        top: 8%;
        right: 18%;
        font-size: 3.5rem;
    }

    .partial-table,.move-table {
        width: 100%;
        color: black;
        border-collapse: collapse;
    }

    #table-partial thead {
        position: sticky;
        top: 0;
        background-color: #2f363b;
    }

    #table-partial thead th {
        position: sticky;
        top: 0;
        background-color: #2f363b;
        z-index: 100;
    }

    #table-partial thead tr {
        border-bottom: 1px solid black;
        background-color: #2f363b;
    }

    .move-table thead {
        position: sticky;
        top: 0;
        background-color: #2f363b;
    }

    .move-table thead th {
        position: sticky;
        top: 0;
        background-color: #2f363b;
        z-index: 100;
    }

    .move-table thead tr {
        border-bottom: 1px solid black;
        background-color: #2f363b;
    }

    .partial-table thead tr th,
    .partial-table tbody tr td,
    .move-table tbody tr td,
    .move-table thead tr th
    {
        padding: 15px;
    }

    .partial-table thead tr th:nth-child(1),
    .partial-table tbody tr td:nth-child(1) {
       /* width: 50%;*/
    }

    .partial-table thead,.move-table {
        background-color: #2f363b;
        color: white;
    }

  /*  .partial-table tbody tr:nth-child(odd),.move-table tbody tr:nth-child(odd) {
        background-color: #DCDCDC;
    }*/

    .qtd_p{
        text-align: center;
    }

    .preco_p{
        text-align: right;
    }

    #table-partial tbody tr td:nth-child(3),
    #table-partial thead tr th:nth-child(3) {
        text-align: center;
    }

    #total-table tbody tr td:nth-child(1),
    #total-table thead tr th:nth-child(1) {
        text-align: center !important;
    }

    .partial-table tbody tr td:nth-child(4),
    .partial-table thead tr th:nth-child(4) {
        text-align: right;
    }

    .concluir-button {
        position: absolute;
        bottom: 1%;
        left: 2%;
        width: 47.5%;
        height: 8%;
        font-size: 3rem;
        background-color: var(--green-color);
        color: white;
        border: none;
    }

    .cancelar-button {
        position: absolute;
        bottom: 1%;
        right: 2%;
        width: 47.5%;
        height: 8%;
        font-size: 3rem;
        background-color: white;
        color: black;
        border: none;
    }

    .remove-room-modal {
        position: absolute;
        width: 45vw;
        height: 10vh;
        top: 25%;
        left: 25%;
        background-color: var(--main-color) !important;
        z-index: 3000;
        color: white;
    }

    .remove-title {
        position: absolute;
        top: 2%;
        left: 3%;
        font-size: 2.5rem;
    }

    .confirm-button {
        position: absolute;
        bottom: 4%;
        right: 4%;
        width: 25%;
        font-size: 2.5rem;
        background-color: var(--green-color);
        color: white;
        border: none;
    }

    .cancel-button {
        position: absolute;
        bottom: 4%;
        left: 4%;
        width: 47.5%;
        font-size: 3rem;
        background-color: var(--red-color);
        color: white;
        border: none;
    }

    #numpadMainWrapper button {
        padding: 20px !important;
        height: auto !important;
    }

    .right-finalizar-container {
        position: absolute;
        top: 0;
        right: 2%;
        height: 100%;
        width: 48%;
        /* background-color: yellow; */
    }

    .total-container {
        position: absolute;
        width: 100%;
        height: 45%;
        /* background-color: grey; */
    }

    .left-finalizar-container {
        position: absolute;
        left: 2%;
        width: 46%;
        height: 100%;
    }

    .numpad-finalizar-container {
        position: absolute;
        bottom: 0;
        width: 100%;
        height: 55%;
        /* background-color: grey; */
    }

    .rou {
        background-color: #2f363b;
        color: white;
        /* padding: 2.9% 0; */
        height: 15% !important;
        font-size: 2.3rem;
        font-family: inherit;
        position: relative;
        display: flex;
        align-items: center;
    }

    .left-items {
        /* border-right: 1px solid white; */
    }

    .right-items {
        /* border-left: 1px solid white; */
        /*text-align: center;*/
    }

    .check-value-left{
        border-right: 0 !important;
    }

    .white-line {
        width: 0.5%;
        height: 110%;
        background-color: white;
        right: 34%;
        position: absolute;
        z-index: 50;
    }

    .white-line2 {
        width: 0.5%;
        height: 10%;
        background-color: white;
        left: 24%;
        bottom: 0;
        position: absolute;
        z-index: 50;
    }

    .numbers-container {
        position: absolute;
        left: 0;
        height: 100%;
        width: 100%;
        background: #000;
    }

    .buttons-container {
        position: absolute;
        right: 0;
        width: 33%;
        height: 100%;
        /* background-color: orange; */
    }

    .calc-finalizar-buttons {
        /*position: absolute;*/
        width: 100%;
        height: 100%;
        border: none;
    }

    .desconto-button,.desconto-money-button {
        top: 0;
        background-color: var(--dark-blue-color);
        font-size: 1.5rem;
        color: white;
        font-family: inherit;
    }

    .cancel-finalizar-button {
        top: 34%;
        background-color: var(--red-color);
    }

    .confirm-finalizar-button {
        bottom: 0;
        background-color: var(--green-color);
    }

    #desc-text {
       /* position: relative;
        top: -50px;
        right: 0px;*/
        position: relative;
        top: -30px;
        right: 0px;
        width: 100%;
        display: block;
        font-size: 1.8rem;
    }

    #desc-val,#desc-money-val {
       /* font-size: 2.5rem;
        position: relative;
        top: 15px;*/
        font-size: 2rem;
        position: relative;
        bottom: -30px;
        width: 100%;
        display: block;
        overflow: hidden;
    }

    .desconto-button,.desconto-money-button{
        height: 100%;
    }

    .desconto-money-button{
        top: 17%
    }

    .button-calc-finalizar,.button-calc-divider,.button-calc-weight,.button-calc-price,.button-nif,.button-alt-keyboard {
        position: absolute;
        background-color: #dedede;
        width: 32%;
        height: 23.5%;
        border: none;
        font-size: 4rem;
        color: black;
    }

    .button-number-keyboard,.button-clear-keyboard,.button-close-keyboard,.button-confirm-keyboard,.button-number-calculator,
    .button-close-calculator,.button-clear-calculator,.button-clear-count-money,.button-calculation-calculator, .button-confirm-calculator,
	.button-number-count-money ,.button-confirm-count-money,.button-close-count-money,.button-add-total-calculator
	{
        position: absolute;
        background-color: #dedede;
        width: 32%;
        height: 23.5%;
        border: none;
        font-size: 4rem;
        color: black;
    }

    .button-calc-backspace,.button-calc-weight-backspace,.button-calc-price-backspace,.button-nif-backspace,.button-alt-keyboard-backspace {
        position: absolute;
        background-color: #dedede;
        width: 32%;
        height: 23.5%;
        border: none;
        font-size: 4rem;
        color: black;
    }

    .btn-1 {
        top: 0;
        left: 0;
    }

    .btn-2 {
        top: 0;
        left: 34%;
    }

    .btn-3 {
        top: 0;
        right: 0;
    }

    .btn-4 {
        top: 25.5%;
        left: 0;
    }

    .btn-5 {
        top: 25.5%;
        left: 34%;
    }

    .btn-6 {
        top: 25.5%;
        right: 0;
    }

    .btn-7 {
        bottom: 25.5%;
        left: 0;
    }

    .btn-8 {
        bottom: 25.5%;
        right: 34%;
    }

    .btn-9 {
        bottom: 25.5%;
        right: 0;
    }

    .btn-0 {
        bottom: 0;
       /* left: 0;*/
        right: 34%;
    }

    .btn-vir {
        bottom: 0;
      /*  right: 34%;*/
        right: 0;
    }

    .btn-arrow {
        bottom: 0;
      /*  right: 0;*/
        left: 0;
    }


    .rou-pay {
        height: 8.5% !important;
    }

    .rou-pay-2 {
        height: 8.5% !important;
        background-color: #8d8d8d !important;
    }

    .rou-pay-3 {
        height: 8.5% !important;
        background-color: #8d8d8d !important;
    }

    .rou-pay-text{
        height: 100%;
        border-right:solid 4px white;
    }

    .rou-pay-label{
        display: flex;
      /*  text-align: center;*/
        position: relative;
        top: 50%;
        -ms-transform: translateY(-50%);
        -webkit-transform: translateY(-50%);
        transform: translateY(-50%);
    }

    .rou-pay-partial{
        margin-bottom: 1.4%;
        height: 8.5% !important;
        cursor: pointer;
        background-color: var(--blue-color);
    }

    .partial-payment {
        position: absolute;
        background-color: var(--main-color);
        width: 100%;
        height: 12%;
        border: none;
        font-size: 2.5rem;
        color: white;
        text-align: left;
        padding-left: 3%;
        bottom: 10.5%;
        z-index: 60;
    }

    .rou-with-value{
        background-color: var(--orange-color) !important;
    }

    .rou-active,.row-count-money-active {
        /*background-color: #606060 !important;*/
        background-color: var(--green-color) !important;
    }

    #numerario-val,#multibanco-val,#cCredito-val,#cheque-val,#predatado-val,#chequeOferta-val,#valeReembolso-val{
        pointer-events:none;
    }



    .button-calc-finalizar:active,.button-calc-divider:active,.button-calc-weight:active,.button-calc-price:active,.button-nif:active,.button-alt-keyboard:active {
        transform: translateY(2px);
        outline: none;
        border: none;
    }

    .button-number-keyboard:active,.button-clear-keyboard:active,.button-close-keyboard:active,.button-confirm-keyboard:active,
    .button-number-calculator:active,.button-close-calculator:active,.button-clear-calculator:active,.button-calculation-calculator:active,
    .button-confirm-calculator:active, .button-number-count-money:active,.button-clear-count-money:active,.button-confirm-count-money:active,
	.change-count-type:active,.button-close-count-money:active,.button-add-total-calculator:active
	{
        transform: translateY(2px);
        outline: none;
        border: none;
    }

    .button-calc-finalizar:focus,.button-calc-divider:focus,.button-calc-weight:focus,.button-calc-price:focus,.button-nif:focus,.button-alt-keyboard:focus {
        outline: 0;
    }

    .button-number-keyboard:focus,.button-clear-keyboard:focus,.button-close-keyboard:focus, .button-confirm-keyboard:focus,
    .button-number-calculator:focus,.button-close-calculator:focus,.button-clear-calculator:focus,.button-calculation-calculator:focus,
    .button-confirm-calculator:focus,.button-number-count-money:focus,.button-clear-count-money:focus,.button-confirm-count-money:focus,
	.change-count-type:focus,.button-close-count-money:focus,.button-add-total-calculator:focus
	{
        outline: 0;
    }


    .numpadFecharWrapper {
        position: absolute;
        width: 30%;
        top: 19%;
        right: 5%;
    }

    .tiposDinheiroWrapper {
        position: absolute;
        width: 40%;
        top: 15%;
        left: 5%;
    }

    .fechar-left-items {
        background-color: var(--main-color);
        text-align: center;
        font-size: 2rem;
        padding: 2% 0;
    }

    .fechar-right-items {
        background-color: white;
        color: black;
        text-align: right;
        font-size: 2rem;
        padding: 2%;
    }

    .tiposDinheiroWrapper .row {
        margin-bottom: 2%;
    }

    .tipo-dinheiro-active {
        opacity: 0.5;
    }

    .header-wrapper {
        position: relative;
        padding: 7px;
        text-align: center;
        font-size: 3rem;
    }

    .hr-thick {
        border: 2px solid white;
    }

    .x-wrapper {
        position: absolute;
        right: 20px;
        top: 11px;
    }

    /*POSTO.PHP*/

    #backdrop {
        width: 100%;
        height: 100%;
        position: fixed;
        background-color: rgba(0, 0, 0, 0.6);
        z-index: 500;
    }

    .margin-right-15 {
        margin-right: 15px;
    }

    .font-size-25 {
        font-size: 25px;
    }

    .font-size-35 {
        font-size: 35px;
    }

    .font-size-30{
        font-size: 30px;
    }

    /*POSTO LOCK.PHP*/

    .white_user_name_h4 {
        color: #ffffff !important;
        font-size: 24px !important;
    }

    a.user_click_item {
        cursor: pointer !important;
        height: auto !important;
        width: 100% !important;
    }

    a.user_click_item .wrapper_user_item:hover img {
        opacity: 0.8;
        filter: alpha(opacity=8) !important;
        -khtml-opacity: 0.8 !important;
        -moz-opacity: 0.8 !important;
    }

    .full_height_container {
        min-height: 90vh !important;
    }

    .wrapper_user_item {
        padding-top: 20vh !important
    }

    .wrapper_user_pwdform {
        padding-top: 20vh !important
    }

    .sticky_bottom {
        margin-top: 20vh;
        height: 50px;
        line-height: 42px !important;
        font-size: 26px !important;
        border-color: #fff !important;
        border-top: 1px solid;
        border-bottom: 1px solid;
    }

    .sticky_bottom2 {
        margin-bottom: 0vh;
        height: 50px;
        line-height: 42px !important;
        font-size: 26px !important;
        border-color: #fff !important;
        border-top: 1px solid;
        border-bottom: 1px solid;
        position: fixed !important;
        bottom: 3vh;
    }

    .container-sticky  {
        padding: 0 !important;
        margin: auto !important;
        max-width: 1138px;
    }

    @media (max-height: 1024px) and (max-width: 1280px) {
        .current-page-title{
            display: none;
        }

        .export-saft-label {
            font-size: 1.5em !important;
        }

        .btn-custom-sale-end,.btn-partial-pay,.btn-div-pay {
            padding: 25px 60px 25px 85px !important;
        }
    }

    @media (max-height: 768px) and (max-width: 1024px) {
        .current-page-title{
            display: none;
        }

        .btn-custom-sale-end,.btn-partial-pay,.btn-div-pay {
            padding: 25px 60px 25px 55px !important;
        }

        .btn-custom-sale-end::before,.btn-partial-pay::before,.btn-div-pay::before {
            width: 50px !important;
        }
    }

    @media (height: 1024px) and (width: 1280px) {
        .modal-center{
            width: 60%;
        }
    }

    @media (width: 1024px) and (width: 768px) {
        .btn-custom-sep-purple {
            padding: 25px 60px 25px 55px !important;
        }

        .btn-custom-purple::before {
            width: 50px !important;
        }
    }




    @media (min-width: 768px) {
        .container-sticky {
            max-width: 718px
        }
    }

    @media (min-width: 992px) {
        .container-sticky {
            max-width: 938px
        }
    }

    @media (min-width: 1200px) {
        .container-sticky {
            max-width: 1138px;
        }
    }


    @media (min-width: 1920px) {
        .product_item {
            height: 203px !important;
        }
        .name-product{
            top: 166px;
        }
    }

    .sticky_bottom2 {
        position: absolute !important;
        width: 30%;
    }

    /*TABLE*/
    .absolute-bottom {
        position: absolute;
       /* top: 50%;*/
        width: 100%;
      /*  transform: translate(0, -50%);*/
        bottom:0;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .absolute-center {
        position: absolute;
        top: 50%;
        width: 100%;
        transform: translate(0, -50%);
        z-index: 1;
    }

    .table-label, .table-total {
        /* width: auto;
         height: auto;
         margin: 0 auto;*/
        /* position: relative;
         top: 50%;
         transform: translateY(-50%);*/
        color: black;
        /*text-shadow: -1px 0 white, 0 1px white, 1px 0 white, 0 -1px white;*/
        text-shadow: 2px 0 0 #fff, -2px 0 0 #fff, 0 2px 0 #fff, 0 -2px 0 #fff, 1px 1px #fff, -1px -1px 0 #fff, 1px -1px 0 #fff, -1px 1px 0 #fff;
        cursor: pointer;
        background-color: #2f363b75 !important;
    }

    .table-total{
        color: var(--green-color);
        text-shadow: 2px 0 0 #333, -2px 0 0 #333, 0 2px 0 #333, 0 -2px 0 #333, 1px 1px #333, -1px -1px 0 #333, 1px -1px 0 #333, -1px 1px 0 #333;
    }

    .numpad-bin {
        background-color: var(--red-color) !important;

    }

    .numpad-bin > i {
        font-size: 20px;
    }

    .row-numpad-bin {
        display: table-cell !important;
        vertical-align: middle !important;
        background-color: var(--red-color);
        text-align: center;
        margin: 0px !important;
    }

	.row-money-count,.tr-money{
		height: 75px !important;
	}

	.row-count-image {
		padding: 10px;
		text-align: center;
		height: 100%;
		justify-content: center;
		align-items: center;
		display: flex;
	}

	.row-money-count-container {
		width: 100%;
		justify-content: center;
		display: flex;
		align-items: center;
		height: 70px;
	}

	.row-count-quantity,.row-count-val {
		float: left;
		padding-right: 10px;
		text-align: right;
		width: 100%;
	}

	.row-count-val {
		font-size: 16px;
	}

    /*Buttons mesas*/

    .btn-table {
        padding: 15px 60px;
        z-index: 1000;
    }

    #newTableButton {
        margin-left: 10px;
    }

    /*btn definições*/
    .btn-def-window {
        margin-top: 15px;
        margin-left: 10px;
    }

    .tab-pagina {
        /*   max-width: 120px;*/
        white-space: nowrap;
        /*  overflow: hidden;*/
        text-overflow: ellipsis;
    }

    /*tabela carrinho*/
    #table-sidebar2 td {
        padding: 10px;
    }

    #table-sidebar2 thead th {
        padding:10px;
        font-size:15px
    }

    #tableEntry > tr > td{
        padding:10px;
        font-size:15px
    }


    #tableEntry > tr {
        border-bottom: 2px solid black !important;
        cursor: pointer;
       /* display: flex;
        flex-direction: row;
        justify-content: space-between;

        min-height: 66px;
        max-height: 66px;
        */
    }


    #tableEntry > tr > td {
        /*display: flex;
        justify-content: center;
        align-items: center;*/
        height: 50px;
        min-height: 50px;
        max-height: 50px;
    }
    #tableEntry {
        border-top: 5px solid black;
    }


    .numpad-bin{
        width: 100%;
        padding:5px;
        border:none;
        margin-top:1px;
    }

    #tableEntry > tr > td.nome_artigo {
        justify-content: left;
        max-width: 40%;
        min-width: 40%;
        max-width: 100px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    #table-sidebar2 thead th.name {
        justify-content: left;
        max-width: 60%;
        min-width: 60%;
    }

    #table-sidebar2 thead th.qtd {
        justify-content: left;
        max-width: 5%;
        min-width: 5%;
        text-align: center;
    }

    #table-sidebar2 thead th.price {
        justify-content: left;
        max-width: 20%;
        min-width: 20%;
    }

    #table-sidebar2 thead th.delete {
        justify-content: left;
        max-width: 25%;
        min-width: 25%;
        background: var(--red-color) !important;
    }

    #table-sidebar2 {
        color: var(--table-text);
        font-size: 0.875rem;
        padding: 0.625rem;
        width: 100%;
    }
    #table-sidebar2 th {
        font-size: 1rem;
    }
    #table-sidebar2 th, table td {
        padding: 0.9375rem;
        text-align: left;
    }
    #table-sidebar2 tbody tr {
        background-color: var(--table-background);
    }
    #table-sidebar2 tbody tr:hover {
        background-color: black;
        box-shadow: 0 3px 5px rgba(0,0,0,0.2);
        color: white;
    }
    #table-sidebar2 tbody tr td:first-of-type {
        border-top-left-radius: 0.3125rem;
        border-bottom-left-radius: 0.3125rem;
    }
    #table-sidebar2 tbody tr td:last-of-type {
        border-top-right-radius: 0.3125rem;
        border-bottom-right-radius: 0.3125rem;
       /* text-align: center;*/
    }
    #table-sidebar2 tbody tr.priority-200 td:first-of-type {
        border-left: 0.3125rem solid var(--priority-200);
    }
    #table-sidebar2 tbody tr.priority-300 td:first-of-type {
        border-left: 0.3125rem solid var(--priority-300);
    }
    #table-sidebar2 tbody tr.priority-600 td:first-of-type {
        border-left: 0.3125rem solid var(--priority-600);
    }
    #table-sidebar2 tbody tr td .fa-circle {
        transform: scale(0.7);
    }


    .delete-btn {
        cursor: pointer;
        background-color: var(--delete-background);
        background-color: transparent;
        border: 0;
        border-radius: 0.125rem;
        color: var(--delete-color);
        font-size: 1.1rem;
        opacity: 0.2;
        padding: 0.3125rem 0.625rem;
    }
    .delete-btn:hover {
        color: var(--delete-hover);
    }
    .delete-btn:focus {
        outline: 0;
    }
    #table-sidebar2 tbody tr:hover .delete-btn {
        opacity: 1;
    }
    /* End Table Styles */

    /*modal*/
    .main-modal {
        min-width: 35%;
        z-index: 1050;
    }

    .modal-content {
        font-size: 2rem;
    }

    .main-modal-button, .main-modal-dismiss, .clear-cart-button, .clear-cart-dismiss, .receipt-dismiss, .receipt-print, .cancel-remove, .confirm-remove,.divide-price {
        margin-top: 10px;
        width: 48.5%;
        border: none;
        padding: 10px 20px !important;
    }

    .main-modal-dismiss, .clear-cart-dismiss, .receipt-dismiss, .cancel-remove {
        background: white;
        border: white;
        color: black !important;
    }

    .main-modal-button, .clear-cart-button, .confirm-remove {
        background-color: var(--red-color);
    }

    .receipt-checkbox input:checked + span{
        background-color: var(--blue-color) !important;
    }

    .close-checkbox input:checked + span{
        background-color: var(--blue-color) !important;
    }

    .receipt-print {
        font-weight: bold;
        background-color: var(--blue-color);
    }

    .main-modal-close, .receipt-close {
        color: whitesmoke;
        opacity: 1;
    }

    .main-modal-close:hover, .receipt-close:hover {
        color: whitesmoke;
    }

    .text-center {
        text-align: center !important;
    }

    .text-right{
        text-align: right !important;
    }

    .text-left{
        text-align: left !important;
    }

    /* @media (min-width: 768px)
         .clear-cart {
             width: 500px !important;
         }
 */
    .main-modal-button, .main-modal-dismiss, .modal-body, .modal-header, .modal-dismiss, #bin, .clear-cart,.divide-price {
        color: whitesmoke;
        font-weight: bold !important;
    }

    .modal-content {
        background: black;
    }

    .modal-header, .modal-footer {
        border: none;
    }

    .modal-footer {
        padding-left: 0px;
        padding-right: 0px;
    }

    .modal-title {
        color: whitesmoke;
        font-weight: bold;
    }

    .modal-header .close {
        margin-top: -20px;
    }

    .modal-center,.modal-calculator-wrapper {
        position: absolute;
        left: 50%;
        top: 45% !important;
        transform: translate(-50%, -50%) !important;
    }

    .modal-price,.modal-weight,.modal-divide,.modal-calculator{
        max-height: calc(100vh - 265px) !important;
    }

    .main-modal-body {
        max-height: calc(100vh - 435px);
    }

    /*menu burger*/

    .bt-menu {
        z-index: 150;
    }

    /*loading center*/
    .loading-center {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
    }

    /*cliente novo cliente*/
    .novo-cliente-wrapper {
        top: 20vh;
    }

    /*scroll*/

    .tableBodyScroll tbody {
        display: block;
        max-height: 350px;
        overflow-y: auto;
    }

    .tableBodyScroll thead, .tableBodyScroll
    tbody tr {
        display: table;
        width: 100%;
        table-layout: fixed;
    }

   /* #tableEntry::-webkit-scrollbar, #tableClientes::-webkit-scrollbar, #tableVendas::-webkit-scrollbar, .client-sales::-webkit-scrollbar, #tableMovimentos::-webkit-scrollbar {
        width: 20px !important;
        height: 20px !important;
        border-right: 0px solid #fff !important;
    }

    #tableEntry::-webkit-scrollbar-thumb, #tableClientes::-webkit-scrollbar-thumb, #tableVendas::-webkit-scrollbar-thumb, .client-sales::-webkit-scrollbar-thumb, #tableMovimentos::-webkit-scrollbar-thumb {
        background-color: var(--main-color) !important;
        border-right: 0px solid #fff !important;
    }

    #tableEntry::-webkit-scrollbar-track, #tableClientes::-webkit-scrollbar-track, #tableVendas::-webkit-scrollbar-track, .client-sales::-webkit-scrollbar-track, #tableMovimentos::-webkit-scrollbar-track {
        background-color: #2f363b !important;
        border-right: 0px solid #fff !important;
    }

    #tableEntry::-webkit-scrollbar-thumb:hover, #tableClientes::-webkit-scrollbar-thumb:hover, #tableVendas::-webkit-scrollbar-thumb:hover, .client-sales::-webkit-scrollbar-thumb:hover, #tableMovimentos::-webkit-scrollbar-thumb:hover {
        background-color: var(--secondary-color) !important;
        border-right: 0px solid #fff !important;
    }*/

    #table-sidebar2 thead th.price{
        text-align:center;
    }

    /*Date Time*/

    #date_time {
        font-size: 16px;
        line-height: 58px;
    }

    .border-1 {
        border: 1px solid transparent;
    }

    .search-form {
        vertical-align: top;
        margin-right: 20px;
        color: black;
        line-height: 55px;
    }

    .clear-input {
        background-color: var(--red-color);
        color: white;
    }

    .fechar-button-wrapper {
        /*   bottom: 46px;*/
        bottom: 0px;
    }

    #search-input {
        background: #2f363b;
        border: none;
        color: white;
        padding: 2px 2px 2px 5px;
        font-family: sans-serif, Arial;
        font-weight: bold
    }

    .tables-icon {
        width: 57px;
        vertical-align: top;
    }

    .table-sidebar-wrapper2 {
        /*   max-height: 39.5%;*/
        max-height: 51%;
    }

    .clock{
        margin-left: 15px
    }

    #productsContainerDisplay {
        height: 77.5vh !important;
        overflow-x: hidden !important;
    }


    #productsContainer {
        height: 89vh !important;
    }

    .main-controls-alt{
        position: absolute;
        bottom: 0px;
        right: 0px;
        width: 100%;
        left: 0px;
        display: block;
        padding-left: 12px !important;
        padding-right: 12px !important;
    }

    .set-total{
	    background-color: var(--blue-color);
    }

    .division-cancel{
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;
        background: var(--red-color);
    }

    @media only screen
    and (min-width: 800px) and (max-width: 1279px){
        #date_time{
            font-size: 11px !important;
        }

        #search-input{
            width: 150px;
        }

        .pay-value-money-label{
            font-size: 17px !important;
        }

        .partial-modal {
            min-width: 95% !important;
        }

        .rou {
            font-size: 2.0rem !important;
        }
    }

    @media only screen
    and (max-height: 767px){
        .cart-table-height-alter-controls {
            max-height: 62% !important;
        }

        .main-controls {
            bottom: 25px !important;
        }

        .sale-controls {
           /* bottom: 29px !important;*/
        }

        #productsContainer {
            height: 86vh !important;
        }

        .modal-keyboard {
            max-height: calc(100vh - 110px) !important;
        }

        .modal-calculator {
            max-height: calc(100vh - 65px) !important;
        }
        .modal-calculator-wrapper{
            top: 50%;
        }

        .modal-keyboard-wrapper{
            top: 50%;
        }
    }




    @media only screen
    and (min-height: 768px) and (max-height: 1023px)  {
        #productsContainer {
            height: 87vh !important;
        }

        #productsContainerDisplay {
            height: 77.5vh !important;
        }
        .modal-center {
            min-width: 70% !important;
        }

        .modal-calculator-wrapper {
            min-width: 45% !important;
            top: 50%!important;
        }

        .modal-calculator {
            max-height: calc(100vh - 110px) !important;
        }


        .modal-keyboard-wrapper {
            min-width: 45% !important;
            top: 50%!important;
        }

        .modal-keyboard {
            max-height: calc(100vh - 110px) !important;
        }

        .clock{
            margin-left: 5px
        }

	    #tablesPrintBill,#tablesPayment,#tablesPartialPayment,#tablesClean,#tablesReplicate{
	        max-width: 195px;
	        white-space: nowrap;
	        overflow: hidden;
	        text-overflow: ellipsis;
	    }

	    .tab-wrapper{
         /*   max-width: 200px;*/
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
	    }

	    .sale-controls{
           /* bottom: 23px !important;*/
	    }

        .total-table-wrapper,.partial-table-wrapper{
            top: 17%;
        }

        #all-right,#all-left{
            top: 40px;
        }

        .cart-table-height-alter-controls {
            max-height: 62% !important;
        }

        .main-controls{
	        bottom: 15px !important;
        }
    }

    @media only screen
    and (min-width: 800px) and (max-width: 1279px){
        #date_time{
            font-size: 11px !important;
        }

        #search-input{
            width: 150px;
        }

        .pay-value-money-label{
            font-size: 17px !important;
        }

        .partial-modal {
            min-width: 95% !important;
        }

        .rou {
            font-size: 2.0rem !important;
        }

        #table-sidebar2 thead th.name {
            max-width: 50%;
            min-width: 50%;
        }

        #table-sidebar2 thead th.price {
            max-width: 30%;
            min-width: 30%;
        }
    }

    @media only screen
    and (min-width: 1300px) {
        .table-sidebar-big {
            /*max-height: 73% !important;*/
            max-height: 65% !important;
        }

        .product_wrapper , .product_wrapper_attributes {
            width: 195px !important;
        }
    }

    @media only screen
    and (min-width: 1224px) {
        .table-sidebar-big {
            /*max-height: 73% !important;*/
            max-height: 65% !important;
        }

        .product_wrapper , .product_wrapper_attributes {
            width: 195px !important;
        }

        .table-head-1 {
            width: 60%;
        }

        .table-head-2 {
            width: 15%;
        }

        .table-head-3 {
            width: 35%;
        }

        .table-head-4 {
            width: auto;
        }

        .attr,.attr-main {
            width: 197px !important;
            left: 10px;
        }
    }

    @media only screen
    and (min-height: 1080px){
        #productsContainer {
            height: 89vh !important;
        }

        #productsContainerDisplay {
            height: 78.5vh !important;
            padding-bottom: 0 !important;
        }


        .clock{
            margin-left: 5px
        }

        .tab-wrapper{
            /*max-width: 200px;*/
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .sale-controls{
            /*bottom: 23px !important;*/
        }

        .total-table-wrapper,.partial-table-wrapper{
            top: 17%;
        }

        #all-right,#all-left{
            top: 40px;
        }

        .cart-table-height-alter-controls {
            max-height: 75% !important;
        }

        #sidebarSellContainer{
            height: 83vh !important;
        }
    }

    @media only screen
    and (min-height: 1024px) and (max-height: 1079px){
        #productsContainer {
            height: 89vh !important;
        }

        #productsContainerDisplay {
            height: 78.5vh !important;
	        padding-bottom: 0 !important;
        }
       /* .modal-center {
            min-width: 70% !important;
        }*/

        .clock{
            margin-left: 5px
        }

        #tablesPrintBill,#tablesPayment,#tablesPartialPayment,#tablesClean,#tablesReplicate{
            max-width: 195px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .tab-wrapper{
           /* max-width: 200px;*/
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .sale-controls{
           /* bottom: 23px !important;*/
        }

        .total-table-wrapper,.partial-table-wrapper{
            top: 17%;
        }

        #all-right,#all-left{
            top: 40px;
        }

        .cart-table-height-alter-controls {
            max-height: 75% !important;
        }

        #sidebarSellContainer{
            height: 82vh !important;
        }

        #table-sidebar2 thead th.name {
            max-width: 50%;
            min-width: 50%;
        }

        #table-sidebar2 thead th.price {
            max-width: 30%;
            min-width: 30%;
        }

    }

    @media only screen
    and (min-width: 1281px) and (max-width: 1366px){
        .cart-table-height-alter-controls {
            max-height: 65% !important;
        }
    }



    @media only screen
    and (min-width: 1501px) {
        .product_wrapper , .product_wrapper_attributes {
            width: 186px !important;
        }

        .table-head-1 {
            width: 55%;
        }
    }

    @media only screen
    and (min-width: 1701px) {
        .product_wrapper , .product_wrapper_attributes {
            width: 171px !important;
        }

        .table-head-1 {
            width: 50%;
        }
    }

    @media only screen
    and (min-width: 1919px) {
        .product_wrapper , .product_wrapper_attributes {
            width: 172px !important;
        }

        .attr,.attr-main {
            width: 227px !important;
            left: 10px;
        }
    }

    .panel.panel-blue-depth {
        min-height: 97vh !important;
        max-height: 97vh !important;
    }

    body {
        overflow: hidden !important;
    }

    .numpadMainWrapper {
        bottom: 28px;
    }

    .page-content {
        padding-top: 15px !important;
        padding-bottom: 15px !important;
    }


    .panel-heading, .left-items-head {
        border: none !important;
    }

    /*tabela scroll*/

    .content {
        background: #BBDEFB;
    }

    .scrollable-content {
        background: white;
        flex-grow: 1;

        overflow: auto;

        /* for Firefox */
        min-height: 0;
    }

    .section {
        flex-grow: 1;

        display: flex;
        flex-direction: column;

        /* for Firefox */
        min-height: 0;
    }

    .container-table {
        top: 0;
        bottom: 0;
        left: 0;
        display: flex;
        flex-direction: column;
    }

    /*tabela clientes*/

    .details-btn{
        border: none;
    }

    @media only screen
    and (min-width: 1224px) {
        .details-btn {
            flex-basis: 20%;
        }
    }

    @media only screen
    and (min-width: 1501px) {
        .details-btn {
            flex-basis: 7%;
        }
    }

    @media only screen
    and (min-width: 1701px) {
        .details-btn {
            flex-basis: 6%;
        }
    }

    @media only screen
    and (min-width: 1919px) {
        .details-btn {
            flex-basis: 12%;
        }
    }

    /*#tableClientes > tr, .clients-head, #table-vendas > tbody > tr, #table-movimentos > tbody > tr {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;

    }*/

    /*#tableClientes > tr > td.nome_cliente, #tableClientes > tr > td.nif_cliente, .head-item, .nome_cliente_venda, .nif_cliente_venda, .data_venda, .numero_venda {
        flex-basis: 100%;
        text-align: left;
        !* border: 1px solid black;*!
    }*/

    #table-vendas tbody tr td, #table-clientes tbody tr td, #table-movimentos tbody tr td {
        padding: 40px 40px 40px 15px;
        font-weight: bold !important;
    }

    #table-clientes tbody tr td.eye-button,#table-clientes tbody tr td.pencil-button, #table-vendas tbody tr td.eye-button {
        padding-left: 40px;
    }

    #panelMainContent {
        padding-bottom: 0 !important;
    }

    .btn-blue {
        color: #fff;
        background-color: #337ab7;
        border-color: #2e6da4;
    }

    .btn-blue:hover {
        color: #fff;
        background-color: #286090;
        border-color: #204d74;
    }

    /*Tables layout*/

    /*.pagination-wrapper {
        position: absolute;
        bottom: 60px;
        right: 195px;
        color: white;
    }*/

    .panel-body {
        position: relative;
    }


    .room-active {
        background-color: var(--secondary-color) !important;
    }

    .tab-wrapper {
        display: inline-block;
    }

    .new-room {
        position: absolute;
        bottom: 60px;
        right: 70px;
        display: inline-block;
        padding: 10 15px;
        font-size: 2rem;
        transform: translate(0, -3px);
        margin-bottom: -10px !important;
        background-color: var(--green-color);
        cursor: pointer
    }

    .remove-room {
        position: absolute;
        bottom: 60px;
        right: 20px;
        display: inline-block;
        padding: 14 15px;
        font-size: 2rem;
        transform: translate(0, -3px);
        margin-bottom: -10px !important;
        background-color: var(--red-color);
        cursor: pointer;
        border: none;
    }

    .pagination-wrapper i {
        color: black !important;
        display: inline-block;
    }

    .pages-mesas {
        padding: 10px 15px;
    !important;
    }

    .seta-page {
        transform: translate(0, 5px);
    }

    .warning-wrapper {
        position: absolute;
        top: 15vh;
        /* left: 15vh; */
        left: 50%;
        margin-left: -225px;
        background-color: black;
        color: white;
        padding: 15px;
        font-size: 2rem;
        max-width: 450px;
        z-index: 800;
    }

    .text-warning-wrapper {
        margin-bottom: 35px;
        text-align: justify;
    }

    .button-warning-wrapper {
        /* text-align: center; */
    }

    .no-button {
        background-color: var(--red-color) !important;
        border: none;
        padding: 10px 20px !important;
    }

    .yes-button {
        background-color: var(--green-color) !important;
        border: none;
        margin-right: 20px;
        padding: 10px 20px !important;
    }

    .warning-wrapper-remove {
        position: absolute;
        top: 15vh;
        /* left: 15vh; */
        left: 50%;
        margin-left: -225px;
        background-color: black;
        color: white;
        padding: 15px;
        font-size: 2rem;
        max-width: 600px;
        z-index: 800;
    }

    .no-remove {
        width: 49.5%;
        background-color: var(--red-color) !important;
        border: none;
        padding: 10px 20px !important;
    }

    .yes-remove {
        width: 49.5%;
        background-color: var(--green-color) !important;
        border: none;
        padding: 10px 20px !important;
    }

    /*botão dentro dos inputs*/

    .input-search-cliente,.btn-create-cliente {
        display: flex;
        flex-direction: row;
        border: 1px solid grey;
        padding: 2px;
    }

    #search-input-vendas, #search-input-clientes, #search-input-movimentos, #search-input-date-start,#search-input-date-end,
    #search-input-date-start-venda,#search-input-date-end-venda,#search-input-date-stations{
        flex-grow: 2;
        border: none;
    }

    [type="date"]::-webkit-inner-spin-button {
        display: none;
    }
    /* [type="date"]::-webkit-calendar-picker-indicator {
         display: none;
     }*/

    #search-input-vendas:focus, #search-input-clientes:focus, #search-input-movimentos:focus {
        outline: none;
    }

    .input-search-cliente-btn {
        border: 1px solid var(--red-color);
        background: var(--red-color);
        color: white;
        width: 63px;
    }

    .input-search-cliente-btn > i {
        font-size: 25px;
    }

    .header-vendas, .header-clientes, .header-movimentos {
        display: flex;
    }

    /*tables delete*/
    .delete-table-icon {
       /* position: absolute;
        top: 10px;
        left: 14px;
        color: var(--red-color);
        text-shadow: -1px 0 white, 0 1px white, 1px 0 white, 0 -1px white;*/
        position: absolute;
        top: -12px;
        left: -12px;
        color: var(--red-color);
        text-shadow: -1px 0 white, 0 1px white, 1px 0 white, 0 -1px white;
        background: #fff;
        border-radius: 50px;
        width: 25px;
        height: 25px;
        padding-left: 1px;
        border: 2px solid var(--red-color);
        font-size: 30px;
        line-height: 0.75;
    }

    .close-nav-button{
        position: absolute;
        color: var(--red-color);
        text-shadow: -1px 0 white, 0 1px white, 1px 0 white, 0 -1px white;
        background: #fff;
        border-radius: 50px;
        border: 2px solid var(--red-color);
        top: 20px;
        left: 20px;
        font-size: 45px;
        width: 50px;
        height: 50px;
        line-height: 1;
        padding-left: 9px;
        cursor: pointer;
    }

    .edit-table-icon{
        position: absolute;
        top: -12px;
        left: 18px;
        color: var(--blue-color);
        text-shadow: -1px 0 white, 0 1px white, 1px 0 white, 0 -1px white;
        background: #fff;
        border-radius: 50px;
        width: 25px;
        height: 25px;
        padding-left: 1px;
        border: 2px solid var(--blue-color);
    }

    .replicate-table-icon{
        position: absolute;
        top: -12px;
        left: 50px;
        color: var(--orange-color);
        text-shadow: -1px 0 white, 0 1px white, 1px 0 white, 0 -1px white;
        background: #fff;
        border-radius: 50px;
        width: 25px;
        height: 25px;
        padding-left: 1px;
        border: 2px solid var(--orange-color);
    }

    .delete-line-ver-icon {
        position: absolute;
        top: 10px;
        left: 2px;
        color: var(--red-color);
        text-shadow: -1px 0 white, 0 1px white, 1px 0 white, 0 -1px white;
        top: 4px;
        left: -5px;
    }
    .delete-line-hor-icon {
        position: absolute;
       /* top: 1.1px;
        left: 10px;*/
        color: var(--red-color);
        text-shadow: -1px 0 white, 0 1px white, 1px 0 white, 0 -1px white;
        top: -6px;
        left: 3px;
    }

    .delete-label-icon{
        /*position: absolute;
        top: 8.1px;
        left: 10px;
        color: var(--red-color);
        text-shadow: -1px 0 white, 0 1px white, 1px 0 white, 0 -1px white;*/
        position: absolute;
        top: -12px;
        left: -12px;
        color: var(--red-color);
        text-shadow: -1px 0 white, 0 1px white, 1px 0 white, 0 -1px white;
        background: #fff;
        border-radius: 50px;
        width: 25px;
        height: 25px;
        padding-left: 1px;
        border: 2px solid var(--red-color);
        font-size: 30px;
        line-height: 0.75;
    }

    span.deleteicon {
        position: relative;
    }

    span.deleteicon span {
        position: absolute;
        display: block;
        top: 5px;
        right: 0px;
        width: 16px;
        height: 16px;
        content: "\f066";
        cursor: pointer;
    }

    span.deleteicon input {
        padding-right: 16px;
        box-sizing: border-box;
    }

    .vertical-divider {
        clear: both;
        position: relative;
    }

    .vertical-divider:after {
        clear: both;
        content: " ";
        display: block;
        height: 0;
        visibility: hidden;
    }

    .vertical-divider .divider:not(:first-child):after, .vertical-divider .divider:not(:first-child):after {
        background: #DDDDDD;
        bottom: 0;
        content: " ";
        margin-left: 5px;
        position: absolute;
        top: 0;
        width: 3px;
        margin-top: 5px;
        margin-bottom: 5px;
    }

    /*modal de editar mesa*/
    .name-to-edit {
        display: block;
        width: 100%;
        height: 34px;
        line-height: 1.42857143;
    }

    #new-table-select {
        font-size: 2rem;
        height: 45px;
        margin-bottom: 10px;
    }

    .create-button {
        background-color: var(--green-color);
    }

    .edit-button {
        background-color: var(--blue-color);
    }

    .field-empty {
        border: 2px solid var(--red-color);
    }

    .field-empty-error, .field-invalid-error {
        font-size: 15px !important;
        color: var(--error-color) !important;
    }

    .input-error {
        color: var(--error-color) !important;
    }

    /*#tableVendas::-webkit-scrollbar, #productsContainerDisplay::-webkit-scrollbar, .client-sales::-webkit-scrollbar {
        width: 20px !important;
    }*/

    .disable-click {
        pointer-events: none
    }

    .pagination-wrapper i {
        color: black !important;
        display: inline-block;
    }

    .pages-mesas {
        margin: 11px;
    }

    .light-blue {
        background-color: var(--light-blue);
    }

    .light-grey {
        background-color: var(--light-grey);
    }

    .movimento-td {
        flex-basis: 100%;
        text-align: left;
    }

    #table-movimentos tbody tr td {
        padding-left: 15px;
    }

    .pagination-wrapper {
        position: absolute;
        bottom: 60px;
    }

    .panel-body {
        position: relative;
    }

    .tab-wrapper {
        display: inline-block;
    }

    .pagination-wrapper i {
        color: black !important;
        display: inline-block;
    }

    .pages-mesas {
        padding: 10px 15px; !important;
        margin: 0px;
    }

    .seta-page {
        transform: translate(0, 5px);
    }

    #tableEntry > tr > td.nome_artigo{
       /* width: 45%;
        position: relative;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        display: inline-block;
        line-height: 3;*/
    }

    .label{
        padding-left: 15px;
    }

    .span-name-cliente:before {
        font: normal normal normal 14px/1 FontAwesome;
        content: "\f362";
        padding-right: 10px;
    }

    .span-nif-cliente:before {
        font: normal normal normal 14px/1 FontAwesome;
        content: "\f079 ";
        padding-right: 10px;
    }

    .span-create-cliente:before {
        font: normal normal normal 14px/1 FontAwesome;
        padding-right: 10px;
    }

    .span-create-cliente,#cliente-create{
        font-weight: bolder;
        cursor: pointer;
    }


    .span-nif-cliente{
        font-size: 15px;
        font-weight: bold;
    }

    .span-name-cliente{
        font-size: 15px;
        display: inline-block;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        -o-text-overflow: ellipsis;
        max-width: 100%;
    }

    .clients-th-head{
        padding-right: 50px !important;
    }

    .client-sales-modal{
        min-width: 50%;
    }

    .selected-row{
       /* color: black;
        text-decoration: underline;
        background-color: white;*/
    }

    #table-clientes,#table-vendas,#table-movimentos{
        height: 77.5vh !important;
    }

    .pay-back{
        position: relative;
        cursor: pointer;
        justify-content: center;
        display: inline-flex;
        align-items: center;width:50%;
        margin-bottom: 1.4%;
    }

    .pay-title{
        position: relative;
        display: inline-flex;
        justify-content: center;
        align-items: center;
        width:49%;
        margin-bottom: 1.4%;
    }

    .modal-client{
        min-width: 45% !important;
    }

    .label, .line{
        cursor: pointer;
    }

    #fechar-confirmar-btn,.submit_button,#fechar-confirmar-btn:hover,.submit_button:hover {
        background-color: var(--green-color);
        border-color: var(--green-color);
        font-weight: bold;
    }

    .count_money_button,.count_money_button:hover{
        background-color: var(--orange-color);
        border-color: var(--orange-color);
        font-weight: bold;
        color: white !important;
        width: 100%;
    }

    .cancel-back-button{
        background: white;
        border: white;
        color: black !important;
        font-weight: bold;
    }

    .caixa-back{
        position: absolute;
        margin-top: 0;
        margin-left: 10px;
        z-index: 1;
        border: solid;
    }

    .hr-thick{
        width: 99%;
    }

    .client-euro-btn{
        color: var(--green-color);
        /* text-shadow: -1px 0 #333, 0 1px #333, 1px 0 #333, 0 -1px #333;*/
        font-size: 3rem;
    }

    .client-edit-btn,.vendas-print-btn,.movimentos-print-btn{
        color: var(--blue-color);
        /*text-shadow: -1px 0 #333, 0 1px #333, 1px 0 #333, 0 -1px #333;*/
        font-size: 3rem;
    }

    .client-info-btn{
        color: var(--orange-color);
        /* text-shadow: -1px 0 #333, 0 1px #333, 1px 0 #333, 0 -1px #333;*/
        font-size: 3rem;
    }


    .numero_venda{
        padding: 0;
    }

    .right-align{
        text-align: right;
    }

    .movimento_total.less{
        color: var(--soft-red-color);
        flex-basis: 100%;
        text-align: right;
        /*  text-shadow: -1px 0 #333, 0 1px #333, 1px 0 #333, 0 -1px #333;*/
    }

    .movimento_total.more,.numero_venda.more{
        color: var(--green-color);
        flex-basis: 100%;
        text-align: right;
        /*   text-shadow: -1px 0 #333, 0 1px #333, 1px 0 #333, 0 -1px #333;*/
    }

    #vendasWrapper,#movimentosWrapper{
        padding: 5px 15px;
    }

    #doc{
        background-color: var(--blue-color);
        color: white;
    }

    .current-page-title{
        vertical-align: top;
        margin-right: 20px;
        color: whitesmoke;
      /*  line-height: 57px;*/
        line-height: 57px;
       /* font-size: 2rem;*/
        font-size: 22px;
        font-weight: bold;
    }

    .no-print-btn{
        position: absolute;
        top: -10px;
        left: 46px;
        color: var(--red-color) !important;
        font-size: 50px;
        font-weight: 400;
    }

    .no-print-close-btn{
        position: absolute;
        top: -10px;
        left: 49px;
        color: var(--red-color) !important;
        font-size: 50px;
        font-weight: 400;
    }

    .receipt-checkbox,.check-btns,.close-checkbox {
        margin:4px;
        background-color:#EFEFEF;
        border-radius:4px;
        /* border:1px solid #D0D0D0;*/
        overflow:auto;
        float:left;
        background-color: grey;
        overflow-y: hidden;
    }

    .receipt-checkbox label,.check-btns label,.close-checkbox label {
        float:left;
        width:4.0em;
    }

    .receipt-checkbox label span,.check-btns label span,.close-checkbox label span{
        text-align:center;
        padding:3px 0px;
        display:block;
        color: white;
    }

    .receipt-checkbox label input,.check-btns label input,.close-checkbox label input {
        position:absolute;
        top:-20px;
    }

    .receipt-checkbox input:checked + span,.check-btns input:checked + span,.close-checkbox input:checked + span {
        background-color: black;
        color:#fff;
    }

    #tables-print-bill-btn input:checked + span{
        background-color: var(--blue-color);
    }

    #tables-payment-btn input:checked + span{
        background-color: var(--green-color);
    }

    #tables-partial-payment-btn input:checked + span{
        background-color:  var(--main-color);
    }

    #tables-clean-btn input:checked + span{
        background-color:  var(--red-color);
    }

    .open-cache-draw{
        width:100%;
        text-align: center;
        background-color: var(--light-purple-color);
        padding: 14px;
        font-size: 2rem;
        color: white;
        position: absolute;
        bottom: 0;
        border:0;
        height: 57px;
    }

    .open-cache-draw:hover,.open-end-actions:hover,.open-cache-draw:hover{
        background-color: var(--light-black-color) !important;
        color: white !important;
    }

    .open-end-actions{
        width:100%;
        text-align: center;
        background-color: var(--green-color);
        padding: 14px;
        font-size: 2rem;
        color: white;
        position: absolute;
        bottom: 0;
        border:0;
        height: 57px;
    }

    /*.open-end-actions:hover{
        background-color: var(--green-color) !important;
        color: white;
    }*/

    #close-checkbox-input{
	    display: none !important;
    }

    .receipt-checkbox{
        cursor: pointer;
        width: 98.5%;
        text-align: center;
        font-size: 2rem;
        color: white;
        position: absolute;
        bottom: 0;
        border-radius: 0;
        margin: 0;
        height: 57px;
    }

    .close-checkbox{
        cursor: pointer;
        width: 100%;
        text-align: center;
        font-size: 2rem;
        color: white;
        bottom: 0;
        border-radius: 0;
        margin: 0;
        height: 58px;
    }

    .receipt-checkbox label,.close-checkbox label{
        cursor: pointer;
    }

    @media  screen and (max-width: 1280px) {
        .no-print-btn{
            left: 46px;
        }

	    .no-print-close-btn{
            left: 40px;
	    }
    }

    @media  screen and (min-width:1280px) and (max-width: 1360px) {
        .rou {
            font-size: 2.0rem !important;
        }
    }

    @media  screen and (min-width:1281px) and (max-width: 1366px) {
        .no-print-btn{
            left: 52px;
        }
        .no-print-close-btn{
            left: 48px;
        }

        .rou {
            font-size: 2.0rem !important;
        }
    }

    @media  screen  and (min-width:1367px) and (max-width: 1920px) {
        .no-print-btn{
            left: 99px;
        }
        .no-print-close-btn{
            left: 104px;
        }

        .rou {
            font-size: 2.3rem !important;
        }
    }
    #attributes-check input:checked + span {
        background-color: whitesmoke;
        color: black;
    }

    .attr,.attr-main{
        margin-bottom: 5px !important;
    }

    .attr-main-body{
        background-color: whitesmoke;

    }

    .attr-main-body-title{
        color: black;
    }

    /*#view-morada-cliente,#view-nif-cliente,#view-nome-cliente,#view-codigopostal-cliente,#view-tele-cliente{
        background: white;
        padding: 5px;
        color: black;
    }*/

    .btn-vendas{
        background: var(--orange-color);
    }

    .special_pos_footer .container {
        padding: 15px !important;
    }

  input[type="date"]::-webkit-clear-button {
        display: none;
    }
     input[type="time"]::-webkit-clear-button {
        display: none;
    }

    ::-webkit-clear-button{
        -webkit-appearance: none;
    }

    /*input[type="date"]::-webkit-inner-spin-button,
    input[type="date"]::-webkit-calendar-picker-indicator {
        display: none;
        -webkit-appearance: none;
    }*/

    .product-price-tag{
        display: none;
    }

    .btn-search{
        border: 1px solid var(--blue-color);
        background: var(--blue-color);
        color: white;
        width: 63px;
        font-size: 25px;
    }

    .ui-datepicker, .ui-datepicker a{
        font-size:20px !important;
    }

    .datepicker table tr td.day,.month,.year  {
        color: black;
    }

    .datepicker table tr td.old, .datepicker table tr td.new {
        color: #999999;
    }

    .datepicker-switch,.prev,.next,.dow{
        font-weight: bold;
        color: black;
    }

    .datepicker table tr td, .datepicker table tr th {
        text-align: center;
        width: 45px;
        height: 45px;
        border-radius: 4px;
        border: none;
    }

    table.dataTable thead > tr > th {
        background-color: var(--light-black-color) !important;
    }

    table.dataTable thead .sorting::before,
    table.dataTable thead .sorting::after,
    table.dataTable thead .sorting_asc::before,
    table.dataTable thead .sorting_asc::after,
    table.dataTable thead .sorting::before,
    table.dataTable thead .sorting_asc::before,
    table.dataTable thead .sorting_desc::before,
    table.dataTable thead .sorting_asc_disabled::before,
    table.dataTable thead .sorting_desc_disabled::before,
    table.dataTable thead .sorting_asc::before,
    table.dataTable thead .sorting_desc::after{
        opacity:0;
    }

    .label-abertura-caixa{
        font-size: 3rem;
        font-weight: normal !important;
    }

    .delete-art{
        color: white;
    }

    .tr-money{
        text-align: center;
    }

    .exchange-main + label,.exchange_item + label,.station_item + label {
        display: block;
        margin: 0.2em;
        cursor: pointer;
        padding: 0.2em;
    }

    .exchange-main,.exchange_item,.station_item {
        display: none;
    }

    .station_item + label::before{
        width: 30px !important;
        height: 30px !important;
        padding-left: 0 !important;
    }

    .disabled-station:before{
        background: red !important;
    }

    .exchange-main + label:before,.exchange_item + label:before,.station_item + label:before {
        content: "\2714";
        border: 0.1em solid var(--grey--color);
        background: var(--grey--color);
        border-radius: 0.2em;
        display: inline-block;
        width: 23px;
        height: 23px;
        padding-left: 0.2em;
        padding-bottom: 0.3em;
        margin-right: 0.2em;
        vertical-align: bottom;
        color: transparent;
        transition: .2s;
    }

    .exchange-main + label:active:before,.exchange_item + label:active:before,.station_item + label:active:before {
        transform: scale(0);
    }

    .exchange-main:checked + label:before,.exchange_item:checked + label:before,.station_item:checked + label:before {
        background-color: MediumSeaGreen;
        border-color: MediumSeaGreen;
        color: #fff;
    }

    .exchange-main:disabled + label:before,.exchange_item:disabled + label:before,.station_item:disabled + label:before {
        transform: scale(1);
        border-color: #aaa;
    }

    .exchange-main:checked:disabled + label:before, .exchange_item:checked:disabled + label:before,.station_item:checked:disabled + label:before {
        transform: scale(1);
        background-color: #bfb;
        border-color: #bfb;
    }

    .datepicker.dropdown-menu{
        font-family: 'Open Sans', sans-serif;
    }

    .search-main{
        content: "\f002";
    }

    .tables-icon:hover,
    .tables-icon:focus {
        filter: brightness(0) invert(1);
    }

    .nif-active{
        background-color: #606060 !important;
    }

    .nif-unlocked{
        background-color: var(--blue-color);
    }

    .pointer{
        cursor: pointer;
    }


    /**/
    .circCont {
      /*  display: inline-block;*/
    }

    .circle {
        background: white;
        width: 40px;
        height: 40px;
       /* background: transparent;*/
        border: 4px solid var(--red-color);
        -moz-border-radius: 50%;
        -webkit-border-radius: 50%;
        border-radius: 50%;
        position: relative;
        cursor: pointer;
        display: inline-block;
        margin: 10px 20px;
    }
    .circle:after {
        width: 24px;
        height: 4px;
        background-color: var(--red-color);
        content: "";
        left: 50%;
        top: 50%;
        margin-left: -12px;
        margin-top: -2px;
        position: absolute;
        -moz-transform: rotate(-45deg);
        -ms-transform: rotate(-45deg);
        -webkit-transform: rotate(-45deg);
        transform: rotate(-45deg);
        /*@include transform-origin(100%,100%);*/
    }
    .circle:before {
        left: 50%;
        top: 50%;
        margin-left: -12px;
        margin-top: -2px;
        width: 24px;
        height: 4px;
        background-color: var(--red-color);
        content: "";
        position: absolute;
        -moz-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        -webkit-transform: rotate(45deg);
        transform: rotate(45deg);
        /*@include transform-origin(0%,0%);*/
    }

    .simpleRotate {
        -moz-animation: rotate 0.1s 2 ease-in-out alternate;
        -webkit-animation: rotate 0.1s 2 ease-in-out alternate;
        animation: rotate 0.1s 2 ease-in-out alternate;
    }

    @-moz-keyframes rotate {
        0% {
            -moz-transform: scale(1);
            transform: scale(1);
        }
        100% {
            -moz-transform: scale(0.8);
            transform: scale(0.8);
        }
    }
    @-webkit-keyframes rotate {
        0% {
            -webkit-transform: scale(1);
            transform: scale(1);
        }
        100% {
            -webkit-transform: scale(0.8);
            transform: scale(0.8);
        }
    }
    @keyframes rotate {
        0% {
            -moz-transform: scale(1);
            -ms-transform: scale(1);
            -webkit-transform: scale(1);
            transform: scale(1);
        }
        100% {
            -moz-transform: scale(0.8);
            -ms-transform: scale(0.8);
            -webkit-transform: scale(0.8);
            transform: scale(0.8);
        }
    }
    .circle[data-animation="simpleRotate"]:not(.simpleRotate) {
        -moz-transition: cubic-bezier(0.175, 0.885, 0.52, 1.775) 200ms;
        -o-transition: cubic-bezier(0.175, 0.885, 0.52, 1.775) 200ms;
        -webkit-transition: cubic-bezier(0.175, 0.885, 0.52, 1.775) 200ms;
        transition: cubic-bezier(0.175, 0.885, 0.52, 1.775) 200ms;
    }
    .circle[data-animation="simpleRotate"]:not(.simpleRotate):hover {
        -moz-transform: scale(1.1);
        -ms-transform: scale(1.1);
        -webkit-transform: scale(1.1);
        transform: scale(1.1);
    }

    .force-open{
        display: block !important;
    }

    .keyboard-corner{
        position: absolute;
        bottom: 375px;
        right: 40px;
       /* width: 0;*/
       /* text-align: right;*/
    }

    .padding-5{
        padding:5px;
    }

    .padding-1{
        padding:1px;
        padding-bottom:5px;
    }

    .notas-btn{
        position: absolute;
        color: var(--grey-color)
    }

    .notas-exists{
        color: var(--blue-color) !important;
    }

    .tr-money{
        max-width: 70px;
        color: white
    }

    .row-money-count {
        border-color: white !important;
    }

    .nota-div{
        left: -10px;
    }

    #numpadWrapper{
        z-index: 90;
    }

    /*Datatables*/

    #tableAllVendas,#tableAllClientes,#tableAllMovimentos,#tablePosClose{
        margin-top: 0 !important;
        padding-top: 0 !important;
    }

    .datatable-pos.dataTable tr th{
        position: sticky !important;
        top: 0 !important;
        margin-top: 0 !important;
    }

    .datatable-pos.dataTable thead .sorting, .datatable-pos.dataTable thead .sorting_asc, .datatable-pos.dataTable thead .sorting_desc, .datatable-pos.dataTable thead .sorting_asc_disabled, .datatable-pos.dataTable thead .sorting_desc_disabled {
        cursor: pointer;
        *cursor: hand: ;
        background-repeat: no-repeat;
        background-position: center left;

    }
    .datatable-pos {
        color: var(--table-text);
        font-size: 0.875rem;
        padding: 0.625rem;
        width: 100%;
        margin-top: 0 !important;
        padding: 0;
    }
    .datatable-pos th {
        font-size: 2rem;
    }
    .datatable-pos th, table td {
        padding: 0.9375rem;
        text-align: left;
        font-weight: bold;
    }

    .datatable-pos tbody tr:nth-child(odd){
        background-color: #d9d9d9;
    }

    .datatable-pos.dataTable tbody th, table.dataTable tbody td {
        padding: 40px 10px;
    }

    .datatable-pos.dataTable thead > tr > th{
        color: white;
        font-weight: bold;
        font-size: 20px;
        padding: 20px;
    }

    .datatable-pos tbody tr {
        font-size: 2rem;
    }
    .datatable-pos tbody tr:hover {
        background-color: var(--light-blue) !important;
        box-shadow: 0 3px 5px rgba(0,0,0,0.2);
    }


    .table-vendas-wrapper,.table-clientes-wrapper,.table-movimentos-wrapper{
        overflow-y: scroll;
        overflow-x: hidden;
        height: 77.5vh !important;
    }

    .btn-print-movement{
        width: 100px;
    }

    #numpadToggler:hover{
        color: white !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered{
        border-radius: 0;
        height: 46px;
        /*font-size: 1.5rem;*/
      /*  color: #555;*/
        line-height: 40px;
    }

    .select2-container--default .select2-selection--single{
        border-radius: 0;
        height: 42px;
        border: 0
    }

    .select2-container--default .select2-selection--single .select2-selection__arro{
        height: 100%;
    }

  /*  .select2-container--default .select2-results > .select2-results__options{
        background: black;
    }*/

    .select2-container--default .select2-search--dropdown .select2-search__field{
      /*  background-color: black;
        border: 1px solid black;*/
        padding: 10px 10px;
        font-size: 1.5rem;
    }

    /*.select2-search--dropdown{
        background-color: #222;
    }*/

    .select2-container--default .select2-results__option[aria-selected="true"]{
        background-color: var(--main-color);
        color: white;
    }

    .select2-results__option[aria-selected]{
        padding: 10px 10px;
        font-size: 1.5rem;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow{
        height: 100%;
    }

    .input-group .input-group-btn .btn.btn-info{
        border-color: var(--info-blue-color) !important;
    }

    .span-user-nif-info{
        z-index: 0;
        margin: 0;
        height: 100%;
        background: var(--info-blue-color);
        border-color: var(--info-blue-color) !important;
    }

    #fechar_valor_total,#entrada_valor_total,#saida_valor_total,#abertura_valor_total{
        background-color: var(--main-color);
        color: white;
    }

    .modal-header .close {
        margin-top: -25px;
    }

    .modal-title {
        font-size: 20px;
    }

    .delete-art{
	    font-size: 25px !important;
    }

    .header-clientes{
        background: transparent;
    }

    .search-bar-main{
        display: inline-block;
        background-color: white;
        height: 40px;
        top: 11px;
        line-height: 0px;
    }

    .search-button-main{
        padding:1px;
        display: inline-block;
        background-color: white;
        height: 40px;
        top: 11px;
        line-height: 0px;
    }

    #search-input{
        line-height: 36px;
        background-color: white;
        color: black
    }

    #final-nif{
        padding: 0;
        padding-left: 1px;
        padding-right: 1px;
        text-align: center;
        height: auto !important;
        background-color: white;
    }

    #cliente-create{
        padding: 0;
        padding-left: 1px;
        padding-right: 1px;
        text-align: center;
        height: auto !important;
        background-color: white;
    }

    .change-value-type{
        font-size: 4rem;
        height: 100% !important;
        width: 100% !important;
        background: var(--blue-color);
        color: white;
        font-weight: bold;
    }

	.change-value-type:hover{
		font-size: 4rem;
		height: 100% !important;
		width: 100% !important;
		background: var(--blue-color);
		color: white;
		font-weight: bold;
	}

	.change-count-type{
		font-size: 4rem !important;
		height: 100% !important;
		width: 100% !important;
		background: var(--blue-color);
		color: white;
		font-weight: bold;
	}

    #display-type-button-keyboard{
        font-size: 4rem;
        height: 100% !important;
        width: 100% !important;
        background: var(--blue-color);
        color: white;
        font-weight: bold;
        display: none;
    }

    #display-type-button-keyboard:active{
        transform: translateY(2px);
        outline: none;
        border: none;
    }

    #display-blank-button-keyboard{
        display: block;
        height: 100% !important;
        background: #dedede;
        color: white
    }

    .button-calc-finalizar:hover,#apagar-fin:hover,.receipt-checkbox input:checked + span:hover,.receipt-checkbox label span:hover,
    .button-number-calculator:hover,.button-calculation-calculator:hover,.button-close-calculator:hover,.button-confirm-calculator:hover,
    .button-clear-calculator:hover,.button-number-keyboard:hover,.button-close-keyboard:hover,.button-confirm-keyboard:hover,#display-type-button-keyboard:hover,
    .button-clear-keyboard:hover,.confirm-finalizar-button:hover, .button-number-count-money:hover, .button-clear-count-money:hover,.button-confirm-count-money:hover,
    .change-count-type:hover,.button-close-count-money:hover,.button-add-total-calculator:hover
	{
        background-color: var(--light-black-color) !important;
        color: white !important;
        cursor: pointer;
        -webkit-transition: opacity .2s ease-in-out;
    }

    .image-product{
        display: flex;
        justify-content: center;
    }

    .rou.rou-pay-2{
        cursor: pointer;
    }

    .button-alt-keyboard,.button-calc-finalizar{
        position: relative !important;
        width: 100% !important;
        height: 100% !important;
    }

    .button-number-keyboard,.button-clear-keyboard,.button-close-keyboard,.button-confirm-keyboard,.button-number-calculator,
    .button-close-calculator,.button-clear-calculator,.button-calculation-calculator, .button-confirm-calculator
	,.button-number-count-money,.button-clear-count-money,.button-confirm-count-money,.button-close-count-money,.button-add-total-calculator
	{
        position: relative !important;
        width: 100% !important;
        height: 100% !important;
    }

    .alt-keyboard-keys-table td{
        padding: 0 !important;
        border: 1px solid black;
        height: 100px;
    }
    .alt-keyboard-keys-table,.finish-keys-table{
        border-collapse: initial;
    }

    .keyboard-keys-table td{
        padding: 0 !important;
        border: 1px solid black;
        height: 100px;
    }
    .keyboard-keys-table{
        border-collapse: initial;
    }

	.keyboard-keys-count-money td{
		padding: 0 !important;
		border: 1px solid black;
		height: 119px;
	}
	.keyboard-keys-count-money {
		border-collapse: initial;
	}

    .finish-keys-table{
        height: 85%;
        background-color: #000;
    }

    .finish-keys-table td{
        padding: 0 !important;
        border: 1px solid #000;
    }

    #alt-keyboard-value{
        font-size: 40px;
        height: 100%;
        display: flex;
        align-items: center;
        width: 100%;
        text-align: center;
        justify-content: center;
        margin-bottom: 0;
        padding-bottom: 0;
        text-decoration: underline;
    }

    #display-value-keyboard{
        font-size: 40px;
        height: 100%;
        display: flex;
        align-items: center;
        width: 100%;
        text-align: center;
        justify-content: center;
        margin-bottom: 0;
        padding-bottom: 0;
    }

    #display-blank-comma-keyboard{
        display: none;
        height: 100% !important;
        background: #dedede;
        color: white
    }

    .display-keyboard{
        min-height: 70px;
        display: flex;
        align-items: center;
        margin-bottom: 10px;
        background: #333;
    }

    .display-calculator{
        min-height: 110px;
        margin-bottom: 10px;
        background: #333;
        display: flex;
        align-items: flex-end;
        justify-content: space-around;
        flex-direction: column;
        padding: 10px;
        word-wrap: break-word;
        word-break: break-all;
    }

	.display-money-count{
		min-height: 110px;
		margin-bottom: 10px;
		background: #333;
		display: flex;
		align-items: flex-end;
		justify-content: space-around;
		flex-direction: column;
		padding: 10px;
		word-wrap: break-word;
		word-break: break-all;
	}

    .button-confirm-keyboard, .button-confirm-calculator,.button-confirm-count-money{
        height: 100% !important;
        background: var(--green-color);
        color: white
    }

    .button-close-keyboard,.button-close-calculator,.button-close-count-money{
        height: 100% !important;
        background: var(--red-color);
        color: white
    }

    .bg-black {
        background-color: var(--dark-soft-color);
        color: whitesmoke;
    }

    .export-saft-label{
        font-size: 2em;
        text-align: center;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 46px;
    }

    .no-products-cart{
        color: var(--main-color);
        font-weight: bold;
    }

    .color-option {
        height: 75px;
        width: 75px;
        list-style: none;
        border-radius: 4px;
        margin: 7px;
        transition: 0.2s;
        cursor: pointer;
    }
    .color-option:hover {
        box-shadow: 0 0 0 5px rgba(128, 128, 128, 0.2);
    }
    .color-option.is-selected {
        transform: scale(1.1);
        box-shadow: 0 0 0 5px rgba(128, 128, 128, 0.2);
    }

    .color-option:nth-child(1) {
        background: #5B00B7;
    }

    .color-option:nth-child(2) {
        background: #3a68b7;
    }

    .color-option:nth-child(3) {
        background: #34b7b0;
    }

    .color-option:nth-child(4) {
        background: #4f8f44;
    }

    .color-option:nth-child(5) {
        background: #c0582f;
    }

    .color-option:nth-child(6) {
        background: #a83030;
    }

    .color-option:nth-child(7) {
        background: #994385;
    }

    .color-grid {
        display: flex;
        margin: 0;
        padding: 0;
        align-items: center;
        justify-content: center;
    }

    .triangle {
        height: 75px;
        width: 75px;
        overflow: hidden;
        border-radius: 4px;
    }

    .triangle-top-right-white,.triangle-top-right-black {
        width: 0;
        height: 0;
        border-top: 75px solid white;
        border-left: 75px solid transparent;
    }

    .triangle-top-right-black {
        border-top: 75px solid black;
    }

    :root {
        --toggleHeight: 35px;
        --toggleWidth: 70px;
        --toggleGap: 2px;
    }

    .toggle {
        width: 0;
        height: 0;
        opacity: 0;
    }

    .toggle + label {
        position: relative;
        background: #c0c0c0;
        width: var(--toggleWidth);
        height: var(--toggleHeight);
        display: -webkit-inline-box;
        display: inline-flex;
        -webkit-box-align: center;
        align-items: center;
        border-radius: 25px;
        cursor: pointer;
        -webkit-transition: background 0.2s ease-in-out;
        transition: background 0.2s ease-in-out;
        text-indent: calc( var(--toggleWidth) + 10px);
        white-space: nowrap;
    }
    .toggle + label:after {
        content: "";
        background: #fff;
        width: calc(var(--toggleHeight) - (var(--toggleGap) * 2));
        height: calc(var(--toggleHeight) - (var(--toggleGap) * 2));
        position: absolute;
        top: var(--toggleGap);
        left: var(--toggleGap);
        border-radius: 50%;
        -webkit-transition: left 0.3s ease-in-out, background 0.2s ease-in-out;
        transition: left 0.3s ease-in-out, background 0.2s ease-in-out;
    }

    .toggle:checked + label {
        background: seaGreen;
    }
    .toggle:checked + label:after {
        left: calc(100% - calc(var(--toggleHeight) - var(--toggleGap)));
    }

    .toggle-label{
        /*color: white;*/
        font-size: 2rem;
    }

    /*!*dark mode*!
    .bg-black {
        background-color: var(--dark-soft-color);
        color: whitesmoke;
    }

    body {
        background-color: #131313 !important;
        color: #FFFFFF;
        height: 100% !important;
    }

    .product_item{
        box-shadow: 0 5px 10px 0 #131313  !important;
        border: 1px solid black !important;
    }

    #table-sidebar2 thead th{
        background-color: #131313 !important;
    }

    #table-sidebar2 tbody tr {
        background-color: black;
    }

    #table-sidebar2 tbody tr:hover {
        background-color: var(--dark-soft-color);
        box-shadow: 0 3px 5px rgba(0,0,0,0.2);
    }

    .rou-pay-text {
        height: 100%;
        border-right: solid 4px var(--dark-soft-color);
    }

    table.dataTable tbody tr{
        background-color: #131313 !important;
    }

    .menu-item{
        background-color: #131313 !important;
        color: white;
    }

    .menu-item button:hover, .menu-item a:hover,.partial-table tbody tr:nth-child(2n) {
        background-color: #151B31FF !important;
        color: white;
    }

    .cat_arrow_left p,.cat_arrow_right p{
        background-color: #333 !important;
    }

    #search-input,.search-bar-main,.search-button-main,#final-nif,#cliente-create,.partial-table-wrapper,.total-table-wrapper{
        background-color: var(--dark-soft-color);
        color: white;
    }

    !*dark mode*!*/

    #display-first-value-calculator, #display-first-value-count-money {
        opacity: 0.6;
        font-size: 2.5rem;
    }

    #display-second-value-calculator, #display-second-value-count-money {
        font-size: 3.5rem;
    }

    .category-color{
        height: 2px;
        /*background: yellow;*/
        position: absolute;
        top: 84px;
        width: 100%;
        margin-right: -4px;
        margin-right: 2px !important;
        position: absolute;
        top: 1px;
        width: -moz-available;
    }

    /*New Buttons*/

    .btn-custom {
        border: none;
        /*font-family: 'Lato';*/
        font-size: inherit;
        color: inherit;
        background: none;
        cursor: pointer;
        padding: 25px 80px;
        display: inline-block;
        /*margin: 15px 30px;*/
        text-transform: uppercase;
      /*  letter-spacing: 1px;*/
        font-weight: 700;
        outline: none;
        position: relative;
        -webkit-transition: all 0.3s;
        -moz-transition: all 0.3s;
        transition: all 0.3s;
    }

    .btn-custom:after {
        content: '';
        position: absolute;
        z-index: -1;
        -webkit-transition: all 0.3s;
        -moz-transition: all 0.3s;
        transition: all 0.3s;
    }

    /* Pseudo elements for icons */
    .btn-custom:before {
        font-family: 'FontAwesome';
        speak: none;
        font-style: normal;
        font-weight: normal;
        font-variant: normal;
        text-transform: none;
        line-height: 1;
        position: relative;
        -webkit-font-smoothing: antialiased;
    }

    /* Icon separator */
    .btn-sep {
        /*padding: 25px 60px 25px 120px;*/
    }

    .btn-sep:before {
        background: rgba(0,0,0,0.15);
    }

    /* Button Confirm */
    .btn-custom-confirm {
        background: var(--green-color);
        color: #fff;
        font-size: 2rem;
        width: 100%;
    }

    .btn-custom-confirm:hover {
        background:  var(--light-black-color) !important;
    }

    .btn-custom-confirm:active {
        background: var(--green-color);
        top: 2px;
    }

    .btn-custom-confirm:before {
        position: absolute;
        height: 100%;
        left: 0;
        top: 0;
        line-height: 2.7;
        font-size: 140%;
        width: 75px;
    }

    .btn-custom-sep-confirm {
        padding: 25px 60px 25px 100px;
    }

    /* Button Warning */
    .btn-custom-warning {
        background: var(--orange-color);
        color: #fff;
        font-size: 2rem;
        width: 100%;
    }

    .btn-custom-warning:hover {
        background:  var(--light-black-color);
    }

    .btn-custom-warning:active {
        background: var(--orange-color);
        top: 2px;
    }

    .btn-custom-warning:before {
        position: absolute;
        height: 100%;
        left: 0;
        top: 0;
        line-height: 2.7;
        font-size: 140%;
        width: 75px;
    }

    .btn-custom-sep-warning {
        padding: 25px 60px 25px 100px;
    }

    /* Button Info */
    .btn-custom-info {
        background: var(--blue-color);
        color: #fff;
        font-size: 2rem;
        width: 100%;
    }

    .btn-custom-info:hover {
        background: var(--light-black-color);
    }

    .btn-custom-info:active {
        background: var(--blue-color);
        top: 2px;
    }

    .btn-custom-info:before {
        position: absolute;
        height: 100%;
        left: 0;
        top: 0;
        line-height: 2.7;
        font-size: 140%;
        width: 75px;
    }

    .btn-custom-sep-info {
        padding: 25px 60px 25px 100px;
    }

    /* Button Default */
    .btn-custom-default {
        background: var(--light-blue);
        color: #333;
        font-size: 2rem;
        width: 100%;
    }

    .btn-custom-default:hover {
        background: var(--light-black-color);
        color: #fff;
    }

    .btn-custom-default:active {
        background: var(--light-blue);
        top: 2px;
    }

    .btn-custom-default:before {
        position: absolute;
        height: 100%;
        left: 0;
        top: 0;
        line-height: 2.7;
        font-size: 140%;
        width: 75px;
    }

    .btn-custom-sep-default {
        padding: 25px 60px 25px 100px;
    }

    /* Buttom danger*/
    .btn-custom-danger {
        background: var(--red-color);
        color: #fff;
        font-size: 2rem;
        width: 100%;
    }

    .btn-custom-danger:hover {
        background:  var(--light-black-color);
    }

    .btn-custom-danger:active {
        background: var(--red-color);
        top: 2px;
    }

    .btn-custom-danger:before {
        position: absolute;
        height: 100%;
        left: 0;
        top: 0;
        line-height: 2.7;
        font-size: 140%;
        width: 75px;
    }

    /* Button Black */
    .btn-custom-dark {
        background: var(--light-black-color);
        color: #fff;
        font-size: 2rem;
        width: 100%;
    }

    .btn-custom-dark:hover {
        background:  var(--light-black-color);
    }

    .btn-custom-dark:active {
        background: var(--light-black-color);
        top: 2px;
    }

    .btn-custom-dark:before {
        position: absolute;
        height: 100%;
        left: 0;
        top: 0;
        line-height: 2.7;
        font-size: 140%;
        width: 75px;
    }

    .btn-custom-sep-dark {
        padding: 25px 60px 25px 100px;
    }

    /* Button Blacker */
    .btn-custom-darker {
        background: var(--dark-soft-color);
        color: #fff;
        font-size: 2rem;
        width: 100%;
    }

    .btn-custom-darker:hover {
        background:  var(--dark-soft-color);
    }

    .btn-custom-darker:active {
        background: var(--dark-soft-color);
        top: 2px;
    }

    .btn-custom-darker:before {
        position: absolute;
        height: 100%;
        left: 0;
        top: 0;
        line-height: 2.7;
        font-size: 140%;
        width: 75px;
    }

    .btn-custom-sep-darker {
        padding: 25px 60px 25px 100px;
    }

    .btn-custom-sep-danger {
        padding: 25px 60px 25px 100px;
    }

    /* Button Purple */
    .btn-custom-purple {
        background: var(--light-purple-color);
        color: #fff;
        font-size: 2rem;
        width: 100%;
    }

    .btn-custom-purple:hover {
        background: var(--light-black-color);
    }

    .btn-custom-purple:active {
        background: var(--light-purple-color);
        top: 2px;
    }

    .btn-custom-purple:before {
        position: absolute;
        height: 100%;
        left: 0;
        top: 0;
        line-height: 2.7;
        font-size: 140%;
        width: 75px;
    }

    .btn-custom-sep-purple {
        padding: 25px 60px 25px 100px;
    }

    /* Button dark blue */
    .btn-custom-dark-blue {
        background: var(--dark-blue-color);
        color: #fff;
        font-size: 2rem;
        width: 100%;
    }

    .btn-custom-dark-blue:hover {
        background: var(--light-black-color);
    }

    .btn-custom-dark-blue:active {
        background: var(--dark-blue-color);
        top: 2px;
    }

    .btn-custom-dark-blue:before {
        position: absolute;
        height: 100%;
        left: 0;
        top: 0;
        line-height: 2.7;
        font-size: 140%;
        width: 75px;
    }

    .btn-custom-sep-dark-blue {
        padding: 25px 60px 25px 100px;
    }

    /* Button grey */
    .btn-custom-grey {
        background: var(--grey--color);
        color: #fff;
        font-size: 2rem;
        width: 100%;
    }

    .btn-custom-grey:hover {
        background: var(--light-black-color);
    }

    .btn-custom-grey:active {
        background: var(--grey--color);
        top: 2px;
    }

    .btn-custom-grey:before {
        position: absolute;
        height: 100%;
        left: 0;
        top: 0;
        line-height: 2.7;
        font-size: 140%;
        width: 75px;
    }

    .btn-custom-sep-grey {
        padding: 25px 60px 25px 100px;
    }

    .btn-loading {
        font-size: 30px;
    }

    button#finalizar::after,button#finalizar-rapido::after, button#doc::after, button#abrir-gaveta::after    {
        content: "\f110";
        font-family: "Font Awesome 5 Free";
        font-weight: 900;
        position: absolute;
        right: 0;
        left: 0;
        top: 7px;
        opacity: 0;
        transition: opacity .25s ease-in-out;
        font-size: 30px;
    }

    button#finalizar.active-loader::after, button#finalizar-rapido.active-loader::after, button#doc.active-loader::after, button#abrir-gaveta.active-loader::after {
        opacity: 1;
        animation: spin .5s linear infinite;
    }

    button#finalizar span,button#finalizar-rapido i,button#doc i,button#abrir-gaveta i {
        opacity: 1;
    }

    button#finalizar.active-loader span,button#finalizar-rapido.active-loader i,button#doc.active-loader i,button#abrir-gaveta.active-loader i {
        opacity: 0;
    }

    .fast-spin {
        -webkit-animation: spin .5s linear infinite;
        animation: spin .5s linear infinite;
    }

    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    /*button.open-end-actions::after, button.open-cache-draw::after {
        content: "\f110";
        font-family: "Font Awesome 5 Free";
        font-weight: 900;
        position: absolute;
        right: 0;
        left: 0;
        top: 7px;
        opacity: 0;
        transition: opacity .25s ease-in-out;
        font-size: 30px;
    }

    button.open-end-actions i,  button.open-cache-draw i{
        opacity: 1;
    }

    button.open-end-actions:focus i, button.open-cache-draw:focus i{
        opacity: 0;
    }

    button.open-end-actions span{
        opacity: 1;
    }

    button.open-end-actions:focus span{
        opacity: 0;
    }

    button.open-end-actions:focus::after, button.open-cache-draw:focus::after {
        opacity: 1;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }*/

    .icon-times:before{
        content: "\f00d";
    }

    .icon-home:before{
        content: "\f015";
    }

    .icon-coins:before{
        content: "\f51e";
    }

    .icon-users:before{
        content: "\f500";
    }

    .icon-leftright:before{
        content: "\f0ec";
    }

    .icon-cog:before{
        content: "\f013";
    }

    .icon-desktop:before{
        content: "\f26c";
    }

    .icon-cash-register:before{
        content: "\f788";
    }

    .icon-object-group:before{
        content: "\f247";
    }

    .icon-shop-slash:before{
        content: "\e070";
    }

    .icon-down:before{
        content: "\f309";
    }

    .icon-up:before{
        content: "\f30c";
    }

    .icon-go-fullscreen:before{
        content: "\f31e";
        font-family: 'FontAwesome';
    }

    .icon-trend-up:before{
        content: "\e098";
    }

    .icon-trend-down:before{
        content: "\e097";
    }


    .icon-money-wave:before{
        content: "\f53a";
    }

    .icon-success:before {
        content: "\f00c";
    }

    .icon-count-money:before {
        content: "\f662";
    }

    .icon-logout:before{
        content: "\f08b";
    }

    .icon-lock:before{
        content: "\f023";
    }

    .icon-left:before{
        content: "\f104";
    }

    .icon-add:before{
        content: "\f067";
    }

    .icon-save:before{
        content:"\f0c7"
    }

    .icon-trash:before{
        content:"\f1f8"
    }

    .icon-print:before{
        content:"\f02f"
    }

    .icon-drawer:before{
        content: "\f1ac"
    }

    .icon-expland:before{
        content: "\f424";
    }

    .icon-division:before{
        content: "\f529";
    }

    .icon-ban:before{
        content: "\f05e"
    }

    .icon-user-times:before{
        content: "\f235";
    }

    .icon-edit:before{
        content: "\f040";
    }

    .icon-edit:before{
        content: "\f040";
    }

    .icon-tags:before{
        content: "\f02c";
    }

    .icon-download:before{
        content: "\f019";
    }

    .icon-send:before{
        content: "\f1d8";
    }

    .icon-eur:before{
        content: "\f153";
    }


    .icon-split:before{
        content: "\f542";
    }

    .icon-receipt:before{
        content: "\f543";
    }

    .icon-utensils:before{
        content: "\f2e7";
    }

    .icon-back:before{
        content: "\f0e2";
    }

	.icon-move:before{
		content: "\f0ec";
	}

    .btn-main.btn-block.btn-dropdown-menu{
        padding: 20px 20px 20px 80px !important;
    }

    .row.window_main_wrapper{
        overflow-x: hidden;
    }

    .payment-type-item,.money-in-type-item,.options,.money-out-type-item{
        cursor: pointer;
    }

    .payment-type-item:hover,.money-in-type-item:hover,.money-out-type-item:hover{
       background: var(--main-color);
    }

    .fWindow.btn-custom,.btn-main.btn-custom{
        border: none
    }

    .btn-sum,.btn-pay,.btn-partial,.btn-clean,.btn-replicate,.btn-move{
        width: auto;
        color: #ffffff;
        letter-spacing: 3px;
        padding: 4px;
        width: 250px;
        position: fixed;
        right: -175px;
        z-index: 1000;
        -webkit-transition: all .25s ease !important;
        -moz-transition: all .25s ease !important;
        -ms-transition: all .25s ease !important;
        -o-transition: all .25s ease !important;
        transition: all .25s ease !important;
        top: 150px !important;
        cursor: pointer;
        height: 78px;
        padding-left: 70px;
        transition: none !important;
    }

    /*.btn-sum:hover,.btn-pay:hover,.btn-partial:hover,.btn-clean:hover {
        right: 0;
        color: #fff;
    }*/

   /* .btn-sum:active,.btn-pay:active,.btn-partial:active,.btn-clean:active {
        -webkit-transition: all .25s ease !important;
        -moz-transition: all .25s ease !important;
        -ms-transition: all .25s ease !important;
        -o-transition: all .25s ease !important;
        transition: all .25s ease !important;
    }*/

    .btn-pay{
        top: 235px !important;
    }

    .btn-partial{
        top: 320px !important;
    }

    .btn-clean{
        top: 405px !important;
    }

    .btn-replicate{
        top: 490px !important;
    }

	.btn-move{
		top: 575px !important;
	}


    .tables-limits{
        width: 100%;
        height: 100%;
        margin-top: 10px;
        border: 5px solid var(--main-color);
        margin-top: 0px;
    }
    .pagination-wrapper{
        bottom: 0px !important;
    }

    .table-highlight{
        border:5px solid var(--main-color)
    }

    .table-move-out{
        border:5px solid  var(--out-color);;
        filter: brightness(100%) grayscale(0%) !important;
    }

    .table-move-out-icon{
        width: 30px;
        height: 30px;
        background: var(--out-color);
        border-radius: 15px;
        position: absolute;
        top: -18px;
        left: -18px;
    }

    .table-move-out-icon > i,.table-move-in-icon > i {
        margin-top: 4px;
        rotate: 40deg;
    }

    .table-move-in-icon{
        width: 30px;
        height: 30px;
        background: var(--in-color);
        border-radius: 15px;
        position: absolute;
        top: -18px;
        left: -18px;
    }

    .table-move-in{
        border:5px solid var(--in-color);
        filter: brightness(100%) grayscale(0%) !important;
    }

    .table-highlight-border{
        border-radius: 100px;
    }

    .newTableWrapper{
        height: 100%;
    }

    /*virtual keyboard*/
    /*
    #mlkeyboard {
        z-index: 999;
    }

    div#mlkeyboard ul li {
        color: black;
    }

    div#mlkeyboard ul{
        position: relative;
    }

    @media screen and (min-width: 1280px) {
        div#mlkeyboard ul li {
            width: 75px;
            height: 75px;
            line-height: 60px;
            margin: 2px;
            font-size: 20px;
        }

        div#mlkeyboard ul #mlkeyboard-backspace {
            width: 86px;
        }

        div#mlkeyboard ul #mlkeyboard-tab {
            width: 85px;
        }

        div#mlkeyboard ul #mlkeyboard-capslock {
            width: 115px;
        }

        div#mlkeyboard ul #mlkeyboard-return {
            width: 96px;
        }

        div#mlkeyboard ul #mlkeyboard-left-shift {
            width: 160px;
        }

        div#mlkeyboard ul #mlkeyboard-right-shift {
            width: 161px;
            margin-right: 0;
        }

        div#mlkeyboard ul {
            width: 1145px;
            height: 405px;
            margin: 0 auto;
            padding: 0px;
            border-radius: 5px 5px 0 0;
        }

        div#mlkeyboard ul #mlkeyboard-capslock {
            width: 120px;
        }

        div#mlkeyboard ul #mlkeyboard-return {
            width: 121px;
        }

    }

    @media screen and (min-width: 540px) {
        div#mlkeyboard ul #mlkeyboard-space {
            clear: left;
            width: 99.2%;
        }
    }

    @media (min-width: 1920px){
        div#mlkeyboard ul li {
            width: 74.4px;
            height: 70px;
            line-height: 60px;
            margin: 2px;
            font-size: 20px;
        }
    }

    #mlkeyboard{
        z-index:250000
    }

    @media only screen
    and (max-width: 1279px){
        div#mlkeyboard ul li {
            width: 55px;
            height: 55px;
            line-height: 60px;
            margin: 2px;
            font-size: 20px;
        }

        div#mlkeyboard ul #mlkeyboard-capslock {
            width: 102px;
        }

        div#mlkeyboard ul #mlkeyboard-return {
            width: 101px;
        }

        div#mlkeyboard ul #mlkeyboard-left-shift {
            width: 137px;
        }

        div#mlkeyboard ul #mlkeyboard-right-shift {
            width: 127px;
            margin-right: 0;
        }

        div#mlkeyboard ul #mlkeyboard-space {
            clear: left;
            width: 99.3%;
        }

        div#mlkeyboard ul {
            width: 887px;
            height: 305px;
        }

        div#mlkeyboard ul #mlkeyboard-backspace {
            width: 87px;
        }

        div#mlkeyboard ul #mlkeyboard-tab {
            width: 87px;
        }

        .keyboard-corner {
            bottom: 277px !important
        }
    }
    */

    @media screen and (min-width: 700px) {
        .keyboard-corner {
            bottom: 315px;
            right: 500px;
        }

        div#mlkeyboard ul li.active {
            background-color: #5F8C46;
            border-color: #6FDA54;
        }
    }



    @media screen and (min-width: 700px) {
        div#mlkeyboard ul {
            width: 1000px;
            height: 346px;
            margin:0 auto;
            padding:0px;
            border-radius:5px 5px 0 0
        }
    }

    @media screen and (min-width: 700px) {
        div#mlkeyboard ul li {
            width:60px;
            height:60px;
            line-height:60px;
            margin:2.5px
        }
    }

    @media screen and (min-width: 700px) {
        div#mlkeyboard ul #mlkeyboard-backspace {
            width: 93px;
        }
    }

    @media screen and (min-width: 700px) {
        div#mlkeyboard ul #mlkeyboard-tab {
            width: 93.5px;
        }
    }

    @media screen and (min-width: 700px) {
        div#mlkeyboard ul #mlkeyboard-capslock {
            width: 110.5px;
        }
    }

    @media screen and (min-width: 700px) {
        div#mlkeyboard ul #mlkeyboard-return {
            width: 112px;
        }
    }

    @media screen and (min-width: 700px) {
        div#mlkeyboard ul #mlkeyboard-space {
            width: 990px;
        }
    }

    @media screen and (min-width: 540px) {
        div#mlkeyboard ul #mlkeyboard-right-shift {
            width: 147px;
            margin-right:0
        }
    }

    @media screen and (min-width: 700px) {
        div#mlkeyboard ul #mlkeyboard-left-shift {
            width: 144px;
        }
    }

    div#mlkeyboard ul li {
        border: 2px solid var(--main-color);
        color: #333;
        font-size: 25px;
        font-weight: bold;
        border-radius: 0px;
    }

    #mlkeyboard{
        z-index:250000;
    }

    div#mlkeyboard ul {
        margin-bottom: 5px !important;
        border-radius: 5px;
    }

    div#mlkeyboard ul.mlkeyboard-modifications{
        height:69px
    }

    .keyboard-corner {
        bottom: 375px !important;
        left: 955px !important;
        position: relative !important;
    }


    .mesas-header{
        height: 100%;
        overflow: hidden;
    }

    @media only screen
    and (min-width: 1920px){
        .modal-center{
            width: 40% !important;
        }
    }

    .pages-mesas.tab-pagina{
        display: block;
        float: left;
        width: 100px;
        padding-top: 7px;
    }

    .pagination-wrapper{
        bottom: 15px !important;
    }

    .pos-controls-options{
        position: absolute;
        right: 25px;
    }

    .datatable-pos tbody tr:nth-child(2n+1), .partial-table tbody tr:nth-child(2n+1), .move-table tbody tr:nth-child(2n+1) {
        background-color: #D5D5D5;
        /*color: var(--light-grey);*/
    }

    .datatable-pos tbody tr:nth-child(2n), .partial-table tbody tr:nth-child(2n), .move-table tbody tr:nth-child(2n) {
        background-color: #e5e9ec ;
    }

    .move-table tbody tr {
        color: black;
        cursor: pointer;
    }

    .ui-icon-gripsmall-diagonal-se {
        background-position: -82px -226px;
        transform: scale(1.5);
        z-index: 0 !important;
    }

    #sideExpand {
        display:flex;
        width: 100%;
        height: calc( (1rem * 1.5) + (0.5rem * 2) + (2px) );
        border-radius: 35px;
        background-color: rgba(31, 45, 65, 0.125);
        transition: transform 1s ease-in;
        transform: translateX(100%);
        z-index: -1;
    }

    #sideExpand.slide{
        transform: translateX(0%);
    }

    .filter-container{
        padding: .3rem;
        display: flex;
        justify-content: flex-end;
        overflow: hidden;
    }

    select {
        border: 0;
        background-color: initial;
        font-size: 100%;
        display: block;
        margin: auto;
        word-wrap: normal;
    }

    #filterToggle{
        background: white;
        font-size: 150%;
        border: .2rem solid #c1c1c1;
    }

    #filterToggle::after{
        position:absolute;
        content: "";
        height: calc( (1rem * 1.5) + (0.5rem * 2) + (2px) );
        width: 4rem;
        background:white;
        right: -2rem ;
        z-index: -1;
    }

    .btn-icon {
        padding: 0;
        display: -webkit-inline-box;
        display: flex;
        -webkit-box-align: center;
        align-items: center;
        -webkit-box-pack: center;
        justify-self: right;
        justify-content: center;
        overflow: hidden;
        border-radius: 100%;
        flex-shrink: 0;
        height: calc( (1rem * 1.5) + (0.5rem * 2) + (2px) ) !important;
        width: calc( (1rem * 1.5) + (0.5rem * 2) + (2px) ) !important;
    }

    .buttons-payments-divisions{
        width: 100%;
        height: 100%;
        font-size: 40px;
        border: 0;
        background: var(--blue-color);
    }

    .buttons-payments-divisions-left{
        border-right: solid 2px var(--dark-soft-color);
    }

    .buttons-payments-divisions-right{
        border-left: solid 2px var(--dark-soft-color);
    }

    .buttons-payments-divisions:hover{
        background: var(--light-black-color) !important;
    }

    #desconto-button,#desconto-money-button{
        padding: 0;
    }

    .keyboard-clear-button{
        background: var(--orange-color);
        color: white;
    }

    #finalizar-total-val{
        font-weight: bold;
    }

    .toast {
        opacity: 1 !important;
        min-height: 57px;
        font-family: "Helvetica Neue",Helvetica,Arial,sans-serif !important;
        font-size: 15px !important;
    }

    .final-total-to-pay{
        background: var(--dark-red-color);
    }

    .money-value-square-section{
        display: flex;
        flex-flow: row wrap;
        height: 30%
    }

    .money-value-square-section > div {
        flex: 1;
        padding: 0.5rem;
    }

    .divider-payment-type{
        margin: 0;
        border-top: 2px solid #eee;
        margin: 3%;
    }

   /* .partial-table tbody tr:nth-child(2n),.move-table tbody tr:nth-child(2n){
        background-color: #131313 !important;
        color: var(--light-grey);
    }

    .partial-table tbody tr:nth-child(2n+1),.move-table tbody tr:nth-child(2n+1){
        background-color: #333 !important;
        color: var(--light-grey);
    }*/

    #table-total thead th,#table-partial thead th,.move-table thead th {
        background: var(--light-black-color) !important
    }



    .payment-type-item,.money-in-type-item,.money-out-type-item{
        max-width: 50%;
    }

    .payment-type-title{
        width: 100%;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        margin-bottom: 5px;
    }

    .options-money-type {
        height: 100%;
        display: block;
        background: var(--light-black-color);
        border: 2px solid var(--main-color);
        border-radius: 0px;
        padding: 1rem;
        margin-bottom: 1rem;
        text-align: center;
        /*box-shadow: 0px 3px 10px -2px rgba(161, 170, 166, 0.5);*/
        position: relative;
        color: white;
    }


    p {
        font-weight: 900;
    }

    @media only screen and (max-width: 700px) {
        money-value-square-section {
            flex-direction: column;
        }
    }

    .fechar-left-items,.fechar-right-items{
        font-size: 3rem;
        padding: 1% 0;
    }

    .options{
        display: flex;
        align-items: center;
        text-align: center;
        justify-content: center;
        padding-top: 0;
        padding-bottom: 0;
    }

    #all-right,#all-left{
        position: absolute !important;
        left: 39%;
        color: white !important;
        top: -15px;
        cursor: pointer;
        z-index:10
    }

    #all-left{
        left:auto;
        right: 39%;
    }

    .modal-fullscreen{
        width: auto !important;
    }

    .partial-table-right{
        overflow: scroll;
        height: 100%;
        padding: 0;
        padding-left: 5px;
        padding-right: 5px;
        background-color: #f7f7f7;
        background-clip: content-box;
    }

    .partial-table-left{
        overflow: scroll;
        height: 100%;
        padding: 0;
        padding-right: 5px;
        padding-left: 5px;
        background-color: #f7f7f7;
        background-clip: content-box;
    }


    .table-total tbody tr,.partial-table tbody tr {
        cursor: pointer;
    }
</style>
<!-- /STYLES POS -->


<style>
    /*payments*/

    .rou-payments{
        display: flex;
        background-color: #2f363b;
        color: white;
        padding: 2.9% 0;
        height: 15.15% !important;
        font-size: 2.3rem;
        font-family: inherit;
        position: relative;
        align-items: center;
    }

    .rou-pay-4{
        background-color: var(--dark-blue-color);
    }

    .modal-center-fixed-width{
        width: 500px !important;
        min-width: 500px !important;
    }

    .modal-center-min-width {
        min-width: 500px !important;
    }

    .modal-center-max-width{
        max-width: 500px !important;
        min-width: 200px !important;
    }

    .modal-header{
        cursor: move;
    }

    .modal.ui-draggable{
        width: 100%;
        height: 100%;
    }

    #money-temp-val{
        font-weight: bold !important;
        font-size: 40px;
        height: 100%;
        display: flex;
        align-items: center;
        width: 100%;
        text-align: right;
        justify-content: center;
        margin-bottom: 0;
        padding-bottom: 0;
    }

    .guide{
        display: none;
        position: absolute;
        left: 0;
        top: 0;
    }

    #guide-h{
        border-top: 2px dashed #55f;
        width: 100%;
    }

    #guide-v{
        border-left: 2px dashed #55f;
        height: 100%;
    }

    .draggable{
        border: 1px solid #333;
        display: inline-block;
        cursor: move;
        position: absolute;
    }

    #nav {
        height: 100vh;
        width: 500px;
        display: flex;
       /* align-items: center;*/
        justify-content: center;
        background-color: white;
        color: black;
        position: fixed;
        right: 0;
        transform: translateX(100%);
        transition: transform 0.3s linear;
        margin-left: 200px;
        top: 0;
    }

    #nav.active {
        transform: translateX(0);
        z-index: 1000;
    }

    .replicate-list-element{
        cursor: pointer;
        padding: 20px;
        font-size: 20px;
        background-color: #333;
        border-bottom: 1px solid #fff
    }

	.keyboard-keys-table,.finish-keys-table {
		table-layout: fixed;
	}

    .total-line {
        display: flex;
        font-size: 13px;
        color: #808080
    }

    /*FORMS*/
    input,
    button {
        font-family: sans-serif, Arial;
    }
    input:focus,
    button:focus,
    input:active,
    button:active {
        outline: none;
    }
    a {
        text-decoration: none;
    }
    a:focus,
    a:active {
        outline: none;
    }

    .formBox {
        width: 100%;
        max-width: 100%;
        /* height: 552px;*/
        margin-left: -4px;
        /* margin-top: 50px;
		 margin-bottom: 40px;*/
        position: relative;
        vertical-align: middle;
        display: inline-block;
        margin-bottom: -45px;
    }
    .formBox .box {
        text-align: left;
        background-color: #fff;
        border-radius: 8px;
        padding: 60px 0px 40px 0;
        position: absolute;
        width: 100%;
        height: 100%;
        box-shadow: 0px 2px 11px -2px rgba(0, 0, 0, 0.5);
        transition: all 0.2s cubic-bezier(0.35, 0.33, 0.75, 0.9);
    }
    .formBox h2 {
        border-left: 6px solid #ed2553;
        color: #ed2553;
        padding: 0px 45px;
        font-size: 32px;
        line-height: 45px;
        height: 45px;
        text-transform: uppercase;
        margin-bottom: 50px;
        position: relative;
    }
    .formBox p {
        font-size: 18px;
        line-height: 27px;
        margin-bottom: 30px;
        color: #696969;
    }
    .formBox form {
        display: block;
        padding: 0px 25px;
        position: relative;
    }
    .formBox .f_row {
        padding: 0;
        position: relative;
        margin-bottom: 45px;
        height: 52px;
    }
    .formBox .f_row.shake {
        animation: shake 0.4s linear;
    }
    .formBox .f_row.last {
        margin-bottom: 53px;
    }
    .formBox .f_row label {
        color: #aeaeae;
        font-size: 25px;
        font-weight: normal;
        position: absolute;
        left: 0;
        top: 10px;
        opacity: 1;
        transition: all 0.3s cubic-bezier(1, -0.33, 0, 1.15);
        transform: translate(0px, 0px) scale(1);
        transform-origin: left top;
    }
    .formBox .f_row input {
        background-color: transparent;
        border: none;
        color: #fff;
        font-size: 25px;
        width: 100%;
        height: 100%;
        position: relative;
    }
    .formBox .f_row u {
        background-color: #e1e1e1;
        width: 100%;
        height: 2px;
        position: absolute;
        left: 0;
        bottom: 0;
    }
    .formBox .f_row u:before {
        content: "";
        display: block;
        height: 100%;
        width: 0;
        background-color: var(--main-color)/*#ed2553*/;
        transition: all 0.35s cubic-bezier(0.35, 0.33, 0.84, 0.85);
    }
    .formBox .f_row.focus label {
        color:#fff;
        opacity: 1;
        transform: translate(0px, -30px) scale(0.8);
    }
    .formBox .f_row.focus u:before {
        width: 100%;
    }

    @keyframes shake {
        from,
        to {
            -webkit-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0);
        }
        10%,
        30%,
        50%,
        70%,
        90% {
            -webkit-transform: translate3d(-10px, 0, 0);
            transform: translate3d(-10px, 0, 0);
        }
        20%,
        40%,
        60%,
        80% {
            -webkit-transform: translate3d(10px, 0, 0);
            transform: translate3d(10px, 0, 0);
        }
    }

    .select2-container--default .select2-selection--single {
        background-color: transparent;
        border-color: transparent;
    }

    .select2-selection__rendered {
        font-size: 25px;
    }


    #select2-pais_cliente-container{
        margin-top: 5px;
        padding-left: 0;
        font-family: sans-serif, Arial;
    }

    .select2-container--default .select2-results__option--highlighted[aria-selected]{
        background-color: var(--secondary-color);
    }

    /*#select2-export_year-container,#select2-export_month-container,#select2-export_iva_year-container,#select2-export_iva_month-container{
        background: #333;
        border: 0;
    }*/

    .select2-search__field,.select2-results__option{
        font-size: 2rem !important;
        font-family: sans-serif, Arial;
    }

    /*THEME MODAL*/
    .modal-header>*{color: black;}.modal-content {background: white;}.formBox .f_row.focus label, .formBox .f_row input {color: black;}.keyboard-keys-table td,.keyboard-keys-count-money td{border: 1px solid white;}.modal-body{color: black;}.display-keyboard,.display-money-count,.display-calculator{background: #ccc}

    body{background-color: #e5e9ec;color: #333}#burger-button,.current-page-title,#date_time{color: #333 !important}.only-ic:hover{color: #333 !important;}.toggle-label{color: #333}.select2-container--default .select2-results > .select2-results__options{background: white}.select2-container--default .select2-search--dropdown .select2-search__field{background: white; border: 1px solid grey;}.select2-selection__rendered{color: black !important;}.select2-dropdown{background-color: #fff}
    /*#2f363b*/

    /*dark*/
    /*body{background-color: #131313;color: #333}#burger-button,.current-page-title,#date_time{color: #fff !important}.only-ic:hover{color: #fff !important;}.toggle-label{color: #fff}.select2-container--default .select2-results > .select2-results__options{background: #333}.select2-container--default .select2-search--dropdown .select2-search__field{background: #333; border: 1px solid grey;}.select2-selection__rendered{color: white !important;}.select2-dropdown{background-color: #333}*//*.select2-container--default .select2-selection--single{background-color: var(--dark-soft-color);}*/

    #main_window {
        visibility: hidden;
    }

    .current_pos_user {
        font-weight: bold;
    }


    .partial-table-right,.partial-table-right {

    }
</style>

