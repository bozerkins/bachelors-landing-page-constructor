// method itself
Backbone.sync = function(method, model, options) {
	console.log(arguments);
	// Default options, unless specified.
	_.defaults(options || (options = {}));

	// Default JSON-request options.
	var params = {type: 'POST', dataType: 'json'};

	// Ensure that we have a URL.
	if (!options.url) {
	  params.url = _.result(model, 'url') || urlError();
	}
	if (params.url && method) {
		params.url = params.url + method;
	}
	// Ensure that we have the appropriate request data.
	if (options.data == null && model && (method === 'create' || method === 'update' || method === 'patch')) {
	  params.contentType = 'application/json';
	  params.data = JSON.stringify(options.attrs || model.toJSON(options));
	}

	// Don't process data on a non-GET request.
	params.processData = false;

	// Make the request, allowing the user to override any Ajax options.
	var xhr = options.xhr = Backbone.ajax(_.extend(params, options));
	model.trigger('request', model, xhr, options);
	return xhr;
};

  // Map from CRUD to HTTP for our default `Backbone.sync` implementation.
//  var methodMap = {
//    'create': 'POST',
//    'update': 'PUT',
//    'patch':  'PATCH',
//    'delete': 'DELETE',
//    'read':   'GET'
//  };