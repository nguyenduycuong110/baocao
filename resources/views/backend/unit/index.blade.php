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
                            <th>Tổng số quân đơn vị</th>
                            <th>Có mặt</th>
                            <th>Trực lãnh đạo</th>
                            <th>Vắng mặt</th>
                            <th>Học tập</th>
                            <th>Nghỉ phép</th>
                            <th>Nghỉ bù</th>
                            <th>Ngày</th>
                            <th class="text-center">Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($records as $record)
                            <tr >
                                <td class="text-center">
                                    <input type="checkbox" value="{{ $record->id }}" class="input-checkbox checkBoxItem">
                                </td>
                                <td class="text-left">
                                    {{ $record->total_unit_personnel }} 
                                </td>
                                <td class="text-left">
                                    {{ $record->present_personnel }}
                                </td>
                                <td class="text-left">
                                    {{ $record->leadership_duty }} 
                                </td>
                                <td class="text-left">
                                    {{ $record->absent_personnel }} 
                                </td>
                                <td class="text-left">
                                    {{ $record->training_absence }} 
                                </td>
                                <td class="text-left">
                                    {{ $record->leave_absence }} 
                                </td>
                                <td class="text-left">
                                    {{ $record->compensatory_leave }} 
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