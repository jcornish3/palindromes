/**
 * View for a value in the list.
 */
var PalindromeItem = Backbone.View.extend({

  tagName: 'li',
  
  className: 'palindrome list-group-item',
  
  template: _.template($('#palindrome-template').html()),

  events: {
    'click .edit': 'doEdit',
    'click .delete': 'doDelete',
  },
  
  /**
   * Initialize the view
   * @params {Object} options - the optons
   */
  initialize: function(options) {
    this.collection = options.collection;

    // bind listener to model changes
    this.listenTo(this.model, 'sync', this.render);
  },
  
  /**
   * Render the view.
   * @return {View} this view
   */
  render: function() {
    var self = this;

    this.$el.html(this.template(this.model.toJSON()));
    return this;
  },

  /** Open the edit dialog to edit a value. */
  doEdit: function(event) {
    var edit = new EditView({
      model: this.model,
    }).render();
  },
  
  /** Confirm and delete the value */
  doDelete: function(event) {
    var confirmDelete = confirm('Delete ' + this.model.get('value') + '?');
    if(confirmDelete) {
      this.collection.remove(this.model);
      this.model.destroy();
      this.remove();
    }
  },
  
});

/**
 * View for the edit value dialog
 */
var EditView = Backbone.View.extend({
  tagName: 'div',
  
  template: _.template($('#edit-template').html()),

  events: {
    'click .btn-primary': 'doEdit',
  },
  
  /**
   * Initialize the view
   * @params {Object} options - the optons
   */
  initialize: function(options) {
    $('body').append(this.el);
    this.$el.html(this.template(this.model.toJSON()));
  },
  
  /**
   * Render the view.
   * @return {View} this view
   */
  render: function() {
    var self = this;
    
    var modal = $('.modal', this.el).modal({'backdrop': 'static'}).modal('show');
    $(modal).on('hide.bs.modal', function(){ self.unrender() });

    return this;
  },

  /** Remove the dialog */
  unrender: function() {
    $(this.el).remove();
    this.remove();
  },

  /** Edit and save the value */
  doEdit: function() {
    if($('#editInput', this.$el)[0].checkValidity()) {
      var newVal = $('#editInput', this.$el).val().trim();
      this.model.set('value', newVal);
      
      this.model.save();
      
      $('.modal', this.el).modal('hide');
      this.unrender();
    }
  },
  
});