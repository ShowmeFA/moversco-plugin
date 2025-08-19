let moverscoTranslations = {};

// Apply translations to text and attributes
function moverscoApplyTranslations() {
  document.querySelectorAll('[data-i18n]').forEach(el => {
    const key = el.dataset.i18n;
    const attr = el.dataset.i18nAttr; // e.g., "placeholder", "title", "value"

    if (moverscoTranslations[key]) {
      if (attr) {
        el.setAttribute(attr, moverscoTranslations[key]);
      } else {
        el.textContent = moverscoTranslations[key];
      }
    }
  });
}

// Load the selected language JSON and apply translations
function moverscoLoadLanguage(lang) {
  fetch(moverscoLang.langPath + lang + '.json')
    .then(res => res.json())
    .then(data => {
      moverscoTranslations = data;
      moverscoApplyTranslations();

      // Optionally save language choice in localStorage
      localStorage.setItem('moverscoLang', lang);
    })
    .catch(() => console.warn('Language file not found for: ' + lang));
}

// On document ready
document.addEventListener('DOMContentLoaded', () => {
  const select = document.getElementById('language-toggle');

  // Load stored language or default
  const storedLang = localStorage.getItem('moverscoLang') || moverscoLang.defaultLang;
  moverscoLoadLanguage(storedLang);

  // Update <select> if storedLang was used
  if (select) {
    select.value = storedLang;

    select.addEventListener('change', function () {
      moverscoLoadLanguage(this.value);
    });
  }
});
