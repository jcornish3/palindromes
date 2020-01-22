/**
 * The View for the list of values.
 */
var PalindromeList = Backbone.View.extend({
  
  /**
   * Initialize the view
   * @params {Object} options - the optons
   */
  initialize: function(options) {
    this.collection = options.collection;

    // bind listeners to the collection
    this.listenTo(this.collection, 'add', this.renderOne);
    this.listenTo(this.collection, 'reset', this.renderAll);
  },
  
  /**
   * Render the view.
   * @return {View} this view
   */
  render: function() {
    var self = this;
    this.collection.fetch({add: false, reset: true});
    return this;
  },
  
  /** 
   * Render one item in the list
   * @params {PalindromeModel} palindrome the value to display
   */
  renderOne: function(palindrome) {
    var item = new PalindromeItem({
      model: palindrome,
      collection: this.collection,
    });
    
    this.$el.append(item.render().$el);
  },
  
  /** Render all values in the list */
  renderAll: function() {
    this.$el.html('');
    this.collection.each(this.renderOne, this);
  },
});