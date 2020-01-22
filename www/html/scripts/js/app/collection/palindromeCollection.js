var PalindromeCollection = Backbone.Collection.extend({

  model: PalindromeModel,

  url: 'rest/palindromes'

});
