<x-filament::page>
    <div 
        x-data="{
            selectedCategory: '',
            selectedUser: '',
            subcategories: @js($subcategories),
            get filtered() {
                return this.subcategories.filter(item => {
                    return (this.selectedCategory === '' || item.category_id == this.selectedCategory)
                        && (this.selectedUser === '' || item.pic_user_id == this.selectedUser);
                });
            }
        }"
        class="space-y-6"
    >
        {{-- Filters --}}
        <div class="flex flex-wrap gap-4">
            <div>
                <label class="block text-sm font-medium">Kategori</label>
                <select x-model="selectedCategory" class="filament-input w-60">
                    <option value="">Semua</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium">PIC</label>
                <select x-model="selectedUser" class="filament-input w-60">
                    <option value="">Semua</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        {{-- Summary --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <x-filament::card>
                <div class="text-sm">Total Subkategori</div>
                <div class="text-2xl font-bold" x-text="filtered.length"></div>
            </x-filament::card>

            <x-filament::card>
                <div class="text-sm">Sudah Diisi</div>
                <div class="text-2xl font-bold" 
                    x-text="filtered.filter(i => i.document_url).length"></div>
            </x-filament::card>

            <x-filament::card>
                <div class="text-sm">Progress (%)</div>
                <div class="text-2xl font-bold" 
                    x-text="filtered.length > 0 ? Math.round(filtered.filter(i => i.document_url).length / filtered.length * 100) + '%' : '0%'">
                </div>
            </x-filament::card>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto border border-gray-200 rounded-lg">
            <table class="w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-teal-50">
                    <tr>
                        <th class="px-4 py-2 text-left font-semibold">Subkategori</th>
                        <th class="px-4 py-2 text-left font-semibold">Kategori</th>
                        <th class="px-4 py-2 text-left font-semibold">PIC</th>
                        <th class="px-4 py-2 text-left font-semibold">Dokumen</th>
                        <th class="px-4 py-2 text-left font-semibold">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100" x-data x-ref="tbody">
                    <template x-for="item in filtered" :key="item.id">
                        <tr class="hover:bg-teal-50">
                            <td class="px-4 py-2" x-text="item.name"></td>
                            <td class="px-4 py-2" x-text="item.category_name"></td>
                            <td class="px-4 py-2" x-text="item.pic_name ?? '-'"></td>
                            <td class="px-4 py-2">
                                <a :href="item.document_url" x-text="item.document_url ?? '-'" class="text-blue-500 underline" target="_blank"></a>
                            </td>
                            <td class="px-4 py-2">
                                <span 
                                    x-show="item.document_url" 
                                    class="text-green-600 font-semibold">✅</span>
                                <span 
                                    x-show="!item.document_url"
                                    class="text-red-600 font-semibold">❌</span>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
    </div>
</x-filament::page>
