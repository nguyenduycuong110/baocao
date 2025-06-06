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
                        <th class="text-center" rowspan="2" style="vertical-align: middle;">
                            <input type="checkbox" id="checkAll" class="input-checkbox">
                        </th>
                        <th class="text-right">Người tạo</th>
                        <th class="text-right">Đội</th>
                        <th class="text-right">Ngày</th>
                        <th class="text-center">Thao tác</th>
                    </thead>
                    <tbody>
                        @foreach($records as $record)
                            
                            <tr >
                                <td class="text-center">
                                    <input type="checkbox" value="{{ $record->id }}" class="input-checkbox checkBoxItem">
                                </td>
                                <td class="text-right">{{ $record->users->name }}</td>
                                <td class="text-right">{{ $record->users->teams->name }}</td>
                                <td class="text-right">
                                    {{ convertDateTime($record->entry_date, 'd-m-Y', 'Y-m-d') }}
                                </td>
                                <td class="text-center"> 
                                    <a 
                                        href="{{ route("{$config['route']}.edit", $record->id) }}" 
                                        class="btn btn-success" 
                                        {{  ($record->close == 1) && isset($record->person_close) && $record->person_close->user_catalogues->level < $auth->user_catalogues->level ? 'disabled' : '' }}
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