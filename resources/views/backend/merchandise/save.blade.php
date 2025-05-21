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
            <div class="col-lg-8">
                <div class="btn-add">
                    <button>+</button>
                </div>
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
                                <input type="hidden" name="user_id" value="{{ $auth->id }}">
                            </td>
                            <td>
                                
                            </td>
                            <td>
                                
                            </td>
                            <td></td>
                        </tr>
                        @if(isset($model->merchandise_products))
                            @foreach($model->merchandise_products as $k => $item)
                                <tr>
                                    <td class="center">{{ $k + 1 }}</td>
                                    <td>
                                        <input 
                                            type="text" 
                                            name="merchandise_products[name][]" 
                                            value="{{ $item->name }}"
                                            class="text-right"
                                        >
                                    </td>
                                    <td>

                                    </td>
                                    <td>
                                        <input 
                                            type="text" 
                                            name="merchandise_products[value][]" 
                                            value="{{ convert_price($item->value, true) }}"
                                            class="text-right int"
                                        >
                                    </td>
                                    <td>
                                        
                                    </td>
                                    <td>
                                        
                                    </td>
                                    <td></td>
                                    <td class="delete">
                                        <button class="btn btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                    @if($config['method'] == 'create')
                                        <input type="hidden" name="user_id" value="{{ $auth->id }}">
                                    @else
                                        <input type="hidden" name="user_id" value="{{ $model->user_id }}">
                                    @endif
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="center">1</td>
                                <td>
                                    <input 
                                        type="text" 
                                        name="merchandise_products[name][]" 
                                        value=""
                                        class="text-right"
                                    >
                                </td>
                                <td>

                                </td>
                                <td>
                                    <input 
                                        type="text" 
                                        name="merchandise_products[value][]" 
                                        value=""
                                        class="text-right int"
                                    >
                                </td>
                                <td>
                                    
                                </td>
                                <td>
                                    
                                </td>
                                <td></td>
                            </tr>
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