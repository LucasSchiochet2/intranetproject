{{-- This file is used for menu items by any Backpack v6 theme --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

<x-backpack::menu-item title="Usuários" icon="la la-user" :link="backpack_url('user')" />
<x-backpack::menu-item title="Notícias" icon="la la-newspaper" :link="backpack_url('news')" />
<x-backpack::menu-item title="Ouvidoria" icon="la la-comments" :link="backpack_url('ombudsman')" />
<x-backpack::menu-item title="Documentos" icon="la la-file" :link="backpack_url('documents')" />
<x-backpack::menu-item title="Calendário" icon="la la-calendar" :link="backpack_url('calendar')" />

<x-backpack::menu-dropdown title="Permissões" icon="la la-key">
    <x-backpack::menu-item title="Funções" icon="la la-id-badge" :link="backpack_url('role')" />
    <x-backpack::menu-item title="Permissões" icon="la la-key" :link="backpack_url('permission')" />
</x-backpack::menu-dropdown>

<x-backpack::menu-dropdown title="Categorias" icon="la la-tags">
    <x-backpack::menu-item title="Categorias de Documentos"  icon="la la-folder" :link="backpack_url('document-category')" />
</x-backpack::menu-dropdown>