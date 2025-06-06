@extends('backend.dashboard.layout')

@section('content')
    
<x-breadcrumb :title="'Xếp loại'" />

<div class="row mt20 statistic-form">
    <div class="col-lg-12">
        <div class="ibox float-e-margins mb20">
            <div class="ibox-title">
                <h5>Kết xuất</h5>
            </div>
            <div class="ibox-content">
                <form action="">
                    <div class="action">
                        <div class="active-name mb10">Chọn tháng</div>
                        <div class="uk-flex uk-flex-middle uk-flex-space-between">
                            <div class="uk-flex uk-flex-middle uk-flex-space-between">
                                <div class="filter uk-flex uk-flex-middle">
                                    <input 
                                        type="text"
                                        name="date"
                                        id="date"
                                        value="{{ old('date') }}"
                                        class="form-control datepicker mr10 evaluation-day"
                                        style="height:32px;"
                                    />
                                    <input type="hidden" value="day" class="date-type">
                                </div>
                                <div class="action">
                                    <div class="uk-flex uk-flex-middle">
                                        <button type="submit" value="excel" class="btn-export btn btn-primary">Xuất ra Excel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection