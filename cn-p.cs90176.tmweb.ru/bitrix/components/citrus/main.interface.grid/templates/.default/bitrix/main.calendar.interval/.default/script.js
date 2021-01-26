function BxCalendarInterval()
{
	"use strict";
	this.OnDateChange = function(sel)
	{
		var bShowDays = false,
			bShowInterval = false,
			bShowFrom = false,
			bShowTo = false,
			bExact = false;

		var daysNode = BX.findNextSibling(sel, {'tag': 'div', 'class': 'bx-filter-days'}),
			intervalNode = BX.findNextSibling(sel, {'tag': 'div', 'class': 'bx-filter-interval'}),
			fromNode = BX.findChild(intervalNode, {'class': 'bx-filter-from'}),
			toNode = BX.findChild(intervalNode, {'class': 'bx-filter-to'}),
			fromInput = BX.findChild(fromNode, {'tag': 'input'}),
			fromPlaceholder = fromInput.dataset.placeholder;

		switch (sel.value) {
			case 'interval':
				bShowInterval = bShowFrom = bShowTo = true;
				break;
			case 'before':
				bShowInterval = bShowTo = true;
				break;
			case 'exact':
				bExact = bShowInterval = bShowFrom = true;
				break;
			case 'after':
				bShowInterval = bShowFrom = true;
				break;
			case 'days':
				bShowDays = true;
		}
		daysNode.style.display = (bShowDays ? '' : 'none');
		intervalNode.style.display = (bShowInterval ? '' : 'none');
		fromNode.style.display = (bShowFrom ? '' : 'none');
		toNode.style.display = (bShowTo ? '' : 'none');
		fromInput.placeholder = (bExact ? '' : fromPlaceholder);
	};
}

var bxCalendarInterval = new BxCalendarInterval();
