    <div id="landing-page" style="background-image:linear-gradient(to bottom, rgba(245, 246, 252, 0.8), rgba(117, 19, 93, 0.12)), url({{ $restorant->coverm }}); display:{{(request()->get('dispalyCart'))?'none':'block'}};">
        <!-- Circles background -->
        <div class="container landing-page-container ">
            <div class="row flex-center-direction" >
                    <div class="col-12 col-sm-5 order-0 text-center h-500 center-v center-h">
                        <button id="landingBtnOnsite" ontouchstart="chooseOnsiteTakeAway(0)" onClick="chooseOnsiteTakeAway(0)" class="btn-landing-page">
                            <i class="fa fa-cutlery ml-fltl">&nbsp;</i>Sur Place<i class="fa fa-chevron-right mr-fltr">&nbsp;</i>
                        </button>
                    </div>
                    <div class="col-12 col-sm-1 order-1">&nbsp;</div>
                    <div class="col-12 col-sm-5 order-2 text-center h-500 center-v center-h">
                        <button id="landingBtnTakeAway" ontouchstart="chooseOnsiteTakeAway(1)" onClick="chooseOnsiteTakeAway(1)"  class="btn-landing-page">
                            <i class="fa fa-archive ml-fltl">&nbsp;</i>À Emporter<i class="fa fa-chevron-right mr-fltr">&nbsp;</i>
                        </button>
                    </div>
            </div>
        </div>
    </div>