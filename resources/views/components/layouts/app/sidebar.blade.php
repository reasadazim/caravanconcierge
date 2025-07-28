<aside :class="{ 'w-full md:w-64': sidebarOpen, 'w-0 md:w-16 hidden md:block': !sidebarOpen }"
       class="bg-sidebar text-sidebar-foreground border-r border-gray-200 dark:border-gray-700 sidebar-transition overflow-hidden">
    <!-- Sidebar Content -->
    <div class="h-full flex flex-col">
        <!-- Sidebar Menu -->
        <nav class="flex-1 overflow-y-auto custom-scrollbar py-4">
            <ul class="space-y-1 px-2">
                <!-- Dashboard -->
                <x-layouts.sidebar-link href="{{ route('dashboard') }}" icon="pixelarticons:dashbaord"
                                        :active="request()->routeIs('dashboard*')">DASHBOARD</x-layouts.sidebar-link>

                <!-- Example two level -->
                <x-layouts.sidebar-two-level-link-parent title="LEAD MANAGEMENT" icon="mdi:leads-outline"
                                                         :active="request()->routeIs('leads.index') || request()->routeIs('contact.index') || request()->routeIs('waiting.index')">
                    <x-layouts.sidebar-two-level-link href="{{ route('leads.index') }}" icon='octicon:dot-24'
                                                      :active="request()->routeIs('leads.index')"> Leads</x-layouts.sidebar-two-level-link>
                    <x-layouts.sidebar-two-level-link href="#" icon='octicon:dot-24'
                                                      :active="request()->routeIs('#')"> Waiting List</x-layouts.sidebar-two-level-link>
                </x-layouts.sidebar-two-level-link-parent>

                <!-- Example two level -->
                <x-layouts.sidebar-two-level-link-parent title="FINANCIAL" icon="carbon:finance"
                                                         :active="request()->routeIs('two-level*')">
                    <x-layouts.sidebar-two-level-link href="#" icon='octicon:dot-24'
                                                      :active="request()->routeIs('two-level*')"> Agreement</x-layouts.sidebar-two-level-link>
                    <x-layouts.sidebar-two-level-link href="#" icon='octicon:dot-24'
                                                      :active="request()->routeIs('two-level*')"> Rent Roll</x-layouts.sidebar-two-level-link>
                </x-layouts.sidebar-two-level-link-parent>

                <!-- Example two level -->
                <x-layouts.sidebar-two-level-link-parent title="REPORTS" icon="icon-park-twotone:sales-report"
                                                         :active="request()->routeIs('two-level*')">
                    <x-layouts.sidebar-two-level-link href="#" icon='octicon:dot-24'
                                                      :active="request()->routeIs('two-level*')"> Sales</x-layouts.sidebar-two-level-link>
                    <x-layouts.sidebar-two-level-link href="#" icon='octicon:dot-24'
                                                      :active="request()->routeIs('two-level*')"> Occupancy & Capacity Matrix</x-layouts.sidebar-two-level-link>
                    <x-layouts.sidebar-two-level-link href="#" icon='octicon:dot-24'
                                                      :active="request()->routeIs('two-level*')"> Financial Performance</x-layouts.sidebar-two-level-link>
                    <x-layouts.sidebar-two-level-link href="#" icon='octicon:dot-24'
                                                      :active="request()->routeIs('two-level*')"> Customer Matrix</x-layouts.sidebar-two-level-link>
                    <x-layouts.sidebar-two-level-link href="#" icon='octicon:dot-24'
                                                      :active="request()->routeIs('two-level*')"> Growth and Marketing</x-layouts.sidebar-two-level-link>
                </x-layouts.sidebar-two-level-link-parent>

                <!-- Example two level -->
                <x-layouts.sidebar-two-level-link-parent title="USER MANAGEMENT" icon="ix:user-management-settings"
                                                         :active="request()->routeIs('two-level*')">
                    <x-layouts.sidebar-two-level-link href="#" icon='octicon:dot-24'
                                                      :active="request()->routeIs('two-level*')"> User List</x-layouts.sidebar-two-level-link>
                    <x-layouts.sidebar-two-level-link href="#" icon='octicon:dot-24'
                                                      :active="request()->routeIs('two-level*')"> Add New User</x-layouts.sidebar-two-level-link>
                </x-layouts.sidebar-two-level-link-parent>


                <!-- Example three level -->
                {{--                            <x-layouts.sidebar-two-level-link-parent title="Example three level" icon="fas-house"--}}
                {{--                                :active="request()->routeIs('three-level*')">--}}
                {{--                                <x-layouts.sidebar-two-level-link href="#" icon='fas-house'--}}
                {{--                                    :active="request()->routeIs('three-level*')">Single Link</x-layouts.sidebar-two-level-link>--}}

                {{--                                <x-layouts.sidebar-three-level-parent title="Third Level" icon="fas-house"--}}
                {{--                                    :active="request()->routeIs('three-level*')">--}}
                {{--                                    <x-layouts.sidebar-three-level-link href="#" :active="request()->routeIs('three-level*')">--}}
                {{--                                        Third Level Link--}}
                {{--                                    </x-layouts.sidebar-three-level-link>--}}
                {{--                                </x-layouts.sidebar-three-level-parent>--}}
                {{--                            </x-layouts.sidebar-two-level-link-parent>--}}
            </ul>
        </nav>
    </div>
</aside>
