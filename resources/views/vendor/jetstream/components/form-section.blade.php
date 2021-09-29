@props(['submit'])

<div class="col" {{-- $attributes->merge(['class' => 'md:grid md:grid-cols-3 md:gap-6']) --}}>
    <div class="row">
        <div class="col pt-2">
            <div class="card">

                <div class="card-header">
                    <x-jet-section-title>
                        <x-slot name="title">{{ $title }}</x-slot>
                        <x-slot name="description">{{ $description }}</x-slot>
                    </x-jet-section-title>
                </div>
                <form wire:submit.prevent="{{ $submit }}">
                    <div class="card-body">
                       
                        {{ $form }}

                        @if (isset($actions))
                            <div class="flex items-center justify-center px-4 py-3 bg-gray-50 text-right sm:px-6">
                                {{ $actions }}
                            </div>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
