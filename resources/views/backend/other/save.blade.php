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
                            <td class="">Khác</td>
                            <td class="center"></td>
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
                            <td>Hướng dẫn TTHC</td>
                            <td>Lượt</td>
                            <td>
                                <input 
                                    type="number" 
                                    name="admin_guidelines" 
                                    value="{{ old('admin_guidelines', ($model->admin_guidelines) ?? '' ) }}" 
                                    class="text-right"
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
                                    type="number" 
                                    name="business_info" 
                                    value="{{ old('business_info', ($model->business_info) ?? '' ) }}" 
                                    class="text-right"
                                >
                            </td>
                            <td>
                                {{ $accumulated['accumulatedMonth']->total_business_info ?? null }}
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
                                    type="number" 
                                    name="issue_solving" 
                                    value="{{ old('issue_solving', ($model->issue_solving) ?? '' ) }}" 
                                    class="text-right"
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
                                    type="number" 
                                    name="regulation_proposal" 
                                    value="{{ old('regulation_proposal', ($model->regulation_proposal) ?? '' ) }}" 
                                    class="text-right"
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