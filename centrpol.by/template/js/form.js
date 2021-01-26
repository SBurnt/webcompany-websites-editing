		function closeMailWindow(win)
		{
			var winNum = win.getAttribute("data-w");
			var wins = document.getElementsByClassName("fade");
			for(var z = 0; z<wins.length; z++)
		{
			if(wins[z].getAttribute("data-w") == winNum)
			wins[z].style.display="none";
		}
		}
			function showMailWindow(win){
			var winNum = win.getAttribute("data-w");
			var wins = document.getElementsByClassName("fade");
			for(var z = 0; z<wins.length; z++)
		{
			if(wins[z].getAttribute("data-w") == winNum)
			wins[z].style.display="block";
		}
		}