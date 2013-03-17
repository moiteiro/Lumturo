<?php 

/*
  <route>
    <url>/^\/inicialization\/state\/(?P&lt;state_id&gt;\d+)\/city\/(?P&lt;city_name&gt;[\w\-]+)\/?$/</url>
    <controller>inicialization</controller>
    <view>index</view>
  </route>

  <route>
    <url>/^\/search\/city\/(?P&lt;city_id&gt;\d+)\/q\/(?P&lt;search_string&gt;[\w\-]+)\/?$/</url>
    <controller>search</controller>
    <view>index</view>
  </route>

  <route>
    <url>/^\/search\/city\/(?P&lt;city_id&gt;\d+)\/neighborhood\/(?P&lt;neighborhood_id&gt;\d+)\/q\/(?P&lt;search_string&gt;[\w\-]+)\/?$/</url>
    <controller>search</controller>
    <view>index</view>
  </route>

*/

$route_apps = array(
                //"inicialization/state:id/city:name(string)/",
                "cities",
                "cities:id/locations", //retorna todos os locais da cidade. 
                // nao foi configurado de modo cities:id/headquarters/location/ para dar ao sistema maior 
                // flexibilidade caso seja cadastro outro tipo local que nao seja uma empresa

                "cities:id/neighborhoods", // retorna todos os bairros de uma cidade.
                "cities:id/neighborhoods:id/locations", // retorna todos os locais de um bairro.

                "cities:id/enterprises", // retorna todas as empresas de uma cidade.

                "neighborhoods", // retorna todos os bairros de todas as cidades.

                "enterprises_types",
                "enterprises_types/enterprises_subtypes", // retorna todos tipos e seus respectivos subtipos.
                "enterprises_types:id/enterprises_subtypes", // retorna todos os subtipos de um tipo.

                "enterprises_subtypes", // retorna todos tipos e seus respectivos subtipos.

                "cities:id/enterprises_types:id/locations", // retorna todos os locais de um determinado tipo de um bairro.
                "cities:id/enterprises_subtypes:id/locations", // retorna todos os locais de um determinado subtipo de um bairro.

                //"cities:id/enterprises_types:id/enterprises_headquarters:name(string)/locations", // retorna todos os locais de um determinado tipo de um bairro.
                //"cities:id/enterprises_subtypes:id/enterprises_headquarters:name(string)/locations", // retorna todos os locais de um determinado subtipo de um bairro.

                "cities:id/neighborhoods:id/enterprises_types:id/locations", // retorna todos os locais de um determinado tipo de um bairro.
                "cities:id/neighborhoods:id/enterprises_subtypes:id/locations", // retorna todos os locais de um determinado subtipo de um bairro.

                //"cities:id/neighborhoods:id/enterprises_types:id/enterprises_headquarters:name(string)/locations", // retorna todos os locais de um determinado tipo de um bairro.
                //"cities:id/neighborhoods:id/enterprises_subtypes:id/enterprises_headquarters:name(string)/locations", // retorna todos os locais de um determinado subtipo de um bairro.


                "enterprises", // retorna todas as empresas.
                "enterprises:id/enterprises_headquarters", // retorna todas as sedes de uma empresa

                "enterprises_headquarters", // warning! retorna todos os dados de todas as sedes.

                "states", // retorna a lista de todos os estados cadastrados.


                "search/city:id/q:name(string)", //lista todos os estabelecimentos de um local a partir de uma string

                //"search",
                //"search/cities:id/", // lista tudo de uma cidade em especifico
                //"search/cities:id/neigborhood/", // lista todos os bairros
                //"search/cities:id/neigborhood:id/", // lista tudo de um bairro em especifico

                //"maps", // retorna todo o mapa que o sistema cobrir
                //"maps/cities:id/", // retorna o mapa completo de uma cidade
                //"maps/cities:id/neigborhood:id/", // retorna o mapa completo de um bairro
                );
/**
 * As rotas do sistema devem ser definidas nesse arquivo.
 * Rotas possuem formato padrão, onde cada módulo definido mais acima conterá oito ações (index, list, show, new
 * create, edit, update e delete) padrões no sistema. Na definição de novas rotas, é possível remover as ações que não sejam
 * necessárias, assim como, definir novas ações.
 * Uma vez que a rota nõa esteja definida, o usuário será submetido à pagina 404(page not found).
 * 
 *  *** Novas Rotas ***
 * Cada módulo novo deve ser inserido, único e exclusivamente, na variável acima.
 * ex:
 * $route_apps = array('users','groups');
 * 
 *  *** Rotas Aninhadas ***
 * Módulos podem conter relação com outros módulos e por isso precisam passar a sua hierarquiedade na url, ou seja, o seu parentesco.
 * Dessa forma, voce pode relacionar um módulo pai com o seu filho na seguinte forma.
 * example/foo
 * isso quer dizer que o múdolo a ser acessado deve ser o foo, que por sua vez, se relaciona com example diretamente.
 * mais exemplos:
 * classroom/students, folder/files, device/resource
 * 
 * A definicao das rotas pode ser do tipo
 * example/foo
 * example:id/foo
 * example:id/foo/bar
 * example:id/foo:id/bar
 * 
 * As variávies da URL devem começar com ":", precisam ter nome único, excetuando o nome "id",
 * podem ser do tipo integer ou string e devem ser declaradas após passar o nome do controller ao qual ela pertece.
 * ex:
 * example:id(integer)/foo
 * example:name(string)/foo
 *
 * Quando a variável for do tipo integer, a declarção do tipo pode ser omitida.
 *
 * OBS!!
 * O controller mais à direita nao deve possir variáveis pois o sistema gera automaticamente.
 * 
 * 
 *  *** Adicionando Acoes às Rotas ***
 * 
 * As ações poderam ser adicionadas de modo simples através de uma simples declaração ou por expressão regular.
 * Adicionando de modo simples, será criada apenas uma ação simples onde não há a possibilidade de pegar argumentos, por exemplo 
 * (id de algum cadastro).
 * 
 * $route_apps = array('users'=>array('add'=>'action'));
 * $route_apps = array('users'=>array('add'=> array('action','another_action')));
 * 
 * Nos exemplos acima, está exibindo os únicos modos suportados, quando se deseja criar uma ou mais ações atráves da key "add".
 * 
 * 
 * *** Removendo Acoes das Rotas ***
 * 
 * Acoes nao desejadas podem ser removidos para evitar a nao integridade do sistema. Essas acoes nao mapeadas serao ignoradas pelo sistema
 * e será enviado para o usuário a mensagem 404.
 * 
 * $route_apps = array('users'=>array('remove'=>'new'))
 * $route_apps = array('users'=>array('remove'=> array('new','create')))
 * 
 */