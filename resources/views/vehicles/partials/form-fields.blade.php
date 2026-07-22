@once
    @push('head')
        <style>
            .vehicle-photo-picker {
                display: grid;
                gap: 10px;
            }
            .vehicle-photo-preview {
                width: 100%;
                max-width: 280px;
                aspect-ratio: 4 / 3;
                object-fit: cover;
                border-radius: 12px;
                border: 1px solid #d1d5db;
                background: linear-gradient(180deg, #ffffff, #eef2f7);
                display: none;
                cursor: zoom-in;
            }
            .vehicle-photo-preview.is-visible {
                display: block;
            }
            .vehicle-photo-empty {
                width: 100%;
                max-width: 280px;
                aspect-ratio: 4 / 3;
                border-radius: 12px;
                border: 1px dashed #cbd5e1;
                background: #f8fafc;
                color: #64748b;
                display: flex;
                align-items: center;
                justify-content: center;
                text-align: center;
                padding: 12px;
                font-size: 14px;
            }
            .vehicle-photo-cropper {
                position: fixed;
                inset: 0;
                display: none;
                align-items: center;
                justify-content: center;
                padding: 18px;
                background: rgba(15, 23, 42, .58);
                backdrop-filter: blur(6px);
                z-index: 2200;
            }
            .vehicle-photo-cropper[aria-hidden="false"] {
                display: flex;
            }
            .vehicle-photo-cropper-card {
                width: min(980px, 100%);
                max-height: 90vh;
                overflow: auto;
                border-radius: 18px;
                background: #fff;
                border: 1px solid #d1d5db;
                box-shadow: 0 24px 60px rgba(15, 23, 42, .28);
            }
            .vehicle-photo-cropper-head {
                display: flex;
                justify-content: space-between;
                gap: 12px;
                align-items: flex-start;
                padding: 16px 18px 10px;
                border-bottom: 1px solid #eef2f7;
            }
            .vehicle-photo-cropper-head h3 {
                margin: 0;
                font-size: 18px;
            }
            .vehicle-photo-cropper-head p {
                margin: 6px 0 0;
                color: #6b7280;
                font-size: 13px;
            }
            .vehicle-photo-cropper-close {
                border: none;
                background: transparent;
                color: #64748b;
                font-size: 28px;
                line-height: 1;
                cursor: pointer;
            }
            .vehicle-photo-cropper-body {
                display: grid;
                grid-template-columns: minmax(320px, 1fr) minmax(260px, 300px);
                gap: 18px;
                padding: 18px;
            }
            .vehicle-photo-stage {
                display: grid;
                place-items: center;
                min-height: 320px;
                border-radius: 16px;
                background: linear-gradient(180deg, #f8fafc, #eef2f7);
                border: 1px solid #e5e7eb;
                padding: 14px;
            }
            .vehicle-photo-canvas {
                width: min(100%, 560px);
                aspect-ratio: 4 / 3;
                border-radius: 12px;
                background: #fff;
                box-shadow: 0 8px 20px rgba(15, 23, 42, .10);
            }
            .vehicle-photo-controls {
                display: grid;
                gap: 14px;
                align-content: start;
            }
            .vehicle-photo-control {
                border: 1px solid #e5e7eb;
                border-radius: 14px;
                background: #f8fafc;
                padding: 12px;
            }
            .vehicle-photo-control label {
                margin-bottom: 8px;
                font-size: 14px;
            }
            .vehicle-photo-control input[type="range"] {
                width: 100%;
                padding: 0;
                border: none;
                outline: none;
                background: transparent;
            }
            .vehicle-photo-cropper-actions {
                display: flex;
                justify-content: flex-end;
                gap: 10px;
                padding: 0 18px 18px;
                flex-wrap: wrap;
            }
            .vehicle-image-lightbox {
                position: fixed;
                inset: 0;
                display: none;
                align-items: center;
                justify-content: center;
                padding: 18px;
                background: rgba(15, 23, 42, .74);
                backdrop-filter: blur(4px);
                z-index: 2300;
            }
            .vehicle-image-lightbox[aria-hidden="false"] {
                display: flex;
            }
            .vehicle-image-lightbox img {
                max-width: min(100%, 1200px);
                max-height: 86vh;
                border-radius: 16px;
                box-shadow: 0 24px 60px rgba(0, 0, 0, .35);
                background: #fff;
            }
            .vehicle-image-lightbox button {
                position: absolute;
                top: 18px;
                right: 18px;
                border: none;
                background: rgba(255,255,255,.14);
                color: #fff;
                width: 44px;
                height: 44px;
                border-radius: 999px;
                font-size: 28px;
                line-height: 1;
                cursor: pointer;
            }
            @media (max-width: 860px) {
                .vehicle-photo-cropper-body {
                    grid-template-columns: 1fr;
                }
            }
        </style>
    @endpush
@endonce

<div>
    <label>Placa</label>
    <input name="plate" value="{{ old('plate', $vehicle->plate ?? '') }}" required>
</div>
<div>
    <label>Identificador</label>
    <input name="identifier" value="{{ old('identifier', $vehicle->identifier ?? '') }}">
</div>
<div>
    <label>Modelo</label>
    <input name="model" value="{{ old('model', $vehicle->model ?? '') }}">
</div>
<div>
    <label>Anio</label>
    <input type="number" name="year" value="{{ old('year', $vehicle->year ?? '') }}" min="1900" max="2100">
</div>
<div>
    <label>Numero de serie</label>
    <input name="serial_number" value="{{ old('serial_number', $vehicle->serial_number ?? '') }}">
</div>
<div>
    <label>Numero de serie adicional</label>
    <input name="additional_serial_number" value="{{ old('additional_serial_number', $vehicle->additional_serial_number ?? '') }}">
</div>
<div>
    <label>Motor</label>
    <input name="engine_number" value="{{ old('engine_number', $vehicle->engine_number ?? '') }}">
</div>
<div>
    <label>Proveedor</label>
    <input name="supplier" value="{{ old('supplier', $vehicle->supplier ?? '') }}">
</div>
<div>
    <label>Personal asignado</label>
    <input name="assigned_personnel" value="{{ old('assigned_personnel', $vehicle->assigned_personnel ?? '') }}">
</div>
<div style="grid-column: 1/-1;">
    <label style="margin-bottom:4px;">Icono del vehiculo</label>
    @include('vehicles.partials.vtype-selector', [
        'selected' => old('vtype', ($vehicle->vtype ?? 'auto') ?: 'auto'),
        'idPrefix' => $idPrefix,
    ])
</div>
<div style="grid-column: 1/-1;">
    <label>Descripcion</label>
    <textarea name="description">{{ old('description', $vehicle->description ?? '') }}</textarea>
</div>
<div>
    <label>Foto del equipo</label>
    <div class="vehicle-photo-picker" data-vehicle-photo-picker>
        <input type="file" name="photo" accept=".jpg,.jpeg,.png,.webp" data-photo-input>
        <input type="hidden" name="photo_cropped" value="" data-photo-cropped>

        <img
            src="{{ $vehicle?->photo_url ?? '' }}"
            alt="Vista previa de la foto del equipo"
            class="vehicle-photo-preview {{ !empty($vehicle?->photo_url) ? 'is-visible' : '' }}"
            data-photo-preview
            {{ empty($vehicle?->photo_url) ? 'hidden' : '' }}
        >

        <div class="vehicle-photo-empty" data-photo-empty {{ !empty($vehicle?->photo_url) ? 'hidden' : '' }}>
            Carga una foto para mostrarla en la ficha de la unidad.
        </div>

        <div class="vehicle-photo-cropper" aria-hidden="true" data-photo-cropper>
            <div class="vehicle-photo-cropper-card" role="dialog" aria-modal="true">
                <div class="vehicle-photo-cropper-head">
                    <div>
                        <h3>Ajustar foto del equipo</h3>
                        <p>Mueve el enfoque y acerca la imagen antes de guardarla.</p>
                    </div>
                    <button class="vehicle-photo-cropper-close" type="button" aria-label="Cerrar" data-photo-cancel>&times;</button>
                </div>

                <div class="vehicle-photo-cropper-body">
                    <div class="vehicle-photo-stage">
                        <canvas class="vehicle-photo-canvas" width="1200" height="900" data-photo-canvas></canvas>
                    </div>

                    <div class="vehicle-photo-controls">
                        <div class="vehicle-photo-control">
                            <label>Zoom</label>
                            <input type="range" min="1" max="3" step="0.01" value="1" data-photo-zoom>
                        </div>
                        <div class="vehicle-photo-control">
                            <label>Enfoque horizontal</label>
                            <input type="range" min="0" max="100" step="1" value="50" data-photo-pan-x>
                        </div>
                        <div class="vehicle-photo-control">
                            <label>Enfoque vertical</label>
                            <input type="range" min="0" max="100" step="1" value="50" data-photo-pan-y>
                        </div>
                    </div>
                </div>

                <div class="vehicle-photo-cropper-actions">
                    <button class="btn btn-secondary" type="button" data-photo-cancel>Cancelar</button>
                    <button class="btn btn-primary" type="button" data-photo-apply>Usar imagen</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div>
    <label>Tarjeta de circulacion</label>
    <input type="file" name="circulation_card" accept=".pdf,.jpg,.jpeg,.png">
    @if(!empty($vehicle?->circulation_card_url))
        <div style="margin-top:8px;">
            <a href="{{ $vehicle->circulation_card_url }}" target="_blank" rel="noopener">Ver archivo actual</a>
        </div>
    @endif
</div>
<div>
    <label>Poliza de seguro</label>
    <input type="file" name="insurance_policy" accept=".pdf,.jpg,.jpeg,.png">
    @if(!empty($vehicle?->insurance_policy_url))
        <div style="margin-top:8px;">
            <a href="{{ $vehicle->insurance_policy_url }}" target="_blank" rel="noopener">Ver archivo actual</a>
        </div>
    @endif
</div>
@if(auth()->check() && auth()->user()->role === 'superadmin')
    <div>
        <label><input type="checkbox" name="active" value="1" {{ old('active', $vehicle->active ?? true) ? 'checked' : '' }}> Activo</label>
    </div>
@else
    <div>
        <label>Estatus</label>
        <input value="{{ ($vehicle->active ?? true) ? 'Activo' : 'Inactivo' }}" disabled>
    </div>
@endif

@once
    @push('scripts')
        <script>
            (function () {
                function initPhotoPicker(picker) {
                    const input = picker.querySelector('[data-photo-input]');
                    const croppedInput = picker.querySelector('[data-photo-cropped]');
                    const preview = picker.querySelector('[data-photo-preview]');
                    const empty = picker.querySelector('[data-photo-empty]');
                    const cropper = picker.querySelector('[data-photo-cropper]');
                    const canvas = picker.querySelector('[data-photo-canvas]');
                    const zoom = picker.querySelector('[data-photo-zoom]');
                    const panX = picker.querySelector('[data-photo-pan-x]');
                    const panY = picker.querySelector('[data-photo-pan-y]');
                    const apply = picker.querySelector('[data-photo-apply]');
                    const cancelButtons = picker.querySelectorAll('[data-photo-cancel]');
                    const context = canvas ? canvas.getContext('2d') : null;
                    let image = null;
                    let objectUrl = null;

                    function togglePreview(src) {
                        if (!preview || !empty) return;

                        if (src) {
                            preview.src = src;
                            preview.hidden = false;
                            preview.classList.add('is-visible');
                            empty.hidden = true;
                        } else {
                            preview.hidden = true;
                            preview.classList.remove('is-visible');
                            empty.hidden = false;
                        }
                    }

                    function draw() {
                        if (!context || !canvas || !image) return;

                        const zoomValue = Number(zoom.value || 1);
                        const panXValue = Number(panX.value || 50) / 100;
                        const panYValue = Number(panY.value || 50) / 100;
                        const targetWidth = canvas.width;
                        const targetHeight = canvas.height;
                        const baseScale = Math.max(targetWidth / image.width, targetHeight / image.height);
                        const scale = baseScale * zoomValue;
                        const drawWidth = image.width * scale;
                        const drawHeight = image.height * scale;
                        const overflowX = Math.max(0, drawWidth - targetWidth);
                        const overflowY = Math.max(0, drawHeight - targetHeight);
                        const drawX = -(overflowX * panXValue);
                        const drawY = -(overflowY * panYValue);

                        context.clearRect(0, 0, targetWidth, targetHeight);
                        context.fillStyle = '#ffffff';
                        context.fillRect(0, 0, targetWidth, targetHeight);
                        context.drawImage(image, drawX, drawY, drawWidth, drawHeight);
                    }

                    function openCropper() {
                        if (!cropper) return;
                        cropper.setAttribute('aria-hidden', 'false');
                    }

                    function closeCropper() {
                        if (!cropper) return;
                        cropper.setAttribute('aria-hidden', 'true');
                    }

                    function resetControls() {
                        zoom.value = '1';
                        panX.value = '50';
                        panY.value = '50';
                    }

                    function loadFile(file) {
                        if (!file || !file.type.startsWith('image/')) return;

                        if (objectUrl) {
                            URL.revokeObjectURL(objectUrl);
                        }

                        objectUrl = URL.createObjectURL(file);
                        image = new Image();
                        image.onload = function () {
                            resetControls();
                            draw();
                            openCropper();
                        };
                        image.src = objectUrl;
                    }

                    if (input) {
                        input.addEventListener('change', function () {
                            const file = input.files && input.files[0];
                            if (!file) return;
                            loadFile(file);
                        });
                    }

                    [zoom, panX, panY].forEach(function (control) {
                        if (!control) return;
                        control.addEventListener('input', draw);
                    });

                    if (apply) {
                        apply.addEventListener('click', function () {
                            if (!canvas || !croppedInput) return;
                            const dataUrl = canvas.toDataURL('image/jpeg', 0.92);
                            croppedInput.value = dataUrl;
                            togglePreview(dataUrl);
                            closeCropper();
                        });
                    }

                    cancelButtons.forEach(function (button) {
                        button.addEventListener('click', function () {
                            closeCropper();
                        });
                    });

                    if (cropper) {
                        cropper.addEventListener('click', function (event) {
                            if (event.target === cropper) {
                                closeCropper();
                            }
                        });
                    }
                }

                document.querySelectorAll('[data-vehicle-photo-picker]').forEach(initPhotoPicker);
            })();
        </script>
    @endpush
@endonce
