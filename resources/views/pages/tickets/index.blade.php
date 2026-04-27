@php use App\Enums\DashboardTab; @endphp

<x-dashboard :tab="DashboardTab::TICKETS">
    <x-tickets-table
        :tickets="$tickets"
        :email-filter="$email"
        :phone-filter="$phone"
        :status-filter="$status"
        :date-from="$dateFrom"
        :date-to="$dateTo"
    />
</x-dashboard>
