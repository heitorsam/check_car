</div>  <!-- FIM CLASS CONTAINER -->
    
    </div> <!-- FIM CLASS CONTEUDO -->
    
    </main>

    <!--RODAPE -->
    <footer class="footer-bs esconde_texto_mobile">
        <div class="row">
        	<div class="col-md-5 footer-brand animated fadeInLeft">
            
            	<h2> <img src="img/logo/icone_santa_casa_sjc_branco.png" height="28px" width="28px"  alt="Santa Casa de São José dos Campos">
                Santa Casa de </br>
                    São José dos Campos
                </h2>
                
                <p>Temos toda estrutura para o seu tratamento médico, análise de exames, exames de alta complexabilidade e internações. 
                   Atendemos todas as idades com nosso corpo de médicos e especialistas. Nossas instalações estão prontas para lhe atender e proporcionar o máximo de conforto.</p>
                <p>Projeto desenvolvido pela equipe de Tecnologia.</p>
            
            </div>
            
        	<div class="col-md-4 footer-nav animated fadeInUp">
            	<h4>Menu</h4>
            	<div class="col-md-10">
                
                    <ul class="pages">
                        <li><a href="home.php">Home</a></li>                           
                    </ul>

                </div>
            	<div class="col-md-10">
                    <ul class="list">
                        <li><a href="sair.php">Sair</a></li>
                    </ul>
                </div>
            </div>
        	<div class="col-md-3 footer-social animated fadeInDown">
            	<h4>Outros Projetos</h4>
            	<ul>
                	<li><a target="_blank" href="http://10.200.0.50:8080/portfolio/">Conheça nosso portfólio</a></li>
                </ul>
            </div>
        </div>


    <!--SUBIR AO TOPO-->
    <a id="subirTopo">
        <i class="fa fa-chevron-circle-up" aria-hidden="true"></i>
    </a>

     <!--SUBIR AO TOPO-->
     <a id="subirTopo">
        <i class="fa fa-chevron-circle-up" aria-hidden="true"></i>
    </a>

    </footer>

    <div id="overlay" class="overlay" style="position: fixed; z-index: 2000; !important;">
        <div class="loading-content">
            <i class="fas fa-car-side loading-icon"></i>
            <p class="loading-text">Carregando<span id="loadingDots"></span></p>
        </div>
    </div>

    <!--POPPER-->    
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!--BOOTSTRAP JAVASCRIPT-->  
    <script src="bootstrap/js/bootstrap.min.js"></script> 

    <!--JAVASCRIPTS-->
    <script src="js/scripts.js"></script>  

</body>
</html>

<script>

 if(navigator.userAgent.match(/Android/i)){
    window.scrollTo(0,1);
 }


    function carrega_load_carro(){

        console.log('chamou carrega_load_carro');

        document.getElementById('overlay').style.display = 'block';
        let dots = '';
        let count = 0;
        const loadingDots = document.getElementById('loadingDots');
        
        const interval = setInterval(() => {
            dots = '.'.repeat(count % 4);
            loadingDots.textContent = dots;
            count++;
        }, 500);
        
        /*
        setTimeout(() => {
            finaliza_load_carro();
        }, 5000);
        */
        
    };

    function finaliza_load_carro(){

        console.log('chamou finaliza_load_carro');

        setTimeout(() => {
            document.getElementById('overlay').style.display = 'none';
        }, 5000);       
        
    };


</script>