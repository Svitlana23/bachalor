$("input[name=send]").click(function () { // Событие нажатия на кнопку "Расчёт" 
    var F = $("input[name=F]").val() * 1; 
    var V0 = $("input[name=V0]").val() * 1;
    var a0 = $("input[name=a0]").val() * 1; 
    var b0 = $("input[name=b0]").val() * 1; 
    var b ; 
    var h0 = $("input[name=h0]").val() * 1;
    var J = $("input[name=J]").val() * 1; 
    var h3;  
    var S0;
        S0=0.5*(a0+b0)*h0;   
    var Q0;
        Q0=V0*S0;
    var Qmax;
        Qmax=Q0+(J*F)/3.6;
    var ctg;
        ctg=(b0-a0)/(2*h0);
        h=Math.pow((2*Qmax*Math.pow(((b0-a0)/(ctg+ctg)),5/3)/(b0*V0)),3/8)-(b0-a0)/(ctg+ctg);
        var Smax;
        b=a0+2*h*ctg;    
        Smax=0.5*(a0+b)*h;
    var Vmax=Qmax/Smax;
        h3=h-h0;
        var M=2;
    var f;
        if((h3/h)<=0.1)
            {
              f=0.3;  
            }
        else if((h3/h)<=0.2)
            {
              f=0.5;  
            }
        else if((h3/h)<=0.4)
            {
              f=0.72;  
            }
        else if((h3/h)<=0.6)
            {
              f=0.96;  
            }
        else if((h3/h)<=0.8)
            {
              f=1.17;  
            }
        else if((h3/h)<=1)
            {
              f=1.32;  
            }
    var V3;
        V3=Vmax*f;
        var res1,res2;
        res1=h3.toFixed(2);
        res2=V3.toFixed(2);
    $("input[name=h3]").val(res1); 
    $("input[name=V3]").val(res2);
});
