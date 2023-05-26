@extends('user.layouts.app')

@section('content')
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

<div class="container">
<div class="mt-5">
      <div class="d-style  border-2 bgc-white w-100 my-3 py-3 shadow-sm bg-light">
        <!-- Basic Plan -->
        <div class="row align-items-center">
          <div class="col-12 col-md-4 ">
            <h4 class="text-center ">
              Get Start
            </h4>
          </div>

          <ul class="list-unstyled mb-0 col-12 col-md-4 text-dark-l1 text-90 text-left my-4 my-md-0">
            <li>
            <i class="fa-solid fa-circle-info text-success-m2 text-110 mr-2 mt-1"></i>
              <span>
                <span class="text-110"><a href="#" class="text-primary" data-toggle="modal" data-target="#loginHelpModal" data-dismiss="modal">How Can I Sign In?</a></span>
            </li>

            <li class="mt-25">
              <i class="fa-solid fa-circle-info text-success-m2 text-110 mr-2 mt-1"></i>
              <span class="text-110">
                <a href="#" class="text-primary" data-toggle="modal" data-target="#forgetHelpModal" data-dismiss="modal">If ForgetPassword How Can I Do?</a>
            </span>
            </li>
          </ul>

          <div class="col-12 col-md-4 text-center">
            <a href="#" data-toggle="modal" data-target="#chatbotModal" class="f-n-hover btn btn-info btn-raised px-4 py-25 w-75 text-600">To Ask More questions</a>
          </div>
        </div>

      </div>

      <div class="d-style  border-2 bgc-white w-100 my-3 py-3 shadow-sm bg-light">
        <!-- Basic Plan -->
        <div class="row align-items-center">
          <div class="col-12 col-md-4 ">
            <h4 class="text-center ">
              Personal Info
            </h4>
          </div>

          <ul class="list-unstyled mb-0 col-12 col-md-4 text-dark-l1 text-90 text-left my-4 my-md-0">
            <li>
            <i class="fa-solid fa-circle-info text-success-m2 text-110 mr-2 mt-1"></i>
              <span>
                <span class="text-110"><a href="#" class="text-primary" data-toggle="modal" data-target="#personalHelpModal" data-dismiss="modal">How can I check my personal info?</a></span>
            </li>

            <li class="mt-25">
              <i class="fa-solid fa-circle-info text-success-m2 text-110 mr-2 mt-1"></i>
              <span class="text-110">
                <a href="#" class="text-primary"  data-toggle="modal" data-target="#profileHelpModal" data-dismiss="modal">How can I update my profile image?</a>
            </span>
            </li>

            <li class="mt-25">
              <i class="fa-solid fa-circle-info text-success-m2 text-110 mr-2 mt-1"></i>
              <span class="text-110">
                <a href="#" class="text-primary" data-toggle="modal" data-target="#passwordHelpModal" data-dismiss="modal">How can I change my password?</a>
            </span>
            </li>
          </ul>

          <div class="col-12 col-md-4 text-center">
            <a href="#" data-toggle="modal" data-target="#chatbotModal" class="f-n-hover btn btn-warning text-light btn-raised px-4 py-25 w-75 text-600">To Ask More questions</a>
          </div>
        </div>

      </div>

      <div class="d-style  border-2 bgc-white w-100 my-3 py-3 shadow-sm bg-light">
        <!-- Basic Plan -->
        <div class="row align-items-center">
          <div class="col-12 col-md-4 ">
            <h4 class="text-center ">
              Order System
            </h4>
          </div>

          <ul class="list-unstyled mb-0 col-12 col-md-4 text-dark-l1 text-90 text-left my-4 my-md-0">
            <li>
            <i class="fa-solid fa-circle-info text-success-m2 text-110 mr-2 mt-1"></i>
              <span>
                <span class="text-110"><a href="#" class="text-primary" data-toggle="modal" data-target="#orderHelpModel" data-dismiss="modal">How Can I Order The Cake?</a></span>
            </li>
          </ul>

          <div class="col-12 col-md-4 text-center">
            <a href="#" data-toggle="modal" data-target="#chatbotModal" class="f-n-hover btn btn-success btn-raised px-4 py-25 w-75 text-600">To Ask More questions</a>
          </div>
        </div>

      </div>

    </div>
</div>


<!-- login Modal -->
<div class="modal fade" id="loginHelpModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">About Login</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <p>&#49; . First, you need to visit the <a href="#" class="text-primary">login page</a>.</p>
            <p>&#50; . If you haven't registered yet, go to the <a href="#" class="text-primary">sign up page</a></p>
            <p>&#51; . And then, you need to fill in all the fields and click the 'Sign Up' button.</p>
            <p>&#52; . After 'Sign Up', you will be redirected to the login page.</p>
            <p>&#53; . On the login page, you need to fill in the 'Email' and 'Password' fields.</p>
            <p>&#54; . Finally, click the 'Sign In' button. After that, you will be redirected to the home page.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- forget Modal -->
<div class="modal fade" id="forgetHelpModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">About ForgetPassword</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <p>&#49; . First, you need to visit the <a href="#" class="text-primary">Forget Password Page</a>.</p>
            <p>&#50; . And then, you need to fill in the email fields and click "Send" button.</p>
            <p>&#51; . And you must check your email and copy the token that the admin team sends.</p>
            <p>&#52; . After click the button, you will be redirected to the "Reset password page".</p>
            <p>&#53; . On the reset password page, you need to fill in all the fields and click the "Reset" button.</p>
            <p>&#54; . Finally, you can sign in with your new password.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- personal info Modal -->
<div class="modal fade" id="personalHelpModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">About Personal Info</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <p>&#49; . First, click on the profile image on the top left of the page </a>.</p>
            <p>&#50; . And then , click the profile and you can check your info.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Profile Update Modal -->
<div class="modal fade" id="profileHelpModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">About Update profile</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <p>&#49; . First, click on the profile image on the top left of the page .</p>
            <p>&#50; . And then , click the profile and you can check your info.</p>
            <p>&#51; . On the 'profile page' , you must click 'Update' button.</p>
            <p>&#52; . Choose your favorite image and update it.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Order Modal -->
<div class="modal fade" id="orderHelpModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">About Order System</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <p>&#49; . Browse our selection: Visit our 'Shop' page to view all the available cake designs and flavors. Each cake listed includes a description and price.</p>
            <p>&#50; . Choose your cake: Once you've decided on the cake you'd like to order, click 'Add to Cart'.</p>
            <p>&#51; . Go to Cart: Here, you can review your order, adjust quantities, or remove items.</p>
            <p>&#52; . Proceed to Checkout: Click on 'Proceed to Checkout'. Here you'll be prompted to provide your contact information and delivery address.</p>
            <p>&#53; . Make payment: Choose your preferred payment method and complete the payment process. We accept several payment methods including Visa, MasterCard, and Google Pay.</p>
            <p>&#54; . Confirmation: After you've successfully placed your order, you'll receive an order confirmation email with your order details.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Password Change Modal -->
<div class="modal fade" id="passwordHelpModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">About Password Change</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <p>&#49; . First, click on the profile image on the top left of the page .</p>
            <p>&#50; . And then , click the profile and you can check your info.</p>
            <p>&#51; . On the 'profile page' , you must click 'Password Change' button and then , you will be redirected to the "Password change page"</p>
            <p>&#52; . On the 'password change page', you need to fill "old password" and "new password" field and click the "Change" button.</p>
            <p>&#53; . After that , You can login with your new password.</p>
            <p>&#54; . If you forget "old password" you can use <a href="#" class="text-primary">Forget Password</a> .</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Chatbot Modal -->
<div class="modal fade" id="chatbotModal" tabindex="-1" role="dialog" aria-labelledby="chatbotModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="chatbotModalLabel">Frequently Asked Questions</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <div id="chatbox">
                  <div id="welcome" class="text-center">
                      <button class="btn btn-primary mt-4" id="get-started">Click to Get Started</button>
                  </div>
                  <div id="questions" class="d-none">
                      <h4 class="mb-4" style="font-size: 14px">Questions:</h4>
                      @forelse ($questions as $question)
                          <button class="btn btn-primary question mb-2 text-left text-wrap w-100 overflow-hidden"
                              style="font-size: 14px"
                              data-question="{{ $question }}">{{ $question }}</button>
                      @empty
                          <p>There is no question currently available.</p>
                      @endforelse
                  </div>
              </div>
              <div id="answer" class="mt-4"></div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
      </div>
  </div>
</div>
@endsection

@push('script')
  <script src="{{ asset('js/user/help.js') }}"></script>
@endpush
