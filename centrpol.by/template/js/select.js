		function openbox(id){
			left = document.getElementById(id).style.left;

			if(left=='-410px'){
				document.getElementById(id).style.left='10px';
				}else{
				document.getElementById(id).style.left='-410px';
			}
		}