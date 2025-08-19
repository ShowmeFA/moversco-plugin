// // This file manages the address autocomplete functionality, integrating with the API to provide suggestions as the user types.

// document.addEventListener('DOMContentLoaded', function () {
//     const addressInput = document.querySelector('.address-autocomplete');

//     if (addressInput) {
//         addressInput.addEventListener('input', function () {
//             const query = this.value;

//             if (query.length > 2) {
//                 fetch(`${moversco_ajax.ajax_url}?action=address_lookup&query=${encodeURIComponent(query)}`, {
//                     method: 'GET',
//                     headers: {
//                         'X-WP-Nonce': moversco_ajax.nonce
//                     }
//                 })
//                 .then(response => response.json())
//                 .then(data => {
//                     if (data.success) {
//                         const suggestions = data.data;
//                         // Clear previous suggestions
//                         clearSuggestions();
//                         suggestions.forEach(suggestion => {
//                             const suggestionItem = document.createElement('div');
//                             suggestionItem.classList.add('suggestion-item');
//                             suggestionItem.textContent = suggestion.formattedAddress;
//                             suggestionItem.addEventListener('click', function () {
//                                 addressInput.value = suggestion.formattedAddress;
//                                 clearSuggestions();
//                             });
//                             document.querySelector('.suggestions-container').appendChild(suggestionItem);
//                         });
//                     }
//                 })
//                 .catch(error => console.error('Error fetching address suggestions:', error));
//             } else {
//                 clearSuggestions();
//             }
//         });
//     }

//     function clearSuggestions() {
//         const suggestionsContainer = document.querySelector('.suggestions-container');
//         suggestionsContainer.innerHTML = '';
//     }
// });