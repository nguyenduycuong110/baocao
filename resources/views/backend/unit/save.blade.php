@extends('backend.dashboard.layout')

@section('content')
    
<x-breadcrumb :title="'Tình hình đơn vị'" />
<x-errors :errors="$errors" />

@php
    $url = ($config['method'] == 'create') ? route('units.store') : route('units.update', $model->id);
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
                            <th>Kết quả trong ngày</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="green-bg">
                            <td class="center">I</td>
                            <td class="">Tình hình đơn vị</td>
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
                        </tr>
                        <tr>
                            <td class="center">1</td>
                            <td class="category-cell">Tổng số quân đơn vị</td>
                            <td class="pr32 text-danger">
                                <input 
                                    type="text" 
                                    name="total_unit_personnel" 
                                    value="{{ old('total_unit_personnel', ($model->total_unit_personnel) ?? '' ) }}" 
                                    class="text-right"
                                     style="background:#eaeaea"
                                >
                            </td>
                        </tr>
                        <tr>
                            <td class="center">2</td>
                            <td class="subcategory-cell">Có mặt</td>
                            <td>
                                <input 
                                    type="text" 
                                    name="present_personnel" 
                                    value="{{ old('present_personnel', ($model->present_personnel) ?? '' ) }}" 
                                    class="text-right"
                                    readonly
                                     style="background:#eaeaea"
                                >
                            </td>
                        </tr>
                        <tr>
                            <td class="center">2.1</td>
                            <td class="subcategory-cell">Trực lãnh đạo</td>
                            <td>
                                <input 
                                    type="text" 
                                    name="leadership_duty" 
                                    value="{{ old('leadership_duty', ($model->leadership_duty) ?? '' ) }}" 
                                    class="text-right"
                                >
                            </td>
                        </tr>
                         <tr>
                            <td class="center">2.2</td>
                            <td class="subcategory-cell">CBCC</td>
                            <td>
                                <input 
                                    type="text" 
                                    name="present_cbcc" 
                                    value="{{ old('present_cbcc', ($model->present_cbcc) ?? '' ) }}" 
                                    class="text-right"
                                >
                            </td>
                        </tr>
                        
                        <tr>
                            <td class="center">3</td>
                            <td class="category-cell">Vắng mặt</td>
                            <td class=" pr32 text-danger">
                                <input 
                                    type="text" 
                                    name="absent_personnel" 
                                    value="{{ old('absent_personnel', ($model->absent_personnel) ?? '' ) }}" 
                                    class="text-right"
                                    readonly
                                    style="background:#eaeaea"
                                >
                            </td>
                        </tr>
                        <tr>
                            <td class="center">3.1</td>
                            <td class="subcategory-cell">Học tập</td>
                            <td>
                                <input 
                                    type="text" 
                                    name="training_absence" 
                                    value="{{ old('training_absence', ($model->training_absence) ?? '' ) }}" 
                                    class="text-right"
                                >
                            </td>
                        </tr>
                        <tr>
                            <td class="center">3.2</td>
                            <td class="subcategory-cell">Nghỉ phép</td>
                            <td>
                                <input 
                                    type="text" 
                                    name="leave_absence" 
                                    value="{{ old('leave_absence', ($model->leave_absence) ?? '' ) }}" 
                                    class="text-right"
                                >
                            </td>
                        </tr>
                        <tr>
                            <td class="center">3.3</td>
                            <td class="subcategory-cell">Nghỉ bù</td>
                            <td>
                                <input 
                                    type="text" 
                                    name="compensatory_leave" 
                                    value="{{ old('compensatory_leave', ($model->compensatory_leave) ?? '' ) }}" 
                                    class="text-right"
                                >
                            </td>
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
