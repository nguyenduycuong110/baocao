@extends('backend.dashboard.layout')

@section('content')
    
<x-breadcrumb :title="'DVCTT'" />
<x-errors :errors="$errors" />

@php
    $url = ($config['method'] == 'create') ? route('merchandises.store') : route('merchandises.update', $model->id);
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
                            <td class="">Mặt hàng XNK chủ yếu</td>
                            <td class="center">Trị giá(USD)</td>
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
                                
                            </td>
                            <td>
                                
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="center">1</td>
                            <td>Sắn lát</td>
                            <td></td>
                            <td>
                                <input 
                                    type="text" 
                                    name="cassava" 
                                    value="{{ old('cassava', (isset($model) ? convert_price($model->cassava, true) : '' )) }}"
                                    class="text-right int"
                                >
                            </td>
                            <td>
                                {{ !is_null($accumulated['accumulatedMonth']) ? convert_price($accumulated['accumulatedMonth']->total_cassava, true) : null }}
                            </td>
                            <td>
                                {{ !is_null($accumulated['accumulatedYear']) ? convert_price($accumulated['accumulatedYear']->total_cassava, true) : null }}
                            </td>
                            <td></td>
                            <input type="hidden" class="user_id" value="{{ $auth->id }}">
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