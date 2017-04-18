			<footer>
				<ul>
					<li><a href="#">Lorem Ipsum</a></li>
					<li><a href="#">Lorem Ipsum</a></li>
					<li><a href="#">Lorem Ipsum</a></li>
					<li><a href="#">Lorem Ipsum</a></li>
					<li><a href="#">Lorem Ipsum</a></li>
					<li><a href="#">Lorem Ipsum</a></li>				
				</ul>		
			</footer>
		</main>	
		<script type="text/javascript"> 
      var position = 0;
      var grayarea = document.getElementById("grayarea");
      var nav_menu_opener = document.getElementById("nav_menu_opener");
    //var nav_menue_auf = document.getElementById("nav_menue_auf");
      
      
      
		console.log("start");

      function toggle(evt) {
        position++;
			 if (position == 1) {
          nav.classList.add("open");
          grayarea.classList.add("open");
          console.log("2");
        } else {
          nav.classList.remove("open");
          grayarea.classList.remove("open");
          console.log("3");
          position = 0;
        }  
      }
		
    //bigContentArea.addEventListener("click", toggle);
    //grayarea.addEventListener("click", toggle);
      grayarea.addEventListener("click", toggle);
      nav_menu_opener.addEventListener("click", toggle);

   
  
     
    </script>

	
	</body>
</html>