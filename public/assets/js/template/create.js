$(document).ready(function () {



  /*
  »»»»»»»»»» sp-form-section ««««««««««
  */
  try {
    var accordionHeaderChevron = document.querySelectorAll('.sp-accordion-header .bi-chevron-down');
    accordionHeaderChevron.forEach(element => {
      element.addEventListener('click', (e) => {
        var parentOfMyParent = myFatherDadName(e.target, 'sp-accordion-item');
        parentOfMyParent.classList.toggle('active');
      });
    });

  } catch (error) {
    console.error(error);
  }

  /*
  »»»»»»»»»» sp-form-section ««««««««««
  */
  try {
    var addAccordionButton = document.querySelectorAll('.sp-accordion-btn');
    let assetContainer = $('#asset-container');
    let pageContainer = $('#page-container');
    var count = 3;
    var countPage = 2;
    addAccordionButton.forEach(element => {
      element.addEventListener('click', (e) => {

        var father = myFatherDadName(e.target, 'sp-accordion-item');

        if (father.classList.length < 2) {
          return e.preventDefault();

        } else if (e.target.innerText == ' file' || e.target.innerText == ' image') {
          var assetItem = '';
          assetItem += '<div class="sp-accordion-row">';
          assetItem += '<div class="sp-form-fields full-width">';
          assetItem += '<div class="sp-form-label sp-form-field">';
          assetItem += '<div>';
          assetItem += '<small class="bi-three-dots-vertical"></small>';
          assetItem += '<label for="tempAsset-' + count + '">';
          assetItem += '<small>Load asset ' + assetFileName(e.target) + '</small>'
          assetItem += '</label>'
          assetItem += '<small class="statusFile">sem ficheiro</small>';

          assetItem += '</div>';
          assetItem += '<span class="bi-x" onclick="removeMe(this)"></span>';
          assetItem += '</div>';
          assetItem += '<input type="file" name="tempAssetFile-' + count + '" id="tempAsset-' + count + '" accept="' + assetAcceptTypeFile(e.target) + '" onchange="changeStatusFileText(this)"  hidden>';
          assetItem += '</div>';
          assetItem += '</div>';

          assetContainer.append(assetItem);
          count++;
          return;

        } else {
          var pageItem = '';
          pageItem += '<div class="sp-accordion-row">';
          pageItem += '<div class="field mb-2">';
          pageItem += ' <span class="bi-x" onclick="removeMe(this)"></span>';
          pageItem += '<div class="sp-form-fields full-width">';
          pageItem += '<input type="text" name="tempPage-' + countPage + '" class="sp-form-field" placeholder="Page name" required>';
          pageItem += '<small class="text-muted"></small>';
          pageItem += '</div>';
          pageItem += '<div class="sp-form-fields full-width">';
          pageItem += '<div class="sp-form-label sp-form-field">';
          pageItem += '<div>';
          pageItem += '<small class="bi-three-dots-vertical"></small>';
          pageItem += '<label for="tempPage-' + countPage + '"> <small>Load page file</small> </label> <small class="statusFile">sem ficheiro</small>';
          pageItem += '</div>';
          pageItem += '</div>';
          pageItem += '<input type="file" name="tempPageContent-' + countPage + '" id="tempPage-' + countPage + '" accept=".html,.htm" onchange="changeStatusFileText(this)" hidden>';
          pageItem += '</div>';
          pageItem += '</div>';
          pageItem += '</div>';

          pageContainer.append(pageItem);
          countPage++;
          return;
        }

      });
    });

  } catch (error) {
    console.error(error);
  }

});
