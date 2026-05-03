/**
 * TagInput — composant léger pour saisir des listes d'items
 * Usage : new TagInput('containerId', 'fieldName', ['item1', 'item2'])
 */
class TagInput {
    constructor(containerId, fieldName, initialItems = []) {
        this.container = document.getElementById(containerId);
        this.fieldName = fieldName;
        this.items = [...initialItems];
        this.render();
    }

    render() {
        this.container.innerHTML = `
            <div class="tag-list flex flex-wrap gap-2 mb-3 min-h-[36px]"></div>
            <div class="flex gap-2">
                <input type="text"
                    class="tag-input flex-1 px-3 py-2 border-2 border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-transparent"
                    placeholder="Tapez un item et appuyez sur Entrée ou +" />
                <button type="button"
                    class="tag-add px-4 py-2 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-xl text-sm font-semibold hover:shadow-md transition">
                    +
                </button>
            </div>
            <div class="hidden-inputs"></div>
        `;

        this.tagList = this.container.querySelector('.tag-list');
        this.input = this.container.querySelector('.tag-input');
        this.addBtn = this.container.querySelector('.tag-add');
        this.hiddenInputs = this.container.querySelector('.hidden-inputs');

        this.items.forEach(item => this._addTag(item));

        this.addBtn.addEventListener('click', () => this._addFromInput());
        this.input.addEventListener('keydown', (e) => {
            if (e.key === 'Enter') { e.preventDefault(); this._addFromInput(); }
        });
    }

    _addFromInput() {
        const val = this.input.value.trim();
        if (val && !this.items.includes(val)) {
            this.items.push(val);
            this._addTag(val);
            this.input.value = '';
        }
        this.input.focus();
    }

    _addTag(text) {
        // Badge visuel
        const badge = document.createElement('span');
        badge.className = 'inline-flex items-center gap-1.5 bg-blue-50 border border-blue-200 text-blue-700 text-sm px-3 py-1.5 rounded-full';
        badge.innerHTML = `
            <span>${text}</span>
            <button type="button" class="text-blue-400 hover:text-red-500 transition font-bold leading-none">&times;</button>
        `;
        badge.querySelector('button').addEventListener('click', () => {
            this.items = this.items.filter(i => i !== text);
            badge.remove();
            this._syncHidden();
        });
        this.tagList.appendChild(badge);

        // Input caché pour le formulaire
        this._syncHidden();
    }

    _syncHidden() {
        this.hiddenInputs.innerHTML = '';
        this.items.forEach(item => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = `${this.fieldName}[]`;
            input.value = item;
            this.hiddenInputs.appendChild(input);
        });
    }
}
