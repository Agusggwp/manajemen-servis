<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Service</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        * {
            font-family: 'Poppins', sans-serif;
        }

        /* Gradient Background */
        .header-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            box-shadow: 0 20px 50px rgba(102, 126, 234, 0.3);
            animation: slideDown 0.6s ease-out;
        }

        /* Summary Card Styles */
        .summary-card {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border: 2px solid rgba(102, 126, 234, 0.1);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .summary-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.05) 0%, transparent 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
            pointer-events: none;
        }

        .summary-card:hover::before {
            opacity: 1;
        }

        .card-hover {
            transform: translateY(0);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(102, 126, 234, 0.15);
        }

        /* Section Card */
        .section-card {
            background: #ffffff;
            border: 1px solid rgba(229, 231, 235, 1);
            transition: all 0.3s ease;
        }

        .section-card:hover {
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }

        /* Form Input Styling */
        .form-input {
            transition: all 0.3s ease;
            background-color: #fafafa;
        }

        .form-input:focus {
            background-color: #ffffff;
            border-color: #667eea !important;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            outline: none;
        }

        .form-input::placeholder {
            color: #9ca3af;
        }

        /* Gradient Button */
        .gradient-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        }

        .gradient-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s ease;
        }

        .gradient-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(102, 126, 234, 0.4);
        }

        .gradient-btn:active {
            transform: translateY(-1px);
        }

        .gradient-btn:hover::before {
            left: 100%;
        }

        /* Action Button */
        .btn-action {
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .btn-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        /* Table Row Hover */
        .table-row-hover {
            transition: all 0.3s ease;
            background-color: #fafafa;
        }

        .table-row-hover:hover {
            background: linear-gradient(90deg, rgba(102, 126, 234, 0.05), transparent);
            box-shadow: inset 0 1px 3px rgba(102, 126, 234, 0.1);
        }

        /* Badge Animation */
        .badge {
            animation: slideInBadge 0.4s ease-out;
        }

        /* Modal Overlay */
        .modal-overlay {
            animation: fadeIn 0.3s ease-out;
        }

        /* Animations */
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInBadge {
            from {
                opacity: 0;
                transform: translateX(-10px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .header-gradient {
                py-8;
            }

            h1 {
                font-size: 2rem;
            }
        }

        .input-focus:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }
    </style>
</head>
<body class="bg-gray-50"> 
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <header class="header-gradient text-white py-12 mb-10 rounded-2xl shadow-2xl">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-5xl font-bold mb-3 leading-tight">📋 Dashboard Service Rekanan</h1>
                    <p class="text-indigo-100 text-lg font-light">Sistem Manajemen Service Profesional</p>
                </div>
            </div>
        </header>

        <!-- Alert Messages -->
        @if($errors->any())
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Validasi Error',
                    html: `
                        <ul class="text-left">
                            @foreach($errors->all() as $error)
                                <li class="mb-2">{{ $error }}</li>
                            @endforeach
                        </ul>
                    `,
                    confirmButtonColor: '#667eea',
                    customClass: {
                        popup: 'rounded-2xl'
                    }
                });
            </script>
        @endif

        @if(session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    timer: 2500,
                    timerProgressBar: true,
                    confirmButtonColor: '#667eea',
                    customClass: {
                        popup: 'rounded-2xl'
                    }
                });
            </script>
        @endif

        <!-- Summary Dashboard Section -->
        <section class="mb-12">
            <h2 class="text-3xl font-bold text-gray-800 mb-8">📊 Ringkasan Status</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="summary-card card-hover p-8 rounded-2xl">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-gray-500 uppercase text-sm font-semibold mb-4 tracking-wider">Total WO</h3>
                            <p class="text-5xl font-bold text-indigo-600">{{ $total }}</p>
                        </div>
                        <div class="text-6xl opacity-10">📦</div>
                    </div>
                </div>
                <div class="summary-card card-hover p-8 rounded-2xl">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-gray-500 uppercase text-sm font-semibold mb-4 tracking-wider">Sedang Diproses</h3>
                            <p class="text-5xl font-bold text-amber-500">{{ $processing }}</p>
                        </div>
                        <div class="text-6xl opacity-10">⏳</div>
                    </div>
                </div>
                <div class="summary-card card-hover p-8 rounded-2xl">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-gray-500 uppercase text-sm font-semibold mb-4 tracking-wider">Sudah Selesai</h3>
                            <p class="text-5xl font-bold text-green-600">{{ $completed }}</p>
                        </div>
                        <div class="text-6xl opacity-10">✓</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Form Section -->
        <section class="section-card p-10 rounded-2xl mb-12 shadow-lg">
            <h2 class="text-3xl font-bold text-gray-800 mb-8">➕ Tambah Work Order Baru</h2>
            <form method="POST" action="{{ url('/work-orders') }}" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="noWorkOrder" class="block text-gray-700 font-semibold mb-3">No Work Order</label>
                        <input type="text" id="noWorkOrder" name="no_work_order" 
                               placeholder="WO-2025-001" required 
                               value="{{ old('no_work_order') }}"
                               class="form-input w-full px-5 py-3 border-2 border-gray-200 rounded-xl input-focus">
                        @error('no_work_order')
                            <span class="text-red-600 text-sm mt-2 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="nama" class="block text-gray-700 font-semibold mb-3">Nama Customer/Project</label>
                        <input type="text" id="nama" name="nama" 
                               placeholder="Nama customer atau project" required
                               value="{{ old('nama') }}"
                               class="form-input w-full px-5 py-3 border-2 border-gray-200 rounded-xl input-focus">
                        @error('nama')
                            <span class="text-red-600 text-sm mt-2 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="rekanan" class="block text-gray-700 font-semibold mb-3">Rekanan/Supplier</label>
                        <input type="text" id="rekanan" name="rekanan" 
                               placeholder="Nama mitra atau supplier" required
                               value="{{ old('rekanan') }}"
                               class="form-input w-full px-5 py-3 border-2 border-gray-200 rounded-xl input-focus">
                        @error('rekanan')
                            <span class="text-red-600 text-sm mt-2 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="tanggalService" class="block text-gray-700 font-semibold mb-3">Tanggal Service</label>
                        <input type="date" id="tanggalService" name="tanggal_service" required
                               value="{{ old('tanggal_service') }}"
                               class="form-input w-full px-5 py-3 border-2 border-gray-200 rounded-xl input-focus">
                        @error('tanggal_service')
                            <span class="text-red-600 text-sm mt-2 block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="barang" class="block text-gray-700 font-semibold mb-3">Barang/Item</label>
                    <input type="text" id="barang" name="barang" 
                           placeholder="Daftar barang atau item yang di-service" required
                           value="{{ old('barang') }}"
                           class="form-input w-full px-5 py-3 border-2 border-gray-200 rounded-xl input-focus">
                    @error('barang')
                        <span class="text-red-600 text-sm mt-2 block">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="gradient-btn w-full text-white font-bold py-4 rounded-xl text-lg">
                    ✨ Simpan Work Order
                </button>
            </form>
        </section>

        <!-- Table Section -->
        <section class="section-card p-10 rounded-2xl shadow-lg">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-3xl font-bold text-gray-800">📋 Daftar Work Orders</h2>
                <button onclick="window.location.href='/'" class="gradient-btn text-white font-semibold py-2 px-6 rounded-xl text-sm">
                    🔄 Refresh
                </button>
            </div>
            
            <div class="flex gap-3 mb-8 flex-wrap">
                <a href="/" class="px-6 py-2 rounded-xl font-semibold transition {{ !isset($status) || $status === 'all' ? 'gradient-btn text-white' : 'bg-gray-200 text-gray-800 hover:bg-gray-300' }}">
                    Semua
                </a>
                <a href="/filter/Sedang Diproses" class="px-6 py-2 rounded-xl font-semibold transition {{ isset($status) && $status === 'Sedang Diproses' ? 'gradient-btn text-white' : 'bg-gray-200 text-gray-800 hover:bg-gray-300' }}">
                    Sedang Diproses
                </a>
                <a href="/filter/Selesai" class="px-6 py-2 rounded-xl font-semibold transition {{ isset($status) && $status === 'Selesai' ? 'gradient-btn text-white' : 'bg-gray-200 text-gray-800 hover:bg-gray-300' }}">
                    Sudah Selesai
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-gradient-to-r from-indigo-50 to-purple-50 border-b-2 border-indigo-200">
                            <th class="px-6 py-4 text-left font-bold text-gray-700">ID</th>
                            <th class="px-6 py-4 text-left font-bold text-gray-700">No WO</th>
                            <th class="px-6 py-4 text-left font-bold text-gray-700">Nama</th>
                            <th class="px-6 py-4 text-left font-bold text-gray-700">Rekanan</th>
                            <th class="px-6 py-4 text-left font-bold text-gray-700">Barang</th>
                            <th class="px-6 py-4 text-left font-bold text-gray-700">Tgl Service</th>
                            <th class="px-6 py-4 text-left font-bold text-gray-700">Status</th>
                            <th class="px-6 py-4 text-left font-bold text-gray-700">Tgl Selesai</th>
                            <th class="px-6 py-4 text-left font-bold text-gray-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($workOrders->isEmpty())
                            <tr class="border-b border-gray-200">
                                <td colspan="9" class="px-6 py-12 text-center text-gray-400 text-lg">📭 Tidak ada data work order</td>
                            </tr>
                        @else
                            @foreach($workOrders as $wo)
                                <tr class="table-row-hover border-b border-gray-200">
                                    <td class="px-6 py-4 font-medium text-gray-700">#{{ $wo->id }}</td>
                                    <td class="px-6 py-4 font-bold text-indigo-600">{{ $wo->no_work_order }}</td>
                                    <td class="px-6 py-4 text-gray-800">{{ $wo->nama }}</td>
                                    <td class="px-6 py-4 text-gray-700">{{ $wo->rekanan }}</td>
                                    <td class="px-6 py-4 text-gray-600 text-sm">{{ Str::limit($wo->barang, 20) }}</td>
                                    <td class="px-6 py-4 text-gray-700">{{ $wo->tanggal_service->format('d-m-Y') }}</td>
                                    <td class="px-6 py-4">
                                        @if($wo->status === 'Selesai')
                                            <span class="badge inline-block bg-green-100 text-green-800 px-4 py-2 rounded-full text-xs font-bold">✓ Selesai</span>
                                        @else
                                            <span class="badge inline-block bg-amber-100 text-amber-800 px-4 py-2 rounded-full text-xs font-bold">⏳ Diproses</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-gray-700">{{ $wo->tanggal_selesai ? $wo->tanggal_selesai->format('d-m-Y') : '-' }}</td>
                                    <td class="px-6 py-4">
                                        <div class="flex gap-2 flex-wrap">
                                            <button class="btn-action bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg text-xs font-bold" onclick="openEditModal({{ $wo->id }})">✏️ Edit</button>
                                            <form method="POST" action="{{ url('/work-orders/' . $wo->id) }}" 
                                                  style="display:inline;" 
                                                  onsubmit="return confirmDelete(event);">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-action bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-xs font-bold">🗑️ Hapus</button>
                                            </form>
                                            @if($wo->status !== 'Selesai')
                                                <form method="POST" action="{{ url('/work-orders/' . $wo->id . '/complete') }}" 
                                                      style="display:inline;" 
                                                      onsubmit="return confirmComplete(event);">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn-action bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-lg text-xs font-bold">✓ Selesai</button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </section>
    </div>

    <!-- Edit Modal -->
    @if(isset($workOrder))
        <div id="editModal" class="fixed inset-0 bg-black bg-opacity-30 backdrop-blur-sm flex items-center justify-center p-4 z-50 modal-overlay" style="display: block;">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-8">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-3xl font-bold text-gray-800">✏️ Edit Work Order</h2>
                    <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600 text-3xl font-light">×</button>
                </div>
                
                <form method="POST" action="{{ url('/work-orders/' . $workOrder->id) }}" class="space-y-5">
                    @csrf
                    @method('PUT')
                    
                    <div>
                        <label for="editNoWorkOrder" class="block text-gray-700 font-semibold mb-2">No Work Order</label>
                        <input type="text" id="editNoWorkOrder" name="no_work_order" 
                               required value="{{ $workOrder->no_work_order }}"
                               class="form-input w-full px-4 py-3 border-2 border-gray-200 rounded-xl input-focus">
                    </div>

                    <div>
                        <label for="editNama" class="block text-gray-700 font-semibold mb-2">Nama</label>
                        <input type="text" id="editNama" name="nama" 
                               required value="{{ $workOrder->nama }}"
                               class="form-input w-full px-4 py-3 border-2 border-gray-200 rounded-xl input-focus">
                    </div>

                    <div>
                        <label for="editRekanan" class="block text-gray-700 font-semibold mb-2">Rekanan</label>
                        <input type="text" id="editRekanan" name="rekanan" 
                               required value="{{ $workOrder->rekanan }}"
                               class="form-input w-full px-4 py-3 border-2 border-gray-200 rounded-xl input-focus">
                    </div>

                    <div>
                        <label for="editTanggalService" class="block text-gray-700 font-semibold mb-2">Tanggal Service</label>
                        <input type="date" id="editTanggalService" name="tanggal_service" 
                               required value="{{ $workOrder->tanggal_service->format('Y-m-d') }}"
                               class="form-input w-full px-4 py-3 border-2 border-gray-200 rounded-xl input-focus">
                    </div>

                    <div>
                        <label for="editBarang" class="block text-gray-700 font-semibold mb-2">Barang/Item</label>
                        <input type="text" id="editBarang" name="barang" 
                               required value="{{ $workOrder->barang }}"
                               class="form-input w-full px-4 py-3 border-2 border-gray-200 rounded-xl input-focus">
                    </div>

                    <div class="flex gap-3 pt-6">
                        <button type="submit" class="flex-1 gradient-btn text-white font-bold py-3 rounded-xl">
                            💾 Update
                        </button>
                        <button type="button" class="flex-1 bg-gray-300 text-gray-800 font-bold py-3 rounded-xl hover:bg-gray-400 transition" onclick="closeEditModal()">
                            ✕ Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @else
        <div id="editModal" class="fixed inset-0 bg-black bg-opacity-30 backdrop-blur-sm flex items-center justify-center p-4 z-50 modal-overlay" style="display: none;">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-8">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-3xl font-bold text-gray-800">✏️ Edit Work Order</h2>
                    <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600 text-3xl font-light">×</button>
                </div>
                <p class="text-center text-gray-500 py-8">Pilih work order untuk mengedit</p>
            </div>
        </div>
    @endif

    <script>
        function confirmDelete(event) {
            event.preventDefault();
            const form = event.target;
            
            Swal.fire({
                title: '🗑️ Hapus Work Order?',
                text: 'Data yang dihapus tidak dapat dikembalikan',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                customClass: {
                    popup: 'rounded-2xl'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
            
            return false;
        }

        function confirmComplete(event) {
            event.preventDefault();
            const form = event.target;
            
            Swal.fire({
                title: '✓ Tandai Selesai?',
                text: 'Work order akan ditandai sebagai selesai',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#22c55e',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Tandai Selesai!',
                cancelButtonText: 'Batal',
                customClass: {
                    popup: 'rounded-2xl'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
            
            return false;
        }

        function closeEditModal() {
            const modal = document.getElementById('editModal');
            modal.style.display = 'none';
            window.location.href = '/';
        }

        function openEditModal(id) {
            window.location.href = '/work-orders/' + id + '/edit';
        }

        // Close modal when clicking outside
        window.addEventListener('click', function(event) {
            const modal = document.getElementById('editModal');
            if (event.target === modal) {
                modal.style.display = 'none';
                window.location.href = '/';
            }
        });
    </script>
</body>
</html>
