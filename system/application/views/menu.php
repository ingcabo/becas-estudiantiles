<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<meta http-equiv="Content-Language" content="en" /> 
<link rel="stylesheet" type="text/css" href="<?php  echo base_url(); ?>system/application/views/css/example1.css" /> 
<script type="text/javascript" src="<?php  echo base_url(); ?>system/application/views/js/DropMenuX.js"></script> 

<style type="text/css">


/*!!!!!!!!!!! MyCSSMenu Core CSS [Do Not Modify!] !!!!!!!!!!!!!*/
qmmc .qmdivider{display:block;font-size:1px;border-width:0px;border-style:solid;position:relative;z-index:1;}.qmmc .qmdividery{float:left;width:0px;}.qmmc .qmtitle{display:block;cursor:default;white-space:nowrap;position:relative;z-index:1;}.qmclear {font-size:1px;height:0px;width:0px;clear:left;line-height:0px;display:block;float:none !important;}.qmmc {position:relative;zoom:1;z-index:10;}.qmmc a, .qmmc li {float:left;display:block;white-space:nowrap;position:relative;z-index:1;}.qmmc div a, .qmmc ul a, .qmmc ul li {float:none;}.qmsh div a {float:left;}.qmmc div{visibility:hidden;position:absolute;}.qmmc li {z-index:auto;}.qmmc ul {left:-10000px;position:absolute;z-index:10;}.qmmc, .qmmc ul {list-style:none;padding:0px;margin:0px;}.qmmc li a {float:none}.qmmc li:hover>ul{left:auto;}#qm0 ul {top:100%;}#qm0 ul li:hover>ul{top:0px;left:100%;}


/*!!!!!!!!!!! MyCSSMenu Styles [Please Modify!] !!!!!!!!!!!*/


	/* MyCSSMenu 0 */

	.mmenu {
	margin:auto;
	text-align:center;
	}

	/*"""""""" (MAIN) Container""""""""*/	
	#qm0	
	{	
		background-color:#FFFFFF;
		background-image:url(<?php echo base_url(); ?>system/application/views/imagenes/bg_main.jpg);
		border-width:0px 0px 0px 0px;
		border-style:solid;
		border-color:#000000;
		width:950px;
		text-align:left;
		z-index:100;
		margin:auto;
	}


	/*"""""""" (MAIN) Items""""""""*/	
	#qm0 a	
	{	
		padding:4px 20px 5px 8px;
		background-color:transparent;
		color:#FFFFFF;
		font-family:Arial;
		font-size:12px;
		text-decoration:none;
		border-width:0px 0px 0px 0px;
		border-style:solid;
		border-color:#000000;
	}


	/*"""""""" (MAIN) Hover State""""""""*/	
	#qm0 a:hover	
	{	
		background-color:#EFF4FA;
		color:#000000;
		text-decoration:underline;
	}


	/*"""""""" (MAIN) Active State""""""""*/	
	body #qm0 .qmactive, body #qm0 .qmactive:hover	
	{	
		background-color:#EFF4FA;
		color:#000000;
		text-decoration:underline;
	}


	/*"""""""" (SUB) Container""""""""*/	
	#qm0 div, #qm0 ul	
	{	
		padding:5px;
		margin:0px;
		background-color:#D6DCE2;
		border-width:1px;
		border-style:solid;
		border-color:#333333;
	}


	/*"""""""" (SUB) Items""""""""*/	
	#qm0 div a, #qm0 ul a	
	{	
		padding:3px 30px 3px 5px;
		color:#333333;
		font-size:11px;
		border-width:0px 1px 0px 1px;
		border-style:solid;
		border-color:#D6DCE2;
	}


	/*"""""""" (SUB) Hover State""""""""*/	
	#qm0 div a:hover, #qm0 ul a:hover	
	{	
		background-color:#EFF4FA;
		color:#000000;
		text-decoration:none;
		border-color:#666666;
	}


	/*"""""""" (SUB) Active State""""""""*/	
	body #qm0 div .qmactive, body #qm0 div .qmactive:hover	
	{	
		background-color:#EFF4FA;
		color:#000000;
		text-decoration:underline;
		border-color:#666666;
	}


</style><!-- Core MyCSSMenu Code -->
<script type="text/javascript">/* <![CDATA[ */var qm_si,qm_li,qm_lo,qm_tt,qm_th,qm_ts,qm_la,qm_ic,qm_ib;var qp="parentNode";var qc="className";var qm_t=navigator.userAgent;var qm_o=qm_t.indexOf("Opera")+1;var qm_s=qm_t.indexOf("afari")+1;var qm_s2=qm_s&&qm_t.indexOf("ersion/2")+1;var qm_s3=qm_s&&qm_t.indexOf("ersion/3")+1;var qm_n=qm_t.indexOf("Netscape")+1;var qm_v=parseFloat(navigator.vendorSub);;function qm_create(sd,v,ts,th,oc,rl,sh,fl,ft,aux,l){var w="onmouseover";var ww=w;var e="onclick";if(oc){if(oc=="all"||(oc=="lev2"&&l>=2)){w=e;ts=0;}if(oc=="all"||oc=="main"){ww=e;th=0;}}if(!l){l=1;qm_th=th;sd=document.getElementById("qm"+sd);if(window.qm_pure)sd=qm_pure(sd);sd[w]=function(e){qm_kille(e)};document[ww]=qm_bo;if(oc=="main"){qm_ib=true;sd[e]=function(event){qm_ic=true;qm_oo(new Object(),qm_la,1);qm_kille(event)};document.onmouseover=function(){qm_la=null;clearTimeout(qm_tt);qm_tt=null;};}sd.style.zoom=1;if(sh)x2("qmsh",sd,1);if(!v)sd.ch=1;}else  if(sh)sd.ch=1;if(oc)sd.oc=oc;if(sh)sd.sh=1;if(fl)sd.fl=1;if(ft)sd.ft=1;if(rl)sd.rl=1;sd.style.zIndex=l+""+1;var lsp;var sp=sd.childNodes;for(var i=0;i<sp.length;i++){var b=sp[i];if(b.tagName=="A"){lsp=b;b[w]=qm_oo;if(w==e)b.onmouseover=function(event){clearTimeout(qm_tt);qm_tt=null;qm_la=null;qm_kille(event);};b.qmts=ts;if(l==1&&v){b.style.styleFloat="none";b.style.cssFloat="none";}}else  if(b.tagName=="DIV"){if(window.showHelp&&!window.XMLHttpRequest)sp[i].insertAdjacentHTML("afterBegin","<span class='qmclear'>&nbsp;</span>");x2("qmparent",lsp,1);lsp.cdiv=b;b.idiv=lsp;if(qm_n&&qm_v<8&&!b.style.width)b.style.width=b.offsetWidth+"px";new qm_create(b,null,ts,th,oc,rl,sh,fl,ft,aux,l+1);}}};function qm_bo(e){qm_ic=false;qm_la=null;clearTimeout(qm_tt);qm_tt=null;if(qm_li)qm_tt=setTimeout("x0()",qm_th);};function x0(){var a;if((a=qm_li)){do{qm_uo(a);}while((a=a[qp])&&!qm_a(a))}qm_li=null;};function qm_a(a){if(a[qc].indexOf("qmmc")+1)return 1;};function qm_uo(a,go){if(!go&&a.qmtree)return;if(window.qmad&&qmad.bhide)eval(qmad.bhide);a.style.visibility="";x2("qmactive",a.idiv);};;function qa(a,b){return String.fromCharCode(a.charCodeAt(0)-(b-(parseInt(b/2)*2)));};function qm_oo(e,o,nt){if(!o)o=this;if(qm_la==o&&!nt)return;if(window.qmv_a&&!nt)qmv_a(o);if(window.qmwait){qm_kille(e);return;}clearTimeout(qm_tt);qm_tt=null;qm_la=o;if(!nt&&o.qmts){qm_si=o;qm_tt=setTimeout("qm_oo(new Object(),qm_si,1)",o.qmts);return;}var a=o;if(a[qp].isrun){qm_kille(e);return;}if(qm_ib&&!qm_ic)return;var go=true;while((a=a[qp])&&!qm_a(a)){if(a==qm_li)go=false;}if(qm_li&&go){a=o;if((!a.cdiv)||(a.cdiv&&a.cdiv!=qm_li))qm_uo(qm_li);a=qm_li;while((a=a[qp])&&!qm_a(a)){if(a!=o[qp]&&a!=o.cdiv)qm_uo(a);else break;}}var b=o;var c=o.cdiv;if(b.cdiv){var aw=b.offsetWidth;var ah=b.offsetHeight;var ax=b.offsetLeft;var ay=b.offsetTop;if(c[qp].ch){aw=0;if(c.fl)ax=0;}else {if(c.ft)ay=0;if(c.rl){ax=ax-c.offsetWidth;aw=0;}ah=0;}if(qm_o){ax-=b[qp].clientLeft;ay-=b[qp].clientTop;}if(qm_s2&&!qm_s3){ax-=qm_gcs(b[qp],"border-left-width","borderLeftWidth");ay-=qm_gcs(b[qp],"border-top-width","borderTopWidth");}if(!c.ismove){c.style.left=(ax+aw)+"px";c.style.top=(ay+ah)+"px";}x2("qmactive",o,1);if(window.qmad&&qmad.bvis)eval(qmad.bvis);c.style.visibility="inherit";qm_li=c;}else  if(!qm_a(b[qp]))qm_li=b[qp];else qm_li=null;qm_kille(e);};function qm_gcs(obj,sname,jname){var v;if(document.defaultView&&document.defaultView.getComputedStyle)v=document.defaultView.getComputedStyle(obj,null).getPropertyValue(sname);else  if(obj.currentStyle)v=obj.currentStyle[jname];if(v&&!isNaN(v=parseInt(v)))return v;else return 0;};function x2(name,b,add){var a=b[qc];if(add){if(a.indexOf(name)==-1)b[qc]+=(a?' ':'')+name;}else {b[qc]=a.replace(" "+name,"");b[qc]=b[qc].replace(name,"");}};function qm_kille(e){if(!e)e=event;e.cancelBubble=true;if(e.stopPropagation&&!(qm_s&&e.type=="click"))e.stopPropagation();};function qm_pure(sd){if(sd.tagName=="UL"){var nd=document.createElement("DIV");nd.qmpure=1;var c;if(c=sd.style.cssText)nd.style.cssText=c;qm_convert(sd,nd);var csp=document.createElement("SPAN");csp.className="qmclear";csp.innerHTML="&nbsp;";nd.appendChild(csp);sd=sd[qp].replaceChild(nd,sd);sd=nd;}return sd;};function qm_convert(a,bm,l){if(!l)bm[qc]=a[qc];bm.id=a.id;var ch=a.childNodes;for(var i=0;i<ch.length;i++){if(ch[i].tagName=="LI"){var sh=ch[i].childNodes;for(var j=0;j<sh.length;j++){if(sh[j]&&(sh[j].tagName=="A"||sh[j].tagName=="SPAN"))bm.appendChild(ch[i].removeChild(sh[j]));if(sh[j]&&sh[j].tagName=="UL"){var na=document.createElement("DIV");var c;if(c=sh[j].style.cssText)na.style.cssText=c;if(c=sh[j].className)na.className=c;na=bm.appendChild(na);new qm_convert(sh[j],na,1)}}}}}/* ]]> */</script>

<!-- Add-On Core Code (Remove when not using any add-on's) -->
<style type="text/css">.qmfv{visibility:visible !important;}.qmfh{visibility:hidden !important;}</style><script type="text/JavaScript">var qmad = new Object();qmad.bvis="";qmad.bhide="";</script>


	<!-- Add-On Settings -->
	<script type="text/JavaScript">

		/*******  Menu 0 Add-On Settings *******/
		var a = qmad.qm0 = new Object();

		// Item Bullets Add On
		a.ibullets_apply_to = "parent";
		a.ibullets_main_image = "<?php echo base_url(); ?>system/application/views/imagenes/white_arrow.gif";
		a.ibullets_main_image_hover = "<?php echo base_url(); ?>system/application/views/imagenes/black_arrow.gif";
		a.ibullets_main_image_active = "<?php echo base_url(); ?>system/application/views/imagenes/black_arrow.gif";
		a.ibullets_main_image_width = 6;
		a.ibullets_main_image_height = 3;
		a.ibullets_main_position_x = -16;
		a.ibullets_main_position_y = -5;
		a.ibullets_main_align_x = "right";
		a.ibullets_main_align_y = "middle";
		a.ibullets_sub_image = "<?php echo base_url(); ?>system/application/views/imagenes/black_arrow_right.gif";
		a.ibullets_sub_image_width = 3;
		a.ibullets_sub_image_height = 6;
		a.ibullets_sub_position_x = -12;
		a.ibullets_sub_position_y = -2;
		a.ibullets_sub_align_x = "right";
		a.ibullets_sub_align_y = "middle";

	</script>

<!-- Add-On Code: Item Bullets -->
<script type="text/javascript">/* <![CDATA[ */qmad.br_navigator=navigator.userAgent.indexOf("Netscape")+1;qmad.br_version=parseFloat(navigator.vendorSub);qmad.br_oldnav6=qmad.br_navigator&&qmad.br_version<7;if(!qmad.br_oldnav6){if(!qmad.ibullets)qmad.ibullets=new Object();if(qmad.bvis.indexOf("qm_ibullets_active(o,false);")==-1){qmad.bvis+="qm_ibullets_active(o,false);";qmad.bhide+="qm_ibullets_active(a,1);";if(window.attachEvent)window.attachEvent("onload",qm_ibullets_init);else  if(window.addEventListener)window.addEventListener("load",qm_ibullets_init,1);if(window.attachEvent)document.attachEvent("onmouseover",qm_ibullets_hover_off);else  if(window.addEventListener)document.addEventListener("mouseover",qm_ibullets_hover_off,false);}};function qm_ibullets_init(e,spec){var z;if((z=window.qmv)&&(z=z.addons)&&(z=z.item_bullets)&&(!z["on"+qmv.id]&&z["on"+qmv.id]!=undefined&&z["on"+qmv.id]!=null))return;qm_ts=1;var q=qmad.ibullets;var a,b,r,sx,sy;z=window.qmv;for(i=0;i<10;i++){if(!(a=document.getElementById("qm"+i))||(!isNaN(spec)&&spec!=i))continue;var ss=qmad[a.id];if(ss&&(ss.ibullets_main_image||ss.ibullets_sub_image)){q.mimg=ss.ibullets_main_image;if(q.mimg){q.mimg_a=ss.ibullets_main_image_active;if(!z)qm_ibullets_preload(q.mimg_a);q.mimg_h=ss.ibullets_main_image_hover;if(!z)qm_ibullets_preload(q.mimg_a);q.mimgwh=eval("new Array("+ss.ibullets_main_image_width+","+ss.ibullets_main_image_height+")");r=q.mimgwh;if(!r[0])r[0]=9;if(!r[1])r[1]=6;sx=ss.ibullets_main_position_x;sy=ss.ibullets_main_position_y;if(!sx)sx=0;if(!sy)sy=0;q.mpos=eval("new Array('"+sx+"','"+sy+"')");q.malign=eval("new Array('"+ss.ibullets_main_align_x+"','"+ss.ibullets_main_align_y+"')");r=q.malign;if(!r[0])r[0]="right";if(!r[1])r[1]="center";}q.simg=ss.ibullets_sub_image;if(q.simg){q.simg_a=ss.ibullets_sub_image_active;if(!z)qm_ibullets_preload(q.simg_a);q.simg_h=ss.ibullets_sub_image_hover;if(!z)qm_ibullets_preload(q.simg_h);q.simgwh=eval("new Array("+ss.ibullets_sub_image_width+","+ss.ibullets_sub_image_height+")");r=q.simgwh;if(!r[0])r[0]=6;if(!r[1])r[1]=9;sx=ss.ibullets_sub_position_x;sy=ss.ibullets_sub_position_y;if(!sx)sx=0;if(!sy)sy=0;q.spos=eval("new Array('"+sx+"','"+sy+"')");q.salign=eval("new Array('"+ss.ibullets_sub_align_x+"','"+ss.ibullets_sub_align_y+"')");r=q.salign;if(!r[0])r[0]="right";if(!r[1])r[1]="middle";}q.type=ss.ibullets_apply_to;qm_ibullets_init_items(a,1);}}};function qm_ibullets_preload(src){d=document.createElement("DIV");d.style.display="none";d.innerHTML="<img src="+src+" width=1 height=1>";document.body.appendChild(d);};function qm_ibullets_init_items(a,main){var q=qmad.ibullets;var aa,pf;aa=a.childNodes;for(var j=0;j<aa.length;j++){if(aa[j].tagName=="A"){if(window.attachEvent)aa[j].attachEvent("onmouseover",qm_ibullets_hover);else  if(window.addEventListener)aa[j].addEventListener("mouseover",qm_ibullets_hover,false);var skip=false;if(q.type!="all"){if(q.type=="parent"&&!aa[j].cdiv)skip=true;if(q.type=="non-parent"&&aa[j].cdiv)skip=true;}if(!skip){if(main)pf="m";else pf="s";if(q[pf+"img"]){var ii=document.createElement("IMG");ii.setAttribute("src",q[pf+"img"]);ii.setAttribute("width",q[pf+"imgwh"][0]);ii.setAttribute("height",q[pf+"imgwh"][1]);ii.style.borderWidth="0px";ii.style.position="absolute";var ss=document.createElement("SPAN");var s1=ss.style;s1.display="block";s1.position="relative";s1.fontSize="1px";s1.lineHeight="0px";s1.zIndex=1;ss.ibhalign=q[pf+"align"][0];ss.ibvalign=q[pf+"align"][1];ss.ibiw=q[pf+"imgwh"][0];ss.ibih=q[pf+"imgwh"][1];ss.ibposx=q[pf+"pos"][0];ss.ibposy=q[pf+"pos"][1];qm_ibullets_position(aa[j],ss);ss.appendChild(ii);aa[j].qmibullet=aa[j].insertBefore(ss,aa[j].firstChild);aa[j]["qmibullet"+pf+"a"]=q[pf+"img_a"];aa[j]["qmibullet"+pf+"h"]=q[pf+"img_h"];aa[j].qmibulletorig=q[pf+"img"];ss.setAttribute("qmvbefore",1);ss.setAttribute("isibullet",1);if(aa[j].className.indexOf("qmactive")+1)qm_ibullets_active(aa[j]);}}if(aa[j].cdiv)new qm_ibullets_init_items(aa[j].cdiv);}}};function qm_ibullets_position(a,b){if(b.ibhalign=="right")b.style.left=(a.offsetWidth+parseInt(b.ibposx)-b.ibiw)+"px";else  if(b.ibhalign=="center")b.style.left=(parseInt(a.offsetWidth/2)-parseInt(b.ibiw/2)+parseInt(b.ibposx))+"px";else b.style.left=b.ibposx+"px";if(b.ibvalign=="bottom")b.style.top=(a.offsetHeight+parseInt(b.ibposy)-b.ibih)+"px";else  if(b.ibvalign=="middle")b.style.top=parseInt((a.offsetHeight/2)-parseInt(b.ibih/2)+parseInt(b.ibposy))+"px";else b.style.top=b.ibposy+"px";};function qm_ibullets_hover(e,targ){e=e||window.event;if(!targ){var targ=e.srcElement||e.target;while(targ.tagName!="A")targ=targ[qp];}var ch=qmad.ibullets.lasth;if(ch&&ch!=targ){qm_ibullets_hover_off(new Object(),ch);}if(targ.className.indexOf("qmactive")+1)return;var wo=targ.qmibullet;var ma=targ.qmibulletmh;var sa=targ.qmibulletsh;if(wo&&(ma||sa)){var ti=ma;if(sa&&sa!=undefined)ti=sa;if(ma&&ma!=undefined)ti=ma;wo.firstChild.src=ti;qmad.ibullets.lasth=targ;}if(e)qm_kille(e);};function qm_ibullets_hover_off(e,o){if(!o)o=qmad.ibullets.lasth;if(o&&o.className.indexOf("qmactive")==-1){if(o.firstChild&&o.firstChild.getAttribute&&o.firstChild.getAttribute("isibullet"))o.firstChild.firstChild.src=o.qmibulletorig;}};function qm_ibullets_active(a,hide){var wo=a.qmibullet;var ma=a.qmibulletma;var sa=a.qmibulletsa;if(!hide&&a.className.indexOf("qmactive")==-1)return;if(hide&&a.idiv){var o=a.idiv;if(o&&o.qmibulletorig){if(o.firstChild&&o.firstChild.getAttribute&&o.firstChild.getAttribute("isibullet"))o.firstChild.firstChild.src=o.qmibulletorig;}}else {if(!a.cdiv.offsetWidth)a.cdiv.style.visibility="inherit";qm_ibullets_wait_relative(a);/*if(a.cdiv){var aa=a.cdiv.childNodes;for(var i=0;i<aa.length;i++){if(aa[i].tagName=="A"&&aa[i].qmibullet)qm_ibullets_position(aa[i],aa[i].qmibullet);}}*/if(wo&&(ma||sa)){var ti=ma;if(sa&&sa!=undefined)ti=sa;if(ma&&ma!=undefined)ti=ma;wo.firstChild.src=ti;}}};function qm_ibullets_wait_relative(a){if(!a)a=qmad.ibullets.cura;if(a.cdiv){if(a.cdiv.qmtree&&a.cdiv.style.position!="relative"){qmad.ibullets.cura=a;setTimeout("qm_ibcss_wait_relative()",10);return;}var aa=a.cdiv.childNodes;for(var i=0;i<aa.length;i++){if(aa[i].tagName=="A"&&aa[i].qmibullet)qm_ibullets_position(aa[i],aa[i].qmibullet);}}}/* ]]> */</script>

</head>

<body>

<table align="center" cellpadding="0"; cellspacing="0" >
  <tr>
    <td class="tope" width="950" height="119">
   
    
    <br>
    
    
    <br>
    
   
	<br>
	
	
	
	 &nbsp;  
	 &nbsp;  



    </td>
  </tr>
</table>


<div class="mmenu">
<ul id="qm0" class="qmmc">

	<li><a class="qmparent" href="javascript:void(0)">Mantenimiento</a>

		<ul>
    <li><a href="<?php  echo base_url(); ?>index.php/tipobeca/tipobecaControl">Tipos de Becas</a></li>
		<li><a href="<?php  echo base_url(); ?>index.php/beca">Becas</a></li>

    <li><a href="<?php  echo base_url(); ?>index.php/accion/accionControl">Acciones</a></li>
		<li><a href="<?php  echo base_url(); ?>index.php/requisito/requisitoControl">Requisitos</a></li>
		
		<li><a href="<?php  echo base_url(); ?>index.php/carrera">Carreras</a></li>
		<li><a href="<?php  echo base_url(); ?>index.php/instituto">Institutos</a></li>
		<li><a href="<?php  echo base_url(); ?>index.php/materiacarrerainstituto">Materia, Carrera</a></li>
		<li><a href="<?php  echo base_url(); ?>"index.php/nucleo">N&uacute;cleos</a></li>
    <li><a href="<?php  echo base_url(); ?>index.php/modalidad/modalidadControl">Modalidades</a></li>
    <li><a class="qmparent" href="javascript:void(0);">Per&iacute;odo</a>
			<ul>
			<li><a href="<?php  echo base_url(); ?>index.php/periodo/PeriodoControl">Per&iacute;odos</a></li>
			<li><a href="<?php  echo base_url(); ?>index.php/tipoPeriodo/TipoPeriodoControl">Tipos de Per&iacute;odo</a></li>
			</ul>
    </li>
    <li><a class="qmparent" href="javascript:void(0);">Materia</a>
			<ul>
			<li><a href="<?php  echo base_url(); ?>index.php/materia/materiaControl">Materias</a></li>
			<li><a href="<?php  echo base_url(); ?>index.php/estadoMateria/estadoMateriaControl">Estado de Materia</a></li>
			</ul>
    </li>
		
		

		<li><a class="qmparent" href="javascript:void(0);">Persona</a>
			<ul>
			<li><a href="<?php  echo base_url(); ?>index.php/persona/personaControl">Personas</a></li>
			<li><a href="<?php  echo base_url(); ?>index.php/estadoPersona/estadoPersonaControl">Estado de Persona</a></li>
			</ul>
    </li>

		<li><a href="<?php  echo base_url(); ?>index.php/tipoProcedencia/tipoProcedenciaControl">Tipo de Procedencia</a></li>
		<li><a href="<?php  echo base_url(); ?>index.php/tipoVerificacion/tipoVerificacionControl">Tipos de Verificaci&oacute;n</a></li>
		<li><a href="<?php  echo base_url(); ?>index.php/liceo/liceoControl">Liceos</a></li>
		<li><a href="<?php  echo base_url(); ?>index.php/banco/bancoControl">Bancos</a></li>
		<li><a class="qmparent" href="javascript:void(0);">Geogr&aacute;fico</a>

			<ul>
			<li><a href="<?php  echo base_url(); ?>index.php/parroquia/parroquiaControl">Parroquias</a></li>
			<li><a href="<?php  echo base_url(); ?>index.php/municipio/municipioControl">Municipios</a></li>
			<li><a href="<?php  echo base_url(); ?>index.php/estado/estadoControl">Estados</a></li>
			<li><a href="<?php  echo base_url(); ?>index.php/pais/paisControl">Pa&iacute;ses</a></li>
			</ul>
    </li>

		</ul>
		
	
		</li>

  <li><a class="qmparent" href="javascript:void(0);">Operaciones</a>

		<ul>
    <li><a href="<?php  echo base_url(); ?>index.php/procedencia/procedenciaControl">Procedencia</a></li>
		<li><a href="<?php  echo base_url(); ?>index.php/aspirante/aspiranteControl">Aspirantes</a></li>
    <li><a href="<?php  echo base_url(); ?>index.php/sorteo/sorteoControl">Sorteos</a></li>
		<li><a href="<?php  echo base_url(); ?>index.php/pendienteBeca/pendienteBecaControl">Asignaci&oacute;n de Beca</a></li>
    <li><a  class="qmparent" href="javascript:void(0);">Beneficiarios</a>
      <ul>
			<li><a href="<?php  echo base_url(); ?>index.php/beneficiario/beneficiarioControl">Informaci&oacute;n de Beneficiarios</a></li>
      <li><a href="<?php  echo base_url(); ?>index.php/accionBeneficiario/accionBeneficiarioControl">Acciones a Beneficiarios</a></li>
			</ul>
    </li>

		</ul>
  </li>

<li class="qmclear">&nbsp;</li>

	<li><a class="qmparent" href="javascript:void(0);">Reportes</a>

		<ul>
		<li><a href="<?php  echo base_url(); ?>index.php/con_madresoltera/index">Madre Soltera</a></li>
		<li><a href="<?php  echo base_url(); ?>index.php/con_rep_censo/index">Censos</a></li>
		<li><a href="<?php  echo base_url(); ?>index.php/con_rep_sorteo/index">Sorteos</a></li>
		<li><a href="<?php  echo base_url(); ?>index.php/con_rep_beneficiario/index">Beneficiarios</a></li>
		<li><a href="<?php  echo base_url(); ?>index.php/con_rep_becaPromedio/index">Beca Promedio</a></li>
		<li><a href="<?php  echo base_url(); ?>index.php/con_rep_historicoBenef/index">Hist&oacute;rico Beneficiario</a></li>
		<li><a href="<?php  echo base_url(); ?>index.php/con_rep_nomina_becaBecario/index">N&oacute;mina Beca Becario</a></li>
		<li><a href="<?php  echo base_url(); ?>index.php/con_rep_beca_ayuda/index">N&oacute;mina Beca Ayuda</a></li>
		<li><a href="<?php  echo base_url(); ?>index.php/con_rep_inst_carreraAsignada/index">Institutos, Carreras y Asignaturas</a></li>
		
		</ul>
    </li>


    <li><a class="qmparent" href="javascript:void(0);">Carga Autom&aacute;tica</a>

		<ul>
    <li><a href="<?php  echo base_url(); ?>index.php/cargaInfoAcademica/cargaInfoAcademicaControl">Informaci&oacute;n Acad&eacute;mica</a></li>
		<li><a href="<?php  echo base_url(); ?>index.php/cargaActivosJEL/cargaActivosJELControl">Activos JEL</a></li>
    <li><a href="<?php  echo base_url(); ?>index.php/cargaActivosNOJEL/cargaActivosNOJELControl">Activos NO JEL</a></li>
		<li><a href="<?php  echo base_url(); ?>index.php/cargaInactivosJEL/cargaInactivosJELControl">Inactivos JEL</a></li>
    <li><a href="<?php  echo base_url(); ?>index.php/cargaInactivosNOJEL/cargaInactivosNOJELControl">Inactivos NO JEL</a></li>
    <li><a href="<?php  echo base_url(); ?>index.php/cargaEgresadosJEL/cargaEgresadosJELControl">Egresados JEL</a></li>
    <li><a href="<?php  echo base_url(); ?>index.php/cargaEgresadosNOJEL/cargaEgresadosNOJELControl">Egresados NO JEL</a></li>

		</ul>
  </li>

<li class="qmclear">&nbsp;</li>

	<li><a class="qmparent" href="javascript:void(0);">Sistema</a>

		<ul>
		<li><a href="<?php  echo base_url(); ?>index.php/con_acceso/salir">Salir</a></li>

		</ul></li>


<li class="qmclear">&nbsp;</li></ul> </div>

<!-- Create Menu Settings: (Menu ID, Is Vertical, Show Timer, Hide Timer, On Click ('all' or 'lev2'), Right to Left, Horizontal Subs, Flush Left, Flush Top) -->
<script type="text/javascript">qm_create(0,false,0,500,false,false,false,false,false);</script>


<!-- This script references optionally loads the MyCSSMenu visual interface, to run the menu stand alone remove the script.-->
<script type="text/javascript">if (window.name=="qm_launch_visual"){document.write('<scr'+'ipt type="text/javascript" src="http://www.mycssmenu.com/qmv6/qm_visual.js"></scr'+'ipt>')}</script>



</body>
</html>
      