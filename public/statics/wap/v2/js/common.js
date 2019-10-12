 $("#navbar-menu li").each(function(index,ele){  
        $this = $(this);  
        console.log($this[0].children[0].href)
		console.log(location.pathname);
		var pathArr = location.pathname.split("/")
		console.log($(ele[0]));

		// console.log(pathArr);
		if(pathArr[2]==""){
        	 $("#navbar-menu li:eq(0)").addClass("active");  
        	 // $(this).addClass("active");  
        }
        if($this[0].children[0].href==String(window.location)){  
            $this.addClass("active");  
        }
    }); 
