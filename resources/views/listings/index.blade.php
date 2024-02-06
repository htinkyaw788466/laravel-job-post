<x-layout>

    @if (session()->has('message'))
        <div x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show" class="alert alert-success">
            {{ session('message') }}
        </div>
   @endif

@include('partials._hero')

@include('partials._search')

<div
class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4"
>


@unless (count($listings)==0)

@foreach ($listings as $listing)

<!-- Item 1 -->
<x-listing-card :listing="$listing"/>

@endforeach

@else
<p>No Listing Found</p>
@endunless

</div>

<div class="mt-6 p-4">
    {{ $listings->links() }}
</div>

</x-layout>
