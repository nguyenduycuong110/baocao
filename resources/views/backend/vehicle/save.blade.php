@extends('backend.dashboard.layout')

@section('content')
    
<x-breadcrumb :title="'PTVT NC, XC'" />
<x-errors :errors="$errors" />

@php
    $url = ($config['method'] == 'create') ? route('vehicles.store') : route('vehicles.update', $model->id);
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
                        @php
                            $total_exit_day = isset($model) ? $model->car_exit + $model->boats_exit : '';
                            $total_entry_day = isset($model) ? $model->car_entry + $model->boats_entry : '';
                            $total_exit_month = count($accumulated) && isset($accumulated['accumulatedMonth']) 
                                ? ($accumulated['accumulatedMonth']->total_car_exit ?? 0) + ($accumulated['accumulatedMonth']->total_boats_exit ?? 0) 
                                : 0;
                            $total_exit_year = count($accumulated) && isset($accumulated['accumulatedYear']) 
                                ? ($accumulated['accumulatedYear']->total_car_exit ?? 0) + ($accumulated['accumulatedYear']->total_boats_exit ?? 0) 
                                : 0;
                            $total_entry_month = count($accumulated) && isset($accumulated['accumulatedMonth']) 
                                ? ($accumulated['accumulatedMonth']->total_car_entry ?? 0) + ($accumulated['accumulatedMonth']->total_boats_entry ?? 0) 
                                : 0;
                            $total_entry_year = count($accumulated) && isset($accumulated['accumulatedYear']) 
                                ? ($accumulated['accumulatedYear']->total_car_entry ?? 0) + ($accumulated['accumulatedYear']->total_boats_entry ?? 0) 
                                : 0;
                        @endphp
                        <tr class="green-bg">
                            <td class="center">I</td>
                            <td class="">PTVT XNC, QC</td>
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
                            <td class="category-cell">Xuất cảnh</td>
                            <td></td>
                            <td class="text-right pr32 text-danger">
                                {{ $total_exit_day }}
                            </td>
                            <td class="text-danger">{{ $total_exit_month  }}</td>
                            <td class="text-danger">{{ $total_exit_year }}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="center">1.1</td>
                            <td class="subcategory-cell">Ô tô</td>
                            <td></td>
                            <td>
                                <input 
                                    type="number" 
                                    name="car_exit" 
                                    value="{{ old('car_exit', ($model->car_exit) ?? '' ) }}" 
                                    class="text-right"
                                >
                            </td>
                            <td>{{ $accumulated['accumulatedMonth']->total_car_exit ?? null }}</td>
                            <td>{{ $accumulated['accumulatedYear']->total_car_exit ?? null }}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="center">1.2</td>
                            <td class="subcategory-cell">Tàu thuyền</td>
                            <td></td>
                            <td>
                                <input 
                                    type="number" 
                                    name="boats_exit" 
                                    value="{{ old('boats_exit', ($model->boats_exit) ?? '' ) }}" 
                                    class="text-right"
                                >
                            </td>
                            <td>
                                {{ $accumulated['accumulatedMonth']->total_boats_exit ?? null }}
                            </td>
                            <td>
                                {{ $accumulated['accumulatedYear']->total_boats_exit ?? null }}
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="center">2</td>
                            <td class="category-cell">Nhập cảnh</td>
                            <td></td>
                            <td class="text-right pr32 text-danger">
                                {{ $total_entry_day }}
                            </td>
                            <td class="text-danger">
                                {{ $total_entry_month  }}
                            </td>
                            <td class="text-danger">
                                {{ $total_entry_year  }}
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="center">2.1</td>
                            <td class="subcategory-cell">Ô tô</td>
                            <td></td>
                            <td>
                                <input 
                                    type="number" 
                                    name="car_entry" 
                                    value="{{ old('car_entry', ($model->car_entry) ?? '' ) }}" 
                                    class="text-right"
                                >
                            </td>
                            <td>
                                {{ $accumulated['accumulatedMonth']->total_car_entry ?? null }}
                            </td>
                            <td>
                                {{ $accumulated['accumulatedYear']->total_car_entry ?? null }}
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="center">2.2</td>
                            <td class="subcategory-cell">Tàu thuyền</td>
                            <td></td>
                            <td>
                                <input 
                                    type="number" 
                                    name="boats_entry" 
                                    value="{{ old('boats_entry', ($model->boats_entry) ?? '' ) }}" 
                                    class="text-right"
                                >
                            </td>
                            <td>
                                {{ $accumulated['accumulatedMonth']->total_boats_entry ?? null }}
                            </td>
                            <td>
                                {{ $accumulated['accumulatedYear']->total_boats_entry ?? null }}
                            </td>
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