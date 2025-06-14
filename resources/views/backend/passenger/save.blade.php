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
                    @php 
                        $departureMonth = isset($accumulated['accumulatedMonth']->total_departure) ? $accumulated['accumulatedMonth']->total_departure : '';
                        $departureYear = isset($accumulated['accumulatedYear']->total_departure) ? $accumulated['accumulatedYear']->total_departure : '';
                        $entryMonth = isset($accumulated['accumulatedMonth']->total_entry) ? $accumulated['accumulatedMonth']->total_entry : '';
                        $entryYear = isset($accumulated['accumulatedYear']->total_entry) ? $accumulated['accumulatedYear']->total_entry : '';
                        $count_turn = isset($model) ?  $model->departure + $model->entry : '';
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
                            <td>Xuất cảnh</td>
                            <td></td>
                            <td>
                                <input 
                                    type="text" 
                                    name="departure" 
                                    value="{{ old('departure', ($model->departure) ?? '' ) }}" 
                                    class="text-right int"
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
                                    type="text" 
                                    name="entry" 
                                    value="{{ old('entry', ($model->entry) ?? '' ) }}" 
                                    class="text-right int"
                                >
                            </td>
                            <td>
                                {{ $entryMonth }}
                            </td>
                            <td>
                                {{ $entryYear }}
                            </td>
                            <td></td>
                            @if($config['method'] == 'create')
                                <input type="hidden" name="user_id" value="{{ $auth->id }}">
                            @else
                                <input type="hidden" name="user_id" value="{{ $model->user_id }}">
                            @endif
                        </tr>
                        <tr class="unit-row">
                            <td rowspan="2" class="stt-column"></td>
                            <td rowspan="2" class="left-text">Tổng số</td>
                        </tr>
                        <tr class="value-row">
                            <td class="small-text"></td>
                            <td class="">{{ $count_turn }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
                @if($auth->user_catalogues->level < 5 && $config['method'] == 'update' && $auth->user_catalogues->level < $model->users->user_catalogues->level  )
                    <div class="uk-flex uk-flex-middle btn-check">
                        <input type="checkbox" name="close" id="closeCheckbox">
                        <label for="closeCheckbox">Phê duyệt</label>
                    </div>
                @endif
            </div>
        </div>
        <div class="text-right mb15">
            <button class="btn btn-primary" type="submit" name="send" value="send">Lưu lại</button>
        </div>
    </div>
</form>
@endsection