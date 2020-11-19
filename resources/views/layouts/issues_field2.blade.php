<select type="text" class="form-control" name="issue">
    <option value="" disabled selected>Select Issue Category</option>
    <option value="Reactivation" {{ $item->issue==='Reactivation'?'selected':'' }}>Reactivation</option>
    <option value="Password Reset" {{ $item->issue==='Password Reset'?'selected':'' }}>Password Reset</option>
    <option value="Enquiry" {{ $item->issue==='Enquiry'?'selected':'' }}>Enquiry</option>
    <option value="Profile Update" {{ $item->issue==='Profile Update'?'selected':'' }}>Profile Update</option>
    <option value="Stuck In Approved" {{ $item->issue==='Stuck In Approved'?'selected':'' }}>Stuck In Approved</option>
    <option value="Login Enquiry" {{ $item->issue==='Login Enquiry'?'selected':'' }}>Login Enquiry</option>
    <option value="Registration Enquiry" {{ $item->issue==='Registration Enquiry'?'selected':'' }}>Registration Enquiry</option>
    <option value="Failed Registration" {{ $item->issue==='Failed Registration'?'selected':'' }}>Failed Registration</option>
    <option value="Invalid Enrollment Number" {{ $item->issue==='Invalid Enrollment Number'?'selected':'' }}>Invalid Enrollment Number</option>
    <option value="Registration Link" {{ $item->issue==='Registration Link'?'selected':'' }}>Registration Link</option>
    <option value="Wrong NBA Phone Number" {{ $item->issue==='Wrong NBA Phone Number'?'selected':'' }}>Wrong NBA Phone Number</option>
</select>