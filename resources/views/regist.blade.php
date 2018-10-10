@extends('welcome')
@section('body')
<!-- START CONTENT -->
      <div class="wrapper">

        <!-- CART SIDEBAR -->
        @include('cart-sidebar')
        @include('nav-sidebar')
        <!-- END CART SIDEBAR -->

<div class="container pb-5 fadeIn animated">
        <div class="col-xl-12 text-center mt-5">
            <div class="regist-font1">LOG IN OR CREATE AN ACCOUNT</div>
        </div>
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-12 regist-b-r regist-m-t5 order-2 order-lg-1 order-xl-1 px-3">
                <div id ="detail">
                     <div class="regist-font2">I'M NEW...</div>
                     <div class="regist-font3 regist-m-t4">Creating an account with us is simple & youeill then benefit from:</div>
                     <div class="regist-font3 mt-2">
                         <i class="fa fa-square square-size mr-1" aria-hidden="true"></i>
                         An expess checkout
                     </div>
                     <div class="regist-font3">
                         <i class="fa fa-square square-size mr-1" aria-hidden="true"></i>
                         Online order tracking
                     </div>
                     <div class="regist-font3">
                         <i class="fa fa-square square-size mr-1" aria-hidden="true"></i>
                         Saving item for later with our wishlist
                     </div>
                     <div class="regist-font3">
                         <i class="fa fa-square square-size mr-1" aria-hidden="true"></i>
                         Email about new brand, upcoming releases & more...
                     </div>
                     <div class="regist-m-t text-center">
                          <button type="button" class="btn regist-btn" onclick="myFunction()">CREATE AN ACCOUNT</button>
                     </div>
               </div>



            <!-- HIDE -->
            <div class="row fadeIn animated regist-m-r" id="my-account">
               <div class="order-2 order-lg-1 order-xl-1">
                    <div class="regist-font2">I'M NEW...</div>
                    <form id="form_register_customer">
                        <div class="form-row mb-3">
                            <div class="col-xl-6 regist-m-t4">
                                <label class="regist-font4 d-flex" for="validationDefaultUsername1">
                                    First Name
                                    <span class="forgot-font3 ml-1">*</span>
                                </label>
                                <div class="input-group text-center">
                                  <div class="input-group-prepend"></div>
                                  <input type="text" class="regist-form firstname" name="firstname" id="validationDefaultUsername1" placeholder="First Name" aria-describedby="inputGroupPrepend1" required>
                                </div>
                            </div>
                            <div class="col-xl-6 regist-m-t3">
                                <label class="regist-font4 d-flex" for="validationDefaultUsername1">
                                    Last Name
                                    <span class="forgot-font3 ml-1">*</span>
                                    <span class="forgot-font4 regist-m-l">*Required fields</span>
                                </label>
                                <div class="input-group text-center">
                                  <div class="input-group-prepend"></div>
                                  <input type="text" class="regist-form" name="lastname" id="validationDefaultUsername1" placeholder="Last Name" aria-describedby="inputGroupPrepend1" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-xl-12 mb-3">
                                <label class="regist-font4 d-flex" for="validationDefaultUsername2">
                                    Email
                                    <span class="forgot-font3 ml-1">*</span>
                                </label>
                                <div class="input-group text-center">
                                  <div class="input-group-prepend"></div>
                                  <input type="text" class="regist-form" name="email" id="validationDefaultUsername2" placeholder="Email" aria-describedby="inputGroupPrepend2" required>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="form-row">
                            <div class="col-xl-6 mb-3">
                                <label class="regist-font4 d-flex" for="validationDefaultUsername2">
                                    Date of birth
                                    <span class="forgot-font3">*</span>
                                </label>

                                <div class="input-group date" data-provide="datepicker">
                                    <input type="text" id="datepicker" class="regist-form" placeholder="dd/mm/yyyy">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <div class="form-row">
                            <div class="col-xl-12 mb-3">
                                <label class="regist-font4 d-flex" for="validationDefaultUsername2">
                                    Create password
                                    <span class="forgot-font3 ml-1">*</span>
                                    <span class="regist-font6 ml-2">(Minimum 6 charactors)</span>
                                </label>
                                <div class="input-group text-center">
                                    <div class="input-group-prepend"></div>
                                    <input type="password" class="regist-form" name="password" id="validationDefaultUsername2" placeholder="Create Password" aria-describedby="inputGroupPrepend2" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-xl-12 mb-3">
                                <label class="regist-font4 d-flex" for="validationDefaultUsername2">
                                    Confirm Password
                                    <span class="forgot-font3 ml-1">*</span>
                                </label>
                                <div class="input-group text-center">
                                    <div class="input-group-prepend"></div>
                                    <input type="password" class="regist-form" name="confirm-password" id="validationDefaultUsername2" placeholder="Confirm Password" aria-describedby="inputGroupPrepend2" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-xl-12 mb-3">
                                <label class="check">
                                       <div class="regist-m-l2 regist-font7 pt-2">I would like to receive news and special promotions by email from Dilok.</div>
                                       <input type="checkbox">
                                       <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
                        <div class="regist-m-t text-center">
                          <button type="button" id="btn-submit_form" class="btn regist-btn">CREATE AN ACCOUNT</button>
                        </div>
                    </form>

               </div>
            </div>
         </div>
         <!-- END HIDE -->


          <div class="col-xl-6 col-lg-6 col-12 regist-p-l regist-m-t7 order-1 order-lg-1 order-xl-1">
               <div class="col-12">
                   <div class="regist-font2">I'VE REGISTERED...</div>
                   <form id="form_login_customer">
                       <div class="form-row regist-m-t4">
                           <div class="col-xl-12 mb-3">
                               <label class="regist-font4 d-flex" for="validationDefaultUsername1">
                                   Email
                                   <span class="forgot-font3 ml-1">*</span>
                               </label>
                               <div class="input-group">
                                 <div class="input-group-prepend">
                                 </div>
                                 <input type="text" class="regist-form" id="validationDefaultUsername1" name="email_login" placeholder="Email" aria-describedby="inputGroupPrepend1" required>
                               </div>
                           </div>
                       </div>
                       <div class="form-row">
                           <div class="col-xl-12 mb-3">
                               <label class="regist-font4 d-flex" for="validationDefaultUsername2">
                                   Password
                                   <span class="forgot-font3 ml-1">*</span>
                               </label>
                               <div class="input-group">
                                 <div class="input-group-prepend">
                                 </div>
                                 <input type="password" class="regist-form" id="validationDefaultUsername2" name="password_login" placeholder="Password" aria-describedby="inputGroupPrepend2" required>
                               </div>
                           </div>
                       </div>
                       <div class="regist-m-t2 text-center">
                           <button class="btn regist-btn" id="btn_login_customer" type="button">LOG IN</button>
                       </div>
                       <div class="mt-3 text-center">
                           <a href="{{ url('forgot') }}" class="regist-font5"><u>Forgot Your Password?</u></a>
                       </div>
                   </form>
                   <hr class="mt-5 d-xl-none d-lg-none">
               </div>
          </div>


        </div>
    </div>
  </div>

@endsection

@section('js_bottom')
<script type="text/javascript">
$.ajaxSetup({
  headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      // 'Accept': 'application/json',
      // 'Content-Type': 'application/json'
  }
});
  function myFunction() {
    $("#my-account").css('display',"block");
    $("#detail").css('display',"none");
  }

$('body').on('click','#btn-submit_form',function(){
    var form = $('#form_register_customer').serializeArray();
    var firstname = $('.firstname').val();
    console.log(form);
      $.ajax({
        method : "POST",
        url : url_gb+"/create_customer",
        async: false,
        // contentType: 'application/json; charset=utf-8',
        dataType: "JSON",
        // data: $(form)  .stringify(),
        data: $('#form_register_customer').serialize(),
    }).done(function(rec){
      if(rec.status==1){
        console.log(1);
        // swal(rec.title,rec.content,"success");
      }else{
        console.log(2);
        // swal("ระบบมีปัญหา","กรุณาติดต่อผู้ดูแล","error");
      }
      // $('#form_register_customer')[0].reset();
    }).fail(function(){
    });
});

$('body').on('click','#btn_login_customer',function(){
    var form = $('#form_login_customer').serializeArray();
      $.ajax({
        method : "POST",
        url : url_gb+"/login_customer",
        contentType: "JSON",
        data : form,
    }).done(function(rec){
      if(rec.status==1){
        console.log(1);
        // swal(rec.title,rec.content,"success");
      }else{
        console.log(2);
        // swal("ระบบมีปัญหา","กรุณาติดต่อผู้ดูแล","error");
      }
      // $('#form_login_customer')[0].reset();
    }).fail(function(){
    });
});

</script>
@endsection

