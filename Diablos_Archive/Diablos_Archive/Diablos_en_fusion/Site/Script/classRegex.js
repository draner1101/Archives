//VALIDATIONS - CLASS
jQuery(function($){
   $.mask.definitions['~']='[A-Za-z éÉÈèêÊîÎàÀÇç\']';
   $.mask.definitions['*']='[A-Za-z0-9 éÉÈèêÊîÎàÀÇç-]';
   $.mask.definitions['^']='[0-3]';
   $.mask.definitions['#']='[0-1]';
   $.mask.definitions['<']='[1-2]';
   $.mask.definitions['>']='[A-Za-z0-9 éÉÈèêÊîÎ@.àÀ/_Çç-]';
   $(".regexCourriel").mask(">>?>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>",{placeholder:""});
   $(".regexRecherche").mask("?>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>",{placeholder:""});
   $(".regexDaNa").mask("<999/#9/^9",{placeholder:"AAAA/MM/JJ"});
   $(".regexSaison").mask("<999-<999");
   $(".regexTel").mask("(999) 999-9999",{placeholder:"(___) ___-____"});
   $(".regexCoPo").mask("a9a 9a9",{placeholder:" "});
   $(".regexNom").mask("~~?~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~",{placeholder:""});
   $(".regexRue").mask("*******?************************************************************************************",{placeholder:""});
   $(".regexNomEqu").mask("***?**********************",{placeholder:""});
   $(".regexNum").mask("9?9",{placeholder:""});
   $(".regexTaiPoi").mask("99?9",{placeholder:""});
   $(".regexNote").mask("~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~",{placeholder:""});
   $(".regexAn").mask("<999",{placeholder:"AAAA"});
});
