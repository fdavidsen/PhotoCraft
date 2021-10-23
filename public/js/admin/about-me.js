// Sync value between input range and number
$('#about-me').on('input', '.skill-percentage, .skill-percentage-slider', function() {
  const percentage = $(this).val();
  $(this).parent().siblings().children().val(percentage);
});


// Current skills
let skillList = $('#skill-list').val();
skillList = JSON.parse(skillList);

// Add new skill
$('#new-skill-submit').on('click', function() {
  const skillName = $('#new-skill-name').val();
  const skillPercentage = $('#new-skill-percentage').val() || 50;
  
  let skillId = 1;
  if (skillList.length > 0) {
    let idList = [];
    skillList.map(item => idList.push(item.id));
    skillId = Math.max(...idList) + 1;
  }

  skillList.push({
    id: skillId,
    name: skillName,
    percentage: skillPercentage
  });
  $('#skill-list').val(JSON.stringify(skillList));

  $('#skill-container').append(`
    <div class="row align-items-end mb-3" id="skill-${ skillId }">
      <div class="col">
        <p class="mb-1">
          <span class="name">${ skillName }</span>
          <span class="percentage ms-3">${ skillPercentage }</span>
        </p>
        <div class="progress">
          <div class="progress-bar" role="progressbar" style="width: ${ skillPercentage }%"></div>
        </div>
      </div>
      <div class="col-auto">
        <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#tempEditSkillModal-${ skillId }"><i class="fas fa-pencil-alt"></i></button>
        <button type="button" class="btn btn-sm btn-danger delete" data-id="${ skillId }"><i class="fas fa-trash-alt"></i></button>
      </div>
    </div>
  `);
  $('#temp-edit-modal-container').append(`
    <div class="edit modal fade" id="tempEditSkillModal-${ skillId }" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header border-0">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body py-0">           
            <div class="mb-3">
              <label for="edit-skill-name" class="form-label">Name</label>
              <input type="text" class="form-control" id="edit-skill-name-${ skillId }" value="${ skillName }">
            </div>
            
            <div class="mb-3">
              <label for="edit-skill-percentage-${ skillId }" class="form-label mb-0">Percentage (%)</label>
              <div class="row align-items-center">
                <div class="col">
                  <input type="range" class="skill-percentage-slider form-range h-auto w-100" id="edit-skill-percentage-slider-${ skillId }" min="0" max="100" step="5" value="${ skillPercentage }">
                </div>
                <div class="col-auto">
                  <input type="number" class="skill-percentage form-control w-auto ms-auto" id="edit-skill-percentage-${ skillId }" min="0" max="100" value="${ skillPercentage }">
                </div>
              </div>
            </div>
          </div>

          <div class="modal-footer border-0">
            <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button class="btn btn-primary edit-skill-submit" data-id="${ skillId }">Update</button>
          </div>
        </div>
      </div>
    </div>
  `);

  $('.modal').modal('hide');
  $('#new-skill-name').val('');
});

// Edit spesific skill
$('#about-me').on('click', '.edit-skill-submit', function() {
  const skillId = $(this).data('id');
  const skillName = $('#edit-skill-name-' + skillId).val();
  const skillPercentage = $('#edit-skill-percentage-' + skillId).val();

  const editedSkill = {
    id: skillId,
    name: skillName,
    percentage: skillPercentage
  };
  skillList = skillList.map(item => (item.id === skillId) ? editedSkill : item);
  $('#skill-list').val(JSON.stringify(skillList));

  const skillItem = $('#skill-container #skill-' + skillId);
  skillItem.find('.name').html(skillName);
  skillItem.find('.percentage').html(skillPercentage);
  skillItem.find('.progress-bar').width(skillPercentage + '%');

  $('.modal').modal('hide');
});

// Remove spesific skill
$('#about-me').on('click', '.delete', function() {
  const skillId = $(this).data('id');
  skillList = skillList.filter(item => item.id !== skillId);
  $('#skill-list').val(JSON.stringify(skillList));
  $('#skill-' + skillId).hide();
});