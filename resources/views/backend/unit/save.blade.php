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
            <div class="col-lg-6">
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
                            <td class="text-right pr32 text-danger">
                                <input 
                                    type="number" 
                                    name="total_unit_personnel" 
                                    value="{{ old('total_unit_personnel', ($model->total_unit_personnel) ?? '' ) }}" 
                                    class="text-right"
                                >
                            </td>
                        </tr>
                        <tr>
                            <td class="center">2</td>
                            <td class="subcategory-cell">Có mặt</td>
                            <td>
                                <input 
                                    type="number" 
                                    name="present_personnel" 
                                    value="{{ old('present_personnel', ($model->present_personnel) ?? '' ) }}" 
                                    class="text-right"
                                >
                            </td>
                        </tr>
                        <tr>
                            <td class="center">3</td>
                            <td class="subcategory-cell">Trực lãnh đạo</td>
                            <td>
                                <input 
                                    type="number" 
                                    name="leadership_duty" 
                                    value="{{ old('leadership_duty', ($model->leadership_duty) ?? '' ) }}" 
                                    class="text-right"
                                >
                            </td>
                        </tr>
                        <tr>
                            <td class="center">4</td>
                            <td class="category-cell">Vắng mặt</td>
                            <td class="text-right pr32 text-danger">
                                <input 
                                    type="number" 
                                    name="absent_personnel" 
                                    value="{{ old('absent_personnel', ($model->absent_personnel) ?? '' ) }}" 
                                    class="text-right"
                                >
                            </td>
                        </tr>
                        <tr>
                            <td class="center">4.1</td>
                            <td class="subcategory-cell">Học tập</td>
                            <td>
                                <input 
                                    type="number" 
                                    name="training_absence" 
                                    value="{{ old('training_absence', ($model->training_absence) ?? '' ) }}" 
                                    class="text-right"
                                >
                            </td>
                        </tr>
                        <tr>
                            <td class="center">4.2</td>
                            <td class="subcategory-cell">Nghỉ phép</td>
                            <td>
                                <input 
                                    type="number" 
                                    name="leave_absence" 
                                    value="{{ old('leave_absence', ($model->leave_absence) ?? '' ) }}" 
                                    class="text-right"
                                >
                            </td>
                        </tr>
                        <tr>
                            <td class="center">4.3</td>
                            <td class="subcategory-cell">Nghỉ bù</td>
                            <td>
                                <input 
                                    type="number" 
                                    name="compensatory_leave" 
                                    value="{{ old('compensatory_leave', ($model->compensatory_leave) ?? '' ) }}" 
                                    class="text-right"
                                >
                            </td>
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