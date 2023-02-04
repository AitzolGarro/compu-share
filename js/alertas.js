function alertTimeout(wait){
    setTimeout(function(){
        $('#alertas').children('.alert:first-child').remove();
    }, wait);
}