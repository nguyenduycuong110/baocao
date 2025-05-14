@extends('backend.dashboard.layout')
@section('content')
    
<x-breadcrumb :title="'PTVT NC, XC'" />

<div class="row mt20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>PTVT NC, XC</h5>
            </div>
            <div class="ibox-content">
                <x-filter :config="$config" />
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center" rowspan="2" style="vertical-align: middle;">
                                <input type="checkbox" id="checkAll" class="input-checkbox">
                            </th>
                            <th colspan="2" class="text-center bg-light">Xuất cảnh</th>
                            <th colspan="2" class="text-center bg-light">Nhập cảnh</th>
                            <th class="text-right" rowspan="2" style="vertical-align: middle;">Ngày</th>
                            <th rowspan="2" class="text-center" style="vertical-align: middle;">Thao tác</th>
                        </tr>
                        <tr>
                            <th class="text-right">Ô tô</th>
                            <th class="text-right">Tàu thuyền</th>
                            <th class="text-right">Ô tô</th>
                            <th class="text-right">Tàu thuyền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($records as $record)
                            <tr >
                                <td class="text-center">
                                    <input type="checkbox" value="{{ $record->id }}" class="input-checkbox checkBoxItem">
                                </td>
                                <td class="text-right">
                                    {{ $record->car_exit }} lượt
                                </td>
                                <td class="text-right">
                                    {{ $record->boats_exit }} lượt
                                </td>
                                <td class="text-right">
                                    {{ $record->car_entry }} lượt
                                </td>
                                <td class="text-right">
                                    {{ $record->boats_entry }} lượt
                                </td>
                                <td class="text-right">
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