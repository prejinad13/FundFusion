<div class="card mb-4">
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-sm-12 mb-2">
                        <label class="form-label" for="name">Idea Name <small class="text-danger">*</small></label>
                        {!! Form::text('name', null, [
                            'class' => 'form-control',
                            'id' => 'name',
                            'placeholder' => 'Idea Name',
                        ]) !!}
                        @error('name') <small class="text-danger">{{$message}}</small> @enderror
                    </div>

                    {{-- Video Field --}}
                    <div class="col-sm-12 mb-2">
                        <label class="form-label">Explanation Video <small class="text-danger">*</small></label>

                        {{-- Toggle buttons --}}
                        <div class="mb-2 d-flex gap-2">
                            <button type="button" class="btn btn-sm btn-outline-primary active" id="btn-url"
                                onclick="switchVideoType('url')">
                                <i class="bx bx-link me-1"></i> Video URL
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-primary" id="btn-file"
                                onclick="switchVideoType('file')">
                                <i class="bx bx-upload me-1"></i> Upload File
                            </button>
                        </div>

                        {{-- URL input --}}
                        <div id="video-url-section">
                            {!! Form::url('video_link', null, [
                                'class' => 'form-control',
                                'id' => 'video_link',
                                'placeholder' => 'YouTube, Vimeo or any video URL',
                            ]) !!}
                            <small class="text-muted">Supports YouTube, Vimeo, or any direct video link</small>
                            @error('video_link') <small class="text-danger d-block">{{$message}}</small> @enderror
                        </div>

                        {{-- File upload input --}}
                        <div id="video-file-section" style="display:none;">
                            <input type="file" name="video_file" id="video_file"
                                class="form-control" accept="video/mp4,video/webm,video/ogg,video/quicktime">
                            <small class="text-muted">Accepted formats: MP4, WebM, OGG, MOV (max 100MB)</small>
                            @error('video_file') <small class="text-danger d-block">{{$message}}</small> @enderror

                            {{-- Show existing video if editing --}}
                            @isset($data['data'])
                                @if(isset($data['data']->video_link) && Str::startsWith($data['data']->video_link, 'storage/'))
                                    <div class="mt-2">
                                        <small class="text-success"><i class="bx bx-check-circle me-1"></i>Current video uploaded. Upload a new file to replace it.</small>
                                    </div>
                                @endif
                            @endisset
                        </div>
                    </div>

                    <div class="col-sm-5">
                        @php
                            $team_sizes = ['Single'=>'Single','Less than 5'=>'Less than 5','5 to 10'=>'5 to 10','Greater than 10'=>'Greater than 10'];
                        @endphp
                        <label class="form-label" for="team_size">Team Size <small class="text-danger">*</small></label>
                        {!! Form::select('team_size', $team_sizes, null, [
                            'class' => 'form-select',
                            'id' => 'team_size',
                            'placeholder' => 'Team Size',
                        ]) !!}
                        @error('team_size') <small class="text-danger">{{$message}}</small> @enderror
                    </div>
                </div>

                <div class="col-md-12 mt-2">
                    <label for="investment_sectors" class="form-label">Investment Sector <small class="text-danger">*</small></label>
                    <div class="position-relative">
                        @if(isset($data['data']))
                            @php $selectedSectors = $data['data']->sectors->pluck('id')->toArray(); @endphp
                        @else
                            @php $selectedSectors = null; @endphp
                        @endisset
                        {!! Form::select('investment_sectors[]', $data['investment_sectors']->pluck('name','id')->toArray(), $selectedSectors, [
                            'class' => 'form-select select2',
                            'id' => 'investment_sectors',
                            'placeholder' => 'Select Investment Sectors',
                            'multiple',
                        ]) !!}
                    </div>
                    @error('investment_sectors') <small class="text-danger">{{$message}}</small> @enderror
                </div>
            </div>

            <div class="col-md-6">
                @livewire('idea.roi',[
                    'required_investment_amount' => $data['data']->required_investment_amount ?? old('required_investment_amount'),
                    'return_on_investment'       => $data['data']->return_on_investment ?? old('return_on_investment'),
                    'estimated_return'           => $data['data']->estimated_return ?? old('estimated_return'),
                ])
            </div>

            <div class="col-md-12">
                <label class="form-label" for="short_description">Short Description <small class="text-danger">*</small></label>
                {!! Form::textarea('short_description', null, [
                    'class' => 'form-control',
                    'id' => 'short_description',
                    'placeholder' => 'Write a short brief about your idea',
                    'rows' => '3',
                ]) !!}
                @error('short_description') <small class="text-danger">{{$message}}</small> @enderror
            </div>

            <div class="col-md-12">
                <label class="form-label" for="long_description">Main Description <small class="text-danger">*</small></label>
                {!! Form::textarea('long_description', null, [
                    'class' => 'form-control',
                    'id' => 'long_description',
                    'placeholder' => 'Write your idea explanation in details.',
                ]) !!}
                @error('long_description') <small class="text-danger">{{$message}}</small> @enderror
            </div>

            <div class="col-12 d-flex justify-content-end">
                <button class="btn btn-primary btn-next">
                    <span class="align-middle d-sm-inline-block d-none me-sm-1">Submit</span>
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // On page load, detect if current value is a file path and switch accordingly
    document.addEventListener('DOMContentLoaded', function () {
        var videoLink = "{{ isset($data['data']) ? $data['data']->video_link : '' }}";
        if (videoLink && videoLink.startsWith('storage/')) {
            switchVideoType('file');
        }
    });

    function switchVideoType(type) {
        var urlSection  = document.getElementById('video-url-section');
        var fileSection = document.getElementById('video-file-section');
        var btnUrl      = document.getElementById('btn-url');
        var btnFile     = document.getElementById('btn-file');
        var urlInput    = document.getElementById('video_link');
        var fileInput   = document.getElementById('video_file');

        if (type === 'url') {
            urlSection.style.display  = 'block';
            fileSection.style.display = 'none';
            btnUrl.classList.add('active');
            btnFile.classList.remove('active');
            fileInput.disabled = true;
            urlInput.disabled  = false;
        } else {
            urlSection.style.display  = 'none';
            fileSection.style.display = 'block';
            btnFile.classList.add('active');
            btnUrl.classList.remove('active');
            urlInput.disabled  = true;
            fileInput.disabled = false;
        }
    }
</script>
@endpush