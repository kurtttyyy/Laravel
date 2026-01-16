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

                    <div>
                        <label class="text-sm font-medium">Name (Last, First, Middle)</label>
                        <input type="text" class="w-full border rounded px-3 py-2 border-black">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="text-sm font-medium">Date of Filing</label>
                        <input type="date" class="w-full border rounded px-3 py-2 border-black">
                    </div>

                    <div>
                        <label class="text-sm font-medium">Position</label>
                        <input type="text" class="w-full border rounded px-3 py-2 border-black">
                    </div>

                    <div>
                        <label class="text-sm font-medium">Salary</label>
                        <input type="text" class="w-full border rounded px-3 py-2 border-black  ">
                    </div>
                </div>

                <!-- DETAILS OF APPLICATION -->
                <div class="border-t pt-4 border-black">
                    <h5 class="font-semibold mb-8 text-center tracking-wide uppercase">DETAILS OF APPLICATION</h5>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 ">

                        <!-- Left Column -->
                        <div class="space-y-3">
                            <div>
                                <label class="text-sm font-medium">Type of Leave</label>
                                <div class="space-y-1 text-sm">
                                    <label><input type="checkbox" class="mr-2">Vacation</label><br>
                                    <label><input type="checkbox" class="mr-2">Sick</label><br>
                                    <label><input type="checkbox" class="mr-2">Maternity</label><br>
                                    <label><input type="checkbox" class="mr-2">Paternity</label><br>
                                    <label class="block">
                                        <input type="checkbox" class="mr-2">
                                        Others (please specify):
                                    </label>
                                    <input type="text" class="w-full border rounded px-2 py-1 mt-1 border-black" placeholder="Specify other type of leave">
                                </div>
                            </div>

                            <div>
                                <label class="text-sm font-medium">
                                    Number of working days applied for
                                </label>
                                <input type="number" class="w-full border rounded px-3 py-2 border-black">
                            </div>

                            <div>
                                <label class="text-sm font-medium">Inclusive Dates</label>
                                <input type="text" class="w-full border rounded px-3 py-2 border-black">
                            </div>
                        </div>


                        <!-- Right Column -->
                        <div class="space-y-3 pl-4 border-l border-black">
                            <div>
                                <label class="text-sm font-medium">
                                    Where leave will be spent
                                </label>
                                <div class="space-y-1 text-sm">
                                    <label><input type="checkbox" class="mr-2">Within the Philippines</label><br>
                                    <label class="flex items-center gap-2">
                                        <input type="checkbox">
                                        Abroad (please specify):
                                    </label>
                                    <input type="text" class="w-full border rounded px-2 py-1 mt-1 border-black" placeholder="Specify country">
                                </div>
                            </div>

                            <div>
                                <label class="text-sm font-medium">In case of sick leave</label>
                                <div class="space-y-1 text-sm">
                                    <label class="flex items-center gap-2">
                                        <input type="checkbox">
                                        In hospital (please specify):
                                    </label>
                                    <input type="text" class="w-full border rounded px-2 py-1 mt-1 border-black" placeholder="Hospital Name">
                                    <label class="flex items-center gap-2">
                                        <input type="checkbox">
                                        Outpatient (please specify):
                                    </label>
                                    <input type="text" class="w-full border rounded px-2 py-1 mt-1 border-black" placeholder="Outpatient">
                                </div>
                            </div>

                            <div>
                                <label class="text-sm font-medium">Commutation</label>
                                <div class="space-y-1 text-sm">
                                    <label><input type="checkbox" name="commutation" class="mr-2">Requested</label><br>
                                    <label><input type="checkbox" name="commutation" class="mr-2">Not Requested</label>
                                </div>
                            </div>

                            <!-- Signature (CENTERED ONLY) -->
                            <div class="flex justify-center mt-6">
                                <div class="w-full md:w-1/2 text-center">
                                            <!-- Signature Line -->
                                    <div class="border-b border-gray-600 w-full h-0.5 mt-20"></div>
                                    <label class="text-sm font-medium block mb-2">Signature of Applicant</label>
                                </div>
                            </div>


                        </div>


                    </div>
                </div>



                <!-- DETAILS ON ACTION OF APPLICATION -->
                <div class="border-t pt-6 space-y-4 border-black">
                    <h5 class="font-semibold mb-8 text-center tracking-wide uppercase">DETAILS ON ACTION OF APPLICATION</h5>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <!-- Leave Credits (Left Column) -->
                        <div>
                            <label class="text-sm font-medium">
                                Certification of Leave Credits (As of)
                                <input type="text" class="w-full border-b-2 border-gray-400 px-0 py-1 mt-1 focus:outline-none mb-1">
                            </label>
                        

                            <table class="w-full border text-sm mt-3 border-black">
                                <thead class="bg-gray-200">
                                    <tr>
                                        <th class="border px-2 py-1 border-black"></th>
                                        <th class="border px-2 py-1 border-black">Vacation</th>
                                        <th class="border px-2 py-1 border-black">Sick</th>
                                        <th class="border px-2 py-1 border-black">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="border px-2 py-1 border-black">Beginning Balance</td>
                                        <td class="border px-2 py-1 border-black"></td>
                                        <td class="border px-2 py-1 border-black"></td>
                                        <td class="border px-2 py-1 border-black"></td>
                                    </tr>
                                    <tr>
                                        <td class="border px-2 py-2 border-black">
                                            Add: Earned<br>
                                            Leave/s<br>
                                            Date:
                                        </td>
                                        <td class="border px-2 py-1 border-black"></td>
                                        <td class="border px-2 py-1 border-black"></td>
                                        <td class="border px-2 py-1 border-black"></td>
                                    </tr>
                                    <tr>
                                        <td class="border px-2 py-1 border-black">
                                        Less: Applied<br>
                                        Leave/s
                                    </td>
                                        <td class="border px-2 py-1 border-black"></td>
                                        <td class="border px-2 py-1 border-black"></td>
                                        <td class="border px-2 py-1 border-black"></td>
                                    </tr>
                                    <tr>
                                        <td class="border px-2 py-1 border-black">Ending Balance</td>
                                        <td class="border px-2 py-1 border-black"></td>
                                        <td class="border px-2 py-1 border-black"></td>
                                        <td class="border px-2 py-1 border-black"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Recommendation (Right Column with vertical line) -->
                        <div class="pl-6 border-l border-black space-y-3 b">
                            <label class="text-sm font-medium">Recommendation</label>

                            <label class="block text-sm">
                                <input type="checkbox" name="recommendation" class="mr-2">
                                Approved
                            </label>

                            <label class="block text-sm">
                                <input type="checkbox" name="recommendation" class="mr-2">
                                Disapproved due to:
                                    <div class="w-full text-center" style="width: 120px; margin-left: 140px;">
                                    <!-- Signature Line -->
                                    <div class="border-b border-gray-600 w-full h-0.5 mt-8"></div>
                                    </div>
                            </label>



                            <div class="flex justify-center mt-6">
                                <div class="w-full md:w-1/2 text-center">
                                    <!-- Signature Line -->
                                    <div class="border-b border-gray-600 w-full h-0.5 mt-20"></div>
                                    <label class="text-sm font-medium block mb-2">Signature of Applicant</label>
                                </div>
                            </div>
                        </div>

                    </div>



                     <!-- Final Approval -->
                    <div class="border-t pt-4 grid grid-cols-1 md:grid-cols-2 gap-6 border-black ">

                    <!-- Approved for (Left Column) -->
                    <div class="space-y-4">
                        <label class="text-sm font-medium block">Approved for:</label>

                        <div class="flex items-center gap-2">
                            <div class="border-b border-gray-600 mt-3" style="width: 80px;"></div>
                            <span>Day(s) with pay</span>
                        </div>

                        <div class="flex items-center gap-2">
                            <div class="border-b border-gray-600 mt-3" style="width: 80px;"></div>
                            <span>Day(s) without pay</span>
                        </div>

                        <div class="flex items-center gap-2">
                            <div class="border-b border-gray-600 mt-3" style="width: 80px;"></div>
                            <span>Others [please specify]</span>
                        </div>
                    </div>

                    <!-- Disapproved due to (Right Column WITHOUT vertical line) -->
                            <label class=" font-medium block text-sm" style="margin-left: 25px;">
                                Disapproved due to:
                                    <div class="w-full text-center" style="width: 120px; margin-left: 140px;">
                                    <!-- Signature Line -->
                                    <div class="border-b border-gray-600 w-full h-0.5 mt-8"></div>
                                    </div>
                            </label>

                </div>


                <!-- HR & PRESIDENT APPROVAL -->


                    <!-- Signatories -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10 text-sm pt-6" style="margin-top: 40px;">

                        <!-- Director of HR -->
                        <div class="text-center space-y-2">
                            <div class="border-b border-gray-400 mx-auto" style="width: 300px; border-color: black;"></div>
                            <p class="font-semibold">Director of Human Resources</p>
                        </div>


                        <!-- President -->
                        <div class="text-center space-y-2">
                            <div class="border-b border-gray-400 mx-auto" style="width: 300px; border-color: black;"></div>
                            <p class="font-semibold">President</p>
                        </div>

                    </div>

                    <!-- Single Date -->
                        <div class="text-center space-y-2">
                            <div class="border-b border-gray-400 mx-auto" style="width: 200px; margin-top: 40px; border-color: black;"></div>
                            <p class="font-semibold">Date</p>
                        </div>

                </div>


            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button
                    type="submit"
                    class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700"
                >
                    Submit Application
                </button>
            </div>
            
        </form>