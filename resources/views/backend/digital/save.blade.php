@extends('backend.dashboard.layout')

@section('content')
    
<x-breadcrumb :title="'DVCTT'" />
<x-errors :errors="$errors" />

@php
    $url = ($config['method'] == 'create') ? route('digitals.store') : route('digitals.update', $model->id);
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
                        $total_month = !is_null($accumulated['accumulatedMonth']) && count($accumulated) ? $accumulated['accumulatedMonth']->total_department_level + $accumulated['accumulatedMonth']->total_branch_level : null;
                        $total_year = !is_null($accumulated['accumulatedYear']) && count($accumulated) ?  $accumulated['accumulatedYear']->total_department_level + $accumulated['accumulatedYear']->total_branch_level : null;
                    @endphp
                    <tbody>
                        <tr class="green-bg">
                            <td class="center">I</td>
                            <td class="">DVCTT</td>
                            <td class="center">Hồ sơ</td>
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
                            <td>
                                {{ $total_month }}
                            </td>
                            <td>
                                {{ $total_year }}
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="center">1</td>
                            <td>Cấp cục</td>
                            <td></td>
                            <td>
                                <input 
                                    type="text" 
                                    name="department_level" 
                                    value="{{ old('department_level', ($model->department_level) ?? '' ) }}" 
                                    class="text-right int"
                                >
                            </td>
                            <td>
                                {{ $accumulated['accumulatedMonth']->total_department_level ?? null }}
                            </td>
                            <td>
                                {{ $accumulated['accumulatedYear']->total_department_level ?? null }}
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="center">2</td>
                            <td>Cấp chi cục</td>
                            <td></td>
                            <td>
                                <input 
                                    type="text" 
                                    name="branch_level" 
                                    value="{{ old('branch_level', ($model->branch_level) ?? '' ) }}" 
                                    class="text-right int"
                                >
                            </td>
                            <td>
                                {{ $accumulated['accumulatedMonth']->total_branch_level ?? null }}
                            </td>
                            <td>
                                {{ $accumulated['accumulatedYear']->total_branch_level ?? null }}
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
                            <td class="centered-text"></td>
                            <td>{{ isset($model) ? ($model->department_level + $model->branch_level) : '' }}</td>
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