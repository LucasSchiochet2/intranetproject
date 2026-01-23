{{-- This file is used for menu items by any Backpack v6 theme --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i>
        {{ trans('backpack::base.dashboard') }}</a></li>
@can('list users')
    <x-backpack::menu-item title="Usuários" icon="la la-user" :link="backpack_url('user')" />
@endcan

<x-backpack::menu-item title="Colaboradores" icon="la la-users" :link="backpack_url('collaborators')" />

@can('list news')
    <x-backpack::menu-item title="Notícias" icon="la la-newspaper" :link="backpack_url('news')" />
@endcan

@can('list ombudsman')
    <x-backpack::menu-item title="Ouvidoria" icon="la la-comments" :link="backpack_url('ombudsman')" />
@endcan

@can('list documents')
    <x-backpack::menu-item title="Documentos" icon="la la-file" :link="backpack_url('documents')" />
@endcan

@can('list calendar')
    <x-backpack::menu-item title="Calendário" icon="la la-calendar" :link="backpack_url('calendar')" />
@endcan
@can('list pages')
<x-backpack::menu-item title="Páginas" icon="la la-file" :link="backpack_url('page')" />
@endcan
{{-- @can('list messages') --}}
<x-backpack::menu-item title="Messages" icon="la la-envelope" :link="backpack_url('message')" />
{{-- @endcan --}}
@can('list banners')
<x-backpack::menu-item title="Banners" icon="la la-image" :link="backpack_url('banner')" />
@endcan
@can('list dashboards')
<x-backpack::menu-item title="Dashboards" icon="la la-dashboard" :link="backpack_url('dashboard')" />
@endcan

@can('list document_categories')
    <x-backpack::menu-dropdown title="Categorias" icon="la la-tags">
        <x-backpack::menu-item title="Categorias de Documentos" icon="la la-folder"
            :link="backpack_url('document-category')" />
    </x-backpack::menu-dropdown>
@endcan

{{-- Dynamic Menu Items --}}
<x-backpack::menu-dropdown title="Avançado" icon="la la-cogs">
    @can('list roles')
        <x-backpack::menu-dropdown title="Permissões" icon="la la-key">
            <x-backpack::menu-item title="Funções" icon="la la-id-badge" :link="backpack_url('role')" />
            <x-backpack::menu-item title="Permissões" icon="la la-key" :link="backpack_url('permission')" />
        </x-backpack::menu-dropdown>
    @endcan
    <x-backpack::menu-item title="Menu Manager" icon="la la-list" :link="backpack_url('menu-item')" />
</x-backpack::menu-dropdown>
{{-- Menu Manager --}}
