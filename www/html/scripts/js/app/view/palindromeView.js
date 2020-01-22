/**
 * The main View for the Palindrome page
 */
var PalindromeView = Backbone.View.extend({

  /** define events */
  events: {
    'click #submit': 'doSubmit', 
  },
  
  /**
   * Initialize the view
   * @params {Object} options - the optons
   */
  initialize: function(options) {
    this.collection = options.collection;
  },
  
  /**
   * Render the view.
   * @return {View} this view
   */
  render: function() {
    this.renderPalindromes();
    return this;
  },
  
  /** Render the list of existing palindromes. */
  renderPalindromes: function() {
    this.list = new PalindromeList({
      collection: this.collection,
      el: $('#palindrome-list'),
    }).render();
  },

  /** Submit a new value for creation. */
  doSubmit: function() {
    if($('#palindromeInput', this.$el)[0].checkValidity()) {
      var value = $('#palindromeInput', this.$el).val().trim();
      var model = new PalindromeModel({"value": value, "palindrome": false});
      
      model.save();
      this.collection.add(model);
      $('#palindromeInput').val('');
    }
  },
  
});