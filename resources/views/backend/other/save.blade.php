@extends('backend.dashboard.layout')

@section('content')
    
<x-breadcrumb :title="'Khác'" />
<x-errors :errors="$errors" />

@php
    $url = ($config['method'] == 'create') ? route('others.store') : route('others.update', $model->id);
@endphp

<form action="{{ $url }}" method="post" class="box">
    @if($config['method'] == 'update')
        @method('PUT')
    @endif
    @csrf
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-7">
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
                            <td class="">Khác</td>
                            <td class="center"></td>
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
                        <tr>
                            <td class="center">1</td>
                            <td>Hướng dẫn TTHC</td>
                            <td>Lượt</td>
                            <td>
                                <input 
                                    type="text" 
                                    name="admin_guidelines" 
                                    value="{{ old('admin_guidelines', ($model->admin_guidelines) ?? '' ) }}" 
                                    class="text-right int"
                                >
                            </td>
                            <td>
                                {{ $accumulated['accumulatedMonth']->total_admin_guidelines ?? null }}
                            </td>
                            <td>
                                {{ $accumulated['accumulatedYear']->total_admin_guidelines ?? null }}
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="center">2</td>
                            <td>Cung cấp thông tin DN/HH</td>
                            <td>Luợt</td>
                            <td>
                                <input 
                                    type="text" 
                                    name="business_info" 
                                    value="{{ old('business_info', ($model->business_info) ?? '' ) }}" 
                                    class="text-right int"
                                >
                            </td>
                            <td>
                                {{ count($accumulated) && !is_null($accumulated['accumulatedMonth']) ?  $accumulated['accumulatedMonth']->total_business_info : null }}
                            </td>
                            <td>
                                {{ $accumulated['accumulatedYear']->total_business_info ?? null }}
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="center">3</td>
                            <td>Giải quyết vướng mắc</td>
                            <td>Vụ</td>
                            <td>
                                <input 
                                    type="text" 
                                    name="issue_solving" 
                                    value="{{ old('issue_solving', ($model->issue_solving) ?? '' ) }}" 
                                    class="text-right int"
                                >
                            </td>
                            <td>
                                {{ $accumulated['accumulatedMonth']->total_issue_solving ?? null }}
                            </td>
                            <td>
                                {{ $accumulated['accumulatedYear']->total_issue_solving ?? null }}
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="center">4</td>
                            <td>Kiến nghị QĐHC/HS</td>
                            <td>Vụ</td>
                            <td>
                                <input 
                                    type="text" 
                                    name="regulation_proposal" 
                                    value="{{ old('regulation_proposal', ($model->regulation_proposal) ?? '' ) }}" 
                                    class="text-right int"
                                >
                            </td>
                            <td>
                                {{ $accumulated['accumulatedMonth']->total_regulation_proposal ?? null }}
                            </td>
                            <td>
                                {{ $accumulated['accumulatedYear']->total_regulation_proposal ?? null }}
                            </td>
                            <td></td>
                            <input type="hidden" name="user_id" value="{{ $auth->id }}">
                        </tr>
                        <tr class="unit-row">
                            <td rowspan="2" class="stt-column"></td>
                            <td rowspan="2" class="left-text">Tổng số</td>
                            <td class="centered-text">Lượt</td>
                            <td>{{ isset($model) ? ($model->admin_guidelines + $model->business_info) : '' }}</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr class="value-row">
                            <td class="small-text">Vụ</td>
                            <td>{{ isset($model) ? ($model->issue_solving + $model->regulation_proposal) : '' }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
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