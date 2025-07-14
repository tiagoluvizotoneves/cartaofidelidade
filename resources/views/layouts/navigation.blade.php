<x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.*')">
    {{ __('Admin') }}
</x-nav-link>
