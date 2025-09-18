            <header class="bg-white shadow-sm">
                <div class="flex items-center justify-between p-4">
                    <div class="flex items-center">
                        <button @click="isSidebarOpen = !isSidebarOpen" class="md:hidden text-gray-500 mr-4">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                        <h1 class="text-2xl font-semibold text-gray-800"
                            x-text="activeTab.charAt(0).toUpperCase() + activeTab.slice(1)"></h1>
                    </div>

                    <div class="flex items-center">
                        <div class="relative mr-4">
                            <input type="text" placeholder="Search..."
                                class="pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        </div>
                        <button class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center relative">
                            <i class="fas fa-bell text-gray-600"></i>
                            <span
                                class="absolute top-0 right-0 w-4 h-4 bg-red-500 text-white text-xs rounded-full flex items-center justify-center">3</span>
                        </button>
                    </div>
                </div>
            </header>
