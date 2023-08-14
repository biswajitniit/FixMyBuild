@if (Auth::user()->is_email_verified === 0)
    <div class="blue-font-color bg-white mb-5 white_box p-5">
        <div class="row justify-content-center">
            <div class="col-md-1 align-self-center">
                <span>
                    <svg width="33" class="warning_svg" height="29" viewBox="0 0 33 29" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M16.4987 0.916992L0.457031 28.6253H32.5404M16.4987 6.75033L27.4799 25.7087H5.51745M15.0404 12.5837V18.417H17.957V12.5837M15.0404 21.3337V24.2503H17.957V21.3337"
                            fill="#EE5719"></path>
                    </svg>
                </span>
            </div>
            <div class="col-md-4 align-self-center mx-2">
                <p class="verify_text">Please verify your email address.</p>
            </div>
            <div class="col-md-6 align-self-center">
                <button type="button" class="btn btn-primary" id="verify_mail">Resend verification link</button>
            </div>
        </div>
    </div>
@endif
