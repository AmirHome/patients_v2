<div class="card">
    <div class="card-header bg-success text-white">{{ trans('cruds.province.fields.registration_complete') }}</div>
    <div class="card-body">
    {{ trans('cruds.province.fields.hello') }} <b>{{ request()->name }}</b>. {{ trans('cruds.province.fields.thank_you_for_joining_us_soon_we_will_approve_your_registration') }} .</br>
    {{ trans('cruds.province.fields.when_your_account_approved_you_will_receive_your_credentials_on') }}<b>{{ request()->email }}</b> </br>
        {{ trans('cruds.province.fields.thank_you') }}</br></br>
        <a href="/" class="btn btn-sm btn-primary">{{ trans('cruds.province.fields.back_to_homepage') }}</a>
    </div>
</div>