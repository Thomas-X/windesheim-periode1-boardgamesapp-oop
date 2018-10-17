import $ from 'jquery';

function cloneEl(buttonId, elCloneId, appendId) {
	$(`#${buttonId}`).click(function (e) {
		const el = $(`#${elCloneId}`).clone();
		$(`#${appendId}`).append(el);
	});
}

cloneEl('addPlayerWon', 'playerwon', 'playerwonContainer');
cloneEl('addPlayerLose', 'playerlose', 'playerloseContainer');

