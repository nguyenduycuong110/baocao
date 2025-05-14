@extends('backend.dashboard.layout')
@section('content')
    
<x-breadcrumb :title="'Khác'" />

<div class="row mt20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Khác</h5>
            </div>
            <div class="ibox-content">
                <x-filter :config="$config" />
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" value="" id="checkAll" class="input-checkbox">
                            </th>
                            <th class="text-right">Hướng dẫn TTHC</th>
                            <th class="text-right">Cung cấp thông tin DN/HH</th>
                            <th class="text-right">Giải quyết vướng mắc</th>
                            <th class="text-right">Kiến nghị QDHC HS</th>
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
                                <td class="text-right">
                                    {{ $record->admin_guidelines }} lượt
                                </td>
                                <td class="text-right">
                                    {{ $record->business_info }} lượt
                                </td>
                                <td class="text-right">
                                    {{ $record->issue_solving }} vụ
                                </td>
                                <td class="text-right">
                                    {{ $record->regulation_proposal }} vụ
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