@extends('backend.dashboard.layout')
@section('content')
    
<x-breadcrumb :title="'XLVP HC / HS'" />

<div class="row mt20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>XLVP HC / HS</h5>
            </div>
            <div class="ibox-content">
                <x-filter :config="$config" />
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" value="" id="checkAll" class="input-checkbox">
                            </th>
                            {{-- <th class="text-right">Buôn lậu và vận chuyển trái phép</th>
                            <th class="text-right">Ma tuý</th>
                            <th class="text-right">Vi phạm sở hữu trí tuệ, hàng giả</th>
                            <th class="text-right">Vi phạm hành chính</th>
                            <th class="text-right">Vi phạm khác</th> --}}
                            <th class="text-right">Người tạo</th>
                            <th class="text-right">Đội</th>
                            <th class="text-right">Ngày</th>
                            <th class="text-center">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($records as $record)
                            <tr >
                                <td>
                                    <input type="checkbox" value="{{ $record->id }}" class="input-checkbox checkBoxItem">
                                </td>
                                {{-- <td class="text-right">
                                    {{ $record->smuggling_cases }} vụ - {{ convert_price($record->smuggling_value, true) ?? null }} vnđ
                                </td>
                                <td class="text-right">
                                    {{ $record->drug_cases }} vụ - {{ convert_price($record->drug_pills, true) ?? null }} viên / kg
                                </td>
                                <td class="text-right">
                                    {{ $record->ip_cases }} vụ - {{ convert_price($record->ip_value, true) ?? null }} vnđ
                                </td>
                                <td class="text-right">
                                    {{ $record->admin_cases }} vụ - {{ convert_price($record->admin_value, true) ?? null }} vnđ
                                </td>
                                <td class="text-right">
                                    {{ $record->other_cases }} vụ - {{ convert_price($record->other_value, true) ?? null }} vnđ
                                </td> --}}
                                <td class="text-right">
                                    {{ $record->users->name }}
                                </td>
                                <td class="text-right">
                                    {{ $record->users->teams->name }}
                                </td>
                                <td class="text-right">
                                    {{ convertDateTime($record->entry_date, 'd-m-Y', 'Y-m-d') }}
                                </td>
                                <td class="text-center"> 
                                    <a 
                                        href="{{ route("{$config['route']}.edit", $record->id) }}" 
                                        class="btn btn-success" 
                                        {{ ($record->close == 1) && $record->person_close->user_catalogues->level < $auth->user_catalogues->level ? 'disabled' : '' }}
                                    >
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{  $records->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>

@endsection