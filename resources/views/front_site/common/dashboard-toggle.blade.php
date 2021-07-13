@if(\App\UserCompany::where('user_id',auth()->id())->first())
    <nav class="position-fixed w-100 px-2 bg-white navbar navbar-expand-lg navbar-light border-bottom justify-content-between dashboard-toggle-top-bar">
        @if(session()->get('company_id'))
            <span class="company-name-nav">{{ company_name(session()->get('company_id'))??'' }}</span>
            <select class="w-auto form-control comp-name" id="compani_id" name="compani_id">
                <option disabled selected value="">-- View your company page --</option>
                @foreach(\App\UserCompany::where('user_id',\Auth::user()->id)->get() as $company)
                    <option value="{{ $company->company_id }}" {{(session()->has('company_id') && session()->get('company_id') == $company->company_id)?'selected':''}}>{{ $company->company->company_name }}</option>
                @endforeach
            </select>
        @endif
    </nav>
@endif
