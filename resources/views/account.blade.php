@extends('welcome')
@section('body')
<!-- START CONTENT -->
      <div class="wrapper">

        <!-- CART SIDEBAR -->
        @include('cart-sidebar')
        @include('nav-sidebar')

        <div class="container">
          <div class="row mt-5 mx-0">
            <div class="col-12">
              <div class="text-center">
                <h3>
                  <span>WELCOME,</span> <span>{{ $token_customer->firstname }}</span>

                </h3>
              </div>
              <div class="text-center">
                <div class="account-font"><span>ORDER HISTORY</span></div>
                <div class="account-text-xsmall"><span>You have no recent orsers.</span></div>
              </div>
            </div>
          </div>


          <div class="row mx-0">
            <div class="col-md-4 col-12" style="padding-left: 5px; padding-right: 5px;">
              <div style="position: relative;">
                <div class="account-font text-center">
                  <span>PERSONAL INFO</span>
                </div>
                <!-- <a href="#" class="account-edit btn_edit_account" data-btn_customer_id="{{ $token_customer->id }}" data-toggle="modal" data-target="#edit_new_address">Edit</a> -->
                <a href="#" class="account-edit btn_edit_account" data-btn_customer_id="{{ $token_customer->id }}">Edit</a>
                <div class="col-12 px-0 my-3">
                  <div class="card account-card">
                    <div class="card-body account-line-height text-md-left text-center">
                        <div><span>Fristname : {{ $token_customer->firstname }}</span></div>
                        <div><span>Lastname : {{ $token_customer->lastname }}</span></div>
                        <div><span>Middlename : @if(!empty($token_customer->middlename)) {{ $token_customer->middlename }} @endif</span></div>
                        <div><span>Email : {{ $token_customer->email }}</span></div>
                        <div><span>Gender : @if(!empty($token_customer->gender)) @if($token_customer->gender == 1) Male @elseif($token_customer->gender == 2) Female @else - @endif @endif</span></div>
                        <div><span>Tax Vat : @if(!empty($token_customer->taxvat)) {{ $token_customer->taxvat }} @endif</span></div>
                        <div><span>Date of Birth : @if(!empty($token_customer->dob)) {{ $token_customer->dob }} @endif</span></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4 col-12" style="padding-left: 5px; padding-right: 5px;">
              <div style="position: relative;">
                <div class="account-font text-center">
                  <span>ADDRESS</span>
                </div>
                @foreach($token_customer->addresses as $key_address => $value_address)
                  <div class="col-12 px-0 my-3">
                    <div class="card account-card">
                        <a href="#" style="right: 15%;" class="account-edit address_edit" data-address_id="{{$value_address->id}}" data-toggle="modal" data-target="#edit_edit_address">Edit</a>
                        <a href="#" class="account-edit del_address_edit" data-del_address_id="{{$value_address->id}}">Delete</a>
                      <div class="card-body account-line-height text-md-left text-center">
                          <div><span>Firstname : {{ $value_address->firstname }}</span></div>
                          <div><span>Lastname : {{ $value_address->lastname }}</span></div>
                          <div><span>Street : {{ $value_address->street[0] }}</span></div>
                          <div><span>Street2 : @if(!empty($value_address->street[1])){{ $value_address->street[1] }} @endif</span></div>
                          <div><span>Company : @if(!empty($value_address->company)) {{ $value_address->company }} @endif</span></div>
                          <div><span>Telephone : @if(!empty($value_address->telephone)) {{ $value_address->telephone }} @endif</span></div>
                          <div><span>Country : @if(!empty($value_address->country_id)) {{ $value_address->country_id }} @endif</span></div>
                          <div><span>City : @if(!empty($value_address->city)) {{ $value_address->city }} @endif</span></div>
                          <div><span>Region : @if(!empty($value_address->region->region)) {{ $value_address->region->region }} @endif</span></div>
                          <div><span>Postcode : @if(!empty($value_address->postcode)) {{ $value_address->postcode }} @endif</span></div>
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>

            <div class="col-md-4 col-12" style="padding-left: 5px; padding-right: 5px;">
              <div style="position: relative;">
                <div class="account-font text-center">
                  <span>SAVED PAYMENT METHODS</span>
                  <!-- <div class="account-text-xsmall"><span>You have no saved payment methods.</span></div> -->
                </div>
                <div class="col-12 px-0 my-3">
                  <div class="card account-card">
                    <div class="card-body account-line-height text-md-left text-center">
                        <div><span>Firstname : @if(!empty($get_cart->billing_address->firstname)){{ $get_cart->billing_address->firstname }} @endif</span></div>
                        <div><span>Lastname : @if(!empty($get_cart->billing_address->lastname)){{ $get_cart->billing_address->lastname }} @endif</span></div>
                        <div><span>Street : @if(!empty($get_cart->billing_address->street[0])){{ $get_cart->billing_address->street[0] }} @endif</span></div>
                        <div><span>Street2 : @if(!empty($get_cart->billing_address->street[1])){{ $get_cart->billing_address->street[1] }} @endif</span></div>
                        <div><span>Company : @if(!empty($get_cart->billing_address->company)) {{ $get_cart->billing_address->company }} @endif</span></div>
                        <div><span>Telephone : @if(!empty($get_cart->billing_address->telephone)) {{ $get_cart->billing_address->telephone }} @endif</span></div>
                        <div><span>City : @if(!empty($get_cart->billing_address->city)) {{ $get_cart->billing_address->city }} @endif</span></div>
                        <div><span>Postcode : @if(!empty($get_cart->billing_address->postcode)) {{ $get_cart->billing_address->postcode }} @endif</span></div>
                        <div><span>Country : @if(!empty($get_cart->billing_address->country_id)) {{ $get_cart->billing_address->country_id }} @endif</span></div>
                        <div><span>Email : @if(!empty($get_cart->billing_address->email)) {{ $get_cart->billing_address->email }} @endif</span></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>


          <div class="row mb-5 mx-0">
            <div class="col-12">
              <div class="text-center">
                <div class="account-font"><span>ADDRESSES</span></div>
                <div class="account-text-xsmall"><span>You have no saved addresses</span></div>
              </div>
            </div>

            <div class="col-lg-4 col-md-6 col-12 mt-md-4 mt-3 mx-auto">
              <div class="text-center">
                <button type="button" class="btn account-btn-save-ad w-100" data-toggle="modal" data-target="#add_new_address">ADD NEW ADDRESS</button>
                <!-- <button type="button" class="btn account-btn" data-toggle="modal" data-target="#add_new_address">ADD NEW ADDRESS</button> -->
              </div>
            </div>
          </div>


          <!-- #Modal ADD NEW ADDRESS -->
            <div class="modal fade px-0" id="add_new_address" tabindex="-1" role="dialog" aria-labelledby="add_new_address" aria-hidden="true">
              <div class="modal-dialog account-modal-dialog " role="document">
                <div class="modal-content rounded-0 px-md-5 py-md-4">
                  <div class="modal-header border-0 mx-md-0 mx-auto">
                    <h5 class="modal-title" id="add_new_address">ADD NEW ADDRESS</h5>
                    <button type="button" class="close account-close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">x</span>
                    </button>
                  </div>
                  <form id="form-add-address">
                      <input type="text" hidden class="form-control" id="customer_id" name="customer_id" value="{{ $token_customer->id }}" required>
                      <input type="text" hidden class="form-control" id="email" name="email" value="{{ $token_customer->email }}" required>
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                              <label for="text"><span>First Name</span> <span class="text-danger">*</span></label>
                              <input type="text" class="form-control" name="firstname" placeholder="" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="text"> <span>Last Name</span> <span class="text-danger">*</span> <span class="account-requited text-danger">Required fields</span></label>
                              <input type="text" class="form-control" name="lastname" placeholder="" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                              <label for="text"><span>Phone Number</span> <span class="text-danger">*</span> <span class="account-text-xsmall">(We'll only content you regarding your order)</span></label>
                              <input type="text" name="telephone" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                           <div class="form-group">
                              <label for="text"><span>Address line 1</span> <span class="text-danger">*</span></label>
                              <input type="text" name="address" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                           <div class="form-group">
                              <label for="text"><span>Address line 2</span> <span class="account-text-xsmall">(Optional)</span></label>
                              <input type="text" name="address2" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <label for="text"><span>Town or City</span> <span class="text-danger">*</span></label>
                              <input type="text" name="city" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="text"><span>Company</span> <span class="account-text-xsmall">(Optional)</span></label>
                              <input type="text" name="company" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <label for="text"><span>Postcode</span> <span class="text-danger">*</span></label>
                              <input type="text" name="postcode" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="text"><span>Country</span></label>
                              <select class="form-control rounded-0 select_country" name="country" id="sel1" required>
                                <option>---- Select ----</option>
                                @foreach($countries as $key_country => $value_country)
                                  @if($value_country->full_name_english != null)
                                    <option value="{{ $value_country->id }}" data_name="{{ $value_country->full_name_english }}">{{ $value_country->full_name_english }}</option>
                                  @endif
                                @endforeach
                                  <input type="text" hidden name="country_name" class="regist-form country_name" placeholder="country_name" required>
                              </select>
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer account-modal-footer border-0">
                      <div class="col-md-4">
                        <div>
                          <button type="button" class="btn account-btn-save-ad w-100" id="btn-add-address">Save changes</button>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>



          <!-- #Modal EDIT NEW ADDRESS -->
            <div class="modal fade px-0" id="edit_new_address" role="dialog" aria-labelledby="edit_new_address" aria-hidden="true">
              <div class="modal-dialog account-modal-dialog " role="document">
                <div class="modal-content rounded-0 px-md-5 py-md-4">
                  <div class="modal-header border-0 mx-md-0 mx-auto">
                    <h5 class="modal-title text-center">EDIT PERSONAL INFO</h5>
                    <button type="button" class="close account-close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">x</span>
                    </button>
                  </div>
                  <form id="form-edit-profile">
                      <input type="text" hidden class="form-control" id="customer_id" name="customer_id" value="{{ $token_customer->id }}">
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                              <label for="text"><span>First Name</span> <span class="text-danger">*</span></label>
                              <input type="text" class="form-control" id="edit_firstname" name="firstname"  required>
                            </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="text"> <span>Last Name</span> <span class="text-danger">*</span> <span class="account-requited text-danger">Required fields</span></label>
                              <input type="text" class="form-control" id="edit_lastname" name="lastname" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="text"><span>Email address</span> <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="edit_email" name="email" readonly required>
                          </div>
                        </div>
                        <!-- <div class="col-md-6">
                            <label for="text"><span>Date of birth</span></label>
                            <div class="input-group date" data-provide="datepicker">
                                <input type="text" id="datepicker" class="form-control" placeholder="dd/mm/yyyy">
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-th"></span>
                                </div>
                            </div>
                        </div> -->
                      </div>

                      <div class="row mt-md-5 mt-3">
                        <div class="col-12 mb-3 text-md-left text-center">
                         <h5 class="modal-title">CHANGE PASSWORD</h5>
                        </div>

                       <!-- <div class="col-12">
                        <div class="form-group">
                          <label for="text"><span>Current Password</span> <span class="text-danger">*</span></label>
                          <input type="password" class="form-control">
                        </div>
                       </div> -->
                       <div class="col-12">
                        <div class="form-group">
                          <label for="text"><span>New Password</span> <span class="text-danger">*</span></label>
                          <input type="password" name="password" class="form-control">
                        </div>
                       </div>
                       <div class="col-12">
                        <div class="form-group">
                          <label for="text"><span>Confirm Password</span> <span class="text-danger">*</span></label>
                          <input type="password" name="confirm-password" class="form-control">
                        </div>
                       </div>
                      </div>

                    </div>
                    <div class="modal-footer account-modal-footer border-0">
                      <div class="col-md-4">
                        <div>
                          <button type="button" class="btn account-btn-save-ad w-100" id="btn-edit-profile">Save changes</button>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>


        </div>

        <!-- END SITE CONTENT -->


      </div>
    <!-- END CONTENT -->
@endsection

@section('js_bottom')
<script>
$( function() {
  $( "#datepicker" ).datepicker();
});

$('body').on('change','.select_country',function(){
  var data = $(this).val();
  var option = $('option:selected', this).attr('data_name');
  $('.country_name').val('');
  $('.country_name').val(option);
});


$('body').on('click','#btn-add-address',function(){
  var form = $('#form-add-address').serializeArray();
  var id = $('#customer_id').val();
  $('body').loader('show');
    $.ajax({
      method : "POST",
      url : url_gb+"/add_address_customer/"+id,
      dataType: "JSON",
      data: form,
    }).done(function(rec){
      if(rec.status==1){
        $('body').loader('hide');
        $('#form-add-address')[0].reset();
        $('#add_new_address').modal('hide');
        window.location.href = url_gb+"/account";
        al_su(rec.content,'success');
      } else if(rec.status==2){
        window.location.href = url_gb+'/regist';
      }else{
        $('body').loader('hide');
        $('#add_new_address').modal('hide');
        al_su(rec.content,'danger');
      }
    }).fail(function(){
        $('body').loader('hide');
        al_su('Error','danger');
  });
});

$('body').on('click','.btn_edit_account',function(){
    var customer_id = $(this).data('btn_customer_id');
      $.ajax({
          method : "GET",
          url : url_gb+"/page_edit_account/"+customer_id,
          dataType : "JSON",
      }).done(function(rec){
          if(rec.status == 1){
            $('#edit_new_address').modal('show');
            $('#edit_firstname').val(rec.customer.firstname);
            $('#edit_lastname').val(rec.customer.lastname);
            $('#edit_email').val(rec.customer.email);
            $('#customer_id').val(rec.customer.id);
          } else {
            $('#edit_new_address').modal('hide');
            al_su(rec.content,'danger');
          }
      }).fail(function(){
          al_su('Error','danger');
      });
});

$('body').on('click','#btn-edit-profile',function(){
  var form = $('#form-edit-profile').serializeArray();
  var id = $('#customer_id').val();
  $('body').loader('show');
    $.ajax({
      method : "POST",
      url : url_gb+"/edit_customer/"+id,
      dataType: "JSON",
      data: form,
    }).done(function(rec){
      if(rec.status==1){
        $('body').loader('hide');
        $('#edit_new_address').modal('hide');
        window.location.href = url_gb+"/account";
        al_su(rec.content,'success');
      }else{
        $('body').loader('hide');
        $('#edit_new_address').modal('hide');
        al_su(rec.content,'danger');
      }
    }).fail(function(){
        $('body').loader('hide');
        al_su('Error','danger');
  });
});

$('body').on('click','.del_address_edit',function(){
    var del_address_id = $(this).data('del_address_id');
    var r = confirm("Delete");
    if(r == true){
      $('body').loader('show');
      $.ajax({
          method : "POST",
          url : url_gb+"/del_address_customer/"+del_address_id,
          dataType : "JSON",
      }).done(function(rec){
          if(rec.status == 1){
            $('body').loader('hide');
            window.location.href = url_gb+"/account";
            al_su(rec.content,'success');
          } else {
            $('body').loader('hide');
            al_su(rec.content,'danger');
          }
      }).fail(function(){
          al_su('Error','danger');
      });
  }
});
</script>
@endsection