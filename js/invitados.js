$(function(){
    /* -------------------------------------------------------------------------- */
    /*                             MODAL DE COLOR BOX                             */
    /* -------------------------------------------------------------------------- */
    if(window.matchMedia("(max-width:800px)").matches){
        $('.invitado-info').colorbox({inline:true, width:"95%"});
    }else{
        $('.invitado-info').colorbox({inline:true, width:"50%"});
    }
})