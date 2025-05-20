@extends('backend.dashboard.layout')
@section('content')
    
<x-breadcrumb :title="'Quản lý thuế'" />

<div class="row mt20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Quản lý thuế</h5>
            </div>
            <div class="ibox-content">
                <x-filter :config="$config" />
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">
                                <input type="checkbox" value="" id="checkAll" class="input-checkbox">
                            </th>
                            {{-- <th class="text-right">Thuế VAT</th>
                            <th class="text-right">Thuế XK</th>
                            <th class="text-right">Thuế NK</th>
                            <th class="text-right">Thuế TTĐB</th>
                            <th class="text-right">Thu khác</th>
                            <th class="text-right">Tờ khai (hoàn thuế )</th>
                            <th class="text-right">Số thuế đã hoàn</th>
                            <th class="text-right">Số nợ trong hạn</th>
                            <th class="text-right">Số nợ quá hạn</th>
                            <th class="text-right">Tờ khai (thu thuế 24/7)</th>
                            <th class="text-right">Số thuế</th>
                            <th class="text-right">Doanh nghiệp</th> --}}
                            <th class="text-right">Người tạo</th>
                            <th class="text-right">Đội</th>
                            <th class="text-right" rowspan="2" style="vertical-align: middle;">Ngày</th>
                            <th rowspan="2" class="text-center" style="vertical-align: middle;">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($records as $record)
                            <tr >
                                <td class="text-center">
                                    <input type="checkbox" value="{{ $record->id }}" class="input-checkbox checkBoxItem">
                                </td>
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