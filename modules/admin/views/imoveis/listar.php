<div id="content-body">
    
    <?= $this->load->view('alerts'); ?>
    
    <section class="title">
        <h4>Lista de Imóveis</h4>
        <nav id="shortcuts">
            <ul>
                <li>
                    <?=anchor('admin/imoveis/novo', 'Adicionar Imóvel', 'class="add"');?>
                </li>
            </ul>
        </nav>
    </section>
    <section class="item">
        
        <table border="0" class="table-list">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Tipo de Imovel</th>
                    <th>Localização</th>
                    <th width="80">Preço</th>
                    <th width="10"></th>
                </tr>
            </thead>
            <tbody>
                
                 <?php
                
                foreach ($imoveis as $value) {
                    
                    echo "<tr>";
                    
                    echo "<td>".$value['titulo']."</td>";
                    echo "<td>".$value['desc_tipo']."</td>";
                    echo "<td>".$value['localidade']."</td>";
                    echo "<td>".$value['preco']."</td>";
                    echo "<td>".anchor('admin/imoveis/edit/'.$value['nimovel'], 'Editar', 'class="button edit"').
                                anchor('admin/imoveis/del/'.$value['nimovel'], 'Apagar', 'class="confirm button delete"')."</td>";
                    echo "</tr>";
                    
                }
                ?>
                
            </tbody>
        </table>
    </section>
</div>