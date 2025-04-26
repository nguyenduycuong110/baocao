@extends('backend.dashboard.layout')

@section('content')
    
<x-breadcrumb :title="'Tham vấn'" />
<x-errors :errors="$errors" />

@php
    $url = ($config['method'] == 'create') ? route('consultations.store') : route('consultations.update', $model->id);
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
                            <td class="">Tham vấn</td>
                            <td class="center">Hồ sơ</td>
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
                            <td>
                                
                            </td>
                            <td>
                                
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="center">1</td>
                            <td>Tờ khai</td>
                            <td></td>
                            <td>
                                <input 
                                    type="number" 
                                    name="declaration" 
                                    value="{{ old('declaration', ($model->declaration) ?? '' ) }}" 
                                    class="text-right"
                                >
                            </td>
                            <td>
                                {{ $accumulated['accumulatedMonth']->total_declaration ?? null }}
                            </td>
                            <td>
                                {{ $accumulated['accumulatedYear']->total_declaration ?? null }}
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="center">2</td>
                            <td>Chấp nhận trị giá khai báo</td>
                            <td></td>
                            <td>
                                <input 
                                    type="number" 
                                    name="accept_value" 
                                    value="{{ old('accept_value', ($model->accept_value) ?? '' ) }}" 
                                    class="text-right"
                                >
                            </td>
                            <td>
                                {{ $accumulated['accumulatedMonth']->total_accept_value ?? null }}
                            </td>
                            <td>
                                {{ $accumulated['accumulatedYear']->total_accept_value ?? null }}
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="center">3</td>
                            <td>Bác bỏ trị giá khai báo</td>
                            <td></td>
                            <td>
                                <input 
                                    type="number" 
                                    name="reject_value" 
                                    value="{{ old('reject_value', ($model->reject_value) ?? '' ) }}" 
                                    class="text-right"
                                >
                            </td>
                            <td>
                                {{ $accumulated['accumulatedMonth']->total_reject_value ?? null }}
                            </td>
                            <td>
                                {{ $accumulated['accumulatedYear']->total_reject_value ?? null }}
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