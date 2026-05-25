<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-base font-bold text-dark-text">Nouvelle candidature</h2>
            <p class="text-xs text-dark-text-secondary mt-0.5">Ajoutez une nouvelle opportunité professionnelle</p>
        </div>
    </x-slot>

    <div class="py-5">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <a href="{{ route('candidatures.index') }}" class="inline-flex items-center gap-1.5 text-sm text-dark-text-secondary hover:text-dark-text font-medium transition-colors mb-6">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/></svg>
                Retour
            </a>

            <div class="glass-card overflow-hidden">
                {{-- Intro banner --}}
                <div class="h-1 w-full bg-gradient-to-r from-dark-primary to-dark-accent"></div>
                <div class="px-6 sm:px-8 pt-6 pb-5 border-b border-dark-border flex items-center gap-4">
                    <div class="w-11 h-11 rounded-xl bg-gradient-primary flex items-center justify-center shrink-0 shadow-glow">
                        <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-bold text-dark-text">Nouvelle candidature</h3>
                        <p class="text-xs text-dark-text-secondary mt-0.5">Renseignez les informations de votre candidature</p>
                    </div>
                </div>

                <div class="p-6 sm:p-8">
                    <form method="POST" action="{{ route('candidatures.store') }}" enctype="multipart/form-data" class="space-y-8">
                        @csrf

                        {{-- Section: Informations --}}
                        <div>
                            <div class="flex items-center gap-3 mb-5">
                                <div class="w-8 h-8 rounded-lg bg-blue-500/10 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21"/>
                                    </svg>
                                </div>
                                <h3 class="text-sm font-semibold text-dark-text">Informations</h3>
                                <div class="flex-1 h-px bg-dark-border"></div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <x-input-label for="company_name" :value="__('Entreprise *')" />
                                    <div class="relative mt-1.5">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                                            <svg class="w-5 h-5 text-dark-text-secondary/50" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21"/>
                                            </svg>
                                        </div>
                                        <x-text-input id="company_name" class="block w-full pl-10 pr-3" type="text" name="company_name" :value="old('company_name')" required autofocus placeholder="Acme Corp" />
                                    </div>
                                    <x-input-error :messages="$errors->get('company_name')" class="mt-1.5" />
                                </div>

                                <div>
                                    <x-input-label for="role" :value="__('Poste visé *')" />
                                    <div class="relative mt-1.5">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                                            <svg class="w-5 h-5 text-dark-text-secondary/50" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M12 12.75h.008v.008H12v-.008z"/>
                                            </svg>
                                        </div>
                                        <x-text-input id="role" class="block w-full pl-10 pr-3" type="text" name="role" :value="old('role')" required placeholder="Développeur Laravel" />
                                    </div>
                                    <x-input-error :messages="$errors->get('role')" class="mt-1.5" />
                                </div>
                            </div>
                        </div>

                        {{-- Section: Détails --}}
                        <div>
                            <div class="flex items-center gap-3 mb-5">
                                <div class="w-8 h-8 rounded-lg bg-violet-500/10 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-violet-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z"/>
                                    </svg>
                                </div>
                                <h3 class="text-sm font-semibold text-dark-text">Détails</h3>
                                <div class="flex-1 h-px bg-dark-border"></div>
                            </div>

                            <div class="space-y-5">
                                <div>
                                    <x-input-label for="offer_url" :value="__('URL de l\'offre (optionnelle)')" />
                                    <div class="relative mt-1.5">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                                            <svg class="w-5 h-5 text-dark-text-secondary/50" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244"/>
                                            </svg>
                                        </div>
                                        <x-text-input id="offer_url" class="block w-full pl-10 pr-3" type="url" name="offer_url" :value="old('offer_url')" placeholder="https://exemple.com/offre/123" />
                                    </div>
                                    <x-input-error :messages="$errors->get('offer_url')" class="mt-1.5" />
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <x-input-label for="status" :value="__('Statut *')" />
                                        <x-select-input id="status" name="status" class="mt-1.5" required>
                                            <option value="to_apply" {{ old('status') == 'to_apply' ? 'selected' : '' }}>À postuler</option>
                                            <option value="applied" {{ old('status') == 'applied' ? 'selected' : '' }}>Candidature envoyée</option>
                                            <option value="waiting" {{ old('status') == 'waiting' ? 'selected' : '' }}>En attente</option>
                                            <option value="interview_scheduled" {{ old('status') == 'interview_scheduled' ? 'selected' : '' }}>Entretien programmé</option>
                                            <option value="rejected" {{ old('status') == 'rejected' ? 'selected' : '' }}>Refus</option>
                                            <option value="accepted" {{ old('status') == 'accepted' ? 'selected' : '' }}>Acceptée</option>
                                        </x-select-input>
                                        <x-input-error :messages="$errors->get('status')" class="mt-1.5" />
                                    </div>

                                    <div>
                                        <x-input-label for="priority" :value="__('Priorité *')" />
                                        <x-select-input id="priority" name="priority" class="mt-1.5" required>
                                            <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Basse</option>
                                            <option value="normal" {{ old('priority') == 'normal' ? 'selected' : '' }}>Normale</option>
                                            <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>Haute</option>
                                        </x-select-input>
                                        <x-input-error :messages="$errors->get('priority')" class="mt-1.5" />
                                    </div>
                                </div>

                                <div>
                                    <x-input-label for="notes" :value="__('Notes (optionnelles)')" />
                                    <textarea id="notes" name="notes" class="block mt-1.5 w-full rounded-glass-input bg-dark-surface border border-dark-border px-4 py-2.5 text-sm text-dark-text placeholder-dark-text-secondary/50 focus:outline-none focus:border-dark-primary-hover focus:ring-2 focus:ring-dark-primary-hover/20 transition-all duration-200" rows="4" placeholder="Informations complémentaires...">{{ old('notes') }}</textarea>
                                    <x-input-error :messages="$errors->get('notes')" class="mt-1.5" />
                                </div>
                            </div>
                        </div>

                        {{-- Section: Date & fichier --}}
                        <div>
                            <div class="flex items-center gap-3 mb-5">
                                <div class="w-8 h-8 rounded-lg bg-amber-500/10 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/>
                                    </svg>
                                </div>
                                <h3 class="text-sm font-semibold text-dark-text">Date & fichier</h3>
                                <div class="flex-1 h-px bg-dark-border"></div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <x-input-label for="application_date" :value="__('Date de candidature *')" />
                                    <div class="relative mt-1.5">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                                            <svg class="w-5 h-5 text-dark-text-secondary/50" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/>
                                            </svg>
                                        </div>
                                        <x-text-input id="application_date" class="block w-full pl-10 pr-3" type="date" name="application_date" :value="old('application_date', date('Y-m-d'))" required />
                                    </div>
                                    <x-input-error :messages="$errors->get('application_date')" class="mt-1.5" />
                                </div>

                                <div>
                                    <x-input-label for="attachments" :value="__('Fichiers joints (optionnel)')" />
                                    <div
                                        x-data="{
                                            files: [],
                                            formatSize(bytes) {
                                                const units = ['o', 'Ko', 'Mo', 'Go'];
                                                let i = 0;
                                                while (bytes >= 1024 && i < units.length - 1) { bytes /= 1024; i++; }
                                                return bytes.toFixed(i > 0 ? 1 : 0) + ' ' + units[i];
                                            },
                                            addFiles($event) {
                                                const newFiles = [...$event.target.files];
                                                for (const nf of newFiles) {
                                                    if (!this.files.some(f => f.name === nf.name && f.size === nf.size)) {
                                                        this.files.push(nf);
                                                    }
                                                }
                                                const dt = new DataTransfer();
                                                for (const f of this.files) dt.items.add(f);
                                                $event.target.files = dt.files;
                                            },
                                            removeFile(index) {
                                                this.files.splice(index, 1);
                                                const dt = new DataTransfer();
                                                const input = document.getElementById('attachments');
                                                for (const f of this.files) dt.items.add(f);
                                                input.files = dt.files;
                                            },
                                            fileIcon(file) {
                                                if (file.type.startsWith('image/')) return 'image';
                                                if (file.type === 'application/pdf') return 'pdf';
                                                if (file.type.includes('word') || file.name.endsWith('.doc') || file.name.endsWith('.docx')) return 'word';
                                                return 'file';
                                            }
                                        }"
                                        class="mt-1.5"
                                    >
                                        <div
                                            @dragover.prevent="$el.classList.add('border-dark-primary/40')"
                                            @dragleave.prevent="$el.classList.remove('border-dark-primary/40')"
                                            @drop.prevent="
                                                $el.classList.remove('border-dark-primary/40');
                                                const dropped = [...$event.dataTransfer.files].filter(f => ['application/pdf','application/msword','application/vnd.openxmlformats-officedocument.wordprocessingml.document','image/png','image/jpeg','image/jpg'].includes(f.type) || f.name.match(/\.(pdf|doc|docx|png|jpg|jpeg)$/i));
                                                const input = document.getElementById('attachments');
                                                const dt = new DataTransfer();
                                                for (const existing of input.files) dt.items.add(existing);
                                                for (const f of dropped) dt.items.add(f);
                                                input.files = dt.files;
                                                files = [...input.files];
                                            "
                                            class="border-2 border-dashed border-dark-border rounded-glass-input px-4 py-5 text-center hover:border-dark-primary/40 transition-colors duration-200 cursor-pointer"
                                        >
                                            <svg class="w-7 h-7 text-dark-text-secondary/40 mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M18.375 12.739l-7.693 7.693a4.5 4.5 0 01-6.364-6.364l10.94-10.94A3 3 0 1119.5 7.372L8.552 18.32m.009-.01l-.01.01m5.699-9.941l-7.81 7.81a1.5 1.5 0 002.112 2.13"/>
                                            </svg>
                                            <input id="attachments" type="file" name="attachments[]" multiple accept=".pdf,.doc,.docx,.png,.jpg,.jpeg"
                                                @change="addFiles($event)"
                                                class="block w-full text-sm text-dark-text-secondary cursor-pointer file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-medium file:bg-dark-primary/10 file:text-dark-primary hover:file:bg-dark-primary/20 transition-colors" />
                                            <p class="mt-2 text-xs text-dark-text-secondary/60">PDF, DOC, PNG ou JPG &mdash; glissez-déposez ou cliquez pour ajouter</p>
                                        </div>

                                        <template x-if="files.length > 0">
                                            <div class="mt-3 space-y-2">
                                                <template x-for="(file, index) in files" :key="index">
                                                    <div class="flex items-center gap-3 px-3 py-2.5 bg-overlay-subtle rounded-lg border border-dark-border">
                                                        <template x-if="fileIcon(file) === 'pdf'">
                                                            <svg class="w-5 h-5 text-dark-danger shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                                                        </template>
                                                        <template x-if="fileIcon(file) === 'image'">
                                                            <svg class="w-5 h-5 text-emerald-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3.75 21h16.5A2.25 2.25 0 0022.5 18.75V5.25A2.25 2.25 0 0020.25 3H3.75A2.25 2.25 0 001.5 5.25v13.5A2.25 2.25 0 003.75 21z"/></svg>
                                                        </template>
                                                        <template x-if="fileIcon(file) === 'word'">
                                                            <svg class="w-5 h-5 text-blue-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                                                        </template>
                                                        <template x-if="fileIcon(file) === 'file'">
                                                            <svg class="w-5 h-5 text-dark-text-secondary shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 00-1.883 2.542l.857 6a2.25 2.25 0 002.227 1.932H19.05a2.25 2.25 0 002.227-1.932l.857-6a2.25 2.25 0 00-1.883-2.542m-16.5 0V6A2.25 2.25 0 016 3.75h3.879a1.5 1.5 0 011.06.44l2.122 2.12a1.5 1.5 0 001.06.44H18A2.25 2.25 0 0120.25 9v.776"/></svg>
                                                        </template>
                                                        <div class="flex-1 min-w-0">
                                                            <p class="text-sm font-medium text-dark-text truncate" x-text="file.name"></p>
                                                            <p class="text-xs text-dark-text-secondary" x-text="formatSize(file.size)"></p>
                                                        </div>
                                                        <button type="button" @click="removeFile(index)" class="shrink-0 p-1 rounded-lg hover:bg-dark-danger/10 text-dark-text-secondary hover:text-dark-danger transition-colors">
                                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                                                        </button>
                                                    </div>
                                                </template>
                                            </div>
                                        </template>
                                    </div>
                                    <x-input-error :messages="$errors->get('attachments')" class="mt-1.5" />
                                    <x-input-error :messages="$errors->get('attachments.*')" class="mt-1.5" />
                                </div>
                            </div>
                        </div>

                        {{-- Footer actions --}}
                        <div class="flex items-center justify-end gap-3 pt-6 border-t border-dark-border">
                            <a href="{{ route('candidatures.index') }}" class="flex items-center px-5 py-2.5 border border-dark-border rounded-glass-button text-sm font-medium text-dark-text-secondary bg-overlay-subtle hover:bg-overlay-hover hover:text-dark-text active:scale-[0.97] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-dark-primary transition-all duration-200">
                                Annuler
                            </a>
                            <x-primary-button>
                                <svg class="w-4 h-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                                </svg>
                                Enregistrer
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
