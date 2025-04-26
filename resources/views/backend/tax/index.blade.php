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
                            <th>Thuế VAT</th>
                            <th>Thuế XK</th>
                            <th>Thuế NK</th>
                            <th>Thuế TTĐB</th>
                            <th>Thu khác</th>
                            <th>Tờ khai (hoàn thuế )</th>
                            <th>Số thuế đã hoàn</th>
                            <th>Số nợ trong hạn</th>
                            <th>Số nợ quá hạn</th>
                            <th>Tờ khai (thu thuế 24/7)</th>
                            <th>Số thuế</th>
                            <th>Doanh nghiệp</th>
                            <th rowspan="2" style="vertical-align: middle;">Ngày</th>
                            <th rowspan="2" class="text-center" style="vertical-align: middle;">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($records as $record)
                            <tr >
                                <td class="text-center">
                                    <input type="checkbox" value="{{ $record->id }}" class="input-checkbox checkBoxItem">
                                </td>
                                <td class="text-left">
                                    {{ $record->vat_tax }} vnđ
                                </td>
                                <td class="text-left">
                                    {{ $record->export_import_tax }} vnđ
                                </td>
                                <td class="text-left">
                                    {{ $record->income_tax }} vnđ
                                </td>
                                <td class="text-left">
                                    {{ $record->personal_income_tax }} vnđ
                                </td>
                                <td class="text-left">
                                    {{ $record->other_revenue }} vnđ
                                </td>
                                <td class="text-left">
                                    {{ $record->refunded_tax_declaration }} bộ
                                </td>
                                <td class="text-left">
                                    {{ $record->refunded_tax_amount }} vnđ
                                </td>
                                <td class="text-left">
                                    {{ $record->current_debt }} vnđ
                                </td>
                                <td class="text-left">
                                    {{ $record->overdue_debt }} vnđ
                                </td>
                                <td class="text-left">
                                    {{ $record->tax_collection_declaration }} tờ khai
                                </td>
                                <td class="text-left">
                                    {{ $record->tax_amount }} vnđ
                                </td>
                                <td class="text-left">
                                    {{ $record->business }} dn
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