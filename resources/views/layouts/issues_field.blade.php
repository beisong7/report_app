<select type="text" class="form-control" name="issue" required>
    <option value="" disabled selected>Select Issue Category</option>
    <option value="Reactivation" {{ old('issue')==='Reactivation'?'selected':'' }}>Reactivation</option>
    <option value="Password Reset" {{ old('issue')==='Password Reset'?'selected':'' }}>Password Reset</option>
    <option value="Enquiry" {{ old('issue')==='Enquiry'?'selected':'' }}>Enquiry</option>
    <option value="OTP" {{ old('issue')==='OTP'?'OTP':'' }}>OTP</option>
    <option value="Profile Update" {{ old('issue')==='Profile Update'?'selected':'' }}>Profile Update</option>
    <option value="Stuck In Approved" {{ old('issue')==='Stuck In Approved'?'selected':'' }}>Stuck In Approved</option>
    <option value="Login Enquiry" {{ old('issue')==='Login Enquiry'?'selected':'' }}>Login Enquiry</option>
    <option value="Registration Enquiry" {{ old('issue')==='Registration Enquiry'?'selected':'' }}>Registration Enquiry</option>
    <option value="Failed Registration" {{ old('issue')==='Failed Registration'?'selected':'' }}>Failed Registration</option>
    <option value="Invalid Enrollment Number" {{ old('issue')==='Invalid Enrollment Number'?'selected':'' }}>Invalid Enrollment Number</option>
    <option value="Registration Link" {{ old('issue')==='Registration Link'?'selected':'' }}>Registration Link</option>
    <option value="Wrong NBA Phone Number" {{ old('issue')==='Wrong NBA Phone Number'?'selected':'' }}>Wrong NBA Phone Number</option>
    <option value="Profile Update" {{ old('issue')==='Others'?'selected':'' }}>Others</option>
</select>