<form action="{{route('front.contact.send_email')}}" method="post" class="commenting-form">
    @csrf
    <div class="row">
        <div class="form-group col-md-6">
            <input 
                type="text" 
                placeholder="@lang('Your Name')" 
                class="form-control"
                name="contact_name"
                value="{{old('contact_name')}}"
                >
        </div>
        <div class="form-group col-md-6">
            <input 
                type="email" 
                placeholder="@lang('Email Address (will not be published)')" 
                class="form-control"
                name="contact_email"
                value="{{old('contact_email')}}"
            >
        </div>
        <div class="form-group col-md-12">
            <textarea 
                placeholder="Type your message" 
                class="form-control" rows="20"
                name="contact_message"
            >{{old('contact_message')}}</textarea>
        </div>
        <div class="form-group col-md-12">
            <button type="submit" class="btn btn-secondary">@lang('Submit Your Message')</button>
        </div>
    </div>
</form>