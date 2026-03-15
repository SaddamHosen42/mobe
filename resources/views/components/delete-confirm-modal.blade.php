{{-- Global Delete Confirmation Modal --}}
{{-- Usage: replace onclick with: onclick="showDeleteConfirm(this, 'Optional custom message')" --}}
{{-- The button must be inside the <form> that should be submitted on confirm --}}

<div id="delete-confirm-modal"
     class="fixed inset-0 z-50 flex items-center justify-center hidden"
     role="dialog"
     aria-modal="true"
     aria-labelledby="delete-modal-title">

    {{-- Backdrop --}}
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm"
         onclick="hideDeleteConfirm()"></div>

    {{-- Dialog Panel --}}
    <div class="relative z-10 bg-white rounded-2xl shadow-2xl w-full max-w-md mx-4 overflow-hidden">
        {{-- Warning Header --}}
        <div class="bg-red-50 px-6 pt-6 pb-4 flex items-start gap-4">
            <div class="flex-shrink-0 flex items-center justify-center w-12 h-12 rounded-full bg-red-100">
                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z">
                    </path>
                </svg>
            </div>
            <div>
                <h3 id="delete-modal-title" class="text-lg font-semibold text-gray-900">
                    Confirm Deletion
                </h3>
                <p id="delete-modal-message" class="mt-1 text-sm text-gray-600">
                    Are you sure you want to delete this? This action cannot be undone.
                </p>
            </div>
        </div>

        {{-- Actions --}}
        <div class="bg-white px-6 py-4 flex justify-end gap-3">
            <button type="button"
                    onclick="hideDeleteConfirm()"
                    class="px-4 py-2 rounded-lg text-sm font-medium text-gray-700 bg-white border border-gray-300 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 transition">
                Cancel
            </button>
            <button type="button"
                    id="delete-confirm-btn"
                    onclick="executeDelete()"
                    class="px-4 py-2 rounded-lg text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition">
                Delete
            </button>
        </div>
    </div>
</div>

<script>
    (function () {
        let _pendingForm = null;

        window.showDeleteConfirm = function (triggerEl, customMessage) {
            _pendingForm = triggerEl.closest('form');
            if (!_pendingForm) {
                console.error('showDeleteConfirm: trigger button must be inside a <form>.');
                return;
            }

            const modal = document.getElementById('delete-confirm-modal');
            const msgEl = document.getElementById('delete-modal-message');

            msgEl.textContent = customMessage
                || 'Are you sure you want to delete this? This action cannot be undone.';

            modal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');

            // Focus the cancel button for accessibility
            setTimeout(() => {
                document.getElementById('delete-confirm-btn').focus();
            }, 50);
        };

        window.hideDeleteConfirm = function () {
            const modal = document.getElementById('delete-confirm-modal');
            modal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
            _pendingForm = null;
        };

        window.executeDelete = function () {
            if (_pendingForm) {
                _pendingForm.submit();
            }
            hideDeleteConfirm();
        };

        // Close on Escape key
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                const modal = document.getElementById('delete-confirm-modal');
                if (!modal.classList.contains('hidden')) {
                    hideDeleteConfirm();
                }
            }
        });
    }());
</script>
