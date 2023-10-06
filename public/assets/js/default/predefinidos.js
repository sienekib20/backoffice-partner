function removeMe(element) {
  var itemToBeRemoved = myFatherDadName(element, 'sp-accordion-row');
  itemToBeRemoved.remove();
}

function myFatherDadName(element, name) {
  if (element.parentNode.classList[0] != name) {
    return myFatherDadName(element.parentNode, name);
  }
  return element.parentNode;
}

function assetFileName(element) {
  return element.innerText;
}

function assetAcceptTypeFile(element) {
  return (element.innerText.trim() == 'file') ? '.css,.js' : 'image/*';
}

function changeStatusFileText(element) {
  console.log();
  var status = element.previousElementSibling.querySelector('.statusFile');
  status.innerText = element.files.length + ' ficheiro(s)';
  status.classList.add('colored');
}
