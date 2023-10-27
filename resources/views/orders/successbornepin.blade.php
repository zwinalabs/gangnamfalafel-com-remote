
<div class="container">
    <div class="col-12 justify-content-center">
        <div class="border-0 mt-1">
            <div class="text-center">
                <div id="successPaymentAnim" class="justify-content-center text-center">
                    <img alt="cash icon successborne-pin" src="/custom/img/payment-successful.gif" >
                </div>
                <h2 class="display-2 display-payment-success">{{ __("You're all set!") }}</h2>
                <h1 class="mb-4">
                    <span class="badge badge-primary">{{ __('Order')." #".($order->sale_id_hiboutik)??$order->id }}</span>
                </h1>
                <div class="d-flex justify-content-center">
                    <div class="col-8">
                        <h5 class="mt-0 mb-1 heading-small text-muted">
                            {{ $errMsg }}
                        </h5>
                        <div class="font-weight-300 mt-2 mb-3 d-none">
                            <a href="javascript:void(0)" onclick="$('#receiptOrderModal').modal('show')" class="btn btn-outline-primary btn-sm fsize-16">
                                <span class="btn-inner--icon fsize-20">
                                    <svg fill="#03643b" height="20px" width="20" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 210.68 210.68" xml:space="preserve" stroke="#136303" style="display: inline-block;"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path d="M67.869,65.313h39.476c4.143,0,7.5-3.358,7.5-7.5c0-4.142-3.357-7.5-7.5-7.5H67.869c-4.142,0-7.5,3.358-7.5,7.5 C60.369,61.954,63.727,65.313,67.869,65.313z"></path> <path d="M142.81,81.994H67.869c-4.142,0-7.5,3.358-7.5,7.5c0,4.142,3.358,7.5,7.5,7.5h74.941c4.143,0,7.5-3.358,7.5-7.5 C150.31,85.352,146.953,81.994,142.81,81.994z"></path> <path d="M67.869,128.682h53.367c4.143,0,7.5-3.358,7.5-7.5c0-4.142-3.357-7.5-7.5-7.5H67.869c-4.142,0-7.5,3.358-7.5,7.5 C60.369,125.324,63.727,128.682,67.869,128.682z"></path> <path d="M142.81,145.367H67.869c-4.142,0-7.5,3.358-7.5,7.5c0,4.142,3.358,7.5,7.5,7.5h74.941c4.143,0,7.5-3.358,7.5-7.5 C150.31,148.725,146.953,145.367,142.81,145.367z"></path> <path d="M174.423,18.144L158.477,2.197C157.071,0.79,155.163,0,153.174,0c-1.989,0-3.897,0.79-5.304,2.197L137.228,12.84 L126.585,2.197C125.178,0.79,123.27,0,121.281,0c-1.989,0-3.897,0.79-5.304,2.197l-10.641,10.642L94.697,2.197 C93.29,0.79,91.382,0,89.392,0c-1.989,0-3.897,0.79-5.304,2.198L73.451,12.839L62.809,2.197C61.403,0.79,59.495,0,57.506,0 s-3.897,0.79-5.304,2.197L36.257,18.144c-1.406,1.406-2.196,3.314-2.196,5.303v163.79c0,1.989,0.791,3.897,2.197,5.304 l15.945,15.942c2.928,2.929,7.676,2.928,10.605,0l10.644-10.642l10.645,10.642c1.407,1.406,3.315,2.196,5.304,2.196 c1.989,0,3.897-0.791,5.303-2.198l10.634-10.638l10.641,10.639c2.928,2.929,7.676,2.928,10.605,0l10.645-10.641l10.643,10.641 c1.464,1.464,3.384,2.196,5.303,2.196c1.919,0,3.839-0.732,5.303-2.196l15.945-15.942c1.407-1.406,2.197-3.314,2.197-5.304V23.447 C176.619,21.458,175.829,19.551,174.423,18.144z M161.619,184.13l-8.445,8.444l-10.643-10.641c-2.93-2.929-7.676-2.928-10.605,0 l-10.644,10.641l-10.642-10.641c-1.407-1.407-3.314-2.197-5.304-2.196c-1.989,0-3.897,0.79-5.303,2.198l-10.634,10.638 l-10.643-10.64c-2.929-2.928-7.676-2.928-10.605,0l-10.644,10.641l-8.445-8.444V26.554l8.445-8.447L68.149,28.75 c1.407,1.407,3.315,2.197,5.304,2.197c1.99,0,3.897-0.791,5.304-2.198l10.637-10.641l10.639,10.642 c1.406,1.407,3.314,2.197,5.304,2.197c1.99,0,3.897-0.79,5.304-2.197l10.641-10.643l10.644,10.643 c1.407,1.407,3.314,2.197,5.304,2.197c1.989,0,3.897-0.79,5.304-2.197l10.642-10.643l8.445,8.446V184.13z"></path> </g> </g></svg>
                                </span>
                                <span  class="btn-inner--text">{{ __('View Receipt') }}</span>
                          </a>
                        </div>
                        <div class="font-weight-300 mb-2">
                            <a href="javascript:void(0)" onclick="hidePaymentDetailsBorneModel();showLandingPageAfterPayment();" class="btn btn-outline-primary btn-sm fsize-16">
                                <span class="btn-inner--icon fsize-20">
                                    <i class="fa fa-angle-double-left"></i>
                                </span>
                                <span  class="btn-inner--text">{{ __('Go back to restaurant') }}</span>
                            </a>
                        </div>
                        <!-- My Order Buttton -->
                        {{--
                            @if (config('app.isqrsaas'))
                        <br/><br/><br/>
                         <a href="{{ route('guest.orders')}}"  class="btn  btn-lg btn-outline-primary btn btn-neutral btn-icon btn-cart">
                            <span class="btn-inner--icon">
                                <i class="fa fa-list-alt"></i>
                              </span>
                             <span  class="btn-inner--text">{{ __('My Orders') }}</span>
                         </a>
                         @endif 
                         --}}
                        
                        <!-- End  My Order Button -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Coupons -->
<div class="modal" id="receiptOrderModal" tabindex="-1" role="dialog" aria-labelledby="receiptOrderModal" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="modalTitle" class="modal-title" id="modal-title-new-item">{{ __('Receipt') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #ffffff;">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body p-0">                        
                <div class="col-12 mr-0 ml-0">
                    <div class="card card-profile receiptTxt">
                        {!! $receipt !!}
                    </div>     
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('custom') }}/js/success.js"></script>