@php use App\Enums\DashboardTab; @endphp

<x-dashboard :tab="DashboardTab::USERS">
    <x-users-table :users="$users"/>
</x-dashboard>
