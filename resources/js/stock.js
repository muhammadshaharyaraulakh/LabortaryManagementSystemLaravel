document.addEventListener('DOMContentLoaded', () => {
    // Basic DOM Elements
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '';
    const tableBody = document.getElementById('inventory-table-body');
    const searchInput = document.getElementById('inventory-search');
    let searchTimeout = null;

    // Helper: Modal Management
    function openInvModal(backdropId, modalId) {
        const backdrop = document.getElementById(backdropId);
        const modal = document.getElementById(modalId);
        backdrop.classList.remove('hidden');
        backdrop.classList.add('flex');
        setTimeout(() => {
            backdrop.classList.remove('opacity-0');
            backdrop.classList.add('opacity-100');
            modal.classList.remove('scale-95');
            modal.classList.add('scale-100');
        }, 10);
    }

    function closeInvModal(backdropId, modalId, formId, prefix) {
        const backdrop = document.getElementById(backdropId);
        const modal = document.getElementById(modalId);
        backdrop.classList.remove('opacity-100');
        backdrop.classList.add('opacity-0');
        modal.classList.remove('scale-100');
        modal.classList.add('scale-95');
        setTimeout(() => {
            backdrop.classList.add('hidden');
            backdrop.classList.remove('flex');
            if (formId) {
                document.getElementById(formId).reset();
                if(prefix) clearInvErrors(prefix);
            }
        }, 300);
    }

    // Helper: Validation Errors
    function clearInvErrors(prefix) {
        document.querySelectorAll(`[id^="error${prefix}"]`).forEach(el => {
            el.classList.add('hidden');
            el.innerText = '';
        });
        document.querySelectorAll(`[id^="${prefix.charAt(0).toLowerCase() + prefix.slice(1)}"]`).forEach(el => {
            if (el.tagName === 'INPUT') el.classList.remove('border-red-500', 'focus:ring-red-200');
        });
    }

    function showInvErrors(errors, prefix) {
        clearInvErrors(prefix);
        for (const [field, messages] of Object.entries(errors)) {
            // Map validation keys to HTML input IDs
            let fieldMap = field;
            if(field === 'initial_stock') fieldMap = 'stock';
            if(field === 'action') fieldMap = 'reason';

            const inputId = `${prefix.charAt(0).toLowerCase() + prefix.slice(1)}${fieldMap.charAt(0).toUpperCase() + fieldMap.slice(1)}`;
            const errorId = `error${prefix}${fieldMap.charAt(0).toUpperCase() + fieldMap.slice(1)}`;
            
            const inputEl = document.getElementById(inputId);
            const errorEl = document.getElementById(errorId);

            if (errorEl) {
                errorEl.innerText = messages[0];
                errorEl.classList.remove('hidden');
            }
            if (inputEl) {
                inputEl.classList.add('border-red-500', 'focus:ring-red-200');
            }
        }
    }

    // Main Fetch Engine
    async function fetchInventory(url = '/inventory') {
        try {
            const response = await fetch(url, { headers: { 'Accept': 'application/json' } });
            const result = await response.json();
            if (response.ok && result.status === 'success') {
                renderInventoryTable(result.data.data || result.data);
            } else {
                tableBody.innerHTML = `<tr class="bg-white"><td colspan="4" class="px-6 py-8 text-center text-gray-500 font-medium">No inventory items found.</td></tr>`;
            }
        } catch (error) {}
    }

    function renderInventoryTable(items) {
        tableBody.innerHTML = '';
        if (!items || items.length === 0) {
            tableBody.innerHTML = `<tr class="bg-white"><td colspan="4" class="px-6 py-8 text-center text-gray-500 font-medium">No inventory items found.</td></tr>`;
            return;
        }

        items.forEach(item => {
            // UPDATED: Using item.alert instead of item.low_stock_alert
            const isLow = parseFloat(item.current_stock) <= parseFloat(item.alert);
            const badgeClass = isLow ? 'bg-red-50 text-red-600' : 'bg-green-50 text-green-600';
            
            const tr = document.createElement('tr');
            tr.className = 'bg-white border-b border-gray-100 hover:bg-gray-50 transition-colors text-gray-800 font-medium';
            tr.innerHTML = `
                <td class="px-6 py-4">${item.name} <span class="text-xs text-gray-400 ml-1">(${item.unit})</span></td>
                <td class="px-6 py-4">
                    <span class="px-3 py-1 rounded-full text-xs font-bold ${badgeClass}">${item.current_stock}</span>
                </td>
                <td class="px-6 py-4 text-gray-500">${item.alert}</td>
                <td class="px-6 py-4 text-right">
                    <button class="btn-edit text-teal-500 hover:text-teal-700 p-1 transition-colors" data-id="${item.id}"><i class="ph-duotone ph-pencil-simple text-lg"></i></button>
                    <button class="btn-add-stock text-green-500 hover:text-green-700 p-1 transition-colors" data-id="${item.id}"><i class="ph-duotone ph-plus-circle text-lg"></i></button>
                    <button class="btn-deduct-stock text-orange-500 hover:text-orange-700 p-1 transition-colors" data-id="${item.id}"><i class="ph-duotone ph-minus-circle text-lg"></i></button>
                    <button class="btn-logs text-blue-500 hover:text-blue-700 p-1 transition-colors" data-id="${item.id}"><i class="ph-duotone ph-clock-counter-clockwise text-lg"></i></button>
                    <button class="btn-delete text-red-500 hover:text-red-700 p-1 transition-colors" data-id="${item.id}"><i class="ph-duotone ph-trash text-lg"></i></button>
                </td>
            `;
            tableBody.appendChild(tr);
        });
        bindTableEvents();
    }

    // Top Level Event Listeners
    if(searchInput) {
        searchInput.addEventListener('keyup', (e) => {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                const q = e.target.value.trim();
                fetchInventory(q ? `/inventory/search/${q}` : '/inventory');
            }, 300);
        });
    }

    document.getElementById('BtnFetchAlerts')?.addEventListener('click', () => fetchInventory('/inventory/alerts'));
    
    document.getElementById('BtnOpenAddInventory')?.addEventListener('click', () => {
        openInvModal('AddInventoryModalBackdrop', 'AddInventoryModal');
    });

    document.getElementById('BtnGlobalHistory')?.addEventListener('click', async () => {
        try {
            const res = await fetch('/inventory/history', { headers: { 'Accept': 'application/json' } });
            const data = await res.json();
            if (data.status === 'success') {
                document.getElementById('LogsModalTitle').innerText = 'Global Inventory History';
                renderLogsTable(data.data.data || data.data);
                openInvModal('InventoryLogsModalBackdrop', 'InventoryLogsModal');
            }
        } catch (e) {}
    });

    // Add Item
    document.getElementById('SaveInventoryBtn')?.addEventListener('click', async (e) => {
        const btn = e.target;
        btn.disabled = true; btn.innerText = 'Saving...';
        
        const payload = {
            name: document.getElementById('addInvName').value,
            unit: document.getElementById('addInvUnit').value,
            initial_stock: document.getElementById('addInvStock').value,
            alert: document.getElementById('addInvAlert').value
        };

        try {
            const res = await fetch('/inventory/add', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': csrfToken },
                body: JSON.stringify(payload)
            });
            const result = await res.json();
            
            if (res.ok) {
                closeInvModal('AddInventoryModalBackdrop', 'AddInventoryModal', 'AddInventoryForm', 'AddInv');
                fetchInventory();
            } else if (res.status === 422) {
                showInvErrors(result.errors, 'AddInv');
            }
        } finally {
            btn.disabled = false; btn.innerText = 'Save Item';
        }
    });

    // Update Item
    document.getElementById('UpdateInventoryBtn')?.addEventListener('click', async (e) => {
        const id = document.getElementById('editInvId').value;
        const btn = e.target;
        btn.disabled = true; btn.innerText = 'Updating...';
        
        const payload = {
            name: document.getElementById('editInvName').value,
            unit: document.getElementById('editInvUnit').value,
            stock: document.getElementById('editInvStock').value,
            alert: document.getElementById('editInvAlert').value,
            _method: 'PUT'
        };

        try {
            const res = await fetch(`/inventory/${id}/edit`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': csrfToken },
                body: JSON.stringify(payload)
            });
            const result = await res.json();
            
            if (res.ok) {
                closeInvModal('EditInventoryModalBackdrop', 'EditInventoryModal', 'EditInventoryForm', 'EditInv');
                fetchInventory();
            } else if (res.status === 422) {
                showInvErrors(result.errors, 'EditInv');
            }
        } finally {
            btn.disabled = false; btn.innerText = 'Update Item';
        }
    });

    // Dynamic Modify Stock (Handles Add & Deduct)
    document.getElementById('SubmitModifyStockBtn')?.addEventListener('click', async (e) => {
        const id = document.getElementById('modifyStockId').value;
        const type = document.getElementById('modifyStockType').value; 
        const btn = e.target;
        
        btn.disabled = true; btn.innerText = 'Processing...';
        
        const payload = {
            stock: document.getElementById('modifyStockQty').value,
            action: document.getElementById('modifyStockReason').value,
            _method: 'PUT'
        };

        const endpoint = type === 'add' ? `/inventory/${id}/add-stock` : `/inventory/${id}/deduct-stock`;

        try {
            const res = await fetch(endpoint, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': csrfToken },
                body: JSON.stringify(payload)
            });
            const result = await res.json();
            
            if (res.ok) {
                closeInvModal('ModifyStockModalBackdrop', 'ModifyStockModal', 'ModifyStockForm', 'ModifyStock');
                fetchInventory();
            } else if (res.status === 422) {
                showInvErrors(result.errors, 'ModifyStock');
            }
        } finally {
            btn.disabled = false; btn.innerText = 'Confirm';
        }
    });

    // Event Delegation for Table Buttons
    function bindTableEvents() {
        document.querySelectorAll('.btn-edit').forEach(btn => {
            btn.addEventListener('click', async () => {
                const id = btn.getAttribute('data-id');
                try {
                    const res = await fetch(`/inventory/${id}`, { headers: { 'Accept': 'application/json' }});
                    const result = await res.json();
                    if(res.ok) {
                        const item = result.data;
                        document.getElementById('editInvId').value = item.id;
                        // UPDATED: Using item.name and item.alert
                        document.getElementById('editInvName').value = item.name;
                        document.getElementById('editInvUnit').value = item.unit;
                        document.getElementById('editInvStock').value = item.current_stock;
                        document.getElementById('editInvAlert').value = item.alert;
                        openInvModal('EditInventoryModalBackdrop', 'EditInventoryModal');
                    }
                } catch(e) {}
            });
        });

        document.querySelectorAll('.btn-add-stock').forEach(btn => {
            btn.addEventListener('click', () => setupModifyStockModal(btn.getAttribute('data-id'), 'add'));
        });

        document.querySelectorAll('.btn-deduct-stock').forEach(btn => {
            btn.addEventListener('click', () => setupModifyStockModal(btn.getAttribute('data-id'), 'deduct'));
        });

        document.querySelectorAll('.btn-logs').forEach(btn => {
            btn.addEventListener('click', async () => {
                const id = btn.getAttribute('data-id');
                try {
                    const res = await fetch(`/inventory/${id}/logs`, { headers: { 'Accept': 'application/json' }});
                    const data = await res.json();
                    if(res.ok) {
                        document.getElementById('LogsModalTitle').innerText = 'Item History';
                        renderLogsTable(data.data.logs);
                        openInvModal('InventoryLogsModalBackdrop', 'InventoryLogsModal');
                    }
                } catch(e) {}
            });
        });

        document.querySelectorAll('.btn-delete').forEach(btn => {
            btn.addEventListener('click', async function() {
                const id = btn.getAttribute('data-id');
                if (!btn.classList.contains('confirming')) {
                    const icon = btn.innerHTML;
                    btn.innerHTML = `<span class="text-xs font-bold px-2 rounded bg-red-100">Sure?</span>`;
                    btn.classList.add('confirming');
                    setTimeout(() => { 
                        if(btn) { btn.innerHTML = icon; btn.classList.remove('confirming'); }
                    }, 3000);
                    return;
                }
                
                try {
                    const res = await fetch(`/inventory/${id}`, { 
                        method: 'DELETE', 
                        headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': csrfToken }
                    });
                    if(res.ok) fetchInventory();
                } catch(e) {}
            });
        });
    }

    function setupModifyStockModal(id, type) {
        document.getElementById('modifyStockId').value = id;
        document.getElementById('modifyStockType').value = type;
        
        const title = document.getElementById('ModifyStockTitle');
        const iconCont = document.getElementById('ModifyStockIconContainer');
        const icon = document.getElementById('ModifyStockIcon');
        const submitBtn = document.getElementById('SubmitModifyStockBtn');

        if(type === 'add') {
            title.innerText = 'Add Incoming Stock';
            iconCont.className = 'w-10 h-10 rounded-lg flex items-center justify-center bg-green-50 text-green-500';
            icon.className = 'ph-duotone ph-plus-circle text-xl';
            submitBtn.className = 'bg-green-600 hover:bg-green-700 text-white px-6 py-2.5 rounded-xl text-sm font-bold transition-colors shadow-sm cursor-pointer';
            document.getElementById('modifyStockReason').placeholder = 'e.g. Purchased from vendor';
        } else {
            title.innerText = 'Deduct Stock';
            iconCont.className = 'w-10 h-10 rounded-lg flex items-center justify-center bg-red-50 text-red-500';
            icon.className = 'ph-duotone ph-minus-circle text-xl';
            submitBtn.className = 'bg-red-500 hover:bg-red-600 text-white px-6 py-2.5 rounded-xl text-sm font-bold transition-colors shadow-sm cursor-pointer';
            document.getElementById('modifyStockReason').placeholder = 'e.g. Expired, Damaged';
        }
        
        openInvModal('ModifyStockModalBackdrop', 'ModifyStockModal');
    }

    function renderLogsTable(logs) {
        const tbody = document.getElementById('logs-table-body');
        tbody.innerHTML = '';
        if (!logs || logs.length === 0) {
            tbody.innerHTML = `<tr class="bg-white"><td colspan="4" class="px-6 py-8 text-center text-gray-500 font-medium">No history records found.</td></tr>`;
            return;
        }

        logs.forEach(log => {
            const isOut = log.type === 'Out';
            const tr = document.createElement('tr');
            tr.className = 'bg-white border-b border-gray-100 hover:bg-gray-50 transition-colors text-gray-800 font-medium';
            tr.innerHTML = `
                <td class="px-6 py-4">
                    <span class="px-3 py-1 rounded-full text-xs font-bold ${isOut ? 'bg-red-50 text-red-600' : 'bg-green-50 text-green-600'}">
                        <i class="ph-bold ${isOut ? 'ph-arrow-down' : 'ph-arrow-up'} mr-1"></i> ${log.type}
                    </span>
                </td>
                <td class="px-6 py-4 font-extrabold">${log.quantity}</td>
                <td class="px-6 py-4 text-gray-600">${log.action}</td>
                <td class="px-6 py-4 text-gray-400 text-xs">${new Date(log.created_at).toLocaleString()}</td>
            `;
            tbody.appendChild(tr);
        });
    }

    // Modal Close Triggers
    const closeTriggers = [
        { btn: 'CloseAddInventoryX', back: 'AddInventoryModalBackdrop', mod: 'AddInventoryModal', form: 'AddInventoryForm', pref: 'AddInv' },
        { btn: 'CloseAddInventoryBtn', back: 'AddInventoryModalBackdrop', mod: 'AddInventoryModal', form: 'AddInventoryForm', pref: 'AddInv' },
        { btn: 'CloseEditInventoryX', back: 'EditInventoryModalBackdrop', mod: 'EditInventoryModal', form: 'EditInventoryForm', pref: 'EditInv' },
        { btn: 'CloseEditInventoryBtn', back: 'EditInventoryModalBackdrop', mod: 'EditInventoryModal', form: 'EditInventoryForm', pref: 'EditInv' },
        { btn: 'CloseModifyStockX', back: 'ModifyStockModalBackdrop', mod: 'ModifyStockModal', form: 'ModifyStockForm', pref: 'ModifyStock' },
        { btn: 'CloseModifyStockBtn', back: 'ModifyStockModalBackdrop', mod: 'ModifyStockModal', form: 'ModifyStockForm', pref: 'ModifyStock' },
        { btn: 'CloseLogsX', back: 'InventoryLogsModalBackdrop', mod: 'InventoryLogsModal', form: null, pref: null }
    ];

    closeTriggers.forEach(t => {
        document.getElementById(t.btn)?.addEventListener('click', () => closeInvModal(t.back, t.mod, t.form, t.pref));
    });

    // Initialize
    if (document.getElementById('section-stock')) {
        fetchInventory();
    }
});