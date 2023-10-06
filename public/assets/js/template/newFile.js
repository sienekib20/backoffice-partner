window.addEventListener('load', (e) => {
  /*
  »»»»»»»»»» sp-form-section ««««««««««
  */
  try {
    var formSectionChevron = document.querySelectorAll('.sp-section-top .bi-chevron-down');

    formSectionChevron.forEach(element => {
      element.addEventListener('click', (e) => {
        var grandPa = e.target.parentNode.parentNode;
        grandPa.classList.toggle('active');
      });
    });

  } catch (error) {
    console.error(error);
  }

  /*
  »»»»»»»»»» sp-form-section ««««««««««
  */
  try {
    var allAddBtns = document.querySelectorAll('.sp-btn');
    var count = 3;
    allAddBtns.forEach(element => {
      element.addEventListener('click', (e) => {
        var father = e.target.parentNode;
        if (father.parentNode.classList.length < 2) {
          return e.preventDefault();
        }
        if (e.target.innerText != 'page') {
          var container = father.nextElementSibling;
          var r = new Element('div');
          var row = '<div class="sp-row">';
          row += '<div class="sp-form-contain">';
          row += '<div class="sp-form-fields">';
          row += '<div class="label sp-form-field">';
          row += '<small class="bi-three-dots-vertical"></small>';
          row += '<label for="file-"' + count + '><small>Load asset ' + e.target.innerText + '</small></label>';
          row += '<span class="bi-x"></span>';
          row += '</div>';
          row += '<input type="file" id="file-"' + count + ' name="asset" hidden>';
          row += '<small class="sp-error"></small>';
          row += '</div>';
          row += '</div>';
          row += '</div>';
          container.appentC;
          count++;
          console.log(r);
        }
      });
    });

  } catch (error) {
    console.error(error);
  }

});
