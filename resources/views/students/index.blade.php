@extends('layout')



@section('content')


<a href="/import-form" class="btn btn-success mt-4 mb-4 ml-4">Import Excel File <i class="fa fa-upload" aria-hidden="true"></i></a>
<!-- Add Student button-->
<button type="button" class="btn btn-primary" id="foc" data-bs-toggle="modal" data-bs-target="#addStudent">
  Add Student <i class="fa fa-plus" aria-hidden="true"></i>
</button>

<table class="table mt-5 mb-5" id="myTable">
  <thead>
    <tr>
      <th scope="col">Roll</th>
      <th scope="col">Name</th>
      <th scope="col">Age</th>
      <th scope="col">Location</th>
      <th scope="col">Email</th>
      <th scope="col">Country</th>
      <th scope="col">State</th>
      <th scope="col">City</th>
      <th scope="col">Gender</th>
      <th scope="col">Hobby</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  </tbody>
</table>

<!-- Update Modal Start Here -->
<!-- <div class="modal fade" id="exampleaddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" id="update-Form">
          <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Name</label>
            <input type="text" name="name" autocomplete="false" class="form-control" id="name">
            <small id="u_name_error" class="text-danger"></small>
          </div>
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Age</label>
            <input type="text" name="age" class="form-control" id="age">
            <small id="u_age_error" class="text-danger"></small>
          </div>
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Street</label>
            <input type="text" name="street" class="form-control" id="street">
            <small id="u_street_error" class="text-danger"></small>
          </div>
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Email</label>
            <input type="email" id="email" class="form-control" name="email">
            <small id="u_email_error" class="text-danger"></small>
          </div>

          <p>Please select your gender:</p>
          <input type="radio" id="u_male" name="u_gender" value="male"> 
          <label for="male">Male</label><br>
          <input type="radio" id="u_female" name="u_gender" value="female" >
          <label for="female">Female</label><br>
          <input type="radio" id="u_other" name="u_gender" value="other">
          <label for="other">Other</label>


          <p>Please select your Hobby:</p>
        <br>
        <input type="checkbox" id="hobby1" name="u_hobby[]" value="Photography" >
        <label for="vehicle1">Photography</label><br>
        <input type="checkbox" id="hobby2" name="u_hobby[]" value="Cricket" >
        <label for="vehicle2">Cricket</label><br>
        <input type="checkbox" id="hobby3" name="u_hobby[]" value="Designing" >
        <label for="vehicle3">Designing</label>



          <div class="forn-group mb-5">
            <select name="country" id="u_country" class="form-control input-lg dynamic" data-dependent="state">
              <option value="">Select Country</option>
              @foreach($country_list as $country)
              <option value="{{$country->id}}">{{$country->name}}</option>
              @endforeach
            </select>
          </div>



          <div class="forn-group mb-5">
            <select name="state" id="u_state" class="form-control input-lg dynamic">
              <option value="">select State</option>
            </select>

          </div>

          <div class="forn-group mb-5">
            <select name="city" id="u_city" class="form-control input-lg">
              <option value="">select city</option>
            </select>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div> -->
<!-- update modal End here -->




<!-- Add Student Modal start here -->
<div class="modal fade" id="addStudent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal For update and create</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" id="addStudentData">
        <input type="hidden" class="form-control tooltips" name="_token" id="_token" value="{{ csrf_token() }}"/>
          <input type="hidden" id="hiddenID" name="hidden">
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Name</label>
            <input type="text" name="name" id="add-name" class="form-control">
            <small id="name_error" class="text-danger"></small>
          </div>
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Age</label>
            <input type="text" name="age" id="add-age" class="form-control">
            <small id="age_error" class="text-danger"></small>
          </div>
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Street</label>
            <input type="text" name="street" id="add-street" class="form-control">
            <small id="street_error" class="text-danger"></small>
          </div>
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Email</label>
            <input type="email" name="email" id="add-email" class="form-control">
            <small id="email_error" class="text-danger"></small>
          </div>

          <p>Please select your gender:</p>
          <input type="radio" id="male" name="gender" value="male">
          <label for="male">Male</label><br>
          <input type="radio" id="female" name="gender" value="female">
          <label for="female">Female</label><br>
          <input type="radio" id="other" name="gender" value="other">
          <label for="other">Other</label>

          <p>Please select your Hobby:</p>
        <br>
        <input type="checkbox" class="add-hobby" id="hobby1" name="hobby[]" value="Photography">
        <label for="vehicle1">Photography</label><br>
        <input type="checkbox" class="add-hobby" id="hobby2" name="hobby[]" value="Cricket">
        <label for="vehicle2">Cricket</label><br>
        <input type="checkbox" class="add-hobby" id="hobby3" name="hobby[]" value="Designing">
        <label for="vehicle3">Designing</label>

          <div class="forn-group mb-5">
            <select name="country" id="country" class="form-control input-lg dynamic" data-dependent="state">
              <option value="">Select Country</option>
              @foreach($country_list as $country)
              <option value="{{$country->id}}">{{$country->name}}</option>
              @endforeach
            </select>
          </div>



          <div class="forn-group mb-5">
            <select name="state" id="state" class="form-control input-lg dynamic">
              <option value="">select State</option>
            </select>

          </div>

          <div class="forn-group mb-5">
            <select name="city" id="city" class="form-control input-lg">
              <option value="">select city</option>
            </select>
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary" id="add_btn">Add Data</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Add student modal END here -->

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h6 class="text-secondary text-center">Do You Reall Want to delete this <strong><span id="studentData" class="text-danger"></strong></span> Data</h6>
        <input type="hidden" id="formtextID">
      </div>
      <div class="modal-footer">
        <form id="deleteFormID">
          @csrf
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection