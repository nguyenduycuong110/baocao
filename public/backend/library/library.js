(function($) {
	"use strict";
	var HT = {}; 
    var _token = $('meta[name="csrf-token"]').attr('content');

    HT.switchery = () => {
        $('.js-switch').each(function(){
            // let _this = $(this)
            var switchery = new Switchery(this, { color: '#1AB394', size: 'small'});
        })
    }

    HT.select2 = () => {
        if($('.setupSelect2').length){
            $('.setupSelect2').select2();
        }
        
    }

    HT.sortui = () => {
        $( "#sortable" ).sortable();
		$( "#sortable" ).disableSelection();
    }

    HT.changeStatus = () => {
        $(document).on('change', '.status', function(e){

            let _this = $(this)
            let option = {
                'value' : _this.val(),
                'modelId' : _this.attr('data-modelId'),
                'model' : _this.attr('data-model'),
                'field' : _this.attr('data-field'),
                '_token' : _token
            }

            $.ajax({
                url: 'ajax/dashboard/changeStatus', 
                type: 'POST', 
                data: option,
                dataType: 'json', 
                success: function(res) {
                    let inputValue = ((option.value == 1)?2:1)
                    if(res.flag == true){
                        _this.val(inputValue)
                    }
                  
                },
                error: function(jqXHR, textStatus, errorThrown) {
                  
                  console.log('Lỗi: ' + textStatus + ' ' + errorThrown);
                }
            });

            e.preventDefault()
        })
    }

    HT.changeStatusAll = () => {
        if($('.changeStatusAll').length){
            $(document).on('click', '.changeStatusAll', function(e){
                let _this = $(this)
                let id = []
                $('.checkBoxItem').each(function(){
                    let checkBox = $(this)
                    if(checkBox.prop('checked')){
                        id.push(checkBox.val())
                    }
                })

                let option = {
                    'value' : _this.attr('data-value'),
                    'model' : _this.attr('data-model'),
                    'field' : _this.attr('data-field'),
                    'id'    : id,
                    '_token' : _token
                }

                $.ajax({
                    url: 'ajax/dashboard/changeStatusAll', 
                    type: 'POST', 
                    data: option,
                    dataType: 'json', 
                    success: function(res) {
                        if(res.flag == true){
                            let cssActive1 = 'background-color: rgb(26, 179, 148); border-color: rgb(26, 179, 148); box-shadow: rgb(26, 179, 148) 0px 0px 0px 16px inset; transition: border 0.4s ease 0s, box-shadow 0.4s ease 0s, background-color 1.2s ease 0s;';
                            let cssActive2 = 'left: 13px; background-color: rgb(255, 255, 255); transition: background-color 0.4s ease 0s, left 0.2s ease 0s;';
                            let cssUnActive = 'background-color: rgb(255, 255, 255); border-color: rgb(223, 223, 223); box-shadow: rgb(223, 223, 223) 0px 0px 0px 0px inset; transition: border 0.4s ease 0s, box-shadow 0.4s ease 0s;'
                            let cssUnActive2 = 'left: 0px; transition: background-color 0.4s ease 0s, left 0.2s ease 0s;'

                            for(let i = 0; i < id.length; i++){
                                if(option.value == 2){
                                    $('.js-switch-'+id[i]).find('span.switchery').attr('style', cssActive1).find('small').attr('style', cssActive2)
                                }else if(option.value == 1){
                                    $('.js-switch-'+id[i]).find('span.switchery').attr('style', cssUnActive).find('small').attr('style', cssUnActive2)
                                }
                            }
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                      
                      console.log('Lỗi: ' + textStatus + ' ' + errorThrown);
                    }
                });

                e.preventDefault()
            })
        }
    }

    HT.checkAll = () => {
        if($('#checkAll').length){
            $(document).on('click', '#checkAll', function(){
                let isChecked = $(this).prop('checked')
                $('.checkBoxItem').prop('checked', isChecked);
                $('.checkBoxItem').each(function(){
                    let _this = $(this)
                    HT.changeBackground(_this)
                })
            })
        }
    }

    HT.checkBoxItem = () => {
        if($('.checkBoxItem').length){
            $(document).on('click', '.checkBoxItem', function(){
                let _this = $(this)
                HT.changeBackground(_this)
                HT.allChecked()
            })
        }
    }

    HT.changeBackground = (object) => {
        let isChecked = object.prop('checked')
        if(isChecked){
            object.closest('tr').addClass('active-bg')
        }else{
            object.closest('tr').removeClass('active-bg')
        }
    }

    HT.allChecked = () => {
        let allChecked = $('.checkBoxItem:checked').length === $('.checkBoxItem').length;
        $('#checkAll').prop('checked', allChecked);
    }

    HT.int = () => {
        $(document).on('change keyup blur', '.int', function(){
            let value = $(this).val().replace(/,/gi, "")
            if(value === '' || isNaN(value)) {
                $(this).val('0')
            } else {
                $(this).val(value.replace(/\B(?=(\d{3})+(?!\d))/g, ','))
            }
        })

        $(document).on('keydown', '.int', function(e){
            if($(this).val() == 0 && e.keyCode != 188) {
                $(this).val('')
            }
        })
    }

    HT.float = () => {
        $(document).on('change keyup blur', '.float', function(){
            let _this = $(this)
            let value = _this.val()
            
            // Nếu rỗng thì set về 0
            if(value === ''){
                _this.val('0')
                return
            }
            
            // Loại bỏ các ký tự không phải số và dấu chấm
            value = value.replace(/[^0-9.]/g, "")
            
            // Xử lý nhiều dấu chấm - chỉ giữ lại dấu chấm đầu tiên
            let parts = value.split('.')
            if(parts.length > 2) {
                value = parts[0] + '.' + parts.slice(1).join('')
            }
            
            // Nếu bắt đầu bằng dấu chấm, thêm 0 phía trước
            if(value.startsWith('.')) {
                value = '0' + value
            }
            
            // Kiểm tra và format số
            if(isNaN(parseFloat(value))) {
                _this.val('0')
                return
            }
            
            // Tách phần nguyên và phần thập phân
            let [integerPart, decimalPart] = value.split('.')
            
            // Format phần nguyên với dấu phẩy
            if(integerPart) {
                integerPart = HT.addCommas(integerPart)
            }
            
            // Ghép lại
            let formattedValue = integerPart
            if(decimalPart !== undefined) {
                formattedValue += '.' + decimalPart
            }
            
            _this.val(formattedValue)
        })
        
        $(document).on('keydown', '.float', function(e){
            let _this = $(this)
            let data = _this.val()
            let unicode = e.keyCode || e.which
            
            // Nếu giá trị hiện tại là 0 và không phải phím dấu chấm (190) thì xóa
            if(data == '0' && unicode != 190) {
                _this.val('')
            }
            
            // Ngăn nhập dấu chấm thứ 2
            if(unicode == 190) { // Phím dấu chấm
                if(data.indexOf('.') !== -1) {
                    e.preventDefault()
                    return false
                }
            }
            
            // Chỉ cho phép số, dấu chấm, backspace, delete, tab, escape, enter, arrow keys
            if ($.inArray(unicode, [46, 8, 9, 27, 13, 37, 39, 190]) !== -1 ||
                // Cho phép Ctrl+A, Ctrl+C, Ctrl+V, Ctrl+X
                (unicode == 65 && e.ctrlKey === true) ||
                (unicode == 67 && e.ctrlKey === true) ||
                (unicode == 86 && e.ctrlKey === true) ||
                (unicode == 88 && e.ctrlKey === true) ||
                // Cho phép số từ 0-9
                (unicode >= 48 && unicode <= 57) ||
                // Cho phép số từ numpad
                (unicode >= 96 && unicode <= 105)) {
                    return
            } else {
                e.preventDefault()
            }
        })
    }

    HT.intCid = () => {
        $(document).on('change keyup blur', '.cid', function(){
            let _this = $(this)
            let value = _this.val()
            if(value === ''){
                $(this).val('0')
            }
            value = value.replace(/\./gi, "")
            // _this.val(HT.addCommas(value))
            if(isNaN(value)){
                _this.val('0')
            }
        })

        $(document).on('keydown', '.cid', function(e){
            let _this = $(this)
            let data = _this.val()
            if(data == 0){
                let unicode = e.keyCode || e.which;
                if(unicode != 190){
                    _this.val('')
                }
            }
        })
    }

    HT.addCommas = (nStr) => { 
        nStr = String(nStr);
        nStr = nStr.replace(/\./gi, "");
        let str ='';
        for (let i = nStr.length; i > 0; i -= 3){
            let a = ( (i-3) < 0 ) ? 0 : (i-3);
            str= nStr.slice(a,i) + '.' + str;
        }
        str= str.slice(0,str.length-1);
        return str;
    }

    HT.setupDatepicker = () => {
        // Khởi tạo tất cả .datepicker
        const $allDatepickers = $('.datepicker');
        if ($allDatepickers.length) {
            $allDatepickers.datetimepicker({
                timepicker: true,
                format: 'd/m/Y',
            });
        }
    
        const $colLg6Datepickers = $('.datepicker');
        if ($colLg6Datepickers.length) {
            const today = new Date();
            const currentDate = today.getDate().toString().padStart(2, '0') + '/' + 
                (today.getMonth() + 1).toString().padStart(2, '0') + '/' + 
                today.getFullYear(); 
    
            $colLg6Datepickers.each(function() {
                const $input = $(this);
                if (!$input.val()) {
                    $input.val(currentDate);
                }
            });
        }
    };


    HT.setupDateRangePicker = () => {
        if($('.rangepicker').length > 0){
            $('.rangepicker').daterangepicker({
                timePicker: true,
                locale: {
                    format: 'dd-mm-yy'
                }
            })
        }
    }

    HT.triggerDate = () => {
        $(document).ready(function() {
            var today = new Date();
            var day = String(today.getDate()).padStart(2, '0');
            var month = String(today.getMonth() + 1).padStart(2, '0'); // Tháng bắt đầu từ 0
            var year = today.getFullYear();
            var currentDate = day + '/' + month + '/' + year;
            if ($('#date').val() === '') {
                $('#date').val(currentDate);
            }
        });
    };

    HT.rowCount = 2;

    HT.addTr = () => {
        $(document).on('click', '.btn-add button', function(e){
            e.preventDefault()
            let html  = ``
            html += `
                <tr>
                    <td class="center">${HT.rowCount}</td>
                    <td>
                        <input 
                            type="text" 
                            name="merchandise_products[name][]" 
                            value=""
                            class="text-right"
                        >
                    </td>
                    <td></td>
                    <td>
                        <input 
                            type="text" 
                            name="merchandise_products[value][]" 
                            value=""
                            class="text-right int-usd"
                        >
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="delete">
                        <button class="btn btn-danger">
                            <i class="fa fa-trash"></i>
                        </button>
                    </td>
                </tr>
            `;
            $('table tbody tr.unit-row:first').before(html)
            HT.rowCount++;
        })
    }

    HT.deleteTr = () => {
        $(document).on('click', '.delete button', function(e){
            e.preventDefault()
            let _this = $(this)
            _this.closest('tr').remove()
        })
    }

    HT.calculatePerson = () => {
    // Hàm helper để lấy giá trị số từ input (loại bỏ dấu phân cách)
    const getNumericValue = (selector) => {
        let element = $(selector);
        let value = element.val() || '0';
        
        // Debug log
        console.log('Selector:', selector);
        console.log('Element found:', element.length);
        console.log('Raw value:', value);
        
        // Loại bỏ dấu chấm phân cách hàng nghìn
        value = value.replace(/\./gi, "");
        let numericValue = parseInt(value) || 0;
        
        console.log('Processed value:', numericValue);
        console.log('---');
        
        return numericValue;
    }

    // Hàm helper để set giá trị có format cho input
    const setFormattedValue = (selector, value) => {
        $(selector).val(HT.addCommas(value.toString()));
    }

    // Hàm tính toán chính
    const calculate = () => {
        // Lấy các giá trị đầu vào
        let leadership_duty = getNumericValue('input[name="leadership_duty"]');
        let present_cbcc = getNumericValue('input[name="present_cbcc"]');
        let training_absence = getNumericValue('input[name="training_absence"]');
        let leave_absence = getNumericValue('input[name="leave_absence"]');
        let compensatory_leave = getNumericValue('input[name="compensatory_leave"]');

        // Tính toán theo công thức
        // 2 = 2.1 + 2.2 (present_personnel = leadership_duty + present_cbcc)
        let present_personnel = leadership_duty + present_cbcc;
        
        // 3 = 3.1 + 3.2 + 3.3 (absent_personnel = training_absence + leave_absence + compensatory_leave)
        let absent_personnel = training_absence + leave_absence + compensatory_leave;
        
        // Tổng quân số = 2 + 3 (total_unit_personnel = present_personnel + absent_personnel)
        let total_unit_personnel = present_personnel + absent_personnel;

        // Cập nhật các input readonly
        setFormattedValue('input[name="present_personnel"]', present_personnel);
        setFormattedValue('input[name="absent_personnel"]', absent_personnel);
        setFormattedValue('input[name="total_unit_personnel"]', total_unit_personnel);
    }

    // Gắn sự kiện cho các input có thể thay đổi
    const bindEvents = () => {
        const inputSelectors = [
            'input[name="leadership_duty"]',
            'input[name="present_cbcc"]', 
            'input[name="training_absence"]',
            'input[name="leave_absence"]',
            'input[name="compensatory_leave"]'
        ];

        inputSelectors.forEach(selector => {
            $(document).on('keyup change blur', selector, function() {
                // Thêm delay nhỏ để đảm bảo giá trị đã được format bởi HT.int()
                setTimeout(calculate, 100);
            });
        });
    }

    // Khởi tạo - chỉ bind events, không tính toán lần đầu
    bindEvents();
    }


    HT.exportExcel = () => {
        $(document).on('click', '.btn-export', function(e){
            e.preventDefault()
            let _this = $(this)
            let exportType = _this.val()
            const dateType = $('.date-type').val()
            let date = (dateType === 'month') ? $('.evaluation-time').val() : $('.evaluation-day').val() ;
            let option = {date : date}
            HT.setupDataForExport(exportType, option);
        })

    }

    HT.setupDataForExport = (type, option) => {
        const loadingOverlay = $('<div class="loading-overlay">Đang tải file...</div>');
        $('body').append(loadingOverlay);
        $.ajax({
            url: 'ajax/report/export', 
            type: 'POST', 
            data: {
                ...option,
                _token: $('meta[name="csrf-token"]').attr('content') 
            },
            dataType: 'json', 
            success: function(res) {
                if (res.status === 'success') {
                    const link = document.createElement('a');
                    link.href = res.file_url;
                    link.download = res.filename;
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                } else {
                    console.error('Error:', res.message);
                }
    
                loadingOverlay.remove();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('AJAX Error:', textStatus, errorThrown);
                loadingOverlay.remove();
            }
        });
    }

    HT.checkAllPermission = () => {
        if ($('#checkAllPermission').length) {
            $('#checkAllPermission').on('change', function() {
                let isChecked = $(this).prop('checked');
                
                $('.checkBoxPermissionItem').each(function() {
                    if (isChecked) {
                        $(this).attr('checked', 'checked');
                        $(this).prop('checked', true);
                    } else {
                        $(this).removeAttr('checked');
                        $(this).prop('checked', false);
                    }
                });
            });
        }
    };


    // HT.intUsd = () => {
    //     $(document).on('input', '.int-usd', function(){
    //         let _this = $(this)
    //         let cursorPos = this.selectionStart
    //         let value = _this.val().replace(/,/g, "")
            
    //         if(value === '' || isNaN(value)) {
    //             _this.val('0.00')
    //         } else {
    //             let num = parseFloat(value).toFixed(2)
    //             let formatted = num.replace(/\B(?=(\d{3})+(?!\d))/g, ',')
    //             _this.val(formatted)
                
    //             // Điều chỉnh vị trí con trở lại
    //             let newPos = cursorPos + (formatted.length - _this.val().replace(formatted, _this.val()).length)
    //             this.setSelectionRange(newPos, newPos)
    //         }
    //     })
        
    //     $(document).on('focus', '.int-usd', function(){
    //         if($(this).val() == '0.00') {
    //             $(this).select()
    //         }
    //     })
    // }

    HT.intUsd = () => {
        $(document).on('input', '.int-usd', function(e){
            let _this = $(this);
            let cursorPos = this.selectionStart;
            let value = _this.val();
            
            // Chỉ cho phép số, dấu chấm và dấu phẩy
            value = value.replace(/[^0-9.,]/g, '');
            
            // Tách phần nguyên và phần thập phân
            let parts = value.split('.');
            let integerPart = parts[0].replace(/,/g, ''); // Loại bỏ dấu phẩy cũ
            let decimalPart = parts[1] || '';
            
            // Giới hạn phần thập phân chỉ 2 chữ số
            if (decimalPart.length > 2) {
                decimalPart = decimalPart.substring(0, 2);
            }
            
            // Nếu không có số nào thì đặt về 0
            if (integerPart === '') {
                integerPart = '0';
            }
            
            // Thêm dấu phẩy cho phần nguyên (thousand separator)
            if (integerPart !== '0' || value.includes('.')) {
                integerPart = parseInt(integerPart, 10).toLocaleString('en-US');
            }
            
            // Tạo giá trị cuối cùng
            let formattedValue = integerPart;
            if (parts.length > 1 || value.endsWith('.')) {
                formattedValue += '.' + decimalPart;
            }
            
            // Cập nhật giá trị
            _this.val(formattedValue);
            
            // Điều chỉnh vị trí con trỏ
            let lengthDiff = formattedValue.length - value.length;
            let newPos = Math.min(cursorPos + lengthDiff, formattedValue.length);
            this.setSelectionRange(newPos, newPos);
        });
        
        $(document).on('focus', '.int-usd', function(){
            let _this = $(this);
            if (_this.val() === '' || _this.val() === '0' || _this.val() === '0.00') {
                _this.val('');
            }
        });
        
        $(document).on('blur', '.int-usd', function(){
            let _this = $(this);
            let value = _this.val();
            
            if (value === '' || value === '0') {
                _this.val('0.00');
            } else if (value.includes('.')) {
                // Đảm bảo có đủ 2 chữ số thập phân
                let parts = value.split('.');
                let decimalPart = parts[1] || '00';
                if (decimalPart.length === 1) {
                    decimalPart += '0';
                }
                _this.val(parts[0] + '.' + decimalPart);
            } else {
                // Thêm .00 nếu không có phần thập phân
                _this.val(value + '.00');
            }
        });
        
        // Xử lý phím Backspace và Delete
        $(document).on('keydown', '.int-usd', function(e){
            let _this = $(this);
            
            // Cho phép các phím điều khiển
            if (e.ctrlKey || e.altKey || e.metaKey || 
                [8, 9, 27, 13, 46, 35, 36, 37, 38, 39, 40].includes(e.keyCode)) {
                return;
            }
            
            // Chỉ cho phép số và dấu chấm
            if ((e.keyCode < 48 || e.keyCode > 57) && 
                (e.keyCode < 96 || e.keyCode > 105) && 
                e.keyCode !== 190 && e.keyCode !== 110) {
                e.preventDefault();
            }
            
            // Chỉ cho phép một dấu chấm
            if ((e.keyCode === 190 || e.keyCode === 110) && _this.val().includes('.')) {
                e.preventDefault();
            }
        });
    };


	$(document).ready(function(){
        HT.intUsd()
        HT.checkAllPermission()
        HT.exportExcel()
        HT.deleteTr()
        HT.addTr()
        HT.triggerDate()
        HT.switchery()
        HT.select2()
        HT.changeStatus()
        HT.checkAll()
        HT.checkBoxItem()
        HT.allChecked()
        HT.changeStatusAll()
        HT.sortui()
        HT.int()
        HT.intCid()
        HT.setupDatepicker()
        HT.setupDateRangePicker()
        HT.float()
        HT.calculatePerson()
        
	});

})(jQuery);


addCommas = (nStr) => { 
    nStr = String(nStr);
    nStr = nStr.replace(/\./gi, "");
    let str ='';
    for (let i = nStr.length; i > 0; i -= 3){
        let a = ( (i-3) < 0 ) ? 0 : (i-3);
        str= nStr.slice(a,i) + '.' + str;
    }
    str= str.slice(0,str.length-1);
    return str;
}