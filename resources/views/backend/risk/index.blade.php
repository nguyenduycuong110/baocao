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
                            {{-- <th class="text-right">Số lượng TK chuyển luồng</th>
                            <th class="text-right">Dừng hàng qua KVGS</th>
                            <th class="text-right">TK phát hiện vi phạm</th>
                            <th class="text-right">Thu thập <br> thông tin DN</th>
                            <th class="text-right">Đề xuất <br> thiết lập tiêu chí</th>
                            <th class="text-right">Thiết lập <br> tiêu chí phân tích</th>
                            <th class="text-right">Thiết lập hồ sơ <br> mặt hàng trọng điểm</th>
                            <th class="text-right">Thiết lập hồ sơ <br> DN trọng điểm</th> --}}
                            <th class="text-right">Người tạo</th>
                            <th class="text-right">Đội</th>
                            <th class="text-right">Ngày</th>
                            <th class="text-center">Thao tác</th>
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