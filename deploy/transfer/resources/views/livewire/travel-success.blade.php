<div class="card">
    <div class="card-header bg-success text-white">Registration complete</div>
    <div class="card-body">
        hello. <b>{{ request()->name }}</b>, thank you for joining us, soon we will approve your registration. </br>
        When your account approved, you will receive your credentials on <b>{{ request()->email }}</b> </br>
        Thank you </br></br>
        <a href="/" class="btn btn-sm btn-primary">Back to home</a>
    </div>
</div>