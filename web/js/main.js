$(function() {
	$('#search').typeahead({
		source: function(query, process) {
			$.post(searchUrl, {query: query}, function(data) {
				labels = []
				mapped = {}

				$.each(data, function(i, item) {
					mapped[item.name + ' (' + item.serialnumber + ')'] = item.serialnumber;
					labels.push(item.name + ' (' + item.serialnumber + ')');
				})

				process(labels);
			});
		},
		updater: function(item) {
			return mapped[item];
		}
	});
});
