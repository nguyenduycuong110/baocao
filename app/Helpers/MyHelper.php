<?php  

if(!function_exists('convertDateTime')){
    function convertDateTime(string $date = '', string $format = 'd/m/Y H:i', string $inputDateFormat = 'Y-m-d H:i:s'){
       $carbonDate = \Carbon\Carbon::createFromFormat($inputDateFormat, $date);

       return $carbonDate->format($format);
    }
}

if(!function_exists('convert_price')){
    function convert_price(mixed $price = '', $flag = false){
        if($price === null) return 0;
        return ($flag === false) ? str_replace(',','', $price) : number_format($price, 0, '.', ',');
    }
}

if(!function_exists('convert_price_usd')) {
    function convert_price_usd(mixed $price = '', $flag = false) {
        if($price === null || $price === '') return 0;
        
        if($flag === false) {
            $cleanPrice = str_replace(',', '', $price);
            return (float)$cleanPrice;
        }
        else {
            $numericPrice = (float)$price;
            return number_format($numericPrice, 2, '.', ',');
        }
    }
}