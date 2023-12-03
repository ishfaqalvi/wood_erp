<div class="row mb-3">
    <label class="col-lg-4 col-form-label">کمپنی کا نام  :</label>
    <div class="col-lg-8">
        <input type="text" name="values[company_name]" class="form-control" value="{{ settings('company_name') }}">
    </div>
</div>
<div class="row mb-3">
    <label class="col-lg-4 col-form-label">بزنس کا نام  :</label>
    <div class="col-lg-8">
        <input type="text" name="values[business_name]" class="form-control" value="{{ settings('business_name') }}">
    </div>
</div>
<div class="row mb-3">
    <label class="col-lg-4 col-form-label">بزنس مالک کا نام  :</label>
    <div class="col-lg-8">
        <input type="text" name="values[owner_name]" class="form-control" value="{{ settings('owner_name') }}">
    </div>
</div>
<div class="row mb-3">
    <label class="col-lg-4 col-form-label">پہلا رابطہ کرنے والے شخص کا نام  :</label>
    <div class="col-lg-8">
        <input type="text" name="values[first_contact_person_name]" class="form-control" value="{{ settings('first_contact_person_name') }}">
    </div>
</div>
<div class="row mb-3">
    <label class="col-lg-4 col-form-label">پہلا رابطہ کرنے والے شخص کا موبائل نمبر  :</label>
    <div class="col-lg-8">
        <input type="text" name="values[first_contact_person_mobile_number]" class="form-control" value="{{ settings('first_contact_person_mobile_number') }}">
    </div>
</div>
<div class="row mb-3">
    <label class="col-lg-4 col-form-label">دوسرے رابطہ کرنے والے شخص کا نام  :</label>
    <div class="col-lg-8">
        <input type="text" name="values[second_contact_person_name]" class="form-control" value="{{ settings('second_contact_person_name') }}">
    </div>
</div>
<div class="row mb-3">
    <label class="col-lg-4 col-form-label">دوسرے رابطہ کرنے والے شخص کا موبائل نمبر  :</label>
    <div class="col-lg-8">
        <input type="text" name="values[second_contact_person_mobile_number]" class="form-control" value="{{ settings('second_contact_person_mobile_number') }}">
    </div>
</div>
<div class="row mb-3">
    <label class="col-lg-4 col-form-label">تیسرے رابطہ کرنے والے شخص کا نام  :</label>
    <div class="col-lg-8">
        <input type="text" name="values[third_contact_person_name]" class="form-control" value="{{ settings('third_contact_person_name') }}">
    </div>
</div>
<div class="row mb-3">
    <label class="col-lg-4 col-form-label">تیسرے رابطہ کرنے والے شخص کا موبائل نمبر  :</label>
    <div class="col-lg-8">
        <input type="text" name="values[third_contact_person_mobile_number]" class="form-control" value="{{ settings('third_contact_person_mobile_number') }}">
    </div>
</div>
<div class="row mb-3">
    <label class="col-lg-4 col-form-label">پتہ  :</label>
    <div class="col-lg-8">
        <textarea rows="3" cols="3" class="form-control" name="address">{{ settings('address') }}</textarea>
    </div>
</div>