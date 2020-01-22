var PalindromeModel = Backbone.Model.extend({

  url: function() {
    var id = this.get('id') ? '/' + this.get('id') : '';  
    return 'rest/palindromes' + id;
  },

});
