<x-app-web-layout>
    <x-slot name="header">
        <h2 class="fw-semibold fs-4 text-dark">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @hasrole('admin|superadmin')
    <div class="py-4">
        <div class="container">
            <div class="row">
                <!-- Users -->
                <div class="col-md-4 mb-4">
                    <div class="bg-primary text-white shadow-sm rounded p-4">
                        <x-nav-link :href="url('users')" :active="request()->routeIs('users')" class="text-white">
                            {{ __('Users') }}
                        </x-nav-link>
                    </div>
                </div>

                <!-- Roles -->
                <div class="col-md-4 mb-4">
                    <div class="bg-success text-white shadow-sm rounded p-4">
                        <x-nav-link :href="url('roles')" :active="request()->routeIs('roles')" class="text-white">
                            {{ __('Roles') }}
                        </x-nav-link>
                    </div>
                </div>

                <!-- Permissions -->
                <div class="col-md-4 mb-4">
                    <div class="bg-warning text-dark shadow-sm rounded p-4">
                        <x-nav-link :href="url('permissions')" :active="request()->routeIs('permissions')" class="text-dark">
                            {{ __('Permissions') }}
                        </x-nav-link>
                    </div>
                </div>

                <!-- Jobs -->
                <div class="col-md-4 mb-4">
                    <div class="bg-danger text-white shadow-sm rounded p-4">
                        <x-nav-link :href="url('job-postings')" :active="request()->routeIs('job-postings.*')" class="text-white">
                            {{ __('Jobs') }}
                        </x-nav-link>
                    </div>
                </div>

                <!-- Portfolios -->
                <div class="col-md-4 mb-4">
                    <div class="bg-info text-white shadow-sm rounded p-4">
                        <x-nav-link :href="url('portfolio')" :active="request()->routeIs('portfolio.show')" class="text-white">
                            {{ __('Portfolios') }}
                        </x-nav-link>
                    </div>
                </div>

                <!-- Job Applications -->
                <div class="col-md-4 mb-4">
                    <div class="bg-secondary text-white shadow-sm rounded p-4">
                        <x-nav-link :href="url('job-applications')" :active="request()->routeIs('job-applications.*')" class="text-white">
                            {{ __('Job Applications') }}
                        </x-nav-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="py-4">
        <div class="container">
            <div class="bg-light shadow-sm rounded">
                <div class="p-4 text-center">
                    <h3 class="text-primary">{{ __('Welcome to Your Dashboard!') }}</h3>
                    <p class="fs-5 text-muted">{{ __("We're excited to have you here. Explore the latest job opportunities tailored just for you!") }}</p>
                </div>
            </div>

            <div class="row mt-4">
                <!-- Jobs -->
                <div class="col-md-6 mb-4">
                    <div class="bg-success text-white shadow-sm rounded p-4">
                        <x-nav-link :href="url('job-postings')" :active="request()->routeIs('job-postings.*')" class="text-white">
                            <h4>{{ __('Explore Jobs') }}</h4>
                            <p>{{ __('Find your next career move with our curated job listings.') }}</p>
                        </x-nav-link>
                    </div>
                </div>

                <!-- Featured Companies -->
                <div class="col-md-6 mb-4">
                    <div class="bg-info text-white shadow-sm rounded p-4">
                        <h4>{{ __('Top Companies') }}</h4>
                        <p>{{ __('Discover companies that are actively hiring and offering great opportunities.') }}</p>
                    </div>
                </div>

                <!-- Career Tips -->
                <div class="col-md-6 mb-4">
                    <div class="bg-warning text-dark shadow-sm rounded p-4">
                        <h4>{{ __('Career Tips') }}</h4>
                        <p>{{ __('Get insights and tips on how to advance your career from industry experts.') }}</p>
                    </div>
                </div>

                <!-- Personal Growth -->
                <div class="col-md-6 mb-4">
                    <div class="bg-primary text-white shadow-sm rounded p-4">
                        <h4>{{ __('Personal Growth') }}</h4>
                        <p>{{ __('Explore resources and courses to help you grow both professionally and personally.') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endhasrole
</x-app-web-layout>
