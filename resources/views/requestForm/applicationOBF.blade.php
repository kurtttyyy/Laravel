        <form method="POST" action="{{ url('/leave/apply') }}" class="space-y-6">
            @csrf

            <!-- APPLICATION FORM FOR OFFICIAL BUSINESS AND OFFICIAL TIME -->
            <div class="border-2 border-black p-6 rounded-lg space-y-4">

                <h4 class="text-center font-semibold text-gray-800 mb-6 tracking-wide uppercase">
                    APPLICATION FORM FOR OFFICIAL BUSINESS AND OFFICIAL TIME
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
                                    <label><input type="checkbox" class="mr-2">Official Business</label><br>
                                    <label><input type="checkbox" class="mr-2">Official Time</label><br>
                                    <label class="block">
                                        <input type="checkbox" class="mr-2">
                                        Others (please specify):
                                    </label>
                                    <input type="text" class="w-full border rounded px-2 py-1 mt-1 border-black" placeholder="Specify other type">
                                </div>
                            </div>

                            <div>
                                <label class="text-sm font-medium">
                                    Number of working days applied for:
                                </label>
                                <input type="number" class="w-full border border-black rounded px-3 py-2">
                            </div>


                            <div>
                                <label class="text-sm font-medium">Inclusive Dates</label>
                                <input type="text" class="w-full border rounded px-3 py-2 border-black">
                            </div>
                        </div>


                        <!-- Right Column -->
                        <div class="space-y-3 pl-4 border-l border-black">
                            <div>
                                <label class="text-sm ">
                                    Purpose of Business
                                </label>
                                <div class="space-y-1 text-sm">
                                    <input type="text" class="w-full border rounded px-2 py-1 mt-1 border-black" placeholder="Purpose of Business">
                                </div>
                            </div>

                            <div>
                                <label class="text-sm">Venue</label>
                                <div class="space-y-1 text-sm">
                                    <input type="text" class="w-full border rounded px-2 py-1 mt-1 border-black" placeholder="Venue location">
                                    <label class="flex items-center gap-2">
                                        Inclusive Dates
                                    </label>
                                    <input type="text" class="w-full border rounded px-2 py-1 mt-1 border-black" placeholder="Inclusive Dates">
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
                            <label class="text-sm font-medium">Recommendation</label>

                            <label class="block text-sm">
                                <input type="checkbox" name="recommendation" class="mr-2">
                                Approved
                            </label>

                            <label class="block text-sm">
                                <input type="checkbox" name="recommendation" class="mr-2">
                                Disapproved due to:
                                    <div class="w-full text-center" style="width: 120px; margin-left: 155px; margin-top: -35px;">
                                    <!-- Signature Line -->
                                    <div class="border-b border-gray-600 w-full h-0.5 mt-8"></div>
                                    </div>
                            </label>



                            <div class="flex justify-left" style="margin-top: -20px;">
                                <div class="w-full text-left">
                                    <!-- Signature Line -->
                                    <div class="border-b border-gray-600 h-0.5 mt-20" style="width:275px"></div>
                                    <label class="text-sm  block mb-2">Immediate Supervisor</label>
                                </div>
                            </div>
                            
                            <div class="flex justify-left" style="margin-top: 40px;">
                                <div class="w-full text-left">

                                    <!-- Name -->
                                    <h1 class="text-sm font-bold" style="margin-bottom: -6px; font-size: 17px;">
                                        DR. DIONICIO D. VILORIA, ACP
                                    </h1>

                                    <!-- Signature Line -->
                                    <div class="border-b border-gray-600 h-0.5 mt-1 mb-1" style="width:275px"></div>

                                    <!-- Position -->
                                    <label class="text-sm  block">
                                        Human Resources Director
                                    </label>

                                </div>
                            </div>
                        </div>
                    </div>



                     <!-- Final Approval -->
                    <div class="border-t pt-4 grid grid-cols-1 gap-6 border-black ">

                    <!-- Approved for (Left Column) -->
                    <div class="space-y-4">
                            <label class="block text-sm" style="margin-bottom: -18px;">
                                <input type="checkbox" name="recommendation" class="mr-2">
                                Approved
                            </label>

                            <label class="block text-sm">
                                <input type="checkbox" name="recommendation" class="mr-2">
                                Disapproved due to:
                                    <div class="w-full text-center" style="width: 120px; margin-left: 155px; margin-top: -35px;">
                                    <!-- Signature Line -->
                                    <div class="border-b border-gray-600 w-full h-0.5 mt-8"></div>
                                    </div>
                            </label>
                    </div>
                            <div class="flex justify-center mt-6" >
                                <div class="w-full text-center" style="width: 240px;">
                                    <h1 class="text-sm font-bold" style="margin-bottom: -80px; font-size: 17px;">
                                        TOMAS C. BAUTISTA, PhD
                                    </h1>
                                    <div class="border-b border-gray-600 w-full h-0.5 mt-20"></div>
                                    <label class="text-sm font-medium block mb-2">Presindent</label>
                                </div>
                            </div>
                            <label class="block text-sm">
                                Attachments:
                                    <div class="w-full text-center" style="width: 120px; margin-left: 85px; margin-top: -38px;">
                                    <!-- Signature Line -->
                                    <div class="border-b border-gray-600 w-full h-0.5 mt-8"></div>
                                    </div>
                            </label>
                            <label class="block text-sm" style="margin-top: -20px;">
                                Date:
                                    <div class="w-full text-center" style="width: 120px; margin-left: 35px; margin-top: -38px;">
                                    <!-- Signature Line -->
                                    <div class="border-b border-gray-600 w-full h-0.5 mt-8"></div>
                                    </div>
                            </label>

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
