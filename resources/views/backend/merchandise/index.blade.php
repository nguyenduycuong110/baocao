@extends('backend.dashboard.layout')
@section('content')
    
<x-breadcrumb :title="'Mặt hàng XNK chủ yếu'" />

<div class="row mt20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Mặt hàng XNK chủ yếu</h5>
            </div>
            <div class="ibox-content">
                <x-filter :config="$config" />
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" value="" id="checkAll" class="input-checkbox">
                            </th>
                            <th>Sắn lát</th>
                            <th>Ngày</th>
                            <th class="text-center">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($records as $record)
                            <tr >
                                <td>
                                    <input type="checkbox" value="{{ $record->id }}" class="input-checkbox checkBoxItem">
                                </td>
                                <td class="text-left">
                                    {{ $record->cassava }} USD
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