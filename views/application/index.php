<div id="documenter_sidebar">
	<a href="#documenter_cover" id="documenter_logo"></a>
	<ol id="documenter_nav">
		<li>
			<a class="current" href="#">Home</a>
		</li>
		<li>
			<a class="" href="#documentation">Documenta&ccedil;&atilde;o</a>
			<ol>
				<li>
					<a href="#documentation_introduction">Introdu&ccedil;&atilde;o</a>
				</li>
				<li>
					<a href="#documentation_request">Requisi&ccedil;&atilde;o</a>
				</li>
			</ol>
		</li>
		<li>
			<a href="#documentation_post">Cadastro</a>
		</li>
	</ol>
	<div id="documenter_copyright">Copyright Lumturo <?php echo date("Y")?><br>
	</div>
</div>
<div id="documenter_content">

	<section id="documenter_cover">
	<h1>Lumturo - WebService</h1>
	<h2>Documenta&ccedil;&atilde;o de utiliza&ccedil;&atilde;o do WebService</h2>
	<hr>
	<ul>
		<li>Criado: 03/11/2012</li>
		<li>Atualizado: 19/11/2012</li>
		<br />
		<li>Por: Bruno Moiteiro </li>
		<li>Email: <a href="mailto:bruno.moiteiro@gmail.com">bruno [dot] moiteiro [at] gmail [dot] com</a></li>
		<li>Site: <a href="http://brunomoiteiro.com">brunomoiteiro.com</a></li>
	</ul>
	<p>
		Documenta&ccedil;&atilde;o r&aacute;pida de como utilizar o servi&ccedil;o.
	</p>
	<p>
		Em Constru&ccedil;&atilde;o
	</p>
	</section>
		
	<section id='documentation'>
		<h3 >Documenta&ccedil;&atilde;o</h3>
		<hr class="notop">

		<h2 id='documentation_introdution'>Introdu&ccedil;&atilde;o</h2>
		<p>
			As requisi&ccedil;&otilde;es do Webservice ser&atilde; feitas sob o protocolo HTTP e as respostas ser&atilde;o no formato JSON ou XML. 
			Esse formato deve ser enviado explicitamente na requisi&ccedil;&atilde;o ou o formato padr&atilde;o definido no WebService ser&aacute; enviado. 
			Cada requisi&atilde;o dever&aacute; conter obrigat&oacute;riamente um c&oacute;digo de segura&ccedil;a para se autenticar no WebService. Sem esse c&oacute;digo, a requisi&ccedil;&atilde;o ser&atilde; ignorada.
		</p>
		
		<h4>Entendendo alguns padr&otilde;es</h4>
		
		<ul>
			<li>As strings n&atilde;o devem conter acentos.</li>
			<li>Os espa&ccedil;os de uma string devem ser trocados pelo sinal de mais (+). Ex: S&atilde;o Paulo -> sao+paulo</li>
		</ul>
		<p>
			As URL's dos recursos sao definidas do seguinte modo:
			<br />
			<span class="link">recurso:id</span> -> <span class="link">recurso/id_do_recurso</span> (nome do recurso, seguindo de uma barra, seguinda do id do recurso)
			<br /> 
			<span class="link">recurso:id/sub_recurso:id</span> -> <span class='link'>recurso/id_do_recurso/sub_recurso/id_do_subrecurso</span> (nome do recurso, seguindo de uma barra, seguinda do id do recurso, seguido do nome do sub-recurso, seguido de uma barra, seguido do id do sub_recurso).
			<br />
			<br />
			Quando o tipo do identificador do sub-recurso n&atilde;o for informado, entende-se que seja do tipo <strong>integer</strong>. Caso contr&aacute;rio o tipo &eacute; exibido dentro de paranteses.
			<br />
			<span class="link">recurso:id(integer)/sub_recurso:name(string)</span> -> <span class='link'>recurso/id_do_recurso/sub_recurso/string</span>
			<br />
			Esses tipos s&atilde;o integers ou strings.
		</p>
		
		<br />
		<h4>Formato das respostas do sistema</h4>		
		<p>
			As requisi&ccedil;&otilde;es em JSON s&atilde;o sempre retornadas no seguinte formato:
			<ul>
				<li><strong>iTotalRecords:</strong> Total de dados cadastrados no sistema referentes &agrave; requisi&ccedil;&atilde;o feita.</li>
				<li><strong>iTotalDisplayRecords:</strong> Total de dados cadastrados no sistema que foram devolvidos na requisi&ccedil;&atilde;o em quest&atilde;o.</li>
				<li><strong>aaData:</strong> O array de objetos com o conte&uacute;do solicitado</li>
			</ul>
		</p>
		
		
		<br />
		<h4> Primeira Requisi&ccedil;&atilde;o (Requisi&ccedil;&atilde;o de Configura&ccedil;&atilde;o)</h4>
		<p>
			A primeira requisi&ccedil;&atilde;o serve para alinhar o utilizador de servi&ccedil;o com o webservice.
			<br />
			Como a aplica&ccedil;&atilde;o ter&aacute; como contexto principal as cidades, &eacute; importante que o aplicativo
			saiba como requerer informa&ccedil;&otilde;es relacionados a elas.
			<br />
			Para diminuir a quantidade de requisi&ccedil;&otilde;es para utilizar o servi&ccedil;o, &eacute; recomend&aacute;vel que essa primeira requisi&ccedil;&atilde;o seja
			feita uma &uacute;nica vez, preferencialmente, logo ap&oacute;s a instala&ccedil;&atilde;o do aplicativo.
			
			<h5>Pegando todos os estados:</h5>
			<p>Para achar uma cidade, o aplivativo precisa saber o c&oacute;digo do estado que a cidade pertence.
			<br />
			A requisicao &eacute; feita do seguinte modo.
			<br />
			<span class='link'>http://webservice_gateway/states</span>
			<br />
			</p>
			
			<h5>Encontrando a cidade padr&atilde;o:</h5>
			<p>
			Depois de conhecido o c&oacute;digo do estado, o aplicativo j&aacute; pode requisitar os dados de uma cidade informando o nome.
			<br />
			<span class='link'>http://webservice_gateway/state/:id(integer)/city/:name(string)</span>
			<br /> 
			Caso a cidade seja encontrada com sucesso, o aplivativo poder&aacute; usar todos os outros servi&ccedil;os dispon&iacute;vies.
			</p>
		</p>
		
		<br />
		<h4>Recursos de Filtros do Webservice</h4>
		<br />
		<h5>Listagem de bairros</h5>
		<p>
			Depois de ter encontrado a cidade, o aplicativo precisa descobrir em qual bairro as buscar por localidades ser&atilde;o feitas.
			<br />
			Para listar todos os bairros de um cidade, utilize:
			<br />
			<span class='link'>http://webservice_gateway/cities/:id(integer)/neighborhoods</span>
			<br/>
			Esse dado tamb&eacute;m pode ser armazenado no aplivativo, uma vez que ele &eacute; praticamente est&aacute;tico. (opcional)
		</p>
		
		<br />
		<br />
		<h5>Listagem de Locais (estabelecimentos)</h5>
		<p>
			Os estabelecimentos podem ser mapeados de duas formas. Pode-se mapear os locais apenas de um bairro em espec&iacute;fico, ou pode se mapear todos os locais de uma cidade.
			<br />
			Isso fica a crit&eacute;rio do contexto do aplicativo.
			<br />
			<br />
			Para mapear os locais de um bairro, utilize:
			<br />
			<span class='link'>http://webservice_gateway/cities/:id(integer)/neighborhoods/:id(integer)/locations</span>
			<br />
			<br />
			Para mapear os locais de uma cidade, utilize:
			<br />
			<span class='link'>http://webservice_gateway/cities/:id(integer)/locations</span>
		</p>
		
		<br />
		<br />
		<h5>Listagem de Tipos e Subtipos</h5>
		<p>
			Todos os estabelecimentos est&atilde;o relacionados ao servi&ccedil;os ou materias que oferecem. A listagem dos tipos &eacute; importante para especializar a busca dos usuarios atrav&eacute;s de filtros.
			<br />
			<br />
			Para carregar os tipos cadastrados no sistema, utilize:
			<br />
			<span class='link'>http://webservice_gateway/enterprises_types</span>
			
			<br />
			<br />
			Para carregar os subtipos de um tipo cadastrado no sistema, utilize:
			<br />
			<span class='link'>http://webservice_gateway/enterprises_types/:id(integer)/enterprises_subtypes</span>
			
			<br />
			<br />
			Para carregar os tipos e subtipos respectivos, utilize:
			<br />
			<span class='link'>http://webservice_gateway/enterprises_types/enterprises_subtypes</span>
		</p>
		
		<br />
		<h4>Montando URL de Busca</h4>
		<br />
		<h5>Organizando os filtros</h5>
		<p>
			A url de busca de um recurso deve ser montanda por ordem de grandeza de cada recurso.<br />
			O n&iacute;vel inicial de uma busca &eacute; cidade. Seguida do Bairro, tipo do estabelecimento, subtipo do estabelecimento e o nome do estabelecimento. <br /> 
			Nem todos os filtros s&atilde;o obrigat&oacute;rios mas a exist&ecirc;ncia deles tornam a busca mais eficiente a url mais intuitiva.
		</p>
		<br/>
		
		<h5>Pesquisa por Tipo</h5>
		<p>
			Essa pesquisa retorna todos os estabelecimentos de um determinado tipo.
			<br />
			A passagem da cidade &eacute; obrigat&oacute;ria em ambos os casos. Bairro, n&atilde;o
			
			<br />
			<br />
			Busca apenas com a cidade.
			<br />
			<span class='link'>http://webservice_gateway/cities:id/enterprises_types:id/locations</span>
			<br/>
			<br />
			A mesma busca mas com um filtro adicinal para trazer apenas estabelecimentos de um bairro.
			<br />
			<span class='link'>http://webservice_gateway/cities:id/neighborhoods:id/enterprises_types:id/locations</span>
			
			<br />
			<br />
			A passagem de uma string com o nome do estabelecimento tamb&eacute;m &eacute; opcional e pode ser aplicado nos dois formatos anteriores.
			<br>
			A n&iacute;vel de exemplo. utilizaremos apenas a busca com a cidade.				
			<br>
			<span class='link'>http://webservice_gateway/cities:id/enterprises_types:id/enterprises_headquarters:name(string)/locations</span>
		</p>
		
		<br />
		<h5>Pesquisa por Subtipo</h5>
		<p>
			Uma busca semelhante &agrave; anterior que serve para estabelecimentos que oferecem servi&ccedil;os mais espec&iacute;ficos.
			<br />
			A passagem da cidade &eacute; obrigat&oacute;ria em ambos os casos. Bairro, n&atilde;o
			
			<br />
			<br />
			Busca apenas com a cidade.
			<br />
			<span class='link'>http://webservice_gateway/cities:id/enterprises_subtypes:id/locations</span>
			<br/>
			<br />
			A mesma busca mas com um filtro adicinal para trazer apenas estabelecimentos de um bairro.
			<br />
			<span class='link'>http://webservice_gateway/cities:id/neighborhoods:id/enterprises_subtypes:id/locations</span>
			
			<br />
			<br />
			A passagem de uma string com o nome do estabelecimento tamb&eacute;m &eacute; opcional e pode ser aplicado nos dois formatos anteriores. Esse formato serve para que o usu&aacute;rio possa buscar na barra de pesquisa.
			<br>
			A n&iacute;vel de exemplo. utilizaremos apenas a busca com a cidade.				
			<br>
			<span class='link'>http://webservice_gateway/cities:id/enterprises_subtypes:id/enterprises_headquarters:name(string)/locations</span>
		</p>


		<br />
		<h5>Pesquisa direta</h5>
		<p>
			Busca feita atrav&eacute;s de um texto digitado pelo usu&aacute;rio.
			<br />
			A busca deve ser restringida pela cidade do usu&aacute;rio e, opcionalmente, pelo bairro.
			<br />
			Ao organizar a URL de busca, o aplicativo pode selecionar a quantidade de resultados que deseja que a pesquisa tenha. Por padr&atilde;o, o total dos resultados ser&aacute; apenas os dez primeiros.
			<br />
			<br />
			Buscando com a cidade e dez estabeleciomentos como resultado.
			<br />
			<span class='link'>http://webservice_gateway/search/cities:id/q/:words(string)</span>
			<br />
			Ex: <span class='link'>http://webservice_gateway/search/cities/981/q/Mc+Barra</span>
			<br />
			<br />
			Buscando com a cidade e informando a p&aacute;gina e a quatidade de resultado por p&aacute;gina.
			<br />
			<span class='link'>http://webservice_gateway/search/cities:id/q/:page(integer)/:amount_per_page(integer)/:words(string)</span>
			<br />
			Ex: <span class='link'>http://webservice_gateway/search/cities/918/q/1/20/Mc+Barra</span>
			<br>
			A primeira est&aacute; na posi&ccedil;&atilde;o 1 (um) e a quantidade m&aacute;xima entregada por cada p&aacute;gina &eacute; de cem elementos.
			<br />
			<br />
		</p>

		<br />
		<br />
		<h3 id='documentation_post'>Cadastro</h3>
		<hr class="notop">
		
		<h4>Cadastro de Bairro</h4>
		
		<ul>
			<li>As strings n&atilde;o devem conter acentos.</li>
			<li>Os espa&ccedil;os de uma string devem ser trocados pelo sinal de menos. Ex: S&atilde;o Paulo -> sao-paulo</li>
		</ul>

	</section>
</div>