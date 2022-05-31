// JavaScript Document
/*
++++++++++++++++++++++++++++++++++++++++++++++++
+ Program Name : NYSC EDO Allowance Software   +
+ Programmer   : IKPEAMA CHUKWUDI KENNETH	   +
+ Phone Number : 08068450263				   +
+ Start Date   : 16TH MAY, 2013				   +
+ End Date     : 							   +
+ Place		   : AIRPORT ROAD BENIN CITY	   +
+ State Code   : ED/13A/0862			++++++++
+										+
+										+
+										+
+++++++++++++++++++++++++++++++++++++++++

*/
$(function(){
	var printpages = 'http://www/nedo/index.php/printpages'; // change according to base_url
	$(document).ajaxStart(function() {
				$('.dataTable').css({display:'none'});
                $('.loading').css({display:'block'});
            });
	$(document).ajaxStop(function() {
                $('.loading').css({display:'none'});
				$('.dataTable').css({display:'table'});
            });
	$('a#print').click(function(){
		month = $('select#mnt').val();
		bankID = $('#bank').val();
		splitBank = bankID.split(' ');
		joinBank = splitBank.join('-');
		branchName = $('#branch').val();
		splitBranch = branchName.split(' ');
		joinBranch = splitBranch.join('-');
		//linkAttr = $('a#print').attr('href');
		if(month == ''){
			alert('You must select a month before clicking on Print');
			return false;
		}
		if(bankID && branchName == 'all'){
		$('a#print').removeAttr('href');
		$('a#print').attr({href:printpages+'?bank='+joinBank+'&month='+month});
		}
		if(branchName && branchName != 'all'){
		$('a#print').removeAttr('href');
		$('a#print').attr({href:printpages+'?bank='+joinBank+'&branch='+joinBranch+'&month='+month});
		}
		return true;
		});
		
	$('select#bank').change(function(){
		var base_url = 'ajaxResponse/';
	bankID = $('#bank').val();
	month = $('select#mnt').val();
	if(bankID == 'all'){
		$('a#print').removeAttr('href');
		$('a#print').attr({href:printpages+'?bank=all&month='+month});
		$('select#branch').attr({disabled:'disabled'});
		$('select#branch option').nextAll().remove();
		window.location = '';
		return;
	}else{
		$('a#print').removeAttr('href');
		splitBank = bankID.split(' ');
		joinBank = splitBank.join('-')
		$('a#print').attr({href:printpages+'?bank='+joinBank+'&month='+month});
		$('select#branch option').nextAll().remove();
		$('select#branch').removeAttr('disabled');
		$.post(base_url+'changeBranch?bnk='+bankID,function(result){
			$('select#branch option').after(result);
				$.post(base_url+'changeData1?bnks='+bankID,function(data){
				$('.dataTable').remove();
				$('div.loading').after(data);
				});
				
			});
	}
		});
	$('select#branch').change(function(){
		var base_url = 'ajaxResponse/';
		month = $('select#mnt').val();
		branchName = $('#branch').val();
		bankName = $('#bank').val();
		splitBank = bankName.split(' ');
		joinBank = splitBank.join('-');
		splitBranch = branchName.split(' ');
		joinBranch = splitBranch.join('-');
		$('a#print').removeAttr('href');
		$('a#print').attr({href:printpages+'?bank='+joinBank+'&branch='+joinBranch+'&month='+month});
		$.post(base_url+'changeData2?branch='+branchName+'&bank='+bankName,function(data1){
				$('.dataTable').remove();
				$('div.loading').after(data1);
				});
		});
		
		$('form#edit').submit(function(){
			var conf = confirm('Are You sure you want to continue with updating this record?');
			if(conf === false){
				return false;
			}else
			return true;
			});
			
		$('a#clearance').click(function(){
		month = $('select#mnt').val();
		if(month == ''){
			alert('You must select a month before clicking');
			return false;
		}else{
			$.post('ajaxResponse/updateMonth',{m: month});
			return true;
		}
		});
		$('.clearanceTable tr').click(function(){
			if($(this).children(':eq(0)').find('input').is(':not(:checked)')){
				$(this).children(':eq(0)').find('input').attr('checked','checked');
				$(this).css('background-color','#DDFAFF');
			}else{
				$(this).children(':eq(0)').find('input').removeAttr('checked');
				$(this).css('background-color','#FFFFFF');
				$(this).removeAttr('style');
			}
			});
		$('.clearanceTable tr td input').click(function(){
			if($(this).is(':not(:checked)')){
				$(this).attr('checked','checked');
			}else{
				$(this).removeAttr('checked');
			}
			});
	
		$('.clearanceTable .tableHead').mouseover().css('background-color','#EEE');
		
		$('button#submitClearance').click(function(){
			$('form#clearanceForm').submit();
			});
		$('h1.clickBank').click(function(){
			if($(this).next('div').is(':hidden')){
				$(this).css({'border-bottom-width':'1px','border-bottom-style':'solid','border-bottom-color':'#D0D0D0'});
				$(this).next('div').slideDown(1000);
			}else{
				$(this).next('div').slideUp(500,function(){
					$('h1.clickBank').css({'border-bottom':'none'});
					});
			}
			});
	});
	
/*function changeBranch(){
	var bankID = $('#bank').val();
	if(bankID == 'all'){
		return;
	}else{
		$.post('ajaxResponse.php?action=changeBranch&bank='+bankID,function(result){
			$('select#branch').append(result);
			});
	}
}*/
function edit(id){
	ed = id.split('/');
	window.location = "index.php/edit/"+ed[2];
}