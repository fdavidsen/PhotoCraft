@extends('admin/layouts/app')
@section('title', 'About Me')

@section('content')
  <div id="about-me">
    <div class="text-center">
      <img class="admin-photo shadow mb-4" src="{{ asset('img/' . $admin->photo) }}" alt="{{ $admin->first_name . $admin->last_name }}">
    </div>

    <form action="/admin/interface/about/update" enctype="multipart/form-data" method="POST">
      @csrf
      <input type="hidden" name="old_photo" value="{{ $admin->photo }}">
      <input type="hidden" id="skill-list" name="skill" value="{{ $admin->skills }}">

      <div class="mb-3">
        <label for="photo" class="form-label">Update photo</label>
        <input class="form-control @error('photo') is-invalid @enderror" type="file" id="photo" name="photo">
        @error('photo')
          <div class="form-text text-danger">{{ $message }}</div>  
        @enderror
      </div>

      <div class="mb-3">
        <div class="row">
          <div class="col">
            <label for="first-name" class="form-label">First name</label>
            <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first-name" name="first_name" value="{{ $admin->first_name }}">
            @error('first_name')
              <div class="form-text text-danger">{{ $message }}</div>  
            @enderror
          </div>
          <div class="col">
            <label for="last-name" class="form-label">Last name</label>
            <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last-name" name="last_name" value="{{ $admin->last_name }}">
            @error('last_name')
              <div class="form-text text-danger">{{ $message }}</div>  
            @enderror
          </div>
        </div>
      </div>

      <div class="mb-4">
        <label for="bio" class="form-label">Bio</label>
        <textarea class="form-control @error('bio') is-invalid @enderror" id="bio" name="bio" maxlength="1000" rows="5">{{ $admin->bio }}</textarea>
        @error('bio')
          <div class="form-text text-danger">{{ $message }}</div>  
        @enderror
      </div>

      <p class="d-inline-block form-label me-2 my-auto">Skill</p>
      <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#newSkillModal"><i class="fas fa-plus"></i></button>

      <div class="card mt-2 mb-5">
        <div class="card-body" id="skill-container">
          @foreach (json_decode($admin->skills) as $skill)
            <div class="row align-items-end mb-3" id="skill-{{ $skill->id }}">
              <div class="col">
                <p class="mb-1">
                  <span class="name">{{ $skill->name }}</span>
                  <span class="percentage ms-3">{{ $skill->percentage }}</span>
                </p>
                <div class="progress">
                  <div class="progress-bar" role="progressbar" style="width: {{ $skill->percentage }}%"></div>
                </div>
              </div>
              <div class="col-auto">
                <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editSkillModal-{{ $skill->id }}"><i class="fas fa-pencil-alt"></i></button>
                <button type="button" class="btn btn-sm btn-danger delete" data-id="{{ $skill->id }}"><i class="fas fa-trash-alt"></i></button>
              </div>
            </div>
          @endforeach
        </div>
      </div>

      <button type="submit" class="btn btn-primary float-end"><i class="fas fa-save me-1"></i> Save</button>
    </form>



    {{-- New skill modal --}}
    <div class="modal fade" id="newSkillModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header border-0">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body py-0">           
            <div class="mb-3">
              <label for="new-skill-name" class="form-label">Name</label>
              <input type="text" class="form-control" id="new-skill-name" placeholder="Photography">
            </div>
            
            <div class="mb-3">
              <label for="new-skill-percentage" class="form-label mb-0">Percentage (%)</label>
              <div class="row align-items-center">
                <div class="col">
                  <input type="range" class="skill-percentage-slider form-range h-auto w-100" id="new-skill-percentage-slider" min="0" max="100" step="5">
                </div>
                <div class="col-auto">
                  <input type="number" class="skill-percentage form-control w-auto ms-auto" id="new-skill-percentage" min="0" max="100" value="50">
                </div>
              </div>
            </div>
          </div>

          <div class="modal-footer border-0">
            <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button class="btn btn-primary" id="new-skill-submit">Add</button>
          </div>
        </div>
      </div>
    </div>

    {{-- Edit skill modals --}}
    @foreach (json_decode($admin->skills) as $skill)
      <div class="edit modal fade" id="editSkillModal-{{ $skill->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header border-0">
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-0">           
              <div class="mb-3">
                <label for="edit-skill-name" class="form-label">Name</label>
                <input type="text" class="form-control" id="edit-skill-name-{{ $skill->id }}" value="{{ $skill->name }}">
              </div>
              
              <div class="mb-3">
                <label for="edit-skill-percentage-{{ $skill->id }}" class="form-label mb-0">Percentage (%)</label>
                <div class="row align-items-center">
                  <div class="col">
                    <input type="range" class="skill-percentage-slider form-range h-auto w-100" id="edit-skill-percentage-slider-{{ $skill->id }}" min="0" max="100" step="5" value="{{ $skill->percentage }}">
                  </div>
                  <div class="col-auto">
                    <input type="number" class="skill-percentage form-control w-auto ms-auto" id="edit-skill-percentage-{{ $skill->id }}" min="0" max="100" value="{{ $skill->percentage }}">
                  </div>
                </div>
              </div>
            </div>

            <div class="modal-footer border-0">
              <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button class="btn btn-primary edit-skill-submit" data-id="{{ $skill->id }}">Update</button>
            </div>
          </div>
        </div>
      </div>
    @endforeach

    {{-- Temporary edit skill modals --}}
    <div id="temp-edit-modal-container"></div>
  </div>
@endsection