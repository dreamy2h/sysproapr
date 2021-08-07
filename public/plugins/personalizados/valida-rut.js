var Fn = {
    // Valida el rut con su cadena completa "XXXXXXXX-X"
    validaRut : function (rutCompleto) {
        var rutCompleto_ =  rutCompleto.replace(/\./g, "");        if (!/^[0-9]+[-|‐]{1}[0-9kK]{1}$/.test( rutCompleto_ ))
            return false;
        var tmp     = rutCompleto_.split('-');
        var digv    = tmp[1]; 
        var rut     = tmp[0];
        if ( digv == 'K' ) digv = 'k' ;
        return (Fn.dv(rut) == digv );
    },
    dv : function(T){
        var M=0,S=1;
        for(;T;T=Math.floor(T/10))
            S=(S+T%10*(9-M++%6))%11;
        return S?S-1:'k';
    },
    formatear : function(rut){
        var tmp = this.quitar_formato(rut);
        var rut = tmp.substring(0, tmp.length - 1), f = "";
        while(rut.length > 3) {
            f = '.' + rut.substr(rut.length - 3) + f;
            rut = rut.substring(0, rut.length - 3);
        }
        return ($.trim(rut) == '') ? '' : rut + f + "-" + tmp.charAt(tmp.length-1);
    },
    quitar_formato : function(rut){
        rut = rut.split('-').join('').split('.').join('');
        return rut;
    }
}