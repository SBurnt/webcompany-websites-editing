/*Подгрузка услуг на главной*/
$(document).ready(function(){
	var inProgress = false;
		$('body').on('click', '#services_index_load', function (event) {
		event.preventDefault();
		var dan;
		var st=$('#services_index_load').attr('start');
		var pr=$('#services_index_load').attr('parent');
		var ajax_url=$('#services_index_load').attr('ajax_url');
		dan="&start="+st+"&parent="+pr;
		
		if(!inProgress) {
			
			$.ajax({
				type: "GET",
				url: ajax_url,
				data: dan,
				beforeSend:function(){
					$(".spinner").show();
					inProgress = true;
				},
				success: function(msg){ 	
					$('.services_index').append(msg);
					$(".spinner").hide();
					$("#services_index_load").hide();
					
					inProgress = false;
				}
			});		
		}	
	});
});


/*Подгрузка товаров и изменение вида отображения товаров*/
$(document).ready(function(){
	var inProgress = false;
	var spinner = '<div class="spinner center"><img src="assets/templates/market/img/spinner.gif" alt=""></div>'
	/*Отображение в виде плитки*/
	$('.sorting-catalog-view .view a.block').on("click", function (event) {
		event.preventDefault();
		if ( !$(this).hasClass("active") ) {
			$(this).addClass("active");
			$('.sorting-catalog-view .view a.line').removeClass("active");
			$('.sorting-catalog-view .view a.list').removeClass("active");
			var dan;
			var st=$('#product_site').attr('start');
			var pr=$('#product_site').attr('parent');
			var tp=$('#product_site').attr('type');
			var total=$('#product_site').attr('total');
			var sortby=$('#product_site').attr('sort');
			var sortdir=$('#product_site').attr('sortdir');
			var ajax_url=$('#product_site').attr('ajax_url');
			var load_prod=0;
			st=0;
			$('#product_site').attr('type','table');
			tp='table';
			dan="&start="+st+"&parent="+pr+"&type="+tp+"&sort="+sortby+"&sortdir="+sortdir+"&total="+total+"&load_prod="+load_prod;
			
			var endd=$('#ajax_stop').val();
			if(!inProgress) {
				
				$.ajax({
					type: "GET",
					url: ajax_url,
					data: dan,
					beforeSend:function(){
						$('#product_cont').html(spinner);
						inProgress = true;
					},
					success: function(msg){ 	
						var suma;
						suma = parseInt(st) + parseInt(total);
						$('#product_site').attr('start',suma);
						$('#product_cont').html(msg);
						$(".spinner").hide();
						var endload=$('#ajax_stop').val();
						if(endload=='end'){$(".more-prod a.primary-button").hide();}
						
						inProgress = false;
					}
				});		
			}
		}
	});
	
	/*Отображение в виде списка*/
	$('.sorting-catalog-view .view a.line').on("click", function (event) {
		event.preventDefault();
		if ( !$(this).hasClass("active") ) {
			$(this).addClass("active");
			$('.sorting-catalog-view .view a.block').removeClass("active");
			$('.sorting-catalog-view .view a.list').removeClass("active");
			var dan;
			var st=$('#product_site').attr('start');
			var pr=$('#product_site').attr('parent');
			var tp=$('#product_site').attr('type');
			var total=$('#product_site').attr('total');
			var sortby=$('#product_site').attr('sort');
			var sortdir=$('#product_site').attr('sortdir');
			var ajax_url=$('#product_site').attr('ajax_url');
			var load_prod=0;
			st=0;
			$('#product_site').attr('type','line');
			tp='line';
			dan="&start="+st+"&parent="+pr+"&type="+tp+"&sort="+sortby+"&sortdir="+sortdir+"&total="+total+"&load_prod="+load_prod;
			
			var endd=$('#ajax_stop').val();
			if(!inProgress) {
				
				$.ajax({
					type: "GET",
					url: ajax_url,
					data: dan,
					beforeSend:function(){
						$('#product_cont').html(spinner);
						inProgress = true;
					},
					success: function(msg){ 	
						var suma;
						suma = parseInt(st) + parseInt(total);
						$('#product_site').attr('start',suma);
						$('#product_cont').html(msg);
						$(".spinner").hide();
						var endload=$('#ajax_stop').val();
						if(endload=='end'){$(".more-prod a.primary-button").hide();}
						
						inProgress = false;
					}
				});		
			}
		}
	});
	
	/*Отображение в виде листа*/
	$('.sorting-catalog-view .view a.list').on("click", function (event) {
		event.preventDefault();
		if ( !$(this).hasClass("active") ) {
			$(this).addClass("active");
			$('.sorting-catalog-view .view a.block').removeClass("active");
			$('.sorting-catalog-view .view a.line').removeClass("active");
			var dan;
			var st=$('#product_site').attr('start');
			var pr=$('#product_site').attr('parent');
			var tp=$('#product_site').attr('type');
			var total=$('#product_site').attr('total');
			var sortby=$('#product_site').attr('sort');
			var sortdir=$('#product_site').attr('sortdir');
			var ajax_url=$('#product_site').attr('ajax_url');
			var load_prod=0;
			st=0;
			$('#product_site').attr('type','list');
			tp='list';
			dan="&start="+st+"&parent="+pr+"&type="+tp+"&sort="+sortby+"&sortdir="+sortdir+"&total="+total+"&load_prod="+load_prod;
			
			var endd=$('#ajax_stop').val();
			if(!inProgress) {
				
				$.ajax({
					type: "GET",
					url: ajax_url,
					data: dan,
					beforeSend:function(){
						$('#product_cont').html(spinner);
						inProgress = true;
					},
					success: function(msg){ 	
						var suma;
						suma = parseInt(st) + parseInt(total);
						$('#product_site').attr('start',suma);
						$('#product_cont').html(msg);
						$(".spinner").hide();
						var endload=$('#ajax_stop').val();
						if(endload=='end'){$(".more-prod a.primary-button").hide();}
						
						inProgress = false;
					}
				});		
			}
		}
	});
	
	/*Отработка изменения количества отображаемых товаров*/
	$('.sorting-catalog-view .quantity a').on("click", function (event) {
		event.preventDefault();
		if ( !$(this).hasClass("active") ) {
			$('.sorting-catalog-view .quantity a').removeClass("active");
			$(this).addClass("active");
			var dan;
			var st=$('#product_site').attr('start');
			var pr=$('#product_site').attr('parent');
			var tp=$('#product_site').attr('type');
			var total=$('#product_site').attr('total');
			var sortby=$('#product_site').attr('sort');
			var sortdir=$('#product_site').attr('sortdir');
			var ajax_url=$('#product_site').attr('ajax_url');
			total=$(this).html();
			if(total=="Все"){
				total="all";
			}
			var load_prod=0;
			st=0;
			$('#product_site').attr('total',total);
			dan="&start="+st+"&parent="+pr+"&type="+tp+"&sort="+sortby+"&sortdir="+sortdir+"&total="+total+"&load_prod="+load_prod;
			
			var endd=$('#ajax_stop').val();
			if(!inProgress) {
				
				$.ajax({
					type: "GET",
					url: ajax_url,
					data: dan,
					beforeSend:function(){
						$('#product_cont').html(spinner);
						inProgress = true;
					},
					success: function(msg){ 	
						var suma;
						suma = parseInt(st) + parseInt(total);
						$('#product_site').attr('start',suma);
						$('#product_cont').html(msg);
						$(".spinner").hide();
						var endload=$('#ajax_stop').val();
						if(endload=='end'){$(".more-prod a.primary-button").hide();}
						
						inProgress = false;
					}
				});		
			}
		}
	});
	
		/*Отработка изменения сортировки товаров товаров*/
	$('.sorting-catalog-view .rate a').on("click", function (event) {
		event.preventDefault();
		if ( !$(this).hasClass("active") ) {
			$('.sorting-catalog-view .rate a').removeClass("active");
			$(this).addClass("active");
			var dan;
			var st=$('#product_site').attr('start');
			var pr=$('#product_site').attr('parent');
			var tp=$('#product_site').attr('type');
			var total=$('#product_site').attr('total');
			var sortby=$('#product_site').attr('sort');
			var sortdir=$('#product_site').attr('sortdir');
			var ajax_url=$('#product_site').attr('ajax_url');
			
			sortby = $(this).attr('id');

			if(sortby=="menuindex"){
				sortby="menuindex";
			}else if(sortby=="price"){
				sortby="new_price";
			}else{
				sortby="rating";
			}
			
			
			$('#product_site').attr('sort',sortby);
			
			if ( !$(this).hasClass("up") ) {
				sortdir="ASC";
			}else{
				sortdir="DESC";
			}
			
			$('#product_site').attr('sortdir',sortdir);
			
			var load_prod=0;
			st=0;
			
			dan="&start="+st+"&parent="+pr+"&type="+tp+"&sort="+sortby+"&sortdir="+sortdir+"&total="+total+"&load_prod="+load_prod;
			
			var endd=$('#ajax_stop').val();
			if(!inProgress) {
				
				$.ajax({
					type: "GET",
					url: ajax_url,
					data: dan,
					beforeSend:function(){
						$('#product_cont').html(spinner);
						inProgress = true;
					},
					success: function(msg){ 	
						var suma;
						suma = parseInt(st) + parseInt(total);
						$('#product_site').attr('start',suma);
						$('#product_cont').html(msg);
						$(".spinner").hide();
						var endload=$('#ajax_stop').val();
						if(endload=='end'){$(".more-prod a.primary-button").hide();}
						
						inProgress = false;
					}
				});		
			}
		}else{
			var dan;
			var st=$('#product_site').attr('start');
			var pr=$('#product_site').attr('parent');
			var tp=$('#product_site').attr('type');
			var total=$('#product_site').attr('total');
			var sortby=$('#product_site').attr('sort');
			var sortdir=$('#product_site').attr('sortdir');
			var ajax_url=$('#product_site').attr('ajax_url');
			
			sortby = $(this).attr('id');

			if(sortby=="menuindex"){
				sortby="menuindex";
			}else if(sortby=="price"){
				sortby="new_price";
			}else{
				sortby="rating";
			}
			
			$('#product_site').attr('sort',sortby);
			
			$(this).toggleClass('up down')
			
			if ( !$(this).hasClass("up") ) {
				sortdir="ASC";
			}else{
				sortdir="DESC";
			}
			
			$('#product_site').attr('sortdir',sortdir);
			
			var load_prod=0;
			st=0;
			
			dan="&start="+st+"&parent="+pr+"&type="+tp+"&sort="+sortby+"&sortdir="+sortdir+"&total="+total+"&load_prod="+load_prod;
			
			var endd=$('#ajax_stop').val();
			if(!inProgress) {
				
				$.ajax({
					type: "GET",
					url: ajax_url,
					data: dan,
					beforeSend:function(){
						$('#product_cont').html(spinner);
						inProgress = true;
					},
					success: function(msg){ 	
						var suma;
						suma = parseInt(st) + parseInt(total);
						$('#product_site').attr('start',suma);
						$('#product_cont').html(msg);
						$(".spinner").hide();
						var endload=$('#ajax_stop').val();
						if(endload=='end'){$(".more a.primary-button").hide();}
						
						inProgress = false;
					}
				});		
			}
		}
	});
	
});	

$(document).ready(function(){
	var inProgress = false;
	$('body').on('click', '#product_cont .more-prod a.primary-button', function (event) {
		event.preventDefault();
		var dan;
		var st=$('#product_site').attr('start');
		var pr=$('#product_site').attr('parent');
		var tp=$('#product_site').attr('type');
		var total=$('#product_site').attr('total');
		var sortby=$('#product_site').attr('sort');
		var sortdir=$('#product_site').attr('sortdir');
		var ajax_url=$('#product_site').attr('ajax_url');
		var load_prod=1;
		dan="&start="+st+"&parent="+pr+"&type="+tp+"&sort="+sortby+"&sortdir="+sortdir+"&total="+total+"&load_prod="+load_prod;
		
		var endd=$('#ajax_stop').val();
		if((!inProgress) && (endd != 'end')) {
			
			$.ajax({
				type: "GET",
				url: ajax_url,
				data: dan,
				beforeSend:function(){
					$(".spinner").show();
					inProgress = true;
				},
				success: function(msg){ 	
					var suma;
					suma = parseInt(st) + parseInt(total);
					$('#product_site').attr('start',suma);
					$('#product_cont>div:first-child').append(msg);
					$(".spinner").hide();
					var endload=$('#ajax_stop').val();
					if(endload=='end'){$(".more-prod a.primary-button").hide();}
					
					inProgress = false;
					
				}
			});		
		}	
	});
});

$(document).ready(function(){
	$('.sorting-catalog-view .sorting-select-mobile > select').change(function(event){
		event.preventDefault();
		var mobile_sort_type=$( ".sorting-catalog-view .sorting-select-mobile > select option:selected" ).val();
		switch (mobile_sort_type) {
			case 'sort_menuindex':
			$('.sorting-catalog-view .rate #menuindex').click();
			break;
			case 'sort_price':
			$('.sorting-catalog-view .rate #price').click();
			break;
			case 'sort_rating':
			$('.sorting-catalog-view .rate #rating').click();
			break;
			case 'count_12':
			$('.sorting-catalog-view .quantity a:first-of-type').click();
			break;
			case 'count_48':
			$('.sorting-catalog-view .quantity a:nth-of-type(2)').click();
			break;
			case 'count_all':
			$('.sorting-catalog-view .quantity a:last-of-type').click();
			break;
		}
	});	
});