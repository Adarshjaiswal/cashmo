<x-app-layout :assets="$assets ?? []">
   <div>
      <?php
         $id = $id ?? null;
      ?>
      @if(isset($id))
      {!! Form::model($data, ['route' => ['users.update', $id], 'method' => 'patch' , 'enctype' => 'multipart/form-data']) !!}
      @else
      {!! Form::open(['route' => ['users.store'], 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
      @endif
      <div class="row">

         <div class="col-xl-12 col-lg-12">
            <div class="card">
               <div class="card-header d-flex justify-content-between">
                  <div class="header-title">
                     <h4 class="card-title">{{$id !== null ? 'Update' : 'New' }} User Information</h4>
                  </div>
                  <div class="card-action">
                        <a href="{{route('users.index')}}" class="btn btn-sm btn-primary" role="button">Back</a>
                  </div>
               </div>
               <div class="card-body">
                  <div class="new-user-info">
                        <div class="row">
                           <div class="form-group col-md-6">
                              <label class="form-label" for="fname">First Name: <span class="text-danger">*</span></label>
                              {{ Form::text('first_name', old('first_name'), ['class' => 'form-control', 'placeholder' => 'First Name', 'required']) }}
                           </div>
                           <div class="form-group col-md-6">
                              <label class="form-label" for="lname">Last Name: <span class="text-danger">*</span></label>
                              {{ Form::text('last_name', old('last_name'), ['class' => 'form-control', 'placeholder' => 'Last Name' ,'required']) }}
                           </div>
                           <div class="form-group col-md-6">
                              <label class="form-label" for="add1">Address: <span class="text-danger">*</span></label>
                              {{ Form::text('address', old('address'), ['class' => 'form-control', 'id' => 'add1', 'placeholder' => 'Enter Address ']) }}
                           </div>
                           <div class="form-group col-md-6">
                              <label class="form-label" for="cname">Firm Name: <span class="text-danger">*</span></label>
                              {{ Form::text('firm_name', old('firm_name'), ['class' => 'form-control', 'required', 'placeholder' => 'Firm Name']) }}
                           </div>
                           <div class="form-group col-md-6">
                              <label class="form-label" for="mobno">Mobile Number: <span class="text-danger">*</span></label>
                              {{ Form::text('phone_number', old('phone_number'), ['class' => 'form-control', 'id' => 'mobno', 'placeholder' => 'Mobile Number']) }}
                           </div>
                           <div class="form-group col-md-6">
                              <label class="form-label" for="altconno">Aadhar Number: <span class="text-danger">*</span></label>
                              {{ Form::text('aadhar_number', old('aadhar_number'), ['class' => 'form-control', 'id' => 'altconno', 'placeholder' => 'Aadhar Number']) }}
                           </div>
                           <div class="form-group col-md-6">
                            <label class="form-label" for="pan_number">Pan Number: <span class="text-danger">*</span></label>
                            {{ Form::text('pan_number', old('pan_number'), ['class' => 'form-control', 'id' => 'pan_number', 'placeholder' => 'Pan Number']) }}
                         </div>
                           <div class="form-group col-md-6">
                              <label class="form-label" for="email">Email: <span class="text-danger">*</span></label>
                              {{ Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => 'Enter e-mail', 'required']) }}
                           </div>
                           <div class="form-group col-md-6">
                              <label class="form-label" for="pno">Pin Code: <span class="text-danger">*</span></label>
                              {{ Form::number('pincode', old('pincode]'), ['class' => 'form-control', 'id' => 'pin_code','step' => 'any']) }}
                           </div>
                        </div>
                        <hr>
                        <h5 class="mb-3">Commission Package</h5>
                        <div class="row">
                        <div class="form-group col-md-6">
    <label class="form-label" for="package">Package: <span class="text-danger">*</span></label>
    {{ Form::select('package_id', $packages, old('package_id', isset($user) ? $user->package_id : null), ['class' => 'form-control', 'placeholder' => 'Select a Package', 'required']) }}
</div>

                        </div>
                        <hr>
                        <h5 class="mb-3">Security</h5>
                        <div class="row">
                           <div class="form-group col-md-12">
                              <label class="form-label" for="uname">User Name: <span class="text-danger">*</span></label>
                              {{ Form::text('username', old('username'), ['class' => 'form-control', 'required', 'placeholder' => 'Enter Username']) }}
                           </div>
                           <div class="form-group col-md-6">
                              <label class="form-label" for="pass">Password:</label>
                              {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) }}
                           </div>
                           <div class="form-group col-md-6">
                              <label class="form-label" for="rpass">Repeat Password:</label>
                              {{ Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Repeat Password']) }}
                           </div>
                        </div>
                        <button type="submit" class="btn btn-primary">{{$id !== null ? 'Update' : 'Add' }} User</button>
                  </div>
               </div>
            </div>
         </div>
        </div>
        {!! Form::close() !!}
   </div>
</x-app-layout>
