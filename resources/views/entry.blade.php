 <div class="modal" id="myModal">
     <div class="modal-dialog">
         <div class="modal-content">
             <form action="{{ route('students.store') }}" method="POST" id="studentEntry">
                 @csrf
                 <!-- Modal Header -->
                 <div class="modal-header">
                     <h4 class="modal-title">New Student</h4>
                     <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                 </div>

                 <!-- Modal body -->
                 <div class="modal-body">

                     <label for="name">Name:</label>
                     <input type="text" name="name" class="form-control" id="name" placeholder="Enter Name"
                         value="{{ old('name') }}">
                     <span class="text-danger error_text name_error" id="nameError"></span>
                     <label for="email" class="mt-2">Email:</label>
                     <input type="text" name="email" class="form-control" id="email" placeholder="Enter Email"
                         value="{{ old('email') }}">
                     <span class="text-danger error_text email_error" id="emailError"></span>

                     <label for="phone" class="mt-2">Phone:</label>
                     <input type="text" name="phone" class="form-control" id="phone" placeholder="Enter Phone"
                         value="{{ old('phone') }}">
                     <span class="text-danger error_text phone_error" id="phoneError"></span>
                     <label for="address" class="mt-2">Address:</label>
                     <textarea name="address" class="form-control" id="address" placeholder="Enter Address">{{ old('address') }}</textarea>
                     <span class="text-danger error_text address_error" id="addressError"></span>

                     <div class="d-block d-inline float-end">
                         <button type="submit" class="btn btn-primary mt-2">Save</button>
                         <button type="button" class="btn btn-danger mt-2 " data-bs-dismiss="modal">Close</button>
                     </div>

                 </div>

             </form>
         </div>
     </div>
 </div>
