(function($) {
    var arrCity ={#CITY#};
    var c={
        name : 'CY_',
		provNum: 0,
		linkGrade: false,
        prov : null,
        city : null,
        area : null,
        prov_func : null,
        city_func : null,
        area_func : null,
		areaShow:true
    };
    var CY = {
		//设置学校级联
		initSch: function(A,B,C){
			var a = $(A).val(),
				b = $(B).val(),
				c = $(C).val();
			switch(a){
				case '1160':
					if(c==36 || c==41){
						$(B).find('option').removeAttr('selected');
						$(C).hide();
						$(B+'Tip').html('');
					}
					break;
				default:
					if(c==40){
						$(B).find('option').removeAttr('selected');
						$(C).hide();
						$(B+'Tip').html('');	
					}
					break;
			}
		},

        domAdd: function(A,B) {
            var o = $(A).get(0);
            var ar=[];
            if (A==c.prov){
                o.name=c.name+'prov';
                var ar=c.provNum == 0 ? arrCity : arrCity.slice(0,c.provNum);
                o.onchange = function() {
                    if(null!==B){ CY.onCity(this); }
                    if(c.prov_func){ c.prov_func(this);}
                    CY.setValue();
					if(c.linkGrade)CY.initSch(A,'#J-identity','#grade');
                };
            }else if (A==c.city){
                o.name=c.name+'city';
                var T=$(c.prov).get(0).selectedIndex;
                var ar=arrCity[T].sub || [];
                o.onchange = function() {
                    if(null!==B){ CY.onCity(this); }
                    if(c.city_func){ c.city_func(this);}
                    CY.setValue();
                };
            }else if (A==c.area && c.areaShow){
                o.name=c.name+'area';
                var T=$(c.prov).get(0).selectedIndex;
                var Q=$(c.city).get(0).selectedIndex;
                var ar=arrCity[T].sub[Q].sub || [];
                o.onchange = function() {
                    if (c.area_func) {c.area_func(this); }
                    CY.setValue();
                };
            }

            o.options.length = 1;

            for (P in ar) {
                if (P == 0) continue;
                o.options[P] = new Option(ar[P].name, ar[P].id);
            }

            if (A==c.area){
                o.style.display=o.options.length<=1 ? 'none' : '';
            }

            //设置初始值
            var T=$(A).attr('CY');
            if (typeof(T) !=='undefined' && T.length>0) $(A).val(T);
            return o.selectedIndex;
        },
        onCity: function(A,B) {
            if ('#'+A.id==c.prov){
                if (null===c.city) return ;
                this.domAdd(c.city,c.area);
                if (null===c.area) return ;
                $(c.area).get(0).options.length=1;
                $(c.area).hide();
            }else if ('#'+A.id==c.city){
                if (null===c.area) return ;
                this.domAdd(c.area,null);
            }
        },
        setValue: function(){
            var P='',T='#'+c.name+'txt';
            P=this.getSecVal(c.prov)+' '+this.getSecVal(c.city)+' '+this.getSecVal(c.area);
            if ($(T).length<=0){
                $(c.prov).after('<input type="text" id="' +c.name+ 'txt" name="' +c.name+ 'txt" style="display:none;" />');
            }
            $(T).val($.trim(P));
        },
        getSecVal: function(A){
            var P='';
            if (null===A) return P;
            var T=$(A).get(0).selectedIndex;
            if (T>0) P=$(A).get(0)[T].text;
            return P;
        }
    }
    $.extend({
      CYinit: function(a){
        //赋值配置
        $.extend(c,a);
        if (null!==c.prov) c.prov='#'+c.prov;
        if (null!==c.city) c.city='#'+c.city;
        if (null!==c.area) c.area='#'+c.area;

        //一级联动
        var T = CY.domAdd(c.prov,c.city);

        if (null!==c.city && T>0){
            var T = CY.domAdd(c.city,c.area);
            if (null!==c.area && T>0) var T = CY.domAdd(c.area,null);
        }

        if (null!==c.area && $(c.area).get(0).options.length<=1){
            $(c.area).hide();
        }
        CY.setValue();
      }
    });

})(jQuery);