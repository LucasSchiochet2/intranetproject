<div class="mb-3">
    <label class="d-block">Selecione o menu para reordenar:</label>
    <div class="btn-group" role="group">
        <a href="{{ backpack_url('menu-item/reorder?menu_key=main') }}" class="btn btn-sm btn-{{ $widget['menu_key'] == 'main' ? 'primary' : 'outline-primary' }}">Principal</a>
        <a href="{{ backpack_url('menu-item/reorder?menu_key=fastaccess') }}" class="btn btn-sm btn-{{ $widget['menu_key'] == 'fastaccess' ? 'primary' : 'outline-primary' }}">Acesso Rápido</a>
        <a href="{{ backpack_url('menu-item/reorder?menu_key=links') }}" class="btn btn-sm btn-{{ $widget['menu_key'] == 'links' ? 'primary' : 'outline-primary' }}">Links Úteis</a>
    </div>
</div>
