<form id="main_contact_form" action="{{route('front.contact.send_email')}}" method="post" class="commenting-form">
    @csrf
    <div class="row">
        <div class="form-group col-md-6">
            <input 
                type="text" 
                placeholder="@lang('Your Name')" 
                class="form-control @if($errors->has('contact_name')) is-invalid @endif"
                name="contact_name"
                value="{{old('contact_name')}}"
                >
            @include('front._layout.partials.form_errors', ['fieldName' => 'contact_name'])
        </div>
        <div class="form-group col-md-6">
            <input 
                type="email" 
                placeholder="@lang('Email Address (will not be published)')" 
                class="form-control @if($errors->has('contact_email')) is-invalid @endif"
                name="contact_email"
                value="{{old('contact_email')}}"
            >
            @include('front._layout.partials.form_errors', ['fieldName' => 'contact_email'])
        </div>
        <div class="form-group col-md-12">
            <textarea 
                placeholder="Type your message" 
                class="form-control @if($errors->has('contact_message')) is-invalid @endif" rows="20"
                name="contact_message"
            >{{old('contact_message')}}</textarea>
            @include('front._layout.partials.form_errors', ['fieldName' => 'contact_message'])
        </div>
        <div style="height: 90px; display: inline-block; width: 45%; margin-left: 15px" class="form-control @if($errors->has('g-recaptcha-response'))is-invalid @endif" id="recaptcha">
            {!! htmlFormSnippet() !!}
        </div> 
        
         
        <div class="form-group col-md-12">
            <button type="submit" class="btn btn-secondary" data-error="recaptcha">@lang('Submit Your Message')</button>
        </div>
        @include('front._layout.partials.form_errors', ['fieldName' => 'g-recaptcha-response'])
    </div>
</form>

@push('head_scripts')

{!! htmlScriptTagJsApi([
    'lang' => 'en'
]) !!}

@endpush

@push('footer_javascript')

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/additional-methods.min.js"></script>

<!--
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/localization/messages_sr_lat.js"></script>
-->

<script type="text/javascript">
    
    $('#main_contact_form').validate({
        "rules": {
            "contact_name": {
                "required": true,
                "minlength": 2
            },
            "contact_email": {
                "required": true,
                "email": true
            },
            "contact_message": {
                "required": true,
                "minlength": 50,
                "maxlength": 255
            }
        },
        submitHandler: function(form) {
        if (grecaptcha.getResponse()) {
            form.submit();
        } else {
            $('#recaptcha_errors').remove();
            $('[data-error="recaptcha"]').after('<p class="text-danger" id="recaptcha_errors">Please confirm that you are not a robot!</p>');
        }
        },
        "errorPlacement": function (error, element) {
            error.addClass('text-danger');
            error.insertAfter(element);
            //element.addClass('is-invalid');
        }
    });
    
</script>

@endpush