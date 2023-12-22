@extends('layouts.app')

@section('title')
{{ __('خریداری کی ادائیگی') }}
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            <span class="fw-normal">خریداری کی ادائیگی</span>
        </h4>
    </div>
    <div class="d-lg-block my-lg-auto ms-lg-auto">
        <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
            <a href="{{ route('purchase-payments.index') }}" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
                <span class="btn-labeled-icon bg-primary text-white rounded-pill">
                    <i class="ph-arrow-circle-left"></i>
                </span>
                پیچھے
            </a>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">{{ __('خریداری کی ادائیگی بنائیں') }}</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('purchase-payments.store') }}" class="validate" role="form" enctype="multipart/form-data">
                @csrf
                @include('purchasing.payment.form')
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(function(){
        $(".select").select2();
        var type = $('select[name=type]');
        var onlineType = $('select[name=online_type]');
        $('.validate').validate({
            errorClass: 'validation-invalid-label',
            successClass: 'validation-valid-label',
            validClass: 'validation-valid-label',
            highlight: function(element, errorClass) {
                $(element).removeClass(errorClass);
                $(element).addClass('is-invalid');
                $(element).removeClass('is-valid');
            },
            unhighlight: function(element, errorClass) {
                $(element).removeClass(errorClass);
                $(element).removeClass('is-invalid');
                $(element).addClass('is-valid');
            },
            success: function(label) {
                label.addClass('validation-valid-label').text('Success.');
            },
            errorPlacement: function(error, element) {
                if (element.hasClass('select2-hidden-accessible')) {
                    error.appendTo(element.parent());
                }else if (element.parents().hasClass('form-control-feedback') || element.parents().hasClass('form-check') || element.parents().hasClass('input-group')) {
                    error.appendTo(element.parent().parent());
                }else {
                    error.insertAfter(element);
                }
            },
            rules: {        
                bank_id:     {required: function(){if (type.val() =='Online' && onlineType.val() == 'Bank') {return true}}},
                account_id:  {required: function(){if (type.val() !='Cash') {return true}}},
                online_type: {required: function(){if (type.val() =='Online') {return true}}},
                slip_number: {required: function(){if (type.val() =='Online') {return true}}},
                check_number:{required: function(){if (type.val() =='Check') {return true}}}
            },
        });
        const dpAutoHideElement = document.querySelector('.date');
        if(dpAutoHideElement) {
            const dpAutoHide = new Datepicker(dpAutoHideElement, {
                container: '.content-inner',
                buttonClass: 'btn',
                prevArrow: document.dir == 'rtl' ? '&rarr;' : '&larr;',
                nextArrow: document.dir == 'rtl' ? '&larr;' : '&rarr;',
                autohide: true
            });
        }
        $('.dropify').dropify();
        $("select[name=type]").change(function(){
            $(this).find("option:selected").each(function(){
                var optionValue = $(this).attr("value");
                if(optionValue =='Online'){
                    $('div.onlineType').show('slow');
                    $('div.slipNumber').show('slow');
                    $("div.checkNumber").hide('slow');
                    $("div.attachment").show('slow');
                    onlineTypeSelect();
                }else if(optionValue =='Check'){
                    $('div.onlineType').hide('slow');
                    $('div.slipNumber').hide('slow');
                    $("div.checkNumber").show('slow');
                    $("div.attachment").show('slow');
                    $('div.account').show('slow');
                }else{
                    $('div.onlineType').hide('slow');
                    $("div.slipNumber").hide('slow');
                    $("div.checkNumber").hide('slow');
                    $("div.attachment").hide('slow');
                    $('div.account').hide('slow');
                    $('div.bank').hide('slow');
                }
            });
        });
        function onlineTypeSelect(){
            $("select[name=online_type]").change(function(){
                if($(this).val() == 'Bank'){
                    $('div.bank').show('slow');
                    $('div.account').hide('slow');
                }else if($(this).val() == 'Account') {
                    $('div.bank').hide('slow');
                    $('div.account').show('slow');
                }else{
                    $('div.account').hide('slow');
                    $('div.bank').hide('slow');
                }
            });
        }
    });
</script>
@endsection