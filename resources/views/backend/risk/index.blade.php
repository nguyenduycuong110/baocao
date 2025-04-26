@extends('backend.dashboard.layout')
@section('content')
    
<x-breadcrumb :title="'Quản lý rủi ro'" />

<div class="row mt20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Quản lý rủi ro</h5>
            </div>
            <div class="ibox-content">
                <x-filter :config="$config" />
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">
                                <input type="checkbox" value="" id="checkAll" class="input-checkbox">
                            </th>
                            <th>Số lượng TK chuyển luồng</th>
                            <th>Dừng hàng qua KVGS</th>
                            <th>TK phát hiện vi phạm</th>
                            <th>Thu thập <br> thông tin DN</th>
                            <th>Đề xuất <br> thiết lập tiêu chí</th>
                            <th>Thiết lập <br> tiêu chí phân tích</th>
                            <th>Thiết lập hồ sơ <br> mặt hàng trọng điểm</th>
                            <th>Thiết lập hồ sơ <br> DN trọng điểm</th>
                            <th>Ngày</th>
                            <th class="text-center">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($records as $record)
                            <tr >
                                <td class="text-center">
                                    <input type="checkbox" value="{{ $record->id }}" class="input-checkbox checkBoxItem">
                                </td>
                                <td class="text-left">
                                    {{ $record->flow_decl }} tờ
                                </td>
                                <td class="text-left">
                                    {{ $record->stop_via_supervision }} tờ
                                </td>
                                <td class="text-left">
                                    {{ $record->violated_decl }} tờ
                                </td>
                                <td class="text-left">
                                    {{ $record->collect_bus_info }} lượt
                                </td>
                                <td class="text-left">
                                    {{ $record->prop_disb_setup }} lượt
                                </td>
                                <td class="text-left">
                                    {{ $record->act_disb_setup }} lượt
                                </td>
                                <td class="text-left">
                                    {{ $record->item_profile_set }} lượt
                                </td>
                                <td class="text-left">
                                    {{ $record->bus_profile_set }} lượt
                                </td>
                                <td class="text-left">
                                    {{ convertDateTime($record->entry_date, 'd-m-Y', 'Y-m-d') }}
                                </td>
                                <td class="text-center"> 
                                    <a href="{{ route("{$config['route']}.edit", $record->id) }}" class="btn btn-success"><i class="fa fa-edit"></i></a>
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