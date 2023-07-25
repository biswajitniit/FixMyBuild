@extends('layouts.app')

@section('content')
      <!--Code area start-->
      <section>
        <div class="container">
           <div class="row">
              <div class="col-md-12 text-center pt-5 fmb_titel">
                 <h1>About us</h1>
                 <ol class="breadcrumb mb-5">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">About us</li>
                 </ol>
              </div>
           </div>
        </div>
     </section>
     <!--Code area end-->
    <section>
       <div class="container">
            {{-- {!! $cms->cms_description !!} --}}
            <div class="row mb-5">
                <div class="col-md-12">
                <div class="our-story mb-5">
                    <div class="row">
                        <div class="col-md-12">
                            <h5>Our story</h5>
                            <p>Our story starts with our founder waking up one morning, realising that life is too short to live with regrets and wanting to make more of a positive difference in our world while he's still alive.</p>
                            <p>He decided to leave his safe job and started to aim to help to our society as much as possible while he is still alive, tackling every challenge that he's faced in his life so far.</p>
                            <p>Up until his life until then, whenever he needed help with finding the right person for general renovation, he spent a lot of time trying to find people he can trust and are available. Sometimes he found the right person at the right time and price, and other times he struggled, often spending a lot of time discussing requirements with a lot of people, taking risks by giving work to people he didn’t know and ending up paying more than his original budget.</p>
                        </div>
                    </div>
                </div>
                <div class="good-quality mb-5">
                    <div class="row">
                        <div class="col-md-12">
                            <h4>We can find people through other websites, but how do we know if they are <span>available</span>, and they can deliver a <span>good quality</span> of work while not <span>overcharging</span> us?</h4>
                        </div>
                    </div>
                </div>
                <section>
                        <div class="row">
                            <div class="col-md-12 text-center  mb-5 fmb_titel">
                            <h2>Our mission</h2>
                        </div>
                    </div>
                </section>
                <div class="white_bg our-missoin">
                    <div class="row">
                        <div class="col-12">
                            <h2>Through our platform we aim to solve these challenges while saving your time and money.</h2>
                            <h5>How do we achieve this?</h5>
                        </div>
                        <div class="row">
                            <div class="col-md-9">
                            <div class="row">
                                <div class="col-2 col-md-1"><span>1</span></div> <div class="col-10 col-md-11"><p>We review each of your projects, identifying areas that might require further thought and, when necessary, providing feedback accordingly before tradespeople are engaged. By doing this, we help to reduce differences in understanding between yourself and tradespeople, which could otherwise cause disputes, while giving you a heads’ up of potential additional work that might be required.</p></div>
                                <div class="col-2 col-md-1"><span>2</span></div> <div class="col-10 col-md-11"><p>After your project request has been approved, multiple tradespeople are engaged right away and receive the same requirements from you. This means you don’t have to call people up individually while making sure you’re informing them the same requirements each time.</p></div>
                                <div class="col-2 col-md-1"><span>3</span></div> <div class="col-10 col-md-11"><p>Tradespeople who are available usually respond to your project requests quickly, so you don’t need to spend time finding someone who is available to start right away.</p></div>
                            </div>
                            </div>
                            <div class="col-md-3 text-center">
                            <img src="{{ asset("frontend/img/5 1 (1).png") }}" alt="">
                            </div>
                            <div class="col-12 bottom_text">
                            <div class="row">
                            <div class="col-2 col-md-1"><span>4</span></div><div class="col-10 col-md-11"><p>The tradespeople whom you desire can inform you when they are available, so at least you’ll know how long you’ll need to wait before they are ready to start on your project.</p></div>
                            <div class="col-2 col-md-1"><span>5</span></div><div class="col-10 col-md-11"><p>To gauge if an estimate is fair you can compare the products and services with other estimates received from other tradespeople on this website.</p></div>
                            <div class="col-2 col-md-1"> <span>6</span></div><div class="col-10 col-md-11"><p>Whilst unplanned costs cannot always be determined in advance, tradespeople on our platform try to give as much advance notice of unexpected costs as possible by including ‘contingency’ in their estimates.  This allows you to set a more accurate budget in advance, and therefore reduce the likelihood of disappointment and delays later on.</p></div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>

                <section>
                        <div class="row">
                            <div class="col-md-12 text-center mt-5  mb-4 fmb_titel">
                            <h2>Our values</h2>
                            </div>
                        </div>
                </section>
                <div class="white_bg our-missoin">
                    <div class="row">
                        <div class="col-md-3 text-center">
                            <img src="{{ asset("frontend/img/5 1 (1).png") }}" alt="">
                        </div>
                        <div class="col-md-9 our-values">
                            <div class="row">
                            <div class="col-2 col-md-1"><span>1</span></div> <div class="col-10 col-md-11">
                                <h5>Kindness and fairness</h5>
                                <p>We try to be kind and fair to everyone in our ecosystem. We believe that kindness goes a long way towards building a better society.</p>
                            </div>
                            <div class="col-2 col-md-1"><span>2</span></div> <div class="col-10 col-md-11">
                                <h5>Empowering women</h5>
                                <p>Most of our tradespeople are in the construction industry, which is currently very heavily male-dominated. We try to encourage more women into the industry to create a more representative community.</p>
                            </div>
                            <div class="col-2 col-md-1"><span>3</span></div> <div class="col-10 col-md-11">
                                <h5>Data Privacy</h5>
                                <p>We respect your privacy, and this respect underpins how we use, store and process data. For more information feel free to read our Privacy Policy.</p>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 text-center  mt-5 fmb_titel">
                    <svg width="88" height="76" viewBox="0 0 88 76" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M63.5312 0.5C55.4648 0.5 48.4023 3.96875 44 9.83203C39.5977 3.96875 32.5352 0.5 24.4688 0.5C18.0478 0.507237 11.8918 3.06117 7.3515 7.6015C2.81117 12.1418 0.257237 18.2978 0.25 24.7188C0.25 52.0625 40.793 74.1953 42.5195 75.1094C42.9746 75.3542 43.4833 75.4823 44 75.4823C44.5167 75.4823 45.0254 75.3542 45.4805 75.1094C47.207 74.1953 87.75 52.0625 87.75 24.7188C87.7428 18.2978 85.1888 12.1418 80.6485 7.6015C76.1082 3.06117 69.9522 0.507237 63.5312 0.5ZM44 68.7812C36.8672 64.625 6.5 45.6914 6.5 24.7188C6.5062 19.955 8.40132 15.3882 11.7698 12.0198C15.1382 8.65132 19.705 6.7562 24.4688 6.75C32.0664 6.75 38.4453 10.7969 41.1094 17.2969C41.3448 17.87 41.7453 18.3603 42.26 18.7053C42.7747 19.0503 43.3804 19.2345 44 19.2345C44.6196 19.2345 45.2253 19.0503 45.74 18.7053C46.2547 18.3603 46.6552 17.87 46.8906 17.2969C49.5547 10.7852 55.9336 6.75 63.5312 6.75C68.295 6.7562 72.8618 8.65132 76.2302 12.0198C79.5987 15.3882 81.4938 19.955 81.5 24.7188C81.5 45.6602 51.125 64.6211 44 68.7812Z" fill="#EE5719"/>
                        </svg>

                    <div class="mt-4">
                        <h2>Thank you for reading and have a lovely day</h2>
                    </div>
                </div>

                </div>
            </div>
        </div>
    </section>

@endsection
