@extends('layouts.admin')

@section('title', 'Hero Images')

@section('styles')
<style>
    .hero-upload-zone {
        border: 2px dashed var(--gray-300);
        border-radius: var(--radius-2xl);
        padding: 48px;
        text-align: center;
        background: linear-gradient(135deg, var(--gray-50), white);
        transition: all 0.3s ease;
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }

    .hero-upload-zone:hover,
    .hero-upload-zone.dragover {
        border-color: var(--primary-600);
        background: linear-gradient(135deg, var(--primary-50), white);
        transform: translateY(-2px);
    }

    .hero-upload-zone.dragover {
        box-shadow: 0 0 0 4px rgba(43, 82, 56, 0.1);
    }

    .upload-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, var(--primary-100), var(--primary-50));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        font-size: 32px;
        color: var(--primary-600);
        transition: all 0.3s ease;
    }

    .hero-upload-zone:hover .upload-icon {
        transform: scale(1.1);
        background: linear-gradient(135deg, var(--primary-200), var(--primary-100));
    }

    .upload-title {
        font-size: 18px;
        font-weight: 700;
        color: var(--gray-800);
        margin-bottom: 8px;
    }

    .upload-subtitle {
        color: var(--gray-500);
        font-size: 14px;
        margin-bottom: 20px;
    }

    .upload-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 24px;
        background: linear-gradient(135deg, var(--primary-600), var(--primary-700));
        color: white;
        border-radius: var(--radius-lg);
        font-weight: 600;
        font-size: 14px;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
    }

    .upload-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(43, 82, 56, 0.3);
    }

    .upload-formats {
        margin-top: 16px;
        font-size: 12px;
        color: var(--gray-400);
    }

    /* Preview Grid */
    .preview-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 16px;
        margin-top: 24px;
    }

    .preview-item {
        position: relative;
        border-radius: var(--radius-xl);
        overflow: hidden;
        aspect-ratio: 16/9;
        background: var(--gray-100);
    }

    .preview-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .preview-remove {
        position: absolute;
        top: 8px;
        right: 8px;
        width: 28px;
        height: 28px;
        background: rgba(239, 68, 68, 0.9);
        color: white;
        border: none;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        transition: all 0.2s ease;
    }

    .preview-remove:hover {
        background: #dc2626;
        transform: scale(1.1);
    }

    /* Hero Images Grid */
    .hero-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 24px;
        margin-top: 32px;
    }

    .hero-card {
        background: white;
        border-radius: var(--radius-2xl);
        overflow: hidden;
        border: 1px solid var(--gray-200);
        transition: all 0.3s ease;
        position: relative;
    }

    .hero-card:hover {
        box-shadow: var(--shadow-xl);
        transform: translateY(-4px);
    }

    .hero-card.inactive {
        opacity: 0.6;
    }

    .hero-card-image {
        position: relative;
        aspect-ratio: 16/9;
        overflow: hidden;
    }

    .hero-card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .hero-card:hover .hero-card-image img {
        transform: scale(1.05);
    }

    .hero-card-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.7) 0%, transparent 50%);
        opacity: 0;
        transition: opacity 0.3s ease;
        display: flex;
        align-items: flex-end;
        padding: 16px;
    }

    .hero-card:hover .hero-card-overlay {
        opacity: 1;
    }

    .hero-card-actions {
        display: flex;
        gap: 8px;
        width: 100%;
    }

    .hero-card-actions .btn {
        flex: 1;
        justify-content: center;
        padding: 10px;
        font-size: 13px;
    }

    .hero-card-body {
        padding: 20px;
    }

    .hero-card-order {
        position: absolute;
        top: 12px;
        left: 12px;
        width: 32px;
        height: 32px;
        background: rgba(0,0,0,0.7);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 14px;
        backdrop-filter: blur(4px);
    }

    .hero-card-status {
        position: absolute;
        top: 12px;
        right: 12px;
    }

    .hero-card-title {
        font-size: 16px;
        font-weight: 600;
        color: var(--gray-800);
        margin-bottom: 4px;
    }

    .hero-card-subtitle {
        font-size: 13px;
        color: var(--gray-500);
    }

    .hero-card-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 16px;
        padding-top: 16px;
        border-top: 1px solid var(--gray-100);
    }

    /* Edit Modal */
    .modal-backdrop {
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.5);
        backdrop-filter: blur(4px);
        z-index: 1000;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .modal-backdrop.active {
        display: flex;
    }

    .modal-content {
        background: white;
        border-radius: var(--radius-2xl);
        width: 100%;
        max-width: 500px;
        max-height: 90vh;
        overflow-y: auto;
        animation: modalSlideIn 0.3s ease;
    }

    @keyframes modalSlideIn {
        from {
            opacity: 0;
            transform: translateY(-20px) scale(0.95);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    .modal-header {
        padding: 24px;
        border-bottom: 1px solid var(--gray-200);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .modal-title {
        font-size: 18px;
        font-weight: 700;
        color: var(--gray-800);
    }

    .modal-close {
        width: 36px;
        height: 36px;
        background: var(--gray-100);
        border: none;
        border-radius: var(--radius-lg);
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--gray-600);
        transition: all 0.2s ease;
    }

    .modal-close:hover {
        background: var(--gray-200);
        color: var(--gray-800);
    }

    .modal-body {
        padding: 24px;
    }

    .modal-footer {
        padding: 16px 24px;
        border-top: 1px solid var(--gray-200);
        display: flex;
        gap: 12px;
        justify-content: flex-end;
    }

    /* Empty State */
    .empty-hero {
        text-align: center;
        padding: 80px 20px;
        background: linear-gradient(135deg, var(--gray-50), white);
        border-radius: var(--radius-2xl);
        border: 2px dashed var(--gray-200);
    }

    .empty-hero-icon {
        width: 100px;
        height: 100px;
        background: linear-gradient(135deg, var(--accent-100), var(--accent-50));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 24px;
        font-size: 40px;
        color: var(--accent-500);
    }

    .empty-hero h3 {
        font-size: 24px;
        font-weight: 700;
        color: var(--gray-800);
        margin-bottom: 8px;
    }

    .empty-hero p {
        color: var(--gray-500);
        font-size: 15px;
        max-width: 400px;
        margin: 0 auto;
    }

    /* Drag Handle */
    .drag-handle {
        cursor: grab;
        color: var(--gray-400);
        padding: 4px;
    }

    .drag-handle:active {
        cursor: grabbing;
    }

    .hero-card.dragging {
        opacity: 0.5;
        transform: scale(0.98);
    }

    /* Form Styling */
    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }

    @media (max-width: 640px) {
        .form-row {
            grid-template-columns: 1fr;
        }
        .hero-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <div>
            <h2 class="card-title">Hero Slider Images</h2>
            <p style="color: var(--gray-500); font-size: 13px; margin-top: 4px;">
                Upload multiple images for the homepage hero slider. Drag to reorder.
            </p>
        </div>
    </div>

    <!-- Upload Form -->
    <form action="{{ route('admin.hero-images.upload') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
        @csrf
        
        <div class="hero-upload-zone" id="dropZone" onclick="document.getElementById('imageInput').click()">
            <div class="upload-icon">
                <i class="fas fa-cloud-upload-alt"></i>
            </div>
            <div class="upload-title">Drop images here or click to upload</div>
            <div class="upload-subtitle">Upload multiple hero images at once</div>
            <button type="button" class="upload-btn">
                <i class="fas fa-plus"></i> Select Images
            </button>
            <div class="upload-formats">
                Supported: JPG, JPEG, PNG, WebP • Max 10MB per image
            </div>
            <input type="file" id="imageInput" name="images[]" multiple accept="image/*" style="display: none;">
        </div>

        <!-- Preview Grid -->
        <div class="preview-grid" id="previewGrid" style="display: none;"></div>

        <!-- Title/Subtitle for all uploads -->
        <div id="uploadMeta" style="display: none; margin-top: 24px;">
            <div class="form-row">
                <div class="form-group">
                    <label for="title">Title (Optional)</label>
                    <input type="text" id="title" name="title" placeholder="e.g., Discover Tanzania">
                </div>
                <div class="form-group">
                    <label for="subtitle">Subtitle (Optional)</label>
                    <input type="text" id="subtitle" name="subtitle" placeholder="e.g., Your adventure awaits">
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-lg" style="width: 100%;">
                <i class="fas fa-upload"></i> Upload <span id="uploadCount">0</span> Image(s)
            </button>
        </div>
    </form>
</div>

<!-- Existing Hero Images -->
<div class="card" style="margin-top: 32px;">
    <div class="card-header">
        <h2 class="card-title">Current Hero Images</h2>
        <span class="badge badge-info">
            <span class="badge-dot"></span>
            {{ $images->where('status', 'active')->count() }} Active
        </span>
    </div>

    @if($images->count() > 0)
        <div class="hero-grid" id="heroGrid">
            @foreach($images as $image)
                <div class="hero-card {{ $image->status !== 'active' ? 'inactive' : '' }}" data-id="{{ $image->id }}">
                    <div class="hero-card-image">
                        <img src="{{ $image->image_url }}" alt="{{ $image->title ?? 'Hero Image' }}">
                        <span class="hero-card-order">{{ $loop->iteration }}</span>
                        <span class="hero-card-status">
                            @if($image->status === 'active')
                                <span class="badge badge-success"><span class="badge-dot"></span> Active</span>
                            @else
                                <span class="badge badge-warning"><span class="badge-dot"></span> Inactive</span>
                            @endif
                        </span>
                        <div class="hero-card-overlay">
                            <div class="hero-card-actions">
                                <button type="button" class="btn btn-secondary" onclick="openEditModal({{ $image->id }}, '{{ addslashes($image->title) }}', '{{ addslashes($image->subtitle) }}', {{ $image->sort_order }})">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <form action="{{ route('admin.hero-images.toggle', $image) }}" method="POST" style="flex: 1;">
                                    @csrf
                                    <button type="submit" class="btn {{ $image->status === 'active' ? 'btn-warning' : 'btn-success' }}" style="width: 100%;">
                                        <i class="fas fa-{{ $image->status === 'active' ? 'eye-slash' : 'eye' }}"></i>
                                    </button>
                                </form>
                                <form action="{{ route('admin.hero-images.delete', $image) }}" method="POST" style="flex: 1;" onsubmit="return confirm('Delete this hero image?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" style="width: 100%;">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="hero-card-body">
                        <div class="hero-card-title">{{ $image->title ?? 'Untitled' }}</div>
                        <div class="hero-card-subtitle">{{ $image->subtitle ?? 'No subtitle' }}</div>
                        <div class="hero-card-meta">
                            <span style="font-size: 12px; color: var(--gray-400);">
                                <i class="fas fa-calendar"></i> {{ $image->created_at->format('M d, Y') }}
                            </span>
                            <span class="drag-handle" title="Drag to reorder">
                                <i class="fas fa-grip-vertical"></i>
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="empty-hero">
            <div class="empty-hero-icon">
                <i class="fas fa-images"></i>
            </div>
            <h3>No Hero Images Yet</h3>
            <p>Upload your first hero image to create an amazing homepage slider experience.</p>
        </div>
    @endif
</div>

<!-- Edit Modal -->
<div class="modal-backdrop" id="editModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Edit Hero Image</h3>
            <button type="button" class="modal-close" onclick="closeEditModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <form id="editForm" method="POST">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="editTitle">Title</label>
                    <input type="text" id="editTitle" name="title" placeholder="Enter title">
                </div>
                <div class="form-group">
                    <label for="editSubtitle">Subtitle</label>
                    <input type="text" id="editSubtitle" name="subtitle" placeholder="Enter subtitle">
                </div>
                <div class="form-group">
                    <label for="editOrder">Sort Order</label>
                    <input type="number" id="editOrder" name="sort_order" min="0" placeholder="0">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeEditModal()">Cancel</button>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Save Changes
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    const dropZone = document.getElementById('dropZone');
    const imageInput = document.getElementById('imageInput');
    const previewGrid = document.getElementById('previewGrid');
    const uploadMeta = document.getElementById('uploadMeta');
    const uploadCount = document.getElementById('uploadCount');
    let selectedFiles = [];

    // Drag and drop
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    ['dragenter', 'dragover'].forEach(eventName => {
        dropZone.addEventListener(eventName, () => dropZone.classList.add('dragover'), false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, () => dropZone.classList.remove('dragover'), false);
    });

    dropZone.addEventListener('drop', handleDrop, false);

    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        handleFiles(files);
    }

    imageInput.addEventListener('change', function() {
        handleFiles(this.files);
    });

    function handleFiles(files) {
        selectedFiles = [...files];
        updatePreview();
    }

    function updatePreview() {
        previewGrid.innerHTML = '';
        
        if (selectedFiles.length === 0) {
            previewGrid.style.display = 'none';
            uploadMeta.style.display = 'none';
            return;
        }

        previewGrid.style.display = 'grid';
        uploadMeta.style.display = 'block';
        uploadCount.textContent = selectedFiles.length;

        selectedFiles.forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const div = document.createElement('div');
                div.className = 'preview-item';
                div.innerHTML = `
                    <img src="${e.target.result}" alt="Preview">
                    <button type="button" class="preview-remove" onclick="removeFile(${index})">
                        <i class="fas fa-times"></i>
                    </button>
                `;
                previewGrid.appendChild(div);
            };
            reader.readAsDataURL(file);
        });

        // Update file input
        const dt = new DataTransfer();
        selectedFiles.forEach(file => dt.items.add(file));
        imageInput.files = dt.files;
    }

    function removeFile(index) {
        selectedFiles.splice(index, 1);
        updatePreview();
    }

    // Edit Modal
    function openEditModal(id, title, subtitle, order) {
        document.getElementById('editForm').action = `/admin/hero-images/${id}/update`;
        document.getElementById('editTitle').value = title || '';
        document.getElementById('editSubtitle').value = subtitle || '';
        document.getElementById('editOrder').value = order || 0;
        document.getElementById('editModal').classList.add('active');
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.remove('active');
    }

    // Close modal on backdrop click
    document.getElementById('editModal').addEventListener('click', function(e) {
        if (e.target === this) closeEditModal();
    });

    // Drag to reorder (simple implementation)
    const heroGrid = document.getElementById('heroGrid');
    if (heroGrid) {
        let draggedItem = null;

        heroGrid.querySelectorAll('.hero-card').forEach(card => {
            card.setAttribute('draggable', true);

            card.addEventListener('dragstart', function() {
                draggedItem = this;
                setTimeout(() => this.classList.add('dragging'), 0);
            });

            card.addEventListener('dragend', function() {
                this.classList.remove('dragging');
                saveOrder();
            });

            card.addEventListener('dragover', function(e) {
                e.preventDefault();
                const afterElement = getDragAfterElement(heroGrid, e.clientY);
                if (afterElement == null) {
                    heroGrid.appendChild(draggedItem);
                } else {
                    heroGrid.insertBefore(draggedItem, afterElement);
                }
            });
        });
    }

    function getDragAfterElement(container, y) {
        const draggableElements = [...container.querySelectorAll('.hero-card:not(.dragging)')];
        return draggableElements.reduce((closest, child) => {
            const box = child.getBoundingClientRect();
            const offset = y - box.top - box.height / 2;
            if (offset < 0 && offset > closest.offset) {
                return { offset: offset, element: child };
            } else {
                return closest;
            }
        }, { offset: Number.NEGATIVE_INFINITY }).element;
    }

    function saveOrder() {
        const cards = document.querySelectorAll('.hero-card');
        const order = [...cards].map(card => card.dataset.id);
        
        fetch('{{ route("admin.hero-images.reorder") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ order: order })
        }).then(response => response.json())
          .then(data => {
              if (data.success) {
                  // Update order numbers
                  cards.forEach((card, index) => {
                      card.querySelector('.hero-card-order').textContent = index + 1;
                  });
              }
          });
    }
</script>
@endsection
