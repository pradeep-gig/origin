
	var app = angular.module('livedisplay', []);
	var res = {
		title: '',
		body: ''
	};
	app.controller('liveformController', function() {
		this.item = res;
	});
