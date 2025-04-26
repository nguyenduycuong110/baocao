@extends('backend.dashboard.layout')

@section('content')
    
<x-breadcrumb :title="'PTVT NC, XC'" />
<x-errors :errors="$errors" />

@php
    $url = ($config['method'] == 'create') ? route('taxes.store') : route('taxes.update', $model->id);
@endphp

<form action="{{ $url }}" method="post" class="box">
    @if($config['method'] == 'update')
        @method('PUT')
    @endif
    @csrf
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-6">
                <table class="board">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Nội dung</th>
                            <th>Đơn vị tính</th>
                            <th>Kết quả trong ngày</th>
                            <th>Lũy kế tháng</th>
                            <th>Lũy kế năm <?php echo date('Y') ?></th>
                            <th>So với cùng kỳ tháng trước(+/- %)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="green-bg">
                            <td class="center">I</td>
                            <td class="">QL thuế</td>
                            <td class="center">Lượt</td>
                            <td>
                                <input 
                                    type="text"
                                    name="entry_date"
                                    value="{{ old('entry_date', ($model->entry_date ?? null) ? Carbon\Carbon::parse($model->entry_date)->format('d/m/Y') : '') }}"
                                    class="datepicker"
                                    placeholder=""
                                    autocomplete="off"
                                >
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="center">1</td>
                            <td class="category-cell">Tổng thu thuế</td>
                            <td></td>
                            <td class="text-right pr32 text-danger">
                                
                            </td>
                            <td class="text-danger"></td>
                            <td class="text-danger"></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="center">1.1</td>
                            <td class="subcategory-cell">Thuế VAT</td>
                            <td></td>
                            <td>
                                <input 
                                    type="number" 
                                    name="vat_tax" 
                                    value="{{ old('vat_tax', ($model->vat_tax) ?? '' ) }}" 
                                    class="text-right"
                                >
                            </td>
                            <td>
                                {{ $accumulated['accumulatedMonth']->total_vat_tax ?? null }}
                            </td>
                            <td>
                                {{ $accumulated['accumulatedYear']->total_vat_tax ?? null }}
                            </td>
                            <td>

                            </td>
                        </tr>
                        <tr>
                            <td class="center">1.2</td>
                            <td class="subcategory-cell">Thuế XK</td>
                            <td></td>
                            <td>
                                <input 
                                    type="number" 
                                    name="export_import_tax" 
                                    value="{{ old('export_import_tax', ($model->export_import_tax) ?? '' ) }}" 
                                    class="text-right"
                                >
                            </td>
                            <td>
                                {{ $accumulated['accumulatedMonth']->total_export_import_tax ?? null }}
                            </td>
                            <td>
                                {{ $accumulated['accumulatedYear']->total_export_import_tax ?? null }}
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="center">1.3</td>
                            <td class="subcategory-cell">Thuế NK</td>
                            <td></td>
                            <td>
                                <input 
                                    type="number" 
                                    name="income_tax" 
                                    value="{{ old('income_tax', ($model->income_tax) ?? '' ) }}" 
                                    class="text-right"
                                >
                            </td>
                            <td>
                                {{ $accumulated['accumulatedMonth']->total_income_tax ?? null }}
                            </td>
                            <td>
                                {{ $accumulated['accumulatedYear']->total_income_tax ?? null }}
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="center">1.4</td>
                            <td class="subcategory-cell">Thuế TTĐB</td>
                            <td></td>
                            <td>
                                <input 
                                    type="number" 
                                    name="personal_income_tax" 
                                    value="{{ old('personal_income_tax', ($model->personal_income_tax) ?? '' ) }}" 
                                    class="text-right"
                                >
                            </td>
                            <td>
                                {{ $accumulated['accumulatedMonth']->total_personal_income_tax ?? null }}
                            </td>
                            <td>
                                {{ $accumulated['accumulatedYear']->total_personal_income_tax ?? null }}
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="center">1.5</td>
                            <td class="subcategory-cell">Thu khác</td>
                            <td></td>
                            <td>
                                <input 
                                    type="number" 
                                    name="other_revenue" 
                                    value="{{ old('other_revenue', ($model->other_revenue) ?? '' ) }}" 
                                    class="text-right"
                                >
                            </td>
                            <td>
                                {{ $accumulated['accumulatedMonth']->total_other_revenue ?? null }}
                            </td>
                            <td>
                                {{ $accumulated['accumulatedYear']->total_other_revenue ?? null }}
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="center">2</td>
                            <td class="category-cell">Hoàn thuế</td>
                            <td></td>
                            <td class="text-right pr32 text-danger">
                                
                            </td>
                            <td class="text-danger">
                                
                            </td>
                            <td class="text-danger">
                                
                            </td>
                            <td>

                            </td>
                        </tr>
                        <tr>
                            <td class="center">2.1</td>
                            <td class="subcategory-cell">Tờ khai</td>
                            <td></td>
                            <td>
                                <input 
                                    type="number" 
                                    name="refunded_tax_declaration" 
                                    value="{{ old('refunded_tax_declaration', ($model->refunded_tax_declaration) ?? '' ) }}" 
                                    class="text-right"
                                >
                            </td>
                            <td>
                                {{ $accumulated['accumulatedMonth']->total_refunded_tax_declaration ?? null }}
                            </td>
                            <td>
                                {{ $accumulated['accumulatedYear']->total_refunded_tax_declaration ?? null }}
                            </td>
                            <td>

                            </td>
                        </tr>
                        <tr>
                            <td class="center">2.2</td>
                            <td class="subcategory-cell">Số thuế đã hoàn</S></td>
                            <td></td>
                            <td>
                                <input 
                                    type="number" 
                                    name="refunded_tax_amount" 
                                    value="{{ old('refunded_tax_amount', ($model->refunded_tax_amount) ?? '' ) }}" 
                                    class="text-right"
                                >
                            </td>
                            <td>
                                {{ $accumulated['accumulatedMonth']->total_refunded_tax_amount ?? null }}
                            </td>
                            <td>
                                {{ $accumulated['accumulatedYear']->total_refunded_tax_amount ?? null }}
                            </td>
                            <td>

                            </td>
                        </tr>
                        <tr>
                            <td class="center">3</td>
                            <td class="category-cell">Tổng số nợ đọng</td>
                            <td></td>
                            <td class="text-right pr32 text-danger">
                                
                            </td>
                            <td class="text-danger">
                                
                            </td>
                            <td class="text-danger">
                                
                            </td>
                            <td>

                            </td>
                        </tr>
                        <tr>
                            <td class="center">3.1</td>
                            <td class="subcategory-cell">Số nợ trong hạn</td>
                            <td></td>
                            <td>
                                <input 
                                    type="number" 
                                    name="current_debt" 
                                    value="{{ old('current_debt', ($model->current_debt) ?? '' ) }}" 
                                    class="text-right"
                                >
                            </td>
                            <td>
                                {{ $accumulated['accumulatedMonth']->total_current_debt ?? null }}
                            </td>
                            <td>
                                {{ $accumulated['accumulatedYear']->total_current_debt ?? null }}
                            </td>
                            <td>

                            </td>
                        </tr>
                        <tr>
                            <td class="center">3.2</td>
                            <td class="subcategory-cell">Số nợ quá hạn</td>
                            <td></td>
                            <td>
                                <input 
                                    type="number" 
                                    name="overdue_debt" 
                                    value="{{ old('overdue_debt', ($model->overdue_debt) ?? '' ) }}" 
                                    class="text-right"
                                >
                            </td>
                            <td>
                                {{ $accumulated['accumulatedMonth']->total_overdue_debt ?? null }}
                            </td>
                            <td>
                                {{ $accumulated['accumulatedYear']->total_overdue_debt ?? null }}
                            </td>
                            <td>

                            </td>
                        </tr>
                        <tr>
                            <td class="center">4</td>
                            <td class="category-cell">Thu thuế 24/7</td>
                            <td></td>
                            <td class="text-right pr32 text-danger">
                                
                            </td>
                            <td class="text-danger">
                                
                            </td>
                            <td class="text-danger">
                                
                            </td>
                            <td>

                            </td>
                        </tr>
                        <tr>
                            <td class="center">4.1</td>
                            <td class="subcategory-cell">Tờ khai</td>
                            <td></td>
                            <td>
                                <input 
                                    type="number" 
                                    name="tax_collection_declaration" 
                                    value="{{ old('tax_collection_declaration', ($model->tax_collection_declaration) ?? '' ) }}" 
                                    class="text-right"
                                >
                            </td>
                            <td>
                                {{ $accumulated['accumulatedMonth']->total_tax_collection_declaration ?? null }}
                            </td>
                            <td>
                                {{ $accumulated['accumulatedYear']->total_tax_collection_declaration ?? null }}
                            </td>
                            <td>

                            </td>
                        </tr>
                        <tr>
                            <td class="center">4.2</td>
                            <td class="subcategory-cell">Số thuế</td>
                            <td></td>
                            <td>
                                <input 
                                    type="number" 
                                    name="tax_amount" 
                                    value="{{ old('tax_amount', ($model->tax_amount) ?? '' ) }}" 
                                    class="text-right"
                                >
                            </td>
                            <td>
                                {{ $accumulated['accumulatedMonth']->total_tax_amount ?? null }}
                            </td>
                            <td>
                                {{ $accumulated['accumulatedYear']->total_tax_amount ?? null }}
                            </td>
                            <td>

                            </td>
                        </tr>
                        <tr>
                            <td class="center">4.3</td>
                            <td class="subcategory-cell">Doanh nghiệp</td>
                            <td></td>
                            <td>
                                <input 
                                    type="number" 
                                    name="business" 
                                    value="{{ old('business', ($model->business) ?? '' ) }}" 
                                    class="text-right"
                                >
                            </td>
                            <td>
                                {{ $accumulated['accumulatedMonth']->total_business ?? null }}
                            </td>
                            <td>
                                {{ $accumulated['accumulatedYear']->total_business ?? null }}
                            </td>
                            <td>

                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="text-right mb15">
            <button class="btn btn-primary" type="submit" name="send" value="send">Lưu lại</button>
        </div>
    </div>
</form>

@endsection