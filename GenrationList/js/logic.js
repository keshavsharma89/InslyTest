	function set_given_genration(){
		var genrations=[];
		genrations.push(['James', 'Mary']);
		genrations.push(['Tom', 'Morris', 'Maria']);
		genrations.push(['Taylor', 'Timothy', 'Alexander', 'John', 'James', 'Juliette']);
		genrations.push(['Dmitry', 'Denis', 'Delore', 'Samuel']);
		
		save_genrations(genrations)
	}
	
	//we will need this function to save the genration to local storage
	function save_genrations(genrations){
		localStorage.setItem("genrations", JSON.stringify(genrations))
	}
	
	function add_genration(){
		var genrations=JSON.parse(localStorage.getItem("genrations"));
		genrations.push([])
		reset_list(genrations)
	}
	
	// this function will add new member to the give level of genrations
	function add_new_member(index){
		var genrations=JSON.parse(localStorage.getItem("genrations"));
		var newmember = prompt("Please enter name of new member", "");
		genrations[index].push(newmember);
		reset_list(genrations)
	}
	
	// this function will genrate the HTML that we can latter appent to div
	function create_html(genrations){
		// Start ul tag
        var html='<ul class="mainul">';
        
		for(i = 0; i < genrations.length; i++){
		    html+='<li class="header">Genration '+(i+1)+' <a onclick="add_new_member('+i+')"  class="pointer" title="Add new member">+</a></li>';
		    
		    // this function will sort the array in alphabetical order, which will also be case insensitive
		    genrations[i].sort(function (a, b) {
				return a.toLowerCase().localeCompare(b.toLowerCase());
			});
			for(j = 0; j < genrations[i].length; j++){
				html+='<li>'+genrations[i][j]+'</li>';
			}
		}
		html+='<li> <button class="pointer genrationbutton" onclick="add_genration()">Add new genration</button></li>';
		// ends our ul tag here
        html+='</ul>';
        
        save_genrations(genrations)
        return html;
	}
	
	// this function will append the HTML to the div
	function append_html(divid, html){
		ele=document.getElementById(divid);
		ele.innerHTML=html;
	}

	// we need this function to reset the list, basically initiate or re initiate the list genration process.
	function reset_list(genrations){
		var html=create_html(genrations)
		var divid='inhere'
		append_html(divid, html)
	}
