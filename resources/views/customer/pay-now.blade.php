@extends('layouts.app') @section('content')
<!--Code area start-->
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center pt-5 fmb_titel">
                <h1>Checkout & Payment</h1>
                <ol class="breadcrumb mb-5">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item"><a href="projects.html">Project list</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="pb-5 checkout_">
    <div class="container">
        <form role="form" action="{{ route('stripe.post') }}" method="post" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
            @csrf
            <input type="hidden" name="taskid" value="{{$task->id}}">
            <input type="hidden" name="totalamount" value="{{ $task->price + $task->contingency }}">

            <div class="row mb-5">
                <div class="col-md-10 offset-md-1">
                    <div class="bs-wizard row">
                        <div class="col">
                            <div class="text-center">
                                Initial payment
                                <h2>£{{ $task->price }}</h2>
                            </div>
                        </div>

                        @if($task->contingency !='')
                        <div class="col">
                            <div class="text-center mt-5">
                                <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect y="15" width="32" height="3" fill="white" />
                                    <rect x="18" width="32" height="3" transform="rotate(90 18 0)" fill="white" />
                                </svg>
                            </div>
                        </div>
                        <div class="col">
                            <div class="text-center">
                                Contingency
                                <h2>£{{ $task->contingency }}</h2>
                            </div>
                        </div>
                        @endif

                        <div class="col">
                            <div class="text-center mt-5">
                                <svg width="33" height="13" viewBox="0 0 33 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect width="32" height="3" fill="white" />
                                    <rect x="32.5" y="12.5" width="32" height="3" transform="rotate(-180 32.5 12.5)" fill="white" />
                                </svg>
                            </div>
                        </div>
                        <div class="col">
                            <div class="text-center">
                                Total amount
                                <h2>£{{ $task->price }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row payment-type">
                <div class="col-md-10 offset-md-1">
                    {{--
                    <div class="row mb-5">
                        <div class="col-12">
                            <div class="white_bg">
                                <h3>Payment type</h3>
                                <h5>
                                    Debit / Credit card
                                    <div class="mt-2">
                                        <svg width="128" height="28" viewBox="0 0 128 28" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <mask id="mask0_1332_1834" style="mask-type: alpha;" maskUnits="userSpaceOnUse" x="0" y="0" width="128" height="28">
                                                <rect width="128" height="28" fill="#D9D9D9" />
                                            </mask>
                                            <g mask="url(#mask0_1332_1834)">
                                                <rect x="-45" y="-7" width="173" height="35" fill="url(#pattern0)" />
                                            </g>
                                            <defs>
                                                <pattern id="pattern0" patternContentUnits="objectBoundingBox" width="1" height="1">
                                                    <use xlink:href="#image0_1332_1834" transform="matrix(0.00119048 0 0 0.00588435 0 -0.00605442)" />
                                                </pattern>

                                            </defs>
                                        </svg>
                                    </div>
                                </h5>

                                <div class="mt-4">
                                    <div class="row form_wrap">
                                        <div class="col-md-6 spt_">
                                            <input type="text" class="form-control" id="" placeholder="7693  4456  7834  9012" />
                                            <em>
                                                <img src="assets/img/mask-group.svg" alt="" />
                                            </em>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="" placeholder="Name as on the card" />
                                            </div>
                                        </div>
                                        <div class="col-md-2 ed_">
                                            <h4>Expiry date</h4>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control" id="" placeholder="MM" />
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control" id="" placeholder="YY" />
                                        </div>
                                        <div class="col-md-2 ccv_">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="" placeholder="CVV" />
                                                <em>
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M12 22C6.477 22 2 17.523 2 12C2 6.477 6.477 2 12 2C17.523 2 22 6.477 22 12C22 17.523 17.523 22 12 22ZM11 15V17H13V15H11ZM13 13.355C13.8037 13.1128 14.4936 12.59 14.9442 11.8817C15.3947 11.1735 15.5759 10.3271 15.4547 9.49647C15.3336 8.66588 14.9181 7.90644 14.284 7.35646C13.6499 6.80647 12.8394 6.50254 12 6.5C11.1909 6.49994 10.4067 6.78015 9.78079 7.29299C9.15492 7.80583 8.72601 8.51963 8.567 9.313L10.529 9.706C10.5847 9.42743 10.7183 9.1704 10.9144 8.96482C11.1104 8.75923 11.3608 8.61354 11.6364 8.54471C11.912 8.47587 12.2015 8.48671 12.4712 8.57597C12.7409 8.66523 12.9797 8.82924 13.1598 9.04891C13.34 9.26858 13.454 9.53489 13.4887 9.81684C13.5234 10.0988 13.4773 10.3848 13.3558 10.6416C13.2343 10.8984 13.0423 11.1154 12.8023 11.2673C12.5623 11.4193 12.2841 11.5 12 11.5C11.7348 11.5 11.4804 11.6054 11.2929 11.7929C11.1054 11.9804 11 12.2348 11 12.5V14H13V13.355Z"
                                                            fill="#6D717A"
                                                        />
                                                    </svg>
                                                </em>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-4 ta_">
                                    <p>Fix my build platform fee (5% + VAT): £2600</p>
                                    <p>Stripe transaction fee (FEE): £195.20</p>
                                    <hr />
                                    <h5>Total amount: £2795.20</h5>
                                </div>

                                <div class="mt-4">
                                    <h3>
                                        <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M15 26.25V23.5938L21.625 16.9688L24.2812 19.625L17.6562 26.25H15ZM3.75 20V17.5H12.5V20H3.75ZM25.1562 18.75L22.5 16.0938L23.4062 15.1875C23.6354 14.9583 23.9271 14.8438 24.2812 14.8438C24.6354 14.8438 24.9271 14.9583 25.1562 15.1875L26.0625 16.0938C26.2917 16.3229 26.4062 16.6146 26.4062 16.9688C26.4062 17.3229 26.2917 17.6146 26.0625 17.8438L25.1562 18.75ZM3.75 15V12.5H17.5V15H3.75ZM3.75 10V7.5H17.5V10H3.75Z"
                                                fill="#061A48"
                                            />
                                        </svg>
                                        Note
                                    </h3>
                                    <p>
                                        After clicking on the Make Payment button, you will be directed to a secure gateway for payment. After completing the payment process, you will be redirected back to the website to view details of
                                        your order.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    --}}
                    <div class="form-group col-md-12 mt-5 text-center pre_">
                        <a href="projects.html" class="btn btn-light mr-3">Back</a>
                        {{-- <a href="#" class="btn btn-primary">Make payment</a> --}}
                        <input
                            type="submit"
                            class="btn btn-primary"
                            value="Make payment"
                            data-key="pk_test_zeGoVEfpYZ93rNF9hwHUVY4r00DWWCoAJT"
                            data-amount="{{ ($task->price + $task->contingency) * 100 }}"
                            data-currency="gbp"
                            data-name="Fixmybuild"
                            data-description=""
                        />
                    </div>
                </div>
            </div>
            <!--// END-->
        </form>
    </div>
</section>
<!--Code area end-->

@push('scripts') @push('scripts')
<script src="https://checkout.stripe.com/v2/checkout.js"></script>

<script>
    $(document).ready(function () {
        $(":submit").on("click", function (event) {
            event.preventDefault();
            var $button = $(this),
                $form = $button.parents("form");
            var opts = $.extend({}, $button.data(), {
                token: function (result) {
                    $form.append($("<input>").attr({ type: "hidden", name: "stripeToken", value: result.id })).submit();
                },
            });
            StripeCheckout.open(opts);
        });
    });

    $("#verify_mail").click(function () {
        $.ajax({
            url: "{{ route('customer.resend_verification_email')}}",
            data: { _token: "{{ csrf_token() }}" },
            method: "POST",
            success: function (data) {
                alert(data);
            },
        });
    });
</script>
@endpush @endsection
