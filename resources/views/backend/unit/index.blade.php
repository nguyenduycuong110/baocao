@extends('backend.dashboard.layout')
@section('content')
    
<x-breadcrumb :title="'Tình hình đơn vị'" />

<div class="row mt20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Tình hình đơn vị</h5>
            </div>
            <div class="ibox-content">
                <x-filter :config="$config" />
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center" rowspan="2" style="vertical-align: middle;">
                                <input type="checkbox" id="checkAll" class="input-checkbox">
                            </th>
                            <th class="text-right">Tổng số quân đơn vị</th>
                            <th class="text-right">Có mặt</th>
                            <th class="text-right">Trực lãnh đạo</th>
                            <th class="text-right">Vắng mặt</th>
                            <th class="text-right">Học tập</th>
                            <th class="text-right">Nghỉ phép</th>
                            <th class="text-right">Nghỉ bù</th>
                            <th class="text-right">Ngày</th>
                            <th class="text-center">Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($records as $record)
                            <tr >
                                <td class="text-center">
                                    <input type="checkbox" value="{{ $record->id }}" class="input-checkbox checkBoxItem">
                                </td>
                                <td class="text-right">
                                    {{ $record->total_unit_personnel }} 
                                </td>
                                <td class="text-right">
                                    {{ $record->present_personnel }}
                                </td>
                                <td class="text-right">
                                    {{ $record->leadership_duty }} 
                                </td>
                                <td class="text-right">
                                    {{ $record->absent_personnel }} 
                                </td>
                                <td class="text-right">
                                    {{ $record->training_absence }} 
                                </td>
                                <td class="text-right">
                                    {{ $record->leave_absence }} 
                                </td>
                                <td class="text-right">
                                    {{ $record->compensatory_leave }} 
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