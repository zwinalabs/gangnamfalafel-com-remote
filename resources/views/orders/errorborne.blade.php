<div class="container">
<div class="col-12 justify-content-center">
    <div  id="checkoutBorneLoader">
        <img class="eCards" alt="card icon" src="/custom/img/payment-processing.gif" >
    </div>
        <div class="border-0 mt-1">
                <div class=" text-center">
                    <div class="swal2-icon swal2-error swal2-animate-error-icon" style="display: flex;"><span class="swal2-x-mark"><span class="swal2-x-mark-line-left"></span><span class="swal2-x-mark-line-right"></span></span></div>
                    <h2 class="display-2 display-payment-success">{{ $errMsg }}</h2>
                    <h1 class="mb-4">
                        <span class="badge badge-primary">{{ __('Order')." #".($order->sale_id_hiboutik)??$order->id }}</span>
                    </h1>
                    <div class="row col-12 pr-0 m-3">
                        <div class="col-4" >
                            <button id="clearAndReset" onclick="hidePaymentDetailsBorneModel();showLandingPageAfterPayment();"  >
                                <svg fill="#277605" height="64px" width="64px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 370 370" xml:space="preserve" stroke="#277605"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path d="M366.85,71.242c-2.842-3.661-7.216-5.802-11.85-5.802H97.836L87.698,37.929c-2.173-5.896-7.791-9.813-14.075-9.813H15 c-8.284,0-15,6.716-15,15c0,8.284,6.716,15,15,15h48.165l85.384,231.704c2.173,5.897,7.791,9.814,14.075,9.814h147.823 c8.284,0,15-6.716,15-15c0-8.284-6.716-15-15-15H173.082l-13.572-36.829h160.319c6.852,0,12.832-4.642,14.531-11.279L369.531,84.16 C370.681,79.671,369.69,74.902,366.85,71.242z M257.856,162.727c5.858,5.858,5.858,15.355,0,21.213 c-2.929,2.929-6.768,4.393-10.606,4.393s-7.678-1.464-10.606-4.393L223,170.296l-13.644,13.644 c-2.929,2.929-6.768,4.393-10.606,4.393s-7.678-1.464-10.606-4.393c-5.858-5.858-5.858-15.355,0-21.213l13.643-13.644 l-13.643-13.643c-5.858-5.858-5.858-15.355,0-21.213c5.857-5.858,15.355-5.858,21.213,0L223,127.87l13.644-13.644 c5.857-5.858,15.355-5.858,21.213,0c5.858,5.858,5.858,15.355,0,21.213l-13.644,13.643L257.856,162.727z"></path> <path d="M181.482,303.196c-10.687,0-19.347,8.658-19.347,19.344c0,10.686,8.66,19.344,19.347,19.344 c10.686,0,19.347-8.659,19.347-19.344C200.829,311.854,192.169,303.196,181.482,303.196z"></path> <path d="M282.311,303.196c-10.686,0-19.347,8.658-19.347,19.344c0,10.686,8.66,19.344,19.347,19.344s19.342-8.659,19.342-19.344 C301.653,311.854,292.998,303.196,282.311,303.196z"></path> </g> </g></svg>
                                <span>{{ __("Cancel") }}</span>
                            </button>
                        </div>
                        <div class="col-4">
                        <button id="clearAndReset" onclick="tryAgainPayment('{{$order->id}}');">
                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" height="64px" width="64px" fill="#000000" stroke="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path style="fill:#277605;" d="M256,0C114.616,0,0,114.616,0,256s114.616,256,256,256s256-114.616,256-256S397.384,0,256,0z"></path> <path style="fill:#FFFFFF;" d="M428.496,379.144H83.504c-6.328,0-11.504-5.176-11.504-11.496V144.352 c0-6.328,5.176-11.504,11.504-11.504h345c6.328,0,11.504,5.176,11.504,11.504V367.64C440,373.968,434.824,379.144,428.496,379.144z"></path> <rect x="71.984" y="171.072" width="368" height="57.504"></rect> <rect x="112.88" y="272.4" width="115.208" height="11.504"></rect> <rect x="112.88" y="304.72" width="78.992" height="11.504"></rect> <path d="M380.656,412.36c-7.92,4.424-21.424,8.848-36.336,8.848c-22.824,0-43.776-9.32-56.824-26.552 c-6.296-7.92-10.944-17.928-13.048-30.272h-15.144V347.84h12.808c0-1.16,0-2.56,0-3.96c0-2.32,0.24-4.648,0.24-6.984h-13.048 v-16.528h15.608c3.024-12.584,8.624-23.288,16.064-31.912c13.28-14.904,31.912-23.752,53.8-23.752 c14.208,0,26.552,3.264,34.936,6.984l-6.52,26.552c-6.048-2.56-15.592-5.6-25.848-5.6c-11.168,0-21.424,3.736-28.632,12.584 c-3.264,3.72-5.824,9.08-7.464,15.144h58v16.528h-61.496c-0.224,2.336-0.224,4.896-0.224,7.224c0,1.4,0,2.32,0,3.72h61.72v16.544 h-58.464c1.624,6.984,4.184,12.344,7.68,16.304c7.448,8.384,18.408,11.864,30.048,11.864c10.704,0,21.648-3.48,26.552-6.048 L380.656,412.36z"></path> </g></svg>
                                <span>{{ __("Try again") }}</span>  </button>
                        </div>
                        <div class="col-4">
                            <button id="clearAndReset" onclick="$('#pinPassOrderModal').modal('show');">
                                <svg width="64px" height="64px" viewBox="0 0 48 48" version="1" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 48 48" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g fill="#FFA726"> <circle cx="10" cy="26" r="4"></circle> <circle cx="38" cy="26" r="4"></circle> </g> <path fill="#FFB74D" d="M39,19c0-12.7-30-8.3-30,0c0,1.8,0,8.2,0,10c0,8.3,6.7,15,15,15s15-6.7,15-15C39,27.2,39,20.8,39,19z"></path> <path fill="#FF5722" d="M24,3C14.6,3,7,10.6,7,20c0,1.2,0,3.4,0,3.4L9,25v-3l21-9.8l9,9.8v3l2-1.6c0,0,0-2.1,0-3.4 C41,12,35.3,3,24,3z"></path> <g fill="#784719"> <circle cx="31" cy="26" r="2"></circle> <circle cx="17" cy="26" r="2"></circle> </g> <path fill="#757575" d="M43,24c-0.6,0-1,0.4-1,1v-7c0-8.8-7.2-16-16-16h-7c-0.6,0-1,0.4-1,1s0.4,1,1,1h7c7.7,0,14,6.3,14,14v10 c0,0.6,0.4,1,1,1s1-0.4,1-1v2c0,3.9-3.1,7-7,7H24c-0.6,0-1,0.4-1,1s0.4,1,1,1h11c5,0,9-4,9-9v-5C44,24.4,43.6,24,43,24z"></path> <g fill="#37474F"> <path d="M43,22h-1c-1.1,0-2,0.9-2,2v4c0,1.1,0.9,2,2,2h1c1.1,0,2-0.9,2-2v-4C45,22.9,44.1,22,43,22z"></path> <circle cx="24" cy="38" r="2"></circle> </g> </g></svg>
                                <span>{{ __("PIN Code") }}</span>
                            </button>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <div class="col-8">
                            <h5 class="mt-0 mb-5 heading-small text-muted d-none">
                                {{ __("You can make another try to pay.") }}
                            </h5>
                            <span class="col-12 d-none">{{ __($error) }}</span>
                            <div class="mb-2 mt-1 d-none">
                                <div class="col-12 dDFlex pr-0 pl-0">
                                    <div class="col-12 p-4 text-center coupons-area">
                                        <a href="javascript:void(0)" onClick="$('#pinPassOrderModal').modal('show')" class="mody-checkout-link text-primary uppercase font-semibold text-xs leading-normal">
                                            <svg fill="#03643b" width="19px" height="19px" class="f-fl" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" stroke="#03643b"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M80,42V33a3,3,0,0,0-3-3H38v2H36V30H23a3,3,0,0,0-3,3v9a8,8,0,0,1,0,16h0v9a3,3,0,0,0,3,3H36V68h2v2H77a3,3,0,0,0,3-3V58a8,8,0,0,1,0-16ZM38,64H36V60h2Zm0-8H36V52h2Zm0-8H36V44h2Zm0-8H36V36h2ZM51,53.62,49.13,55l-2-2.75L45,55l-1.87-1.33,2-2.9-3.11-1,.69-2.18,3,1V45.05h2.53v3.52l3-1,.68,2.18-3.11,1Zm15.84,0L65,55l-2-2.75L60.85,55,59,53.62,61,50.72l-3.11-1,.68-2.18,3,1V45.05h2.53v3.52l3-1,.69,2.18-3.11,1Z"></path></g></svg>
                                            <span id="couponsLabel">{{ __('Cash') }}</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <a href="javascript:void(0)" onclick="hidePaymentDetailsBorneModel();showLandingPageAfterPayment();" class="btn btn-outline-primary btn-sm">
                                <span class="btn-inner--icon fsize-20">
                                    <i class="fa fa-angle-double-left"></i>
                                </span>
                                <span  class="btn-inner--text">{{ __('Go back to restaurant') }}</span>
                            </a>
                                
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Coupons -->
<div class="modal" id="pinPassOrderModal" tabindex="-1" role="dialog" aria-labelledby="pinPassOrderModal" aria-hidden="true">
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
                    <div class="card card-profile">
                        <div class="px-2">
                            <div class="mt-3">
                                <h6>{{ __('PIN Code') }}<span class="font-weight-light"></span></h6>
                            </div>
                            <div class="card-content border-top">
                                <div class="form-group">
                                    <input type="text" name="rscode_pin" id="rscode_pin" class="green-border form-control" placeholder="PIN">
                                </div>
                            </div>
                            <div class="row col-12">
                                <div class="col-6"><button id="btn-cancel-comment" type="button" class="btn btn-outline-primary action-btn close" data-dismiss="modal" aria-label="Close" >{{ __('Cancel') }}</button></div>
                                <div class="col-6 text-right"><button  id="btn-valid-comment" type="button" class="btn btn-outline-primary action-btn close" data-dismiss="modal" aria-label="Close" onClick="codePinCODPayment({{$order->id}});">{{ __('Apply') }}</button></div>
                            </div>
                        </div>
                    </div>     
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('custom') }}/js/cancel.js"></script>





