function makeVisible(element) {
  element.style.opacity = '1';
  element.style.transition = 'opacity 0.75s, background-color 0.5s';
}

const forms = document.querySelectorAll('form');
let i = 0;
forms.forEach((form) => {
  setTimeout(function () {
    makeVisible(form);
  }, i * 75);
  i++;
});
