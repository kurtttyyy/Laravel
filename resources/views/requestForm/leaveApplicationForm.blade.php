<style>
    @page {
        size: legal portrait;
        margin-top: 2mm;
        margin-bottom: 2mm;
        margin-left: -80px;
        margin-right: -80px;

    }

    @media print {
        .print-row-two {
            display: grid !important;
            grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
            gap: 1rem !important;
        }

        .print-row-three {
            display: grid !important;
            grid-template-columns: repeat(3, minmax(0, 1fr)) !important;
            gap: 1rem !important;
        }

        .print-details-two {
            display: grid !important;
            grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
            gap: 2rem !important;
            align-items: stretch !important;
        }

        .print-right-divider {
            border-left: 1px solid #000 !important;
            padding-left: 1.25rem !important;
        }

        .print-action-two {
            display: grid !important;
            grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
            gap: 2rem !important;
            align-items: stretch !important;
        }

        .print-signatory-margin {
            margin-top: 4.5rem !important;
        }

    }
</style>

<form method="POST" action="{{ url('') }}" class="space-y-6">
    @csrf

    <div id="leave-application-print-area" class="space-y-5 rounded-lg border-2 border-black bg-white p-6 text-[11px] text-black">
        <h4 class="text-center text-base font-bold tracking-wide uppercase">Leave Application Form</h4>

        <div class="print-row-two grid grid-cols-1 gap-4 md:grid-cols-2">
            <div>
                <label class="mb-1 block font-medium">Office / Department</label>
                <input type="text" class="w-full rounded border border-black px-3 py-2">
            </div>
            <div>
                <label class="mb-1 block font-medium">Name (Last, First, Middle)</label>
                <input type="text" class="w-full rounded border border-black px-3 py-2">
            </div>
        </div>

        <div class="print-row-three grid grid-cols-1 gap-4 md:grid-cols-3">
            <div>
                <label class="mb-1 block font-medium">Date of Filing</label>
                <input type="date" class="w-full rounded border border-black px-3 py-2">
            </div>
            <div>
                <label class="mb-1 block font-medium">Position</label>
                <input type="text" class="w-full rounded border border-black px-3 py-2">
            </div>
            <div>
                <label class="mb-1 block font-medium">Salary</label>
                <input type="text" class="w-full rounded border border-black px-3 py-2">
            </div>
        </div>

        <section class="border-t border-black pt-5">
            <h5 class="mb-6 text-center font-bold tracking-wide uppercase">Details of Application</h5>

            <div class="print-details-two grid grid-cols-1 gap-8 md:grid-cols-2 md:items-stretch">
                <div class="space-y-4">
                    <div>
                        <p class="mb-2 font-medium">Type of Leave</p>
                        <div class="space-y-1">
                            <label class="block"><input type="checkbox" class="mr-2">Vacation</label>
                            <label class="block"><input type="checkbox" class="mr-2">Sick</label>
                            <label class="block"><input type="checkbox" class="mr-2">Maternity</label>
                            <label class="block"><input type="checkbox" class="mr-2">Paternity</label>
                            <label class="block"><input type="checkbox" class="mr-2">Others (please specify)</label>
                            <input type="text" class="mt-1 w-full rounded border border-black px-2 py-1" placeholder="Specify other type of leave">
                        </div>
                    </div>

                    <div>
                        <label class="mb-1 block font-medium">Number of working days applied for</label>
                        <input type="number" class="w-full rounded border border-black px-3 py-2">
                    </div>

                    <div>
                        <label class="mb-1 block font-medium">Inclusive Dates</label>
                        <input type="text" class="w-full rounded border border-black px-3 py-2">
                    </div>
                </div>

                <div class="print-right-divider border-l border-black pl-5">
                    <div>
                        <p class="mb-2 font-medium">Where leave will be spent</p>
                        <div class="space-y-1">
                            <label class="block"><input type="checkbox" class="mr-2">Within the Philippines</label>
                            <label class="block"><input type="checkbox" class="mr-2">Abroad (please specify)</label>
                            <input type="text" class="mt-1 w-full rounded border border-black px-2 py-1" placeholder="Specify country">
                        </div>
                    </div>

                    <div class="mt-4 space-y-4 border-t border-black pt-4">
                        <div>
                            <p class="mb-2 font-medium">In case of sick leave</p>
                            <div class="space-y-1">
                                <label class="block"><input type="checkbox" class="mr-2">In hospital (please specify)</label>
                                <input type="text" class="w-full rounded border border-black px-2 py-1" placeholder="Hospital name">
                                <label class="block"><input type="checkbox" class="mr-2">Outpatient (please specify)</label>
                                <input type="text" class="w-full rounded border border-black px-2 py-1" placeholder="Outpatient details">
                            </div>
                        </div>

                        <div>
                            <p class="mb-2 font-medium">Commutation</p>
                            <label class="block"><input type="checkbox" name="commutation" class="mr-2">Requested</label>
                            <label class="block"><input type="checkbox" name="commutation" class="mr-2">Not Requested</label>
                        </div>

                        <div class="pt-8 text-center">
                            <div class="mx-auto h-0.5 w-full max-w-xs border-b border-black"></div>
                            <p class="mt-2 font-medium">Signature of Applicant</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="border-t border-black pt-6">
            <h5 class="mb-6 text-center font-bold tracking-wide uppercase">Details on Action of Application</h5>

            <div class="print-action-two grid grid-cols-1 gap-8 md:grid-cols-2">
                <div>
                    <label class="block font-medium">
                        Certification of Leave Credits (As of)
                        <input type="text" class="mt-1 w-full border-0 border-b-2 border-black px-0 py-1 focus:outline-none focus:ring-0">
                    </label>

                    <table class="mt-3 w-full border-collapse border border-black text-sm">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border border-black px-2 py-1"></th>
                                <th class="border border-black px-2 py-1">Vacation</th>
                                <th class="border border-black px-2 py-1">Sick</th>
                                <th class="border border-black px-2 py-1">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="border border-black px-2 py-1">Beginning Balance</td>
                                <td class="border border-black px-2 py-1"></td>
                                <td class="border border-black px-2 py-1"></td>
                                <td class="border border-black px-2 py-1"></td>
                            </tr>
                            <tr>
                                <td class="border border-black px-2 py-2">Add: Earned Leave/s Date:</td>
                                <td class="border border-black px-2 py-1"></td>
                                <td class="border border-black px-2 py-1"></td>
                                <td class="border border-black px-2 py-1"></td>
                            </tr>
                            <tr>
                                <td class="border border-black px-2 py-1">Less: Applied Leave/s</td>
                                <td class="border border-black px-2 py-1"></td>
                                <td class="border border-black px-2 py-1"></td>
                                <td class="border border-black px-2 py-1"></td>
                            </tr>
                            <tr>
                                <td class="border border-black px-2 py-1">Ending Balance</td>
                                <td class="border border-black px-2 py-1"></td>
                                <td class="border border-black px-2 py-1"></td>
                                <td class="border border-black px-2 py-1"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="space-y-4 border-l border-black pl-5">
                    <p class="font-medium">Recommendation</p>
                    <label class="block"><input type="checkbox" name="recommendation" class="mr-2">Approved</label>
                    <div>
                        <label class="block"><input type="checkbox" name="recommendation" class="mr-2">Disapproved due to:</label>
                        <div class="mt-2 h-0.5 w-full border-b border-black"></div>
                    </div>

                    <div class="pt-10 text-center">
                        <div class="mx-auto h-0.5 w-full max-w-xs border-b border-black"></div>
                        <p class="mt-2 font-medium">Authorized Signature</p>
                    </div>
                </div>
            </div>

            <div class="print-action-two mt-6 grid grid-cols-1 gap-8 border-t border-black pt-5 md:grid-cols-2">
                <div class="space-y-3">
                    <p class="font-medium">Approved for:</p>
                    <div class="flex items-end gap-2">
                        <div class="h-0.5 w-24 border-b border-black"></div>
                        <span>Day(s) with pay</span>
                    </div>
                    <div class="flex items-end gap-2">
                        <div class="h-0.5 w-24 border-b border-black"></div>
                        <span>Day(s) without pay</span>
                    </div>
                    <div class="flex items-end gap-2">
                        <div class="h-0.5 w-24 border-b border-black"></div>
                        <span>Others (please specify)</span>
                    </div>
                </div>

                <div>
                    <p class="font-medium">Disapproved due to:</p>
                    <div class="mt-2 h-0.5 w-full border-b border-black"></div>
                </div>
            </div>

            <div class="print-signatory-margin mt-10 grid grid-cols-2 gap-10 text-sm">
                <div class="text-center">
                    <div class="mx-auto h-0.5 w-72 border-b border-black"></div>
                    <p class="mt-2 font-semibold">President</p>
                </div>
                <div class="text-center">
                    <div class="mx-auto h-0.5 w-72 border-b border-black"></div>
                    <p class="mt-2 font-semibold">Director of Human Resources</p>
                </div>
            </div>

            <div class="mt-10 text-center">
                <div class="mx-auto h-0.5 w-52 border-b border-black"></div>
                <p class="mt-2 font-semibold">Date</p>
            </div>
        </section>
    </div>

    <div class="flex justify-end">
        <button
            id="leave-application-download-button"
            type="button"
            onclick="downloadLeaveApplicationForm()"
            class="rounded-lg bg-blue-600 px-6 py-2 text-white hover:bg-blue-700"
        >
            Download Form
        </button>
    </div>
</form>

<script>
    function buildLeaveApplicationPrintMarkup(printArea) {
        const clone = printArea.cloneNode(true);
        const originalFields = printArea.querySelectorAll('input, textarea, select');
        const clonedFields = clone.querySelectorAll('input, textarea, select');

        originalFields.forEach((field, index) => {
            const clonedField = clonedFields[index];
            if (!clonedField) {
                return;
            }

            if (field.tagName === 'INPUT') {
                const type = (field.getAttribute('type') || 'text').toLowerCase();
                if (type === 'checkbox' || type === 'radio') {
                    if (field.checked) {
                        clonedField.setAttribute('checked', 'checked');
                    } else {
                        clonedField.removeAttribute('checked');
                    }
                } else {
                    clonedField.setAttribute('value', field.value || '');
                }
            } else if (field.tagName === 'TEXTAREA') {
                clonedField.textContent = field.value || '';
            } else if (field.tagName === 'SELECT') {
                Array.from(clonedField.options).forEach((option, optionIndex) => {
                    const isSelected = field.options[optionIndex]?.selected;
                    if (isSelected) {
                        option.setAttribute('selected', 'selected');
                    } else {
                        option.removeAttribute('selected');
                    }
                });
            }
        });

        return clone.outerHTML;
    }

    function downloadLeaveApplicationForm() {
        const printArea = document.getElementById('leave-application-print-area');
        if (!printArea) {
            return;
        }

        const printWindow = window.open('', '_blank');
        if (!printWindow) {
            return;
        }

        const styles = Array.from(document.querySelectorAll('style, link[rel="stylesheet"]'))
            .map((node) => node.outerHTML)
            .join('');

        printWindow.document.open();
        printWindow.document.write(`
            <!doctype html>
            <html>
            <head>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <title>Leave Application Form</title>
                ${styles}
                <style>
                    body { margin: 0; padding: 0; background: #fff; }
                    #leave-application-print-area {
                        margin-left: 2px !important;
                        margin-right: 2px !important;
                        padding-left: 10px !important;
                        padding-right: 10px !important;
                    }
                </style>
            </head>
            <body>${buildLeaveApplicationPrintMarkup(printArea)}</body>
            </html>
        `);
        printWindow.document.close();

        printWindow.onload = function () {
            printWindow.focus();
            printWindow.print();
            printWindow.close();
        };
    }
</script>
