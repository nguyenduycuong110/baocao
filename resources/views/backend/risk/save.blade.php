@extends('backend.dashboard.layout')

@section('content')
    
<x-breadcrumb :title="'Quản lý rủi ro'" />
<x-errors :errors="$errors" />

@php
    $url = ($config['method'] == 'create') ? route('risks.store') : route('risks.update', $model->id);
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
                            <td class="">Quản lý rủi ro</td>
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
                            <td>Số lượng TK chuyển luồng</td>
                            <td>Tờ</td>
                            <td>
                                <input 
                                    type="text" 
                                    name="flow_decl" 
                                    value="{{ old('flow_decl', ($model->flow_decl) ?? '' ) }}" 
                                    class="text-right int"
                                >
                            </td>
                            <td>
                                {{ $accumulated['accumulatedMonth']->total_flow_decl ?? null }}
                            </td>
                            <td>
                                {{ $accumulated['accumulatedYear']->total_flow_decl ?? null }}
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="center">2</td>
                            <td>Dừng hàng qua KVGS</td>
                            <td>Tờ</td>
                            <td>
                                <input 
                                    type="text" 
                                    name="stop_via_supervision" 
                                    value="{{ old('stop_via_supervision', ($model->stop_via_supervision) ?? '' ) }}" 
                                    class="text-right int"
                                >
                            </td>
                            <td>
                                {{ $accumulated['accumulatedMonth']->total_stop_via_supervision ?? null }}
                            </td>
                            <td>
                                {{ $accumulated['accumulatedMonth']->total_stop_via_supervision ?? null }}
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="center">3</td>
                            <td>TK phát hiện vi phạm</td>
                            <td>Tờ</td>
                            <td>
                                <input 
                                    type="text" 
                                    name="violated_decl" 
                                    value="{{ old('violated_decl', ($model->violated_decl) ?? '' ) }}" 
                                    class="text-right int"
                                >
                            </td>
                            <td>
                                {{ $accumulated['accumulatedMonth']->total_violated_decl ?? null }}
                            </td>
                            <td>
                                {{ $accumulated['accumulatedMonth']->total_violated_decl ?? null }}
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="center">4</td>
                            <td>Thu thập thông tin DN</td>
                            <td>Lượt</td>
                            <td>
                                <input 
                                    type="text" 
                                    name="collect_bus_info" 
                                    value="{{ old('collect_bus_info', ($model->collect_bus_info) ?? '' ) }}" 
                                    class="text-right int"
                                >
                            </td>
                            <td>
                                {{ $accumulated['accumulatedMonth']->total_collect_bus_info ?? null }}
                            </td>
                            <td>
                                {{ $accumulated['accumulatedMonth']->total_collect_bus_info ?? null }}
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="center">5</td>
                            <td>Đề xuất thiết lập tiêu chí</td>
                            <td>Lượt</td>
                            <td>
                                <input 
                                    type="text" 
                                    name="prop_disb_setup" 
                                    value="{{ old('prop_disb_setup', ($model->prop_disb_setup) ?? '' ) }}" 
                                    class="text-right int"
                                >
                            </td>
                            <td>
                                {{ $accumulated['accumulatedMonth']->total_prop_disb_setup ?? null }}
                            </td>
                            <td>
                                {{ $accumulated['accumulatedMonth']->total_prop_disb_setup ?? null }}
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="center">6</td>
                            <td>Thiết lập tiêu chí phân tích</td>
                            <td>Lượt</td>
                            <td>
                                <input 
                                    type="text" 
                                    name="act_disb_setup" 
                                    value="{{ old('act_disb_setup', ($model->act_disb_setup) ?? '' ) }}" 
                                    class="text-right int"
                                >
                            </td>
                            <td>
                                {{ $accumulated['accumulatedMonth']->total_act_disb_setup ?? null }}
                            </td>
                            <td>
                                {{ $accumulated['accumulatedMonth']->total_act_disb_setup ?? null  }}
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="center">7</td>
                            <td>Thiết lập hồ sơ mặt hàng trọng điểm</td>
                            <td>Lượt</td>
                            <td>
                                <input 
                                    type="text" 
                                    name="item_profile_set" 
                                    value="{{ old('item_profile_set', ($model->item_profile_set) ?? '' ) }}" 
                                    class="text-right int"
                                >
                            </td>
                            <td>
                                {{ $accumulated['accumulatedMonth']->total_item_profile_set ?? null }}
                            </td>
                            <td>
                                {{ $accumulated['accumulatedMonth']->total_item_profile_set ?? null }}
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="center">8</td>
                            <td>Thiết lập hồ sơ DN trọng điểm</td>
                            <td>Lượt</td>
                            <td>
                                <input 
                                    type="text" 
                                    name="bus_profile_set" 
                                    value="{{ old('bus_profile_set', ($model->bus_profile_set) ?? '' ) }}" 
                                    class="text-right int"
                                >
                            </td>
                            <td>
                                {{ $accumulated['accumulatedMonth']->total_bus_profile_set ?? null }}
                            </td>
                            <td>
                                {{ $accumulated['accumulatedMonth']->total_bus_profile_set ?? null }}
                            </td>
                            <td></td>
                        </tr>
                        @php
                            $count_sheet = isset($model) ? ($model->flow_decl + $model->stop_via_supervision + $model->violated_decl ) : '';
                            $count_turn = isset($model) ? ($model->collect_bus_info + $model->prop_disb_setup + $model->act_disb_setup + $model->item_profile_set + $model->bus_profile_set) : '';
                        @endphp
                        <tr class="unit-row">
                            <td rowspan="2" class="stt-column"></td>
                            <td rowspan="2" class="left-text">Tổng số</td>
                            <td class="centered-text">Tờ</td>
                            <td>{{ $count_sheet }}</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr class="value-row">
                            <td class="small-text">Lượt</td>
                            <td>{{ $count_turn }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        @if($config['method'] == 'create')
                            <input type="hidden" name="user_id" value="{{ $auth->id }}">
                        @else
                            <input type="hidden" name="user_id" value="{{ $model->user_id }}">
                        @endif
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