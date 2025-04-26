@extends('backend.dashboard.layout')

@section('content')
    
<x-breadcrumb :title="'Hành khách XNC'" />
<x-errors :errors="$errors" />

@php
    $url = ($config['method'] == 'create') ? route('passengers.store') : route('passengers.update', $model->id);
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
                    @php 
                        $departureMonth = isset($accumulated['accumulatedMonth']->total_departure) ? $accumulated['accumulatedMonth']->total_departure : '';
                        $departureYear = isset($accumulated['accumulatedYear']->total_departure) ? $accumulated['accumulatedYear']->total_departure : '';
                        $entryMonth = isset($accumulated['accumulatedMonth']->total_entry) ? $accumulated['accumulatedMonth']->total_entry : '';
                        $entryYear = isset($accumulated['accumulatedYear']->total_entry) ? $accumulated['accumulatedYear']->total_entry : '';
                    @endphp
                    <tbody>
                        <tr class="green-bg">
                            <td class="center">I</td>
                            <td class="">Hành khách XNC</td>
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
                            <td>Xuất cảnh</td>
                            <td></td>
                            <td>
                                <input 
                                    type="number" 
                                    name="departure" 
                                    value="{{ old('departure', ($model->departure) ?? '' ) }}" 
                                    class="text-right"
                                >
                            </td>
                            <td>
                                {{ $departureMonth }}
                            </td>
                            <td>
                                {{ $departureYear }}
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="center">2</td>
                            <td>Nhập cảnh</td>
                            <td></td>
                            <td>
                                <input 
                                    type="number" 
                                    name="entry" 
                                    value="{{ old('entry', ($model->entry) ?? '' ) }}" 
                                    class="text-right"
                                >
                            </td>
                            <td>
                                {{ $entryMonth }}
                            </td>
                            <td>
                                {{ $entryYear }}
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