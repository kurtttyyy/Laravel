        <form method="POST" action="{{ url('') }}" class="space-y-6">
            @csrf

            <!-- LEAVE APPLICATION FORM -->
            <div class="border-2 border-black p-6 rounded-lg space-y-4">

                <h4 class="text-center font-semibold text-gray-800 mb-6 tracking-wide uppercase">
                    LEAVE APPLICATION FORM
                </h4>

                <!-- Top Information -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm font-medium ">Office / Department</label>
                        <input type="text" class="w-full border rounded px-3 py-2 border-black">
                    </div>

        <div class="print-row-three grid grid-cols-1 gap-4 md:grid-cols-3">
            <div>
                <label class="mb-1 block font-medium">Date of Filing</label>
                <input name="filing_date" type="date" class="w-full rounded border border-black px-3 py-2">
            </div>
            <div>
                <label class="mb-1 block font-medium">Position</label>
                <input
                    name="position"
                    type="text"
                    value="{{ old('position', $employeeFormPosition ?? '') }}"
                    class="w-full rounded border border-black px-3 py-2"
                >
            </div>
            <div>
                <label class="mb-1 block font-medium">Salary</label>
                <input name="salary" type="text" class="w-full rounded border border-black px-3 py-2">
            </div>
        </div>

        <section class="border-t border-black pt-5">
            <h5 class="mb-6 text-center font-bold tracking-wide uppercase">Details of Application</h5>

            <div class="print-details-two grid grid-cols-1 gap-8 md:grid-cols-2 md:items-stretch">
                <div class="space-y-4">
                    <div>
                        <p class="mb-2 font-medium">Type of Leave</p>
                        <div class="space-y-1">
                            <label class="block"><input id="leave-type-vacation" type="checkbox" class="mr-2">Vacation</label>
                            <label class="block"><input id="leave-type-sick" type="checkbox" class="mr-2">Sick</label>
                            <label class="block"><input type="checkbox" class="mr-2">Maternity</label>
                            <label class="block"><input type="checkbox" class="mr-2">Paternity</label>
                            <label class="block"><input type="checkbox" class="mr-2">Others (please specify)</label>
                            <input type="text" class="mt-1 w-full rounded border border-black px-2 py-1" placeholder="Specify other type of leave">
                        </div>
                    </div>

                    <div>
                        <label class="mb-1 block font-medium">Number of working days applied for</label>
                        <input id="leave-days-requested" name="number_of_working_days" type="number" min="0" step="0.5" class="w-full rounded border border-black px-3 py-2">
                    </div>

                    <div>
                        <label class="mb-1 block font-medium">Inclusive Dates</label>
                        <input id="leave-inclusive-dates" name="inclusive_dates" type="text" class="w-full rounded border border-black px-3 py-2" readonly>
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
                            <label class="block"><input type="radio" name="commutation" value="Requested" class="mr-2">Requested</label>
                            <label class="block"><input type="radio" name="commutation" value="Not Requested" class="mr-2">Not Requested</label>
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
                        <input type="text" value="{{ now()->format('F, Y') }}" class="mt-1 w-full border-0 border-b-2 border-black px-0 py-1 focus:outline-none focus:ring-0" readonly>
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
                                <td id="beginning-vacation-balance" class="border border-black px-2 py-1">{{ rtrim(rtrim(number_format((float) ($beginningVacationBalance ?? 0), 1, '.', ''), '0'), '.') }}</td>
                                <td id="beginning-sick-balance" class="border border-black px-2 py-1">{{ rtrim(rtrim(number_format((float) ($beginningSickBalance ?? 0), 1, '.', ''), '0'), '.') }}</td>
                                <td id="beginning-total-balance" class="border border-black px-2 py-1">{{ rtrim(rtrim(number_format((float) (($beginningVacationBalance ?? 0) + ($beginningSickBalance ?? 0)), 1, '.', ''), '0'), '.') }}</td>
                            </tr>
                            <tr>
                                <td class="border border-black px-2 py-2">
                                    <span class="block">Add: Earned Leave/s</span>
                                    <span class="block">Date: {{ $earnedRangeLabel ?? '-' }}</span>
                                </td>
                                <td id="earned-vacation-balance" class="border border-black px-2 py-1">{{ rtrim(rtrim(number_format($formEarnedVacationValue, 1, '.', ''), '0'), '.') }}</td>
                                <td id="earned-sick-balance" class="border border-black px-2 py-1">{{ rtrim(rtrim(number_format($formEarnedSickValue, 1, '.', ''), '0'), '.') }}</td>
                                <td id="earned-total-balance" class="border border-black px-2 py-1">{{ rtrim(rtrim(number_format($formEarnedTotalValue, 1, '.', ''), '0'), '.') }}</td>
                            </tr>
                            <tr>
                                <td class="border border-black px-2 py-1">Less: Applied Leave/s</td>
                                <td id="applied-vacation-balance" class="border border-black px-2 py-1">0</td>
                                <td id="applied-sick-balance" class="border border-black px-2 py-1">0</td>
                                <td id="applied-total-balance" class="border border-black px-2 py-1">0</td>
                            </tr>
                            <tr>
                                <td class="border border-black px-2 py-1">Ending Balance</td>
                                <td id="ending-vacation-balance" class="border border-black px-2 py-1">{{ rtrim(rtrim(number_format((float) (($beginningVacationBalance ?? 0) + $formEarnedVacationValue), 1, '.', ''), '0'), '.') }}</td>
                                <td id="ending-sick-balance" class="border border-black px-2 py-1">{{ rtrim(rtrim(number_format((float) (($beginningSickBalance ?? 0) + $formEarnedSickValue), 1, '.', ''), '0'), '.') }}</td>
                                <td id="ending-total-balance" class="border border-black px-2 py-1">{{ rtrim(rtrim(number_format((float) ((($beginningVacationBalance ?? 0) + $formEarnedVacationValue) + (($beginningSickBalance ?? 0) + $formEarnedSickValue)), 1, '.', ''), '0'), '.') }}</td>
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
                        <div id="days-with-pay-value" class="min-w-[6rem] border-b border-black text-center">0</div>
                        <span>Day(s) with pay</span>
                    </div>
                    <div class="flex items-end gap-2">
                        <div id="days-without-pay-value" class="min-w-[6rem] border-b border-black text-center">0</div>
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

            <!-- Download Button -->
            <div class="flex justify-end">
                <button
                    type="button"
                    onclick="window.print()"
                    class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700"
                >
                    Download Form
                </button>
            </div>
            
        </form>
