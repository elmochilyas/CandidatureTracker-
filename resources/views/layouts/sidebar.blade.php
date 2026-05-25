<div x-data="{ mobileOpen: false }" @toggle-mobile-menu.window="mobileOpen = !mobileOpen">
    <aside class="hidden lg:flex lg:flex-col fixed inset-y-0 left-0 z-50 w-64 glass-sidebar">
        <div class="flex items-center gap-3 px-5 h-14 shrink-0 border-b border-dark-border">
            <x-application-logo class="w-7 h-7 shrink-0 fill-current text-dark-primary" />
            <span class="text-sm font-bold text-dark-text tracking-tight">CandidatureTracker</span>
        </div>

        <nav class="flex-1 flex flex-col justify-between px-2 py-3 overflow-y-auto">
            <div class="space-y-0.5">
                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/>
                    </svg>
                    <span>Tableau de bord</span>
                </x-nav-link>

                <x-nav-link :href="route('candidatures.index')" :active="request()->routeIs('candidatures.index')">
                    <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z"/>
                    </svg>
                    <span>Candidatures</span>
                </x-nav-link>

                <x-nav-link :href="route('candidatures.archived')" :active="request()->routeIs('candidatures.archived')">
                    <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5m6 4.125l2.25 2.25m0 0l2.25 2.25M12 11.625l2.25-2.25M12 11.625l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z"/>
                    </svg>
                    <span>Archives</span>
                </x-nav-link>
            </div>

            <div class="space-y-1">
                <button @click="$dispatch('toggle-theme')" class="w-full flex items-center gap-3 px-3 py-2 rounded-xl text-sm font-medium text-dark-text-secondary hover:text-dark-text hover:bg-overlay-subtle focus-visible:ring-2 focus-visible:ring-dark-primary transition-all duration-200">
                    <template x-if="!isDark">
                        <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z"/>
                        </svg>
                    </template>
                    <template x-if="isDark">
                        <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"/>
                        </svg>
                    </template>
                    <span x-text="isDark ? 'Mode clair' : 'Mode sombre'"></span>
                </button>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-3 py-2 rounded-xl text-sm font-medium text-dark-text-secondary hover:text-dark-danger hover:bg-dark-danger/10 focus-visible:ring-2 focus-visible:ring-dark-danger active:scale-[0.98] transition-all duration-200">
                        <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9"/>
                        </svg>
                        <span>Déconnexion</span>
                    </button>
                </form>

                <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl bg-overlay-subtle border border-dark-border hover:bg-overlay-hover active:scale-[0.98] transition-all duration-200 cursor-pointer group">
                    <span class="inline-flex items-center justify-center w-7 h-7 rounded-lg bg-gradient-primary text-white text-xs font-bold shrink-0 group-hover:scale-105 transition-transform duration-200">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </span>
                    <div class="min-w-0 flex-1">
                        <p class="text-sm font-medium text-dark-text truncate leading-tight">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-dark-text-secondary truncate leading-tight">{{ Auth::user()->email }}</p>
                    </div>
                </a>
            </div>
        </nav>
    </aside>

    <template x-teleport="body">
        <div x-show="mobileOpen" x-cloak class="relative z-50 lg:hidden">
            <div x-show="mobileOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-black/60 backdrop-blur-sm" @click="mobileOpen = false"></div>
            <div x-show="mobileOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="ease-in duration-200" x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full" class="fixed inset-y-0 left-0 w-72 glass-sidebar shadow-2xl flex flex-col">
                <div class="flex items-center justify-between px-5 h-14 shrink-0 border-b border-dark-border">
                    <div class="flex items-center gap-3">
                        <x-application-logo class="w-7 h-7 shrink-0 fill-current text-dark-primary" />
                        <span class="text-sm font-bold text-dark-text tracking-tight">CandidatureTracker</span>
                    </div>
                    <button @click="mobileOpen = false" class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-dark-text-secondary hover:text-dark-text hover:bg-overlay-subtle focus-visible:ring-2 focus-visible:ring-dark-primary transition-all duration-200">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                    <nav class="flex-1 flex flex-col justify-between px-2 py-3 overflow-y-auto">
                    <div class="space-y-0.5">
                        <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            <svg class="w-5 h-5 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/>
                            </svg>
                            Tableau de bord
                        </x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('candidatures.index')" :active="request()->routeIs('candidatures.index')">
                            <svg class="w-5 h-5 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z"/>
                            </svg>
                            Candidatures
                        </x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('candidatures.archived')" :active="request()->routeIs('candidatures.archived')">
                            <svg class="w-5 h-5 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5m6 4.125l2.25 2.25m0 0l2.25 2.25M12 11.625l2.25-2.25M12 11.625l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z"/>
                            </svg>
                            Archives
                        </x-responsive-nav-link>
                    </div>

                    <div class="space-y-1">
                        <button @click="$dispatch('toggle-theme')" class="flex items-center w-full px-3 py-2 rounded-xl text-sm font-medium text-dark-text-secondary hover:text-dark-text hover:bg-overlay-subtle focus-visible:ring-2 focus-visible:ring-dark-primary transition-all duration-200">
                            <template x-if="!isDark">
                                <svg class="w-5 h-5 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z"/>
                                </svg>
                            </template>
                            <template x-if="isDark">
                                <svg class="w-5 h-5 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"/>
                                </svg>
                            </template>
                            <span x-text="isDark ? 'Mode clair' : 'Mode sombre'"></span>
                        </button>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" onclick="event.preventDefault(); this.closest('form').submit();" class="flex items-center w-full px-3 py-2 rounded-xl text-sm font-medium text-dark-text-secondary hover:text-dark-danger hover:bg-dark-danger/10 focus-visible:ring-2 focus-visible:ring-dark-danger active:scale-[0.98] transition-all duration-200">
                                <svg class="w-5 h-5 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9"/>
                                </svg>
                                Déconnexion
                            </button>
                        </form>

                        <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl bg-overlay-subtle border border-dark-border hover:bg-overlay-hover active:scale-[0.98] transition-all duration-200 cursor-pointer group">
                            <span class="inline-flex items-center justify-center w-7 h-7 rounded-lg bg-gradient-primary text-white text-xs font-bold shrink-0 group-hover:scale-105 transition-transform duration-200">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </span>
                            <div class="min-w-0 flex-1">
                                <p class="text-sm font-medium text-dark-text truncate leading-tight">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-dark-text-secondary truncate leading-tight">{{ Auth::user()->email }}</p>
                            </div>
                        </a>
                    </div>
                </nav>
            </div>
        </div>
    </template>
</div>
