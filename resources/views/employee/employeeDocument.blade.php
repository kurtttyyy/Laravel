<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Documents</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body { font-family: Inter, system-ui, sans-serif; transition: margin-left 0.3s ease; }

        main {
            transition: margin-left 0.3s ease;
        }

        aside:not(:hover) ~ main {
            margin-left: 4rem;
        }

        aside:hover ~ main {
            margin-left: 14rem;
        }
    </style>
</head>
<body class="bg-gray-50">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    @include('components.employeeSideBar')

    <!-- MAIN -->
    <main class="flex-1 ml-16 transition-all duration-300">
    @include('components.employeeHeader.documentHeader')
<div class="p-4 md:p-8 space-y-8 pt-20">

        <div class="grid grid-cols-2 gap-8">

            <!-- 201 FILE -->
            <div class="bg-white border border-gray-200 rounded-2xl p-6">
                <h2 class="text-lg font-bold text-gray-900">201 File Submission</h2>
                <p class="text-gray-500 text-sm mt-1 mb-6">
                    Upload your required documents for your 201 file
                </p>

                <!-- Upload Box -->
                <form action="{{ route('employee.upload_documents')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="document_name" placeholder="Document Type" required>
                    <div class="border-2 border-dashed border-gray-300 rounded-xl py-10 text-center mb-6">
                        <div class="w-14 h-14 mx-auto bg-indigo-100 rounded-xl flex items-center justify-center mb-3">
                            <i class="fa-solid fa-cloud-arrow-up text-indigo-600 text-xl"></i>
                        </div>
                        <p class="font-medium text-gray-900">Click to upload documents</p>
                        <p class="text-sm text-gray-500">PDF, JPG, PNG up to 10MB</p>
                        <input type="file" name="uploadFile">
                        <button type="submit">Save</button>
                    </div>
                </form>

                <!-- Container -->
                <div class="bg-green-100 border border-green-500 rounded-xl p-4 max-w mb-4">

                    <!-- Uploaded -->
                    <div class="status uploaded flex items-center gap-4 bg-green-100">
                        <span class="icon bg-green-200 text-green-600 w-10 h-10 rounded-full flex items-center justify-center">
                            <i class="fa-solid fa-circle-check text-2xl"></i>
                        </span>

                        <div>
                            <p class="font-medium text-gray-800">Birth Certificate</p>
                            <p class="text-sm text-gray-500">Uploaded - 1.2 MB</p>
                        </div>
                    </div>

                </div>


                <div class="bg-green-100 border border-green-500 rounded-xl p-4 shadow-sm max-w mb-4">
                <div class="status uploaded flex items-center gap-4">
                    <span class="icon  bg-green-200 text-green-600 w-10 h-10 rounded-full flex items-center justify-center">
                        <i class="fa-solid fa-circle-check text-2xl"></i>
                    </span>
                    <div>
                        <p class="font-medium">NBI Clearance</p>
                        <p class="text-sm text-gray-500">Uploaded - 0.8 MB</p>
                    </div>
                </div>
                </div>

                <!-- Pending -->
                 <div class="bg-yellow-100 border border-yellow-600 rounded-xl p-4 shadow-sm max-w mb-4">
                <div class="status pending flex items-center gap-4">
                    <span class="icon bg-yellow-200 text-yellow-600 w-10 h-10 rounded-full flex items-center justify-center">
                        <i class="fa-solid fa-clock text-2xl"></i>
                    </span>
                    <div>
                        <p class="font-medium">Medical Certificate</p>
                        <p class="text-sm text-gray-500">Pending upload</p>
                    </div>
                </div>
                </div>

                <div class="bg-yellow-100 border border-yellow-600 rounded-xl p-4 shadow-sm max-w mb-4">
                <div class="status pending flex items-center gap-4">
                    <span class="icon bg-yellow-200 text-yellow-600 w-10 h-10 rounded-full flex items-center justify-center">
                        <i class="fa-solid fa-clock text-2xl"></i>
                    </span>
                    <div>
                        <p class="font-medium">TIN ID</p>
                        <p class="text-sm text-gray-500">Pending upload</p>
                    </div>
                </div>
            </div>
            </div>

            <!-- PERSONAL DOCUMENTS -->
            <div class="bg-white border border-gray-200 rounded-2xl p-6">
                <h2 class="text-lg font-bold text-gray-900">My Personal Documents</h2>
                <p class="text-gray-500 text-sm mt-1 mb-6">
                    Access your uploaded documents
                </p>


                <div class="bg-white border-2 border-gray-200 rounded-xl p-4 max-w mb-4 flex items-center gap-4">
                    <span class="doc-icon bg-blue-100 text-blue-600 w-10 h-10 rounded flex items-center justify-center">
                        <i class="fa-solid fa-file"></i>
                    </span>
                    <div class="flex-1">
                        <p class="font-medium text-gray-800">Birth Certificate</p>
                        <p class="text-sm text-gray-500">PDF - 1.2 MB - Jan 15, 2025</p>
                    </div>
                    <a href="#" class="text-blue-600 font-medium hover:underline">View</a>
                </div>


                <div class="bg-white border-2 border-gray-200 rounded-xl p-4 max-w mb-4 flex items-center gap-4">
                    <span class="doc-icon bg-green-100 text-green-600 w-10 h-10 rounded flex items-center justify-center">
                        <i class="fa-solid fa-file"></i>
                    </span>
                    <div class="flex-1">
                        <p class="font-medium text-gray-800">NBI Clearance</p>
                        <p class="text-sm text-gray-500">PDF - 0.8 MB - Jan 18, 2025</p>
                    </div>
                    <a href="#" class="text-blue-600 font-medium hover:underline">View</a>
                </div>

                <div class="bg-white border-2 border-gray-200 rounded-xl p-4 max-w mb-4 flex items-center gap-4">
                    <span class="doc-icon bg-purple-100 text-purple-600 w-10 h-10 rounded flex items-center justify-center">
                        <i class="fa-solid fa-file"></i>
                    </span>
                    <div class="flex-1">
                        <p class="font-medium text-gray-800">Resume</p>
                        <p class="text-sm text-gray-500">PDF - 0.5 MB - Jan 10, 2025</p>
                    </div>
                    <a href="#" class="text-blue-600 font-medium hover:underline">View</a>
                </div>

                <div class="bg-white border-2 border-gray-200 rounded-xl p-4 max-w mb-4 flex items-center gap-4">
                    <span class="doc-icon bg-red-100 text-red-600 w-10 h-10 rounded flex items-center justify-center">
                        <i class="fa-solid fa-file"></i>
                    </span>
                    <div class="flex-1">
                        <p class="font-medium text-gray-800">Diploma</p>
                        <p class="text-sm text-gray-500">PDF - 1.8 MB - Jan 8, 2025</p>
                    </div>
                    <a href="#" class="text-blue-600 font-medium hover:underline">View</a>
                </div>
            </div>

        </div>
    </div>
    </main>
</div>

<style>
.nav {
    @apply flex px-4 py-3 rounded-lg hover:bg-gray-100 cursor-pointer;
}
.nav.active {
    @apply bg-indigo-500 text-white;
}
.status {
    @apply flex items-center gap-4 border rounded-xl p-4 mb-3;
}
.uploaded {
    @apply bg-green-50 border-green-200;
}
.pending {
    @apply bg-yellow-50 border-yellow-200;
}
.icon {
    @apply w-9 h-9 rounded-full flex items-center justify-center;
}
.doc {
    @apply flex items-center gap-4 border rounded-xl p-4 mb-4;
}
.doc-icon {
    @apply w-12 h-12 rounded-xl flex items-center justify-center;
}
.view {
    @apply text-indigo-600 font-medium text-sm hover:underline;
}
</style>

<script>
    const sidebar = document.querySelector('aside');
    const main = document.querySelector('main');

    if (sidebar && main) {
        sidebar.addEventListener('mouseenter', function() {
            main.classList.remove('ml-16');
            main.classList.add('ml-56');
        });

        sidebar.addEventListener('mouseleave', function() {
            main.classList.remove('ml-56');
            main.classList.add('ml-16');
        });
    }
</script>

</body>
</html>
