<div class="card-profile">
    <div class="">
      
      <div  class="border-top pt-3">
        <!-- End price overview -->
        <!-- Delivery / Pickup --> 
        <div class="row mr-0 ml-0">
            <div class="col-12 dDFlex pr-0 pl-0">
                <h6 class="col-12 pr-0 pl-0 f-bolder"><?php echo e(__('Dine In / Takeaway')); ?></h6>
            </div>
            <div class="col-12 dDFlex pr-0 pl-0">
                <div id="dineInTakewayChoice" class="col-6 pr-0 pl-0 f-size-15">
                    <span id="dineInTakewayChoice_dinein" class="f-bolder" >
                        <i class="fa fa-cutlery greenColor">&nbsp;</i>&nbsp;&nbsp;<?php echo e(__('Dine In')); ?>

                    </span>
                    <span id="dineInTakewayChoice_takeaway" class="f-bolder" style="display:none;">
                        <i class="fa fa-archive greenColor">&nbsp;</i>&nbsp;&nbsp;<?php echo e(__('Takeaway')); ?>

                    </span>
                </div>
                <div class="col-6 pl-0 text-right">
                    <a href="javascript:void(0)" onClick="$('#dineiintakeawayModal').modal('show')" class="mody-checkout-link text-primary uppercase font-semibold text-xs leading-normal pt-0">
                    <?php echo e(__('Modifier')); ?>

                    </a>
                </div>
            </div>
        </div>
        <div class="modal" id="dineiintakeawayModal" tabindex="-1" role="dialog" aria-labelledby="dineiintakeawayModal" aria-hidden="true">
            <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 id="modalTitle" class="modal-title" id="modal-title-new-item"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #ffffff;">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body p-0">                        
                        <div class="row col-12 dDFlex pr-0 pl-0  mr-0 ml-0">
                            <div class="col-12 pr-0 pl-0">
                                
                                <?php echo $__env->make('cart.localorder.dineiintakeaway', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                            <div class="col-12 pl-0"> 
                                <!-- Local Order Phone -->
                                <div class="col-12 pr-0 pl-0">
                                    <?php echo $__env->make('cart.localorder.phone', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>
                                 <!-- Takeaway time slot -->
                                <div class="takeaway_picker col-12 pr-0 pl-0" style="display: none">
                                    <?php echo $__env->make('cart.time', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>
                                <!-- LOCAL ORDERING -->
                                <div class="col-12 pr-0 pl-0">
                                    <?php echo $__env->make('cart.localorder.table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>
                                
                            </div>
                            <div class="row col-12">
                                <div class="col-6"><button id="btn-cancel-dineintakeaway" type="button" class="btn btn-outline-primary action-btn close" data-dismiss="modal" aria-label="Close"><?php echo e(__('Cancel')); ?></button></div>
                                <div class="col-6 text-right"><button  id="btn-valid-dineintakeaway" type="button" class="btn btn-outline-primary action-btn close" data-dismiss="modal" aria-label="Close"><?php echo e(__('Apply')); ?></button></div>
                              </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
      <div  class="border-top pt-3">
        <!-- Comments --> 
        <div class="row mr-0 ml-0">
            <div class="col-12 dDFlex pr-0 pl-0">
                <h6 class="col-12 pr-0 pl-0 f-bolder"><?php echo e(__('Comment')); ?></h6>
            </div>
            <div class="col-12 dDFlex pr-0 pl-0">
                <div id="commentArea" class="col-6 pr-0 pl-0 f-size-15">
                    <span id="fullCommentArea" class="f-bolder">
                    </span>
                </div>
                <div class="col-6 pl-0 text-right">
                    <a href="javascript:void(0)" onClick="$('#commentsModal').modal('show');$('#comment').val(comment);" class="mody-checkout-link text-primary uppercase font-semibold text-xs leading-normal pt-0">
                        <?php echo e(__('Modifier')); ?>

                    </a>
                </div>
            </div>
        </div>
        <div class="modal" id="commentsModal" tabindex="-1" role="dialog" aria-labelledby="commentsModal" aria-hidden="true">
            <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 id="modalTitle" class="modal-title" id="modal-title-new-item"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #ffffff;">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body p-0">                        
                        <div class="row col-12 dDFlex pr-0 pl-0  mr-0 ml-0">
                            <div class="col-12 pr-0 pl-0">
                                <!-- Comment -->
                                <?php echo $__env->make('cart.comment', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>




    

    <div  class="border-top pt-3">
        <!-- Payements --> 
        <div class="row mr-0 ml-0" v-if="itemsCount">
            <div class="col-12 dDFlex pr-0 pl-0">
                <h6 class="col-12 pr-0 pl-0 f-bolder">
                    <?php if(session('isBorne')): ?>
                        <?php echo e(__('Pay via Card terminal')); ?>

                    <?php else: ?>
                        <?php echo e(__('Payment')); ?>

                    <?php endif; ?>
                    
                </h6>
            </div>
            <div class="row col-12 dDFlex mr-0 ml-0 pr-0 pl-0">
                
                    <div id="paymentChoiceNotSelected" class="col-12 pr-0 pl-0 f-size-15">
                        <span id="payementNotSelected" class="f-bolder" >
                            <a href="javascript:void(0)" onClick="$('#paymentsTypeModal').modal('show')" class="mody-checkout-link text-primary uppercase font-semibold text-xs leading-normal p-0">
                                <svg fill="#03643b" height="22px" width="22px" version="1.1" id="Layer_1" class="f-fl" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 511.999 511.999" xml:space="preserve" stroke="#03643b"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <path d="M493.714,66.178h-69.659H197.661h-69.661c-10.099,0-18.286,8.187-18.286,18.286v63.563h18.286h18.286h10.203h32.195 c12.566-12.003,21.598-27.666,25.337-45.277h193.674c7.188,33.842,33.891,60.545,67.734,67.734v89.183 c-33.843,7.186-60.547,33.891-67.734,67.734h-17.598v36.572h33.958h69.659c10.099,0,18.286-8.186,18.286-18.286v-69.66V154.121 V84.464C512,74.364,503.813,66.178,493.714,66.178z"></path> </g> </g> <g> <g> <path d="M335.24,184.597H146.285h-36.572H18.286C8.187,184.597,0,192.784,0,202.882v54.857h353.526v-54.857 C353.526,192.784,345.339,184.597,335.24,184.597z"></path> </g> </g> <g> <g> <path d="M0,294.311v133.224c0,10.099,8.187,18.286,18.286,18.286H335.24c10.099,0,18.286-8.186,18.286-18.286v-63.564V327.4 v-33.089H0z M152.383,367.454H91.429c-10.099,0-18.286-8.187-18.286-18.286c0-10.099,8.187-18.286,18.286-18.286h60.954 c10.099,0,18.286,8.187,18.286,18.286C170.668,359.267,162.481,367.454,152.383,367.454z"></path> </g> </g> </g></svg>
                                &nbsp;&nbsp;<?php echo e(__('Sélectionnez le mode de paiement')); ?>

                            </a>
                        </span>
                    </div>
                    <div class="col-12 dDFlex pr-0 pl-0 ">
                        <div class="col-6 pr-0 pl-0 f-size-15">
                            <span id="paymentAppelPay" class="f-bolder"   style="display:none;"  >
                                <svg width="44px" height="38px" viewBox="0 -29.75 165.5 165.5" id="Artwork" xmlns="http://www.w3.org/2000/svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <style>.st0{fill:#fff}</style> <path id="XMLID_4_" d="M150.7 0h-139c-1 0-2.1.1-3.1.3-1 .2-2 .5-3 1-.9.4-1.8 1.1-2.5 1.8S1.7 4.7 1.3 5.6c-.5.9-.8 1.9-1 3-.2 1-.2 2.1-.3 3.1v82.5c0 1 .1 2.1.3 3.1.2 1 .5 2 1 3 .5.9 1.1 1.8 1.8 2.5s1.6 1.4 2.5 1.8c.9.5 1.9.8 3 1 1 .2 2.1.2 3.1.3h142.1c1 0 2.1-.1 3.1-.3 1-.2 2-.5 3-1 .9-.5 1.8-1.1 2.5-1.8s1.4-1.6 1.8-2.5c.5-.9.8-1.9 1-3 .2-1 .2-2.1.3-3.1v-1.4-78-1.7-1.4c0-1-.1-2.1-.3-3.1-.2-1-.5-2-1-3-.5-.9-1.1-1.8-1.8-2.5s-1.6-1.4-2.5-1.8c-.9-.5-1.9-.8-3-1-1-.2-2.1-.2-3.1-.3H150.7z"></path> <path id="XMLID_3_" class="st0" d="M150.7 3.5H153.8c.8 0 1.7.1 2.6.2.8.1 1.4.3 2 .6.6.3 1.1.7 1.6 1.2s.9 1 1.2 1.6c.3.6.5 1.2.6 2 .2.9.2 1.8.2 2.6v82.5c0 .8-.1 1.7-.2 2.6-.1.7-.3 1.4-.6 2-.3.6-.7 1.1-1.2 1.6s-1 .9-1.6 1.2c-.6.3-1.2.5-2 .6-.9.2-1.8.2-2.6.2H11.7c-.7 0-1.7-.1-2.6-.2-.7-.1-1.4-.3-2-.7-.6-.3-1.1-.7-1.6-1.2s-.9-1-1.2-1.6c-.3-.6-.5-1.2-.6-2-.2-.9-.2-1.8-.2-2.6v-81-1.4c0-.8.1-1.7.2-2.6.1-.7.3-1.4.6-2 .3-.6.7-1.1 1.2-1.6s1-.9 1.6-1.2c.6-.3 1.2-.5 2-.6.9-.2 1.8-.2 2.6-.2h139"></path> <path d="M45.2 35.6c1.4-1.8 2.4-4.2 2.1-6.6-2.1.1-4.6 1.4-6.1 3.1-1.3 1.5-2.5 4-2.2 6.3 2.4.3 4.7-1 6.2-2.8M47.3 39c-3.4-.2-6.3 1.9-7.9 1.9-1.6 0-4.1-1.8-6.8-1.8-3.5.1-6.7 2-8.5 5.2-3.6 6.3-1 15.6 2.6 20.7 1.7 2.5 3.8 5.3 6.5 5.2 2.6-.1 3.6-1.7 6.7-1.7s4 1.7 6.8 1.6c2.8-.1 4.6-2.5 6.3-5.1 2-2.9 2.8-5.7 2.8-5.8-.1-.1-5.5-2.1-5.5-8.3-.1-5.2 4.2-7.7 4.4-7.8-2.3-3.6-6.1-4-7.4-4.1"></path> <g> <path d="M76.7 31.9c7.4 0 12.5 5.1 12.5 12.4 0 7.4-5.2 12.5-12.7 12.5h-8.1v12.9h-5.9V31.9h14.2zm-8.3 20h6.7c5.1 0 8-2.8 8-7.5 0-4.8-2.9-7.5-8-7.5h-6.8v15zM90.7 62c0-4.8 3.7-7.8 10.3-8.2l7.6-.4v-2.1c0-3.1-2.1-4.9-5.5-4.9-3.3 0-5.3 1.6-5.8 4h-5.4c.3-5 4.6-8.7 11.4-8.7 6.7 0 11 3.5 11 9.1v19h-5.4v-4.5h-.1c-1.6 3.1-5.1 5-8.7 5-5.6 0-9.4-3.4-9.4-8.3zm17.9-2.5v-2.2l-6.8.4c-3.4.2-5.3 1.7-5.3 4.1 0 2.4 2 4 5 4 4 0 7.1-2.7 7.1-6.3zM119.3 80v-4.6c.4.1 1.4.1 1.8.1 2.6 0 4-1.1 4.9-3.9 0-.1.5-1.7.5-1.7l-10-27.6h6.1l7 22.5h.1l7-22.5h6l-10.3 29.1c-2.4 6.7-5.1 8.8-10.8 8.8-.4-.1-1.8-.1-2.3-.2z"></path> </g> </g></svg>
                            </span>
                            <span id="paymentCache" class="f-bolder" style="display:none;"  >
                                <svg fill="#03643b" width="22px" height="22px" viewBox="0 -64 640 640" class="f-fl" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M608 64H32C14.33 64 0 78.33 0 96v320c0 17.67 14.33 32 32 32h576c17.67 0 32-14.33 32-32V96c0-17.67-14.33-32-32-32zM48 400v-64c35.35 0 64 28.65 64 64H48zm0-224v-64h64c0 35.35-28.65 64-64 64zm272 176c-44.19 0-80-42.99-80-96 0-53.02 35.82-96 80-96s80 42.98 80 96c0 53.03-35.83 96-80 96zm272 48h-64c0-35.35 28.65-64 64-64v64zm0-224c-35.35 0-64-28.65-64-64h64v64z"></path></g></svg>
                                &nbsp;&nbsp;<?php echo e(config('app.isqrsaas')?__('Cash / Card Terminal'): __('Cash on delivery')); ?>

                            </span>
                            <span id="paymentCard" class="f-bolder" style="display:none;" >
                                <svg width="22px" height="22px" viewBox="0 -4 20 20" version="1.1" class="f-fl" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#03643b"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>money [#03643b]</title> <desc>Created with Sketch.</desc> <defs> </defs> <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g id="Dribbble-Light-Preview" transform="translate(-340.000000, -2923.000000)" fill="#03643b"> <g id="icons" transform="translate(56.000000, 160.000000)"> <path d="M292,2769 C292,2767.895 292.895,2767 294,2767 C295.105,2767 296,2767.895 296,2769 C296,2770.105 295.105,2771 294,2771 C292.895,2771 292,2770.105 292,2769 L292,2769 Z M300.343,2765 L302,2765 L302,2766.657 L300.343,2765 Z M302,2773 L300.343,2773 L302,2771.343 L302,2773 Z M286,2773 L286,2771.343 L287.657,2773 L286,2773 Z M286,2765 L287.657,2765 L286,2766.657 L286,2765 Z M297.515,2765 L301.515,2769 L297.515,2773 L290.485,2773 L286.485,2769 L290.485,2765 L297.515,2765 Z M284,2775 L304,2775 L304,2763 L284,2763 L284,2775 Z" id="money-[#03643b]"> </path> </g> </g> </g> </g></svg>
                                &nbsp;&nbsp;<?php echo e(__('Pay with card')); ?>

                            </span>
                            <span id="paymentPaypal" class="f-bolder"   style="display:none;"  >
                                <svg width="44px" height="38px" viewBox="0 -139.5 750 750" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <desc>Created with Sketch.</desc> <defs> </defs> <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g id="paypal" fill="#393939" fill-rule="nonzero"> <path d="M52.8846154,28.2035928 C39.608341,28.2035928 28.8461538,38.7262291 28.8461538,51.7065868 L28.8461538,419.293413 C28.8461538,432.274332 39.6079531,442.796407 52.8846154,442.796407 L697.115385,442.796407 C710.391473,442.796407 721.153846,432.273953 721.153846,419.293413 L721.153846,51.7065868 C721.153846,38.7266083 710.391085,28.2035928 697.115385,28.2035928 L52.8846154,28.2035928 Z M52.8846154,0 L697.115385,0 C726.322376,0 750,23.1501941 750,51.7065868 L750,419.293413 C750,447.850476 726.322653,471 697.115385,471 L52.8846154,471 C23.6766623,471 0,447.850746 0,419.293413 L0,51.7065868 C0,23.1499239 23.6769386,0 52.8846154,0 Z" id="Rectangle-1"> </path> <g id="Group" transform="translate(54.000000, 161.000000)"> <path d="M109.272795,8.45777679 C101.24875,2.94154464 90.7780357,0.176741071 77.8606518,0.176741071 L27.8515268,0.176741071 C23.8915714,0.176741071 21.7038036,2.15719643 21.2882232,6.11428571 L0.972553571,133.638223 C0.761419643,134.890696 1.07477679,136.03617 1.90975893,137.077509 C2.73996429,138.120759 3.78416964,138.639518 5.03473214,138.639518 L28.7887321,138.639518 C32.9550446,138.639518 35.2450357,136.663839 35.6653929,132.701973 L41.2905357,98.3224911 C41.4959375,96.6563482 42.2286964,95.3016518 43.4792589,94.2584018 C44.7288661,93.2170625 46.2918304,92.5358929 48.1671964,92.2234911 C50.0425625,91.9139554 51.8109286,91.7582321 53.4808929,91.7582321 C55.1460804,91.7582321 57.124625,91.8633214 59.4203482,92.0706339 C61.7103393,92.2789018 63.170125,92.3801696 63.7958839,92.3801696 C81.7145625,92.3801696 95.7793304,87.3311071 105.991143,77.2224732 C116.198179,67.1176607 121.307429,53.1063929 121.307429,35.1829375 C121.307429,22.8903571 117.293018,13.9826071 109.272795,8.45777679 Z M83.4877054,46.7484911 C82.4425446,54.0426429 79.7369732,58.8328036 75.3614375,61.1256607 C70.9849464,63.4213839 64.7340446,64.5630357 56.6087321,64.5630357 L46.2937411,64.8754375 L51.6083929,31.43125 C52.0230179,29.1412589 53.3767589,27.9948304 55.6705714,27.9948304 L61.6109821,27.9948304 C69.9416964,27.9948304 75.9881518,29.1957143 79.7388839,31.5879286 C83.4877054,33.985875 84.7382679,39.0406696 83.4877054,46.7484911 Z" id="Shape"> </path> <path d="M637.025455,0.176741071 L613.899125,0.176741071 C611.600536,0.176741071 610.24775,1.32316964 609.835036,3.61602679 L589.518411,133.639179 L589.205054,134.263982 C589.205054,135.311054 589.621589,136.296027 590.457527,137.234187 C591.285821,138.170438 592.332893,138.639518 593.581545,138.639518 L614.211527,138.639518 C618.16575,138.639518 620.354473,136.663839 620.775786,132.701973 L641.092411,4.86276786 L641.092411,4.55227679 C641.091455,1.63557143 639.732938,0.176741071 637.025455,0.176741071 Z" id="Shape"> </path> <path d="M357.599732,50.4963571 C357.599732,49.4569286 357.18033,48.4652679 356.352991,47.5290179 C355.517054,46.5918125 354.576982,46.1208214 353.539464,46.1208214 L329.471152,46.1208214 C327.174473,46.1208214 325.300063,47.1678929 323.845054,49.2457946 L290.714223,98.0072232 L276.961857,51.1230714 C275.915741,47.7917411 273.62575,46.1208214 270.086152,46.1208214 L246.640732,46.1208214 C245.596527,46.1208214 244.659321,46.5908571 243.831027,47.5290179 C242.995089,48.4652679 242.580464,49.4578839 242.580464,50.4963571 C242.580464,50.9167143 244.612509,57.0606161 248.674688,68.9376161 C252.736866,80.8174821 257.112402,93.6326429 261.801295,107.385964 C266.490188,121.13642 268.936857,128.433437 269.14608,129.261732 C252.058562,152.601107 243.51767,165.103866 243.51767,166.768098 C243.51767,169.479402 244.870455,170.832188 247.580804,170.832188 L271.648161,170.832188 C273.939107,170.832188 275.813518,169.792759 277.274259,167.70817 L356.976839,52.684125 C357.39242,52.2704554 357.599732,51.5443839 357.599732,50.4963571 Z" id="Shape"> </path> <path d="M581.704545,46.1208214 L557.947679,46.1208214 C555.029063,46.1208214 553.262607,49.5601071 552.638759,56.4367679 C547.214241,48.1050982 537.323429,43.9330536 522.942438,43.9330536 C507.940464,43.9330536 495.174027,49.5601071 484.655545,60.8123036 C474.13133,72.0645 468.872089,85.2990625 468.872089,100.508348 C468.872089,112.80475 472.465188,122.597161 479.652339,129.887491 C486.841402,137.185464 496.479045,140.827286 508.567179,140.827286 C514.608857,140.827286 520.755625,139.574813 527.006527,137.076554 C533.257429,134.576384 538.149813,131.244098 541.698964,127.07492 C541.698964,127.284143 541.48592,128.220393 541.07225,129.886536 C540.652848,131.5565 540.447446,132.808973 540.447446,133.637268 C540.447446,136.975286 541.798321,138.637607 544.511536,138.637607 L566.079679,138.637607 C570.031991,138.637607 572.32867,136.661929 572.951563,132.700063 L585.768634,51.1221161 C585.974036,49.8715536 585.660679,48.7270357 584.830473,47.6837857 C583.99358,46.6434018 582.955107,46.1208214 581.704545,46.1208214 Z M540.915571,107.696455 C535.60283,112.906018 529.19525,115.509366 521.694741,115.509366 C515.649241,115.509366 510.756857,113.845134 507.004214,110.509027 C503.251571,107.180563 501.376205,102.595804 501.376205,96.7566607 C501.376205,89.0517054 503.981464,82.5352143 509.191027,77.2224732 C514.394857,71.9087768 520.860714,69.2519286 528.570446,69.2519286 C534.400036,69.2519286 539.245607,70.9715714 543.104295,74.4079911 C546.955339,77.8472768 548.887071,82.5887143 548.887071,88.6323036 C548.886116,96.1328125 546.229268,102.489759 540.915571,107.696455 Z" id="Shape"> </path> <path d="M226.64033,46.1208214 L202.885375,46.1208214 C199.963893,46.1208214 198.196482,49.5601071 197.570723,56.4367679 C191.944625,48.1050982 182.04617,43.9330536 167.877268,43.9330536 C152.874339,43.9330536 140.109813,49.5601071 129.588464,60.8123036 C119.06425,72.0645 113.805009,85.2990625 113.805009,100.508348 C113.805009,112.80475 117.400018,122.597161 124.58908,129.887491 C131.778143,137.185464 141.41292,140.827286 153.500098,140.827286 C159.331598,140.827286 165.378054,139.574813 171.628,137.076554 C177.878902,134.576384 182.880196,131.244098 186.630929,127.07492 C185.794991,129.575089 185.380366,131.763813 185.380366,133.637268 C185.380366,136.975286 186.734107,138.637607 189.4435,138.637607 L211.009732,138.637607 C214.965866,138.637607 217.260634,136.661929 217.886393,132.700063 L230.700598,51.1221161 C230.906,49.8715536 230.594554,48.7270357 229.763393,47.6837857 C228.929366,46.6434018 227.888027,46.1208214 226.64033,46.1208214 Z M185.850402,107.851223 C180.53575,112.962384 174.02117,115.509366 166.316214,115.509366 C160.269759,115.509366 155.425143,113.845134 151.781411,110.509027 C148.132902,107.180563 146.311036,102.595804 146.311036,96.7566607 C146.311036,89.0517054 148.914384,82.5352143 154.125857,77.2224732 C159.331598,71.9087768 165.791723,69.2519286 173.504321,69.2519286 C179.335821,69.2519286 184.180438,70.9715714 188.039125,74.4079911 C191.891125,77.8472768 193.820946,82.5887143 193.820946,88.6323036 C193.820946,96.3420357 191.164098,102.751527 185.850402,107.851223 Z" id="Shape"> </path> <path d="M464.337964,8.45777679 C456.314875,2.94154464 445.847027,0.176741071 432.926777,0.176741071 L383.231964,0.176741071 C379.06183,0.176741071 376.768018,2.15719643 376.354348,6.11428571 L356.039634,133.638223 C355.8285,134.890696 356.139946,136.03617 356.975884,137.077509 C357.804179,138.120759 358.85125,138.639518 360.100857,138.639518 L385.729268,138.639518 C388.229438,138.639518 389.89558,137.286732 390.729607,134.577339 L396.357616,98.3224911 C396.563018,96.6563482 397.293866,95.3016518 398.544429,94.2584018 C399.794991,93.2170625 401.356045,92.5358929 403.233321,92.2234911 C405.108688,91.9139554 406.876098,91.7582321 408.547973,91.7582321 C410.212205,91.7582321 412.191705,91.8633214 414.483607,92.0706339 C416.776464,92.2789018 418.238161,92.3801696 418.859143,92.3801696 C436.781643,92.3801696 450.8445,87.3311071 461.055357,77.2224732 C471.265259,67.1176607 476.369732,53.1063929 476.369732,35.1829375 C476.370687,22.8903571 472.357232,13.9826071 464.337964,8.45777679 Z M432.301973,59.8750982 C427.717214,63.0000714 420.839598,64.5620804 411.673902,64.5620804 L401.670357,64.8744821 L406.985964,31.4302946 C407.398679,29.1403036 408.751464,27.993875 411.048143,27.993875 L416.67233,27.993875 C421.255179,27.993875 424.900821,28.2021429 427.614036,28.6177232 C430.319607,29.037125 432.926777,30.3364107 435.426946,32.5241786 C437.929027,34.7119464 439.177679,37.891375 439.177679,42.0576875 C439.177679,50.8106696 436.882911,56.7472589 432.301973,59.8750982 Z" id="Shape"> </path> </g> </g> </g> </g></svg>
                            </span>
                        </div>
                        <div class="col-6 pl-0 text-right">
                            <a id="linModifyPaymentMethod" href="javascript:void(0)" onClick="$('#paymentsTypeModal').modal('show')" class="mody-checkout-link text-primary uppercase font-semibold text-xs leading-normal pt-0"  style="display:none;"> <?php echo e(__('Modifier')); ?></a>
                        </div>
                    </div>
            </div>
        </div>
        <div class="modal" id="paymentsTypeModal" tabindex="-1" role="dialog" aria-labelledby="paymentsTypeModal" aria-hidden="true">
            <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 id="modalTitle" class="modal-title" id="modal-title-new-item"><?php echo e(__("Online payments")); ?></h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #ffffff;">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body p-0">                        
                        <div class="row col-12 dDFlex pr-0 pl-0  mr-0 ml-0">
                            <div class="col-12 pr-0 pl-0">
                                <!-- Payment  Methods -->
                                <div class="cards">
                                    <div class="px-2">
                                        <div class="mt-3"><h6><span class="font-weight-light">Mode de paiements</span></h6></div>
                                        <div class="card-body-n">
                                            <!-- Display a payment form -->
                                            <div id="payment-form" class="col-12 pr-0 pl-0"  data-secret="">
                                                <div id="link-authentication-element">
                                                <!--Stripe.js injects the Link Authentication Element-->
                                                </div>
                                                <div id="payment-element">
                                                <!--Stripe.js injects the Payment Element-->
                                                </div>
                                                <div class="spinner hidden" id="spinner"></div>
                                                <button id="submit" class="d-none">
                                                <span id="button-text">Pay now</span>
                                                </button>
                                                <div id="payment-message" class="hidden"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

      <div  class="border-top pt-3">
        <!-- Coupons -->
        <div class="row mr-0 ml-0 mt-4 mb-4">
            <div class="col-12 dDFlex pr-0 pl-0">
                <div class="col-12 p-4 text-center coupons-area">
                    <a href="javascript:void(0)" onClick="$('#couponsModal').modal('show')" class="mody-checkout-link text-primary uppercase font-semibold text-xs leading-normal">
                        <svg fill="#03643b" width="19px" height="19px" class="f-fl" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" stroke="#03643b"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M80,42V33a3,3,0,0,0-3-3H38v2H36V30H23a3,3,0,0,0-3,3v9a8,8,0,0,1,0,16h0v9a3,3,0,0,0,3,3H36V68h2v2H77a3,3,0,0,0,3-3V58a8,8,0,0,1,0-16ZM38,64H36V60h2Zm0-8H36V52h2Zm0-8H36V44h2Zm0-8H36V36h2ZM51,53.62,49.13,55l-2-2.75L45,55l-1.87-1.33,2-2.9-3.11-1,.69-2.18,3,1V45.05h2.53v3.52l3-1,.68,2.18-3.11,1Zm15.84,0L65,55l-2-2.75L60.85,55,59,53.62,61,50.72l-3.11-1,.68-2.18,3,1V45.05h2.53v3.52l3-1,.69,2.18-3.11,1Z"></path></g></svg>
                        <span id="couponsLabel"><?php echo e(__('Ajouter un code de réduction')); ?></span>
                    </a>
                </div>
            </div>
        </div>
        <div class="modal" id="couponsModal" tabindex="-1" role="dialog" aria-labelledby="couponsModal" aria-hidden="true">
            <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 id="modalTitle" class="modal-title" id="modal-title-new-item"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #ffffff;">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body p-0">                        
                        <div class="row col-12 dDFlex pr-0 pl-0  mr-0 ml-0">
                                <!-- Comment -->
                                <?php echo $__env->make('cart.coupons', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- tempo until to resolve the vuejs issues #120 -->
        <div class="border-top pt-3" v-if="itemsCount">
            <!-- Price overview -->
            <div id="totalPrices">
                <div class="card-stats mb-4 mb-xl-0">
                    <div class="card-body-fake">
                        <div class="row mr-0 ml-0">
                            <div class="col pr-0 pl-0"><!----> 
                                <div class="col-12 dDFlex pr-0 pl-0">
                                    <div class="col-6 pr-0 pl-0">
                                        <span>Sous-total:</span>
                                    </div> 
                                    <div class="col-6 pl-0 text-right">
                                        <span class="ammount" id="itemsCountTotalPrice"><?php echo e($itemsCountTotalPrice); ?>&nbsp;€</span>
                                    </div>
                                </div> <!----> 
                                <div class="col-12 dDFlex pr-0 pl-0">
                                    <div class="col-6 pr-0 pl-0">
                                        <span><strong>TOTAL:</strong></span>
                                    </div> 
                                    <div class="col-6 pl-0 text-right">
                                        <span class="ammount"><strong><?php echo e($itemsCountTotalPrice); ?>&nbsp;€</strong></span>
                                    </div></div> 
                                    <input type="hidden" id="tootalPricewithDeliveryRaw" value="<?php echo e($itemsCountTotalPrice); ?>"></div>
                                </div>
                            </div>
                        </div>
                    </div>
          </div>

        <!-- -->
        
        <div  class="border-top pt-3" v-if="itemsCount">
            <!-- Price overview -->
            <div id="totalPrices" v-cloak>
                <div class="card-stats mb-4 mb-xl-0">
                    <div class="card-body-fake">
                        <div class="row mr-0 ml-0">
                            <div class="col pr-0 pl-0">
                                <span v-if="itemsCount==0"><?php echo e(__('Cart is empty')); ?>!</span>
                                <div class="col-12 dDFlex pr-0 pl-0">
                                    <div class="col-6 pr-0 pl-0">
                                        <span v-if="itemsCount"><?php echo e(__('Subtotal')); ?>:</span>
                                    </div>
                                    <div class="col-6 pl-0 text-right">  
                                        <span v-if="itemsCount" class="ammount">{{ totalPriceFormat }}</span>
                                    </div>
                                </div>
                                <?php if(config('app.isft')||config('settings.is_whatsapp_ordering_mode')|| in_array("poscloud", config('global.modules',[])) || in_array("deliveryqr", config('global.modules',[])) ): ?>
                                <div class="col-12 dDFlex pr-0 pl-0">
                                    <div class="col-6 pr-0 pl-0 ">  
                                        <span v-if="itemsCount&&deliveryPrice>0"><?php echo e(__('Delivery')); ?>:</span>
                                    </div>
                                    <div class="col-6 pl-0 text-right"> 
                                        <span v-if="itemsCount&&deliveryPrice>0" class="ammount">{{ deliveryPriceFormated }}</span><br />
                                    </div>
                                </div>
                                <?php endif; ?>
                                <div class="col-12 dDFlex pr-0 pl-0" v-if="deduct">
                                    <div class="col-6 pr-0 pl-0"> 
                                        <span v-if="deduct"><?php echo e(__('Applied coupon discount')); ?>:</span>
                                    </div>
                                    <div class="col-6 pl-0 text-right"> 
                                        <span v-if="deduct" class="ammount">{{ deductFormat }}</span>
                                    </div> 
                               </div>
                                <div class="col-12 dDFlex pr-0 pl-0">
                                    <div class="col-6 pr-0 pl-0"> 
                                    <span v-if="itemsCount"><strong><?php echo e(__('TOTAL')); ?>:</strong></span>
                                    </div>
                                    <div class="col-6 pl-0 text-right"> 
                                        <span v-if="itemsCount" class="ammount"><strong>{{ withDeliveryFormat   }}</strong></span>
                                    </div>
                                </div> 
                                <input v-if="itemsCount" type="hidden" id="tootalPricewithDeliveryRaw" :value="withDelivery" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>


        <!-- END Payment -->

        <div class="text-center d-none">
            <div class="d-none">
                <input class="custom-control-input d-none" id="privacypolicy" type="checkbox" checked="true">
                <!--<label class="custom-control-label" for="privacypolicy"><?php echo e(__('I agree to the Terms and Conditions and Privacy Policy')); ?></label>-->
                <label class="custom-control-label d-none" for="privacypolicy">
                    &nbsp;&nbsp;<?php echo e(__('I agree to the')); ?>

                    <a href="<?php echo e(config('settings.link_to_ts')); ?>" target="_blank" style="text-decoration: underline;"><?php echo e(__('Terms of Service')); ?></a> <?php echo e(__('and')); ?>

                    <a href="<?php echo e(config('settings.link_to_pr')); ?>" target="_blank" style="text-decoration: underline;"><?php echo e(__('Privacy Policy')); ?></a>.
                </label>
            </div>
        </div>

        <input type="hidden" name="hiboutik_sale_id" id="hiboutik_sale_id" value="">
        
        <div class="text-center">
            <button
                id="go_payement_btn"
                v-if="totalPrice"
                type="button"
                class="btn btn-success mt-4 paymentbutton bg-gradient-red icon-shape callOutShoppingButtonBottomCheckout mb-1 go_pay_btn_bord"
                onclick="storeOrder();"
            >
            <span class="col-4">&nbsp;</span>
            <span class="col-4"><?php echo e(__('Place order')); ?></span>
            <span class="col-4 icon-shape">
                <svg width="30px" height="30px" viewBox="0 -139.5 750 750" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <desc>Created with Sketch.</desc> <defs> </defs> <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g id="mastercard" fill-rule="nonzero"> <rect id="Rectangle-1" fill="#000000" x="0" y="0" width="750" height="471" rx="40"> </rect> <g id="Group" transform="translate(133.000000, 48.000000)"> <path d="M88.13,373.67 L88.13,348.82 C88.13,339.29 82.33,333.08 72.81,333.08 C67.81,333.08 62.46,334.74 58.73,340.08 C55.83,335.52 51.73,333.08 45.48,333.08 C40.7599149,332.876008 36.2525337,335.054575 33.48,338.88 L33.48,333.88 L25.61,333.88 L25.61,373.64 L33.48,373.64 L33.48,350.89 C33.48,343.89 37.62,340.54 43.42,340.54 C49.22,340.54 52.53,344.27 52.53,350.89 L52.53,373.67 L60.4,373.67 L60.4,350.89 C60.4,343.89 64.54,340.54 70.34,340.54 C76.14,340.54 79.45,344.27 79.45,350.89 L79.45,373.67 L88.13,373.67 Z M217.35,334.32 L202.85,334.32 L202.85,322.32 L195,322.32 L195,334.32 L186.72,334.32 L186.72,341.32 L195,341.32 L195,360 C195,369.11 198.31,374.5 208.25,374.5 C212.015784,374.421483 215.705651,373.426077 219,371.6 L216.51,364.6 C214.275685,365.996557 211.684475,366.715565 209.05,366.67 C204.91,366.67 202.84,364.18 202.84,360.04 L202.84,341 L217.34,341 L217.34,334.37 L217.35,334.32 Z M291.07,333.08 C286.709355,332.982846 282.618836,335.185726 280.3,338.88 L280.3,333.88 L272.43,333.88 L272.43,373.64 L280.3,373.64 L280.3,351.31 C280.3,344.68 283.61,340.54 289,340.54 C290.818809,340.613783 292.62352,340.892205 294.38,341.37 L296.87,333.91 C294.971013,333.43126 293.02704,333.153071 291.07,333.08 Z M179.66,337.22 C175.52,334.32 169.72,333.08 163.51,333.08 C153.57,333.08 147.36,337.64 147.36,345.51 C147.36,352.14 151.92,355.86 160.61,357.11 L164.75,357.52 C169.31,358.35 172.21,360.01 172.21,362.08 C172.21,364.98 168.9,367.08 162.68,367.08 C157.930627,367.177716 153.278889,365.724267 149.43,362.94 L145.29,369.15 C151.09,373.29 158.13,374.15 162.29,374.15 C173.89,374.15 180.1,368.77 180.1,361.31 C180.1,354.31 175.1,350.96 166.43,349.71 L162.29,349.3 C158.56,348.89 155.29,347.64 155.29,345.16 C155.29,342.26 158.6,340.16 163.16,340.16 C168.16,340.16 173.1,342.23 175.59,343.47 L179.66,337.22 Z M299.77,353.79 C299.77,365.79 307.64,374.5 320.48,374.5 C326.28,374.5 330.42,373.26 334.56,369.94 L330.42,363.73 C327.488758,366.10388 323.841703,367.41823 320.07,367.46 C313.07,367.46 307.64,362.08 307.64,354.21 C307.64,346.34 313,341 320.07,341 C323.841703,341.04177 327.488758,342.35612 330.42,344.73 L334.56,338.52 C330.42,335.21 326.28,333.96 320.48,333.96 C308.05,333.13 299.77,341.83 299.77,353.84 L299.77,353.79 Z M244.27,333.08 C232.67,333.08 224.8,341.36 224.8,353.79 C224.8,366.22 233.08,374.5 245.09,374.5 C250.932775,374.623408 256.638486,372.722682 261.24,369.12 L257.1,363.32 C253.772132,365.898743 249.708598,367.349004 245.5,367.46 C240.12,367.46 234.32,364.15 233.5,357.11 L262.91,357.11 L262.91,353.8 C262.91,341.37 255.45,333.09 244.27,333.09 L244.27,333.08 Z M243.86,340.54 C249.66,340.54 253.8,344.27 254.21,350.48 L232.68,350.48 C233.92,344.68 237.68,340.54 243.86,340.54 Z M136.59,353.79 L136.59,333.91 L128.72,333.91 L128.72,338.91 C125.82,335.18 121.72,333.11 115.88,333.11 C104.7,333.11 96.41,341.81 96.41,353.82 C96.41,365.83 104.69,374.53 115.88,374.53 C121.68,374.53 125.82,372.46 128.72,368.73 L128.72,373.73 L136.59,373.73 L136.59,353.79 Z M104.7,353.79 C104.7,346.33 109.26,340.54 117.13,340.54 C124.59,340.54 129.13,346.34 129.13,353.79 C129.13,361.66 124.13,367.04 117.13,367.04 C109.26,367.45 104.7,361.24 104.7,353.79 Z M410.78,333.08 C406.419355,332.982846 402.328836,335.185726 400.01,338.88 L400.01,333.88 L392.14,333.88 L392.14,373.64 L400,373.64 L400,351.31 C400,344.68 403.31,340.54 408.7,340.54 C410.518809,340.613783 412.32352,340.892205 414.08,341.37 L416.57,333.91 C414.671013,333.43126 412.72704,333.153071 410.77,333.08 L410.78,333.08 Z M380.13,353.79 L380.13,333.91 L372.26,333.91 L372.26,338.91 C369.36,335.18 365.26,333.11 359.42,333.11 C348.24,333.11 339.95,341.81 339.95,353.82 C339.95,365.83 348.23,374.53 359.42,374.53 C365.22,374.53 369.36,372.46 372.26,368.73 L372.26,373.73 L380.13,373.73 L380.13,353.79 Z M348.24,353.79 C348.24,346.33 352.8,340.54 360.67,340.54 C368.13,340.54 372.67,346.34 372.67,353.79 C372.67,361.66 367.67,367.04 360.67,367.04 C352.8,367.45 348.24,361.24 348.24,353.79 Z M460.07,353.79 L460.07,318.17 L452.2,318.17 L452.2,338.88 C449.3,335.15 445.2,333.08 439.36,333.08 C428.18,333.08 419.89,341.78 419.89,353.79 C419.89,365.8 428.17,374.5 439.36,374.5 C445.16,374.5 449.3,372.43 452.2,368.7 L452.2,373.7 L460.07,373.7 L460.07,353.79 Z M428.18,353.79 C428.18,346.33 432.74,340.54 440.61,340.54 C448.07,340.54 452.61,346.34 452.61,353.79 C452.61,361.66 447.61,367.04 440.61,367.04 C432.73,367.46 428.17,361.25 428.17,353.79 L428.18,353.79 Z" id="Shape" fill="#FFFFFF"> </path> <g> <rect id="Rectangle-path" fill="#FF5F00" x="170.55" y="32.39" width="143.72" height="234.42"> </rect> <path d="M185.05,149.6 C185.05997,103.912554 205.96046,60.7376085 241.79,32.39 C180.662018,-15.6713968 92.8620037,-8.68523415 40.103462,48.4380037 C-12.6550796,105.561241 -12.6550796,193.638759 40.103462,250.761996 C92.8620037,307.885234 180.662018,314.871397 241.79,266.81 C205.96046,238.462391 185.05997,195.287446 185.05,149.6 Z" id="Shape" fill="#EB001B"> </path> <path d="M483.26,149.6 C483.30134,206.646679 450.756789,258.706022 399.455617,283.656273 C348.154445,308.606523 287.109181,302.064451 242.26,266.81 C278.098424,238.46936 299.001593,195.290092 299.001593,149.6 C299.001593,103.909908 278.098424,60.7306402 242.26,32.39 C287.109181,-2.86445052 348.154445,-9.40652324 399.455617,15.5437274 C450.756789,40.493978 483.30134,92.5533211 483.26,149.6 Z" id="Shape" fill="#F79E1B"> </path> </g> </g> </g> </g> </g></svg>
                <svg height="30px" width="30px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path style="fill:#FFFFFF;" d="M512,402.281c0,16.716-13.55,30.267-30.265,30.267H30.265C13.55,432.549,0,418.997,0,402.281V109.717 c0-16.716,13.55-30.266,30.265-30.266h451.47c16.716,0,30.265,13.551,30.265,30.266V402.281L512,402.281z"></path> <path style="fill:#F79F1A;" d="M113.64,258.035l-12.022-57.671c-2.055-7.953-8.035-10.319-15.507-10.632H30.993l-0.491,2.635 C73.431,202.774,101.836,227.88,113.64,258.035z"></path> <g> <polygon style="fill:#059BBF;" points="241.354,190.892 205.741,190.892 183.499,321.419 219.053,321.419 "></polygon> <path style="fill:#059BBF;" d="M135.345,321.288l56.01-130.307h-37.691l-34.843,89.028l-3.719-13.442 c-6.83-16.171-26.35-39.446-49.266-54.098l31.85,108.863L135.345,321.288z"></path> <path style="fill:#059BBF;" d="M342.931,278.75c0.132-14.819-9.383-26.122-29.887-35.458c-12.461-6.03-20.056-10.051-19.965-16.17 c0-5.406,6.432-11.213,20.368-11.213c11.661-0.179,20.057,2.367,26.624,5.003l3.218,1.475l4.826-28.277 c-7.059-2.637-18.094-5.451-31.895-5.451c-35.157,0-59.904,17.691-60.128,43.064c-0.224,18.763,17.692,29.216,31.181,35.469 c13.847,6.374,18.493,10.453,18.404,16.171c-0.089,8.743-11.035,12.73-21.264,12.73c-14.25,0-21.8-1.965-33.509-6.843l-4.55-2.09 l-4.998,29.249c8.303,3.629,23.668,6.801,39.618,6.933C318.361,323.342,342.663,305.876,342.931,278.75z"></path> <path style="fill:#059BBF;" d="M385.233,301.855c4.065,0,40.382,0.045,45.566,0.045c1.072,4.545,4.333,19.565,4.333,19.565h33.011 L439.33,191.027h-27.472c-8.533,0-14.874,2.323-18.628,10.809l-52.845,119.629h37.392 C377.774,321.465,383.848,305.386,385.233,301.855z M409.622,238.645c-0.176,0.357,2.95-7.549,4.737-12.463l2.411,11.256 c0,0,6.792,31.182,8.22,37.704h-29.528C398.411,267.638,409.622,238.645,409.622,238.645z"></path> <path style="fill:#059BBF;" d="M481.735,79.451H30.265C13.55,79.451,0,93.001,0,109.717v31.412h512v-31.412 C512,93.001,498.451,79.451,481.735,79.451z"></path> </g> <path style="fill:#F79F1A;" d="M481.735,432.549H30.265C13.55,432.549,0,418.998,0,402.283v-31.412h512v31.412 C512,418.998,498.451,432.549,481.735,432.549z"></path> <path style="opacity:0.15;fill:#202121;enable-background:new ;" d="M21.517,402.281V109.717 c0-16.716,13.551-30.266,30.267-30.266h-21.52C13.55,79.451,0,93.001,0,109.717v292.565c0,16.716,13.55,30.267,30.265,30.267h21.52 C35.069,432.549,21.517,418.997,21.517,402.281z"></path> </g></svg>
                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" width="30px" height="30px" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path style="fill:#E7E8E3;" d="M512,402.282c0,16.716-13.55,30.267-30.265,30.267H30.265C13.55,432.549,0,418.996,0,402.282V109.717 c0-16.716,13.55-30.266,30.265-30.266h451.469c16.716,0,30.265,13.551,30.265,30.266L512,402.282L512,402.282z"></path> <rect y="148.13" style="fill:#34495E;" width="512" height="72.01"></rect> <rect y="220.16" style="fill:#FFFFFF;" width="512" height="44.555"></rect> <path style="opacity:0.15;fill:#202121;enable-background:new ;" d="M21.517,402.282V109.717 c0-16.716,13.552-30.266,30.267-30.266h-21.52C13.55,79.451,0,93.003,0,109.717v292.565c0,16.716,13.55,30.267,30.265,30.267h21.52 C35.07,432.549,21.517,418.996,21.517,402.282z"></path> <g> <path style="fill:#34495E;" d="M160.063,322.723H55.437c-4.611,0-8.348-3.736-8.348-8.348c0-4.611,3.736-8.348,8.348-8.348h104.626 c4.611,0,8.348,3.736,8.348,8.348S164.674,322.723,160.063,322.723z"></path> <path style="fill:#34495E;" d="M160.063,357.422H55.437c-4.611,0-8.348-3.738-8.348-8.348c0-4.611,3.736-8.348,8.348-8.348h104.626 c4.611,0,8.348,3.736,8.348,8.348S164.674,357.422,160.063,357.422z"></path> <path style="fill:#34495E;" d="M160.063,392.121H55.437c-4.611,0-8.348-3.738-8.348-8.348c0-4.611,3.736-8.348,8.348-8.348h104.626 c4.611,0,8.348,3.736,8.348,8.348C168.411,388.383,164.674,392.121,160.063,392.121z"></path> </g> <g> <polygon style="fill:#EE3725;" points="426.722,294.646 322.495,294.646 374.611,346.762 "></polygon> <polygon style="fill:#EE3725;" points="322.495,314.313 322.495,294.646 270.387,346.762 322.495,398.871 322.495,375.274 "></polygon> <polygon style="fill:#EE3725;" points="426.722,294.646 426.722,314.313 426.722,375.274 426.722,398.871 478.837,346.762 "></polygon> <polygon style="fill:#EE3725;" points="403.124,375.274 374.611,346.762 346.095,375.274 346.093,375.274 322.495,398.871 426.722,398.871 "></polygon> </g> </g></svg>
                <svg height="30px" width="30px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path style="fill:#92DBEF;" d="M512,402.282c0,16.716-13.55,30.267-30.265,30.267H30.265C13.55,432.549,0,418.997,0,402.282V109.717 c0-16.716,13.55-30.266,30.265-30.266h451.47c16.716,0,30.265,13.551,30.265,30.266V402.282L512,402.282z"></path> <path style="opacity:0.15;fill:#202121;enable-background:new ;" d="M21.517,402.282V109.717 c0-16.716,13.552-30.266,30.267-30.266h-21.52C13.55,79.451,0,93.001,0,109.717v292.565c0,16.716,13.55,30.267,30.265,30.267h21.52 C35.07,432.549,21.517,418.997,21.517,402.282z"></path> <path style="fill:#263B80;" d="M332.435,148.47c-11.22-12.825-32.057-19.233-60.905-19.233h-80.143 c-4.811,0-9.616,4.812-11.22,9.613L148.11,348.817c0,4.815,3.207,8.014,6.407,8.014h49.687l12.823-78.534v3.206 c1.606-4.813,6.409-9.615,11.222-9.615h24.045c46.479,0,81.733-19.233,92.955-72.132v-4.808c-1.602,0-1.602,0,0,0 C346.854,174.117,343.648,161.292,332.435,148.47"></path> <path style="fill:#232C65;" d="M345.25,199.756v-4.808c0.011-0.159,0.018-0.307,0.028-0.465c-2.85-1.981-5.52-3.363-7.561-4.259 c-9.732-4.021-19.684-4.779-24.278-4.894l-0.024-0.02h-23.374c0,0,0.02,0.012,0.03,0.019h-49.03 c-8.336,0.303-10.634,7.024-11.236,9.948l-12.777,83.021v1.97v1.235c1.606-4.813,6.409-9.615,11.222-9.615h24.045 C298.774,271.888,334.028,252.654,345.25,199.756z"></path> <path style="fill:#139AD6;" d="M360.996,214.814c-3.622-9.993-10.031-16.378-15.717-20.332c-0.011,0.158-0.018,0.306-0.028,0.465 v4.808c-11.222,52.898-46.476,72.132-92.955,72.132h-24.045c-4.813,0-9.616,4.801-11.222,9.615v-1.236 c-0.183,0.41-0.352,0.823-0.49,1.236l-9.055,55.247l-3.279,20.082h-0.012l-3.679,22.442c0,3.204,1.605,6.403,6.408,6.403h39.953 c8.038,0,10.563-6.253,11.339-9.622l0.339-2.093v-0.001l7.672-47.584c0,0,1-11.219,11.945-11.219h4.089 c40.07,0,72.126-16.025,80.139-64.107C364.626,237.645,364.516,225.032,360.996,214.814z"></path> </g></svg>
            </span>
        </button>
        </div>

        <div class="text-center">
            <button
                id="go_payement_btn"
                v-if="totalPrice"
                type="button"
                class="btn btn-success mt-4 paymentbutton bg-gradient-red icon-shape callOutShoppingButtonBottomCheckout mb-1 go_pay_btn_bord"
                onclick="storeOrderCash();"
            ><?php echo e(__('Pay now')); ?></button>
        </div>

        <div class="text-center">
            
        </div>

      </div>
      <br />
      <br />
    </div>
  </div>

  <?php if(config('settings.is_demo') && config('settings.enable_stripe')): ?>
    
  <?php endif; ?>
<?php /**PATH C:\laragon\www\gangnamfalafel-com\resources\views/cart/payment.blade.php ENDPATH**/ ?>