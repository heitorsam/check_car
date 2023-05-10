<?php

	//ESTILO CSS	
	//echo '</br></br> ESTILO CSS OK';
	
?>

<style>





@media (max-width: 2000px) {

	

}


@media (max-width: 768px) {

	.esconde_botão_desktop{

		display:none;

	}

	.top_modal{

		margin-top:50%;

	}

	.column_table_show{

	display: none;

	}

	.column_table_hide{

		display: block;

	}

	.esconde_btn_desktop{

		display:block;

	}

	.display_esconder_mobile{

		display: none;
	}

	.title_mob{

		display: block;

	}

	.esconde{

		display: none;

	}

	.esconde_btn{

		display:block;

	}

	/********/
	/*BOTOES*/
	/********/

	/*BOTAO HOME */

	.botao_home { 
		width: 180px;
		font-size: 12px;
		
	}



	.botao_home:hover{ 
		width: 180px;
		font-size: 12px;
	}

	/*BOTAO HOME ADM */

	.botao_home_adm { 

		width: 180px;
		font-size: 12px;

	}

	.botao_home_adm:hover { 
		width: 180px;
		font-size: 12px;

	}

	/*************/
	/*FORMULARIOS*/
	/*************/

	.bloco_permissoes_setor{
		
		width: 100%;
		height: 260px;

		background-color: #ffffff;

		overflow: auto;
		overflow-x: hidden;
	}

	.table thead th {
		font-size: 12px;
	}
	.table td, .table th {
		font-size: 12px;
	}

	/********/
	/*FONTES*/
	/********/

	h10{
		font-size:14px;
	}

	h12{
		font-family: 'sans-serif', 'arial'; 
		font-size:14px;
		color: #3d3d3d;
	}

	/*INFORMACOES HOME*/
	.link_home_pend{
		font-family: 'sans-serif', 'arial'; 
		font-size:11px;
		color: #3d3d3d;
		text-decoration: none;
	}

	.link_home_pend:hover{
		color: #3185c1;
		text-decoration: none;
	}

	.mobile_nav_bar{

		width: 100%;
		display: block;



	}

	.navbar_desktop{

		display: none !important;

	}

	.sidebar {
	height: 100%;
	width: 0;
	position: fixed;
	z-index: 1;
	top: 0;
	right: 0;
	background-color: #3c3d41;
	background-color:rgba(60,61,65,0.98);

	overflow-x: hidden;
	transition: 0.5s;
	padding-top: 60px;
	}

	.sidebar a {
	padding: 8px 8px 8px 32px;
	text-decoration: none;
	font-size: 25px;
	color: #818181;
	display: block;
	transition: 0.3s;
	}

	.sidebar a:hover {
	color: #f1f1f1;
	}

	.sidebar .closebtn {
	position: absolute;
	top: 0;
	right: 25px;
	font-size: 36px;
	margin-left: 50px;
	
	}

	@media screen and (max-height: 450px) {
	.sidebar {padding-top: 15px;}
	.sidebar a {font-size: 18px;}
	}



	/*TITULO*/
	.title_mob{

		width: 50%; 
		margin: 0 auto;
		text-align: center;

	}

	.display_none_mobile{

		display: none;

	}

	.carro_check{

		width: 100%;

	}


}


	


</style>
