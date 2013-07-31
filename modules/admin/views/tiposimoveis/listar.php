<div id="content-body">
    
    <?= $this->load->view('alerts'); ?>
    
    <section class="title">
        <h4>Tipos de Imóveis</h4>
        <nav id="shortcuts">
            <ul>
                <li>
                    <?=anchor('admin/tiposimoveis/novo', 'Adicionar Tipo', 'class="add"');?>
                </li>
            </ul>
        </nav>
    </section>
    <section class="item">
        
        <table border="0" class="table-list">
            <thead>
                <tr>
                    <th>Tipo de Imóvel</th>
                    <th width="110"></th>
                </tr>
            </thead>
            <tbody>
                
                <?php
                
                foreach ($tipos as $value) {
                    
                    echo "<tr>";
                    
                    echo "<td>".$value['desc_tipo']."</td>";
                    echo "<td>".anchor('admin/tiposimoveis/edit/'.$value['id_tipo'], 'Editar', 'class="button edit"').
                                anchor('admin/tiposimoveis/del/'.$value['id_tipo'], 'Apagar', 'class="confirm button delete"')."</td>";
                    echo "</tr>";
                    
                }
                ?>
                
            </tbody>
        </table>
    </section>
</div>
