@extends('backend.dashboard.layout')

@section('content')
    
<x-breadcrumb :title="'XLVP HC / HS'" />
<x-errors :errors="$errors" />

@php
    $url = ($config['method'] == 'create') ? route('violations.store') : route('violations.update', $model->id);
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
                            <th class="stt-column">STT</th>
                            <th class="content-column">Nội dung</th>
                            <th class="unit-column">Đơn vị tính</th>
                            <th class="result-column">Kết quả trong ngày</th>
                            <th class="cumulative-column">Lũy kế tháng</th>
                            <th class="cumulative-column">Lũy kế năm 2025</th>
                            <th class="compare-column">So với cùng kỳ tháng trước(+/- %)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="green-bg">
                            <td class="roman-numeral">IX</td>
                            <td class="roman-numeral">XLVP HC/HS</td>
                            <td></td>
                            <td>
                                <input 
                                    type="text"
                                    name="entry_date"
                                    value="{{ old('entry_date', ($model->entry_date ?? null) ? Carbon\Carbon::parse($model->entry_date)->format('d/m/Y') : '') }}"
                                    class="datepicker text-right"
                                    placeholder=""
                                    autocomplete="off"
                                >
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        
                        <!-- Item 1 -->
                        <tr class="unit-row">
                            <td rowspan="2" class="stt-column">1</td>
                            <td rowspan="2" class="left-text">Buôn lậu và vận chuyển trái phép</td>
                            <td class="centered-text">Vụ</td>
                            <td>
                                <input 
                                    type="number" 
                                    name="smuggling_cases" 
                                    value="{{ old('smuggling_cases', ($model->smuggling_cases) ?? '' ) }}" 
                                    class="text-right"
                                >
                            </td>
                            <td>
                                {{ $accumulated['accumulatedMonth']->total_smuggling_cases ?? null }}
                            </td>
                            <td>
                                {{ $accumulated['accumulatedYear']->total_smuggling_cases ?? null }}
                            </td>
                            <td></td>
                        </tr>
                        <tr class="value-row">
                            <td class="small-text">Trị giá (VN đồng)</td>
                            <td>
                                <input 
                                    type="text" 
                                    name="smuggling_value" 
                                    value="{{ old('smuggling_value', (isset($model) ? convert_price($model->smuggling_value, true) : '' )) }}" 
                                    class="text-right int"
                                >
                            </td>
                            <td>
                                {{ !is_null($accumulated['accumulatedMonth']) ? convert_price($accumulated['accumulatedMonth']->total_smuggling_value, true) : null }}
                            </td>
                            <td>
                                {{ !is_null($accumulated['accumulatedYear']) ? convert_price($accumulated['accumulatedYear']->total_smuggling_value, true) : null }}
                            </td>
                            <td></td>
                        </tr>
                        
                        <!-- Item 2 -->
                        <tr class="unit-row">
                            <td rowspan="2" class="stt-column">2</td>
                            <td rowspan="2" class="left-text">Ma túy</td>
                            <td class="centered-text">Vụ</td>
                            <td>
                                <input 
                                    type="number" 
                                    name="drug_cases" 
                                    value="{{ old('drug_cases', ($model->drug_cases) ?? '' ) }}" 
                                    class="text-right"
                                >
                            </td>
                            <td>
                                {{ $accumulated['accumulatedMonth']->total_drug_cases }}
                            </td>
                            <td>
                                {{ $accumulated['accumulatedYear']->total_drug_cases }}
                            </td>
                            <td></td>
                        </tr>
                        <tr class="value-row">
                            <td class="small-text">Viên/kg</td>
                            <td>
                                <input 
                                    type="text" 
                                    name="drug_pills" 
                                    value="{{ old('drug_pills', (isset($model) ? convert_price($model->drug_pills , true) : '' )) }}" 
                                    class="text-right int"
                                >
                            </td>
                            <td>
                                {{ !is_null($accumulated['accumulatedMonth']) ? convert_price($accumulated['accumulatedMonth']->total_drug_pills, true) : null }}
                            </td>
                            <td>
                                {{ !is_null($accumulated['accumulatedYear']) ? convert_price($accumulated['accumulatedYear']->total_drug_pills, true) : null }}
                            </td>
                            <td></td>
                        </tr>
                        
                        <!-- Item 3 -->
                        <tr class="unit-row">
                            <td rowspan="2" class="stt-column">3</td>
                            <td rowspan="2" class="left-text">Vi phạm sở hữu trí tuệ, hàng giả</td>
                            <td class="centered-text">Vụ</td>
                            <td>
                                <input 
                                    type="number" 
                                    name="ip_cases" 
                                    value="{{ old('ip_cases', ($model->ip_cases) ?? '' ) }}" 
                                    class="text-right"
                                >
                            </td>
                            <td>
                                {{ $accumulated['accumulatedMonth']->total_ip_cases }}
                            </td>
                            <td>
                                {{ $accumulated['accumulatedYear']->total_ip_cases }}
                            </td>
                            <td></td>
                        </tr>
                        <tr class="value-row">
                            <td class="small-text">Trị giá (VN đồng)</td>
                            <td>
                                <input 
                                    type="text" 
                                    name="ip_value" 
                                    value="{{ old('ip_value', (isset($model) ? convert_price($model->ip_value , true) : '' )) }}" 
                                    class="text-right int"
                                >
                            </td>
                            <td>
                                {{ !is_null($accumulated['accumulatedMonth']) ? convert_price($accumulated['accumulatedMonth']->total_ip_value, true) : null }}
                            </td>
                            <td>
                                {{ !is_null($accumulated['accumulatedYear']) ? convert_price($accumulated['accumulatedYear']->total_ip_value, true) : null }}
                            </td>
                            <td></td>
                        </tr>
                        
                        <!-- Item 4 -->
                        <tr class="unit-row">
                            <td rowspan="2" class="stt-column">4</td>
                            <td rowspan="2" class="left-text">Vi phạm hành chính</td>
                            <td class="centered-text">Vụ</td>
                            <td>
                                <input 
                                    type="number" 
                                    name="admin_cases" 
                                    value="{{ old('admin_cases', ($model->admin_cases) ?? '' ) }}" 
                                    class="text-right"
                                >
                            </td>
                            <td>
                                {{ $accumulated['accumulatedMonth']->total_admin_cases }}
                            </td>
                            <td class="centered-text">
                                {{ $accumulated['accumulatedMonth']->total_admin_cases }}
                            </td>
                            <td></td>
                        </tr>
                        <tr class="value-row">
                            <td class="small-text">Trị giá (VN đồng)</td>
                            <td>
                                <input 
                                    type="text" 
                                    name="admin_value" 
                                    value="{{ old('admin_value', (isset($model) ? convert_price($model->admin_value , true) : '' )) }}" 
                                    class="text-right int"
                                >
                            </td>
                            <td>
                                {{ !is_null($accumulated['accumulatedMonth']) ? convert_price($accumulated['accumulatedMonth']->total_admin_value, true) : null }}
                            </td>
                            <td class="value-cell">
                                {{ !is_null($accumulated['accumulatedYear']) ? convert_price($accumulated['accumulatedYear']->total_admin_value, true) : null }}
                            </td>
                            <td></td>
                        </tr>
                        
                        <!-- Item 5 -->
                        <tr class="unit-row">
                            <td rowspan="2" class="stt-column">5</td>
                            <td rowspan="2" class="left-text">Vi phạm khác</td>
                            <td class="centered-text">Vụ</td>
                            <td>
                                <input 
                                    type="number" 
                                    name="other_cases" 
                                    value="{{ old('other_cases', ($model->other_cases) ?? '' ) }}" 
                                    class="text-right"
                                >
                            </td>
                            <td>
                                {{ $accumulated['accumulatedMonth']->total_other_cases }}
                            </td>
                            <td>
                                {{ $accumulated['accumulatedYear']->total_other_cases }}
                            </td>
                            <td></td>
                        </tr>
                        <tr class="value-row">
                            <td class="small-text">Trị giá (VN đồng)</td>
                            <td>
                                <input 
                                    type="text" 
                                    name="other_value" 
                                    value="{{ old('other_value', (isset($model) ? convert_price($model->other_value , true) : '' )) }}" 
                                    class="text-right int"
                                >
                            </td>
                            <td>
                                {{ !is_null($accumulated['accumulatedMonth']) ? convert_price($accumulated['accumulatedMonth']->total_other_value, true) : null }}
                            </td>
                            <td>
                                {{ !is_null($accumulated['accumulatedYear']) ? convert_price($accumulated['accumulatedYear']->total_other_value, true) : null }}
                            </td>
                            <td></td>
                        </tr>
                        
                        <!-- Item 6 -->
                        <tr class="unit-row">
                            <td rowspan="2" class="stt-column">6</td>
                            <td rowspan="2" class="left-text">Tổng số</td>
                            <td class="centered-text">Vụ</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr class="value-row">
                            <td class="small-text">Trị giá (VN đồng)</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <input type="hidden" class="user_id" value="{{ $auth->id }}">
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