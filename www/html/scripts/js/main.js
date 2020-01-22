$(document).ready(function() {

  // init the list of palindromes
  var palindromes = new PalindromeCollection();
  
  // init the view
  var palindromeView = new PalindromeView({
    collection: palindromes, 
    el: $('#container'),
  }).render();

});