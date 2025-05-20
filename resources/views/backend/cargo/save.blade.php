@extends('backend.dashboard.layout')

@section('content')
    
<x-breadcrumb :title="'XLVP HC / HS'" />
<x-errors :errors="$errors" />

@php
    $url = ($config['method'] == 'create') ? route('cargos.store') : route('cargos.update', $model->id);
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
                            <th style="width: 60px;">STT</th>
                            <th>Nội dung</th>
                            <th style="width: 120px;">Đơn vị tính</th>
                            <th style="width: 150px;">Kết quả trong ngày</th>
                            <th style="width: 120px;">Lũy kế tháng</th>
                            <th style="width: 120px;">Lũy kế năm 2025</th>
                            <th style="width: 180px;">So với cùng kỳ tháng trước(+/- %)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="level-0 green-bg">
                            <td>III</td>
                            <td>THÔNG QUAN HÀNG HÓA XNK</td>
                            <td class="center"></td>
                            <td class="number">
                                <input 
                                    type="text"
                                    name="entry_date"
                                    value="{{ old('entry_date', ($model->entry_date ?? null) ? Carbon\Carbon::parse($model->entry_date)->format('d/m/Y') : '') }}"
                                    class="datepicker text-right"
                                    placeholder=""
                                    autocomplete="off"
                                >
                            </td>
                            <td class="number"></td>
                            <td class="number"></td>
                            <td class="number"></td>
                        </tr>
                        <tr class="level-0">
                            <td>1</td>
                            <td>TK Xuất khẩu</td>
                            <td class="center">Tờ</td>
                            <td class="number"></td>
                            <td class="number"></td>
                            <td class="number"></td>
                            <td class="number"></td>
                        </tr>
                        <tr class="level-1">
                            <td>1.1</td>
                            <td>Luồng Xanh</td>
                            <td class="center"></td>
                            <td class="number">
                                <input 
                                    type="text" 
                                    name="green_channel" 
                                    value="{{ old('green_channel', ($model->green_channel) ?? '' ) }}" 
                                    class="text-right int"
                                >
                            </td>
                            <td class="number">
                                {{ $accumulated['accumulatedMonth']->total_green_channel }}
                            </td>
                            <td class="number">
                                {{ $accumulated['accumulatedYear']->total_green_channel }}
                            </td>
                            <td class="number"></td>
                        </tr>
                        <tr class="level-1">
                            <td>1.2</td>
                            <td>Luồng Vàng</td>
                            <td class="center"></td>
                            <td class="number">
                                <input 
                                    type="text" 
                                    name="yellow_channel" 
                                    value="{{ old('yellow_channel', ($model->yellow_channel) ?? '' ) }}" 
                                    class="text-right int"
                                >
                            </td>
                            <td class="number">
                                {{ $accumulated['accumulatedMonth']->total_yellow_channel }}
                            </td>
                            <td class="number">
                                {{ $accumulated['accumulatedYear']->total_yellow_channel }}
                            </td>
                            <td class="number"></td>
                        </tr>
                        <tr class="level-1">
                            <td>1.3</td>
                            <td>Luồng Đỏ</td>
                            <td class="center"></td>
                            <td class="number">
                                <input 
                                    type="text" 
                                    name="red_channel" 
                                    value="{{ old('red_channel', ($model->red_channel) ?? '' ) }}" 
                                    class="text-right int"
                                >
                            </td>
                            <td class="number">
                                {{ $accumulated['accumulatedMonth']->total_red_channel }}
                            </td>
                            <td class="number">
                                {{ $accumulated['accumulatedYear']->total_red_channel }}
                            </td>
                            <td class="number"></td>
                        </tr>
                        <tr class="level-1">
                            <td>1.4</td>
                            <td>Tờ khai hủy</td>
                            <td class="center"></td>
                            <td class="number">
                                <input 
                                    type="text" 
                                    name="void_declaration" 
                                    value="{{ old('void_declaration', ($model->void_declaration) ?? '' ) }}" 
                                    class="text-right int"
                                >
                            </td>
                            <td class="number">
                                {{ $accumulated['accumulatedMonth']->total_void_declaration }}
                            </td>
                            <td class="number">
                                {{ $accumulated['accumulatedYear']->total_void_declaration }}
                            </td>
                            <td class="number"></td>
                        </tr>
                        
                        <tr class="level-0">
                            <td>2</td>
                            <td>TK Nhập khẩu</td>
                            <td class="center">Tờ</td>
                            <td class="number"></td>
                            <td class="number"></td>
                            <td class="number"></td>
                            <td class="number"></td>
                        </tr>
                        <tr class="level-1">
                            <td>2.1</td>
                            <td>Luồng Xanh</td>
                            <td class="center"></td>
                            <td class="number">
                                <input 
                                    type="text" 
                                    name="green_channel_import" 
                                    value="{{ old('green_channel_import', ($model->green_channel_import) ?? '' ) }}" 
                                    class="text-right int"
                                >
                            </td>
                            <td class="number">
                                {{ $accumulated['accumulatedMonth']->total_green_channel_import }}
                            </td>
                            <td class="number">
                                {{ $accumulated['accumulatedYear']->total_green_channel_import }}
                            </td>
                            <td class="number"></td>
                        </tr>
                        <tr class="level-1">
                            <td>2.2</td>
                            <td>Luồng Vàng</td>
                            <td class="center"></td>
                            <td class="number">
                                <input 
                                    type="text" 
                                    name="yellow_channel_import" 
                                    value="{{ old('yellow_channel_import', ($model->yellow_channel_import) ?? '' ) }}" 
                                    class="text-right int"
                                >
                            </td>
                            <td class="number">
                                {{ $accumulated['accumulatedMonth']->total_yellow_channel_import }}
                            </td>
                            <td class="number">
                                {{ $accumulated['accumulatedYear']->total_yellow_channel_import }}
                            </td>
                            <td class="number"></td>
                        </tr>
                        <tr class="level-1">
                            <td>2.3</td>
                            <td>Luồng Đỏ</td>
                            <td class="center"></td>
                            <td class="number">
                                <input 
                                    type="text" 
                                    name="red_channel_import" 
                                    value="{{ old('red_channel_import', ($model->red_channel_import) ?? '' ) }}" 
                                    class="text-right int"
                                >
                            </td>
                            <td class="number">
                                {{ $accumulated['accumulatedMonth']->total_red_channel_import }}
                            </td>
                            <td class="number">
                                {{ $accumulated['accumulatedYear']->total_red_channel_import }}
                            </td>
                            <td class="number"></td>
                        </tr>
                        <tr class="level-1">
                            <td>2.4</td>
                            <td>Tờ khai hủy</td>
                            <td class="center"></td>
                            <td class="number">
                                <input 
                                    type="text" 
                                    name="void_declaration_import" 
                                    value="{{ old('void_declaration_import', ($model->void_declaration_import) ?? '' ) }}" 
                                    class="text-right int"
                                >
                            </td>
                            <td class="number">
                                {{ $accumulated['accumulatedMonth']->total_void_declaration_import }}
                            </td>
                            <td class="number">
                                {{ $accumulated['accumulatedYear']->total_void_declaration_import }}
                            </td>
                            <td class="number"></td>
                        </tr>
                        
                        <tr class="level-0">
                            <td>3</td>
                            <td>TK tạm nhập, tái xuất</td>
                            <td class="center">Tờ</td>
                            <td class="number"></td>
                            <td class="number"></td>
                            <td class="number"></td>
                            <td class="number"></td>
                        </tr>
                        <tr class="level-1">
                            <td>3.1</td>
                            <td>TK Tạm nhập</td>
                            <td class="center"></td>
                            <td class="number">
                                <input 
                                    type="text" 
                                    name="temp_import" 
                                    value="{{ old('temp_import', ($model->temp_import) ?? '' ) }}" 
                                    class="text-right int"
                                >
                            </td>
                            <td class="number">
                                {{ $accumulated['accumulatedMonth']->total_temp_import }}
                            </td>
                            <td class="number">
                                {{ $accumulated['accumulatedYear']->total_temp_import }}  
                            </td>
                            <td class="number"></td>
                        </tr>
                        <tr class="level-1">
                            <td>3.2</td>
                            <td>TK Tái xuất</td>
                            <td class="center"></td>
                            <td class="number">
                                <input 
                                    type="text" 
                                    name="reexport" 
                                    value="{{ old('reexport', ($model->reexport) ?? '' ) }}" 
                                    class="text-right int"
                                >
                            </td>
                            <td class="number">
                                {{ $accumulated['accumulatedMonth']->total_reexport }}
                            </td>
                            <td class="number">
                                {{ $accumulated['accumulatedYear']->total_reexport }}
                            </td>
                            <td class="number"></td>
                        </tr>
                        <tr class="level-1">
                            <td>3.3</td>
                            <td>TK TN quá hạn chưa TX</td>
                            <td class="center"></td>
                            <td class="number">
                                <input 
                                    type="text" 
                                    name="overdue_not_reexported" 
                                    value="{{ old('overdue_not_reexported', ($model->overdue_not_reexported) ?? '' ) }}" 
                                    class="text-right int"
                                >
                            </td>
                            <td class="number">{{ $accumulated['accumulatedMonth']->total_overdue_not_reexported }}</td>
                            <td class="number">{{ $accumulated['accumulatedYear']->total_overdue_not_reexported }}</td>
                            <td class="number"></td>
                        </tr>
                        
                        <tr class="level-0">
                            <td>4</td>
                            <td>Kim ngạch hàng hóa XNK</td>
                            <td class="center">USD</td>
                            <td class="number"></td>
                            <td class="number"></td>
                            <td class="number"></td>
                            <td class="number"></td>
                        </tr>
                        <tr class="level-1">
                            <td>4.1</td>
                            <td>Xuất khẩu</td>
                            <td class="center"></td>
                            <td class="number">
                                <input 
                                    type="text" 
                                    name="export_turnover" 
                                    value="{{ old('export_turnover', (isset($model) ? convert_price($model->export_turnover , true) : '' )) }}" 
                                    class="text-right int"
                                >
                            </td>
                            <td class="number">{{ !is_null($accumulated['accumulatedMonth']) ? convert_price($accumulated['accumulatedMonth']->total_export_turnover, true) : null }}</td>
                            <td class="number">{{ !is_null($accumulated['accumulatedYear']) ? convert_price($accumulated['accumulatedYear']->total_export_turnover, true) : null }}</td>
                            <td class="number"></td>
                        </tr>
                        <tr class="level-1">
                            <td>4.2</td>
                            <td>Nhập khẩu</td>
                            <td class="center"></td>
                            <td class="number">
                                <input 
                                    type="text" 
                                    name="import_turnover" 
                                    value="{{ old('import_turnover', (isset($model) ? convert_price($model->import_turnover , true) : '' )) }}" 
                                    class="text-right int"
                                >
                            </td>
                            <td class="number">{{ !is_null($accumulated['accumulatedMonth']) ? convert_price($accumulated['accumulatedMonth']->total_import_turnover, true) : null }}</td>
                            <td class="number">{{ !is_null($accumulated['accumulatedYear']) ? convert_price($accumulated['accumulatedYear']->total_import_turnover, true) : null }}</td>
                            <td class="number"></td>
                        </tr>
                        <tr class="level-1">
                            <td>4.3</td>
                            <td>Trong đó:</td>
                            <td class="center"></td>
                            <td class="number"></td>
                            <td class="number"></td>
                            <td class="number"></td>
                            <td class="number"></td>
                        </tr>
                        <tr class="level-2">
                            <td>4.3.1</td>
                            <td>KN Xuất khẩu có thuế</td>
                            <td class="center"></td>
                            <td class="number">
                                <input 
                                    type="text" 
                                    name="taxable_export_turnover" 
                                    value="{{ old('taxable_export_turnover', (isset($model) ? convert_price($model->taxable_export_turnover , true) : '' )) }}" 
                                    class="text-right int"
                                >
                            </td>
                            <td class="number">{{ !is_null($accumulated['accumulatedMonth']) ? convert_price($accumulated['accumulatedMonth']->total_taxable_export_turnover, true) : null }}</td>
                            <td class="number">{{ !is_null($accumulated['accumulatedYear']) ? convert_price($accumulated['accumulatedYear']->total_taxable_export_turnover, true) : null }}</td>
                            <td class="number"></td>
                        </tr>
                        <tr class="level-2">
                            <td>4.3.2</td>
                            <td>KN Nhập khẩu có thuế</td>
                            <td class="center"></td>
                            <td class="number">
                                <input 
                                    type="text" 
                                    name="taxable_import_turnover" 
                                    value="{{ old('taxable_import_turnover', (isset($model) ? convert_price($model->taxable_import_turnover , true) : '' )) }}" 
                                    class="text-right int"
                                >
                            </td>
                            <td class="number">{{ !is_null($accumulated['accumulatedMonth']) ? convert_price($accumulated['accumulatedMonth']->total_taxable_import_turnover, true) : null }}</td>
                            <td class="number">{{ !is_null($accumulated['accumulatedYear']) ? convert_price($accumulated['accumulatedYear']->total_taxable_import_turnover, true) : null }}</td>
                            <td class="number"></td>
                        </tr>
                        
                        <!-- Phần IV -->
                        <tr class="level-0 green-bg">
                            <td>IV</td>
                            <td>HÀNG QUÁ CẢNH</td>
                            <td class="center"></td>
                            <td class="number"></td>
                            <td class="number"></td>
                            <td class="number"></td>
                            <td class="number"></td>
                        </tr>
                        <tr class="level-0">
                            <td>1</td>
                            <td>TK quá cảnh</td>
                            <td class="center">Tờ</td>
                            <td class="number">
                            </td>
                            <td class="number"></td>
                            <td class="number"></td>
                            <td class="number"></td>
                        </tr>
                        <tr class="level-1">
                            <td>1.1</td>
                            <td>TK VCĐL đi</td>
                            <td class="center"></td>
                            <td class="number">
                                <input 
                                    type="text" 
                                    name="outgoing_transit" 
                                    value="{{ old('outgoing_transit', ($model->outgoing_transit) ?? '' ) }}" 
                                    class="text-right int"
                                >
                            </td>
                            <td class="number">
                                {{ $accumulated['accumulatedMonth']->total_outgoing_transit }}
                            </td>
                            <td class="number">
                                {{ $accumulated['accumulatedYear']->total_outgoing_transit }}
                            </td>
                            <td class="number"></td>
                        </tr>
                        <tr class="level-1">
                            <td>1.2</td>
                            <td>TK VCĐL đến</td>
                            <td class="center"></td>
                            <td class="number">
                                <input 
                                    type="text" 
                                    name="incoming_transit" 
                                    value="{{ old('incoming_transit', ($model->incoming_transit) ?? '' ) }}" 
                                    class="text-right int"
                                >
                            </td>
                            <td class="number">
                                {{ $accumulated['accumulatedMonth']->total_incoming_transit }}
                            </td>
                            <td class="number">
                                {{ $accumulated['accumulatedYear']->total_incoming_transit }}
                            </td>
                            <td class="number"></td>
                        </tr>
                        
                        <tr class="level-0">
                            <td>2</td>
                            <td>Kim ngạch quá cảnh</td>
                            <td class="center">USD</td>
                            <td class="number"></td>
                            <td class="number"></td>
                            <td class="number"></td>
                            <td class="number"></td>
                        </tr>
                        <tr class="level-1">
                            <td>2.1</td>
                            <td>KN hàng hóa VCĐL đi</td>
                            <td class="center"></td>
                            <td class="number">
                                <input 
                                    type="text" 
                                    name="outgoing_transit_turnover" 
                                    value="{{ old('outgoing_transit_turnover', (isset($model) ? convert_price($model->outgoing_transit_turnover , true) : '' )) }}" 
                                    class="text-right int"
                                >
                            </td>
                            <td class="number">
                                {{ !is_null($accumulated['accumulatedMonth']) ? convert_price($accumulated['accumulatedMonth']->total_outgoing_transit_turnover, true) : null }}
                            </td>
                            <td class="number">
                                {{ !is_null($accumulated['accumulatedYear']) ? convert_price($accumulated['accumulatedYear']->total_outgoing_transit_turnover, true) : null }}
                            </td>
                            <td class="number"></td>
                        </tr>
                        <tr class="level-1">
                            <td>2.2</td>
                            <td>KN hàng hóa VCĐL đến</td>
                            <td class="center"></td>
                            <td class="number">
                                <input 
                                    type="text" 
                                    name="incoming_transit_turnover" 
                                    value="{{ old('incoming_transit_turnover', (isset($model) ? convert_price($model->incoming_transit_turnover , true) : '' )) }}" 
                                    class="text-right int"
                                >
                            </td>
                            <td class="number">
                                {{ !is_null($accumulated['accumulatedMonth']) ? convert_price($accumulated['accumulatedMonth']->total_incoming_transit_turnover, true) : null }}
                            </td>
                            <td class="number">
                                {{ !is_null($accumulated['accumulatedYear']) ? convert_price($accumulated['accumulatedYear']->total_incoming_transit_turnover, true) : null }}
                            </td>
                            <td class="number"></td>
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