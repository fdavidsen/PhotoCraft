@extends('admin/layouts/app')
@section('title', ucfirst($section))

@section('content')
  <div id="photo-list">
    <button class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#newPhotoModal"><i class="fas fa-plus me-1"></i> New photo</button>

    <table class="table text-center">
      <thead>
        <tr>
          <th scope="col">Photo</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($photos as $photo)
          <tr>
            <td class="w-50">
              <img src="{{ asset('img/photo/' . $photo->filename) }}" alt="{{ $photo->caption }}">
            </td>
            <td class="align-middle w-50">
              <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editPhotoModal-{{ $photo->id }}"><i class="fas fa-pencil-alt me-1"></i> Edit</button>
              <button class="btn btn-sm btn-danger delete" data-id="{{ $photo->id }}" data-filename="{{ $photo->filename }}"><i class="fas fa-trash-alt me-1"></i> Delete</button>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>

    {{-- New photo modal --}}
    <div class="modal fade" id="newPhotoModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header border-0">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form>
            <input type="hidden" name="section" value="{{ $section }}">

            <div class="modal-body py-0">           
              <div class="mb-1">
                <label for="new-photo" class="form-label">Upload photo</label>
                <input type="file" class="form-control" id="new-photo" name="photo">
                <div class="form-text text-danger mb-3"></div>
              </div>

              <div class="mb-4">
                <label for="new-caption" class="form-label">Caption</label>
                <textarea class="form-control" id="new-caption" name="caption" maxlength="1000" rows="5"></textarea>
                <div class="form-text text-danger"></div>
              </div>
            </div>

            <div class="modal-footer border-0">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Post</button>
              <button type="button" class="btn btn-primary d-none" disabled>
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Loading...
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>

    {{-- Edit photo modals --}}
    @foreach ($photos as $photo)
      <div class="edit modal fade" id="editPhotoModal-{{ $photo->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header border-0">
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form>
              <input type="hidden" name="_method" value="PUT">
              <input type="hidden" name="id" value="{{ $photo->id }}">
              <input type="hidden" name="old_photo" value="{{ $photo->filename }}">

              <div class="modal-body py-0">
                <div class="text-center mb-5">
                  <img class="shadow" src="{{ asset('img/photo/' . $photo->filename) }}" alt="{{ $photo->caption }}">
                </div>
                
                <div class="mb-1">
                  <label for="edit-photo-{{ $photo->id }}" class="form-label">Update photo</label>
                  <input type="file" class="form-control" id="edit-photo-{{ $photo->id }}" name="photo">
                  <div class="form-text text-danger mb-3"></div>
                </div>

                <div class="mb-4">
                  <label for="edit-caption-{{ $photo->id }}" class="form-label">Caption</label>
                  <textarea class="form-control" id="edit-caption-{{ $photo->id }}" name="caption" maxlength="1000" rows="5">{{ $photo->caption }}</textarea>
                  <div class="form-text text-danger"></div>
                </div>
              </div>
              
              <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update</button>
                <button type="button" class="btn btn-primary d-none" disabled>
                  <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                  Loading...
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    @endforeach
  </div>
@endsection