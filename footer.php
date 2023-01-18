<footer class="footer bg-light border-top">
	<div class="mt-2 footer-bottom bg-secondary">
		<div class="container">
			<div class="row">
				<div class="col-md-4 p-2">
					<div class="">
						<h4 class="text-light">Usefull links</h4>
						<hr>
						<div class="links">
							<a class="nav-link text-white" href="#">Ministry of Education</a>
							<a class="nav-link text-white" href="#">NSTU Official</a>
							<a class="nav-link text-white" href="#">privacy</a>
							<a class="nav-link text-white" href="#">Office of Chancellor</a>
						</div>

					</div>
				</div>
				<div class="col-md-4 p-2">
					<div class="">
						<h4 class="text-light ">CENTER/CELL</h4>
						<hr>
						<div class="links">
							<a class="nav-link text-white" href="#">Research Cell</a>
							<a class="nav-link text-white" href="#">Cyber Center</a>
							<a class="nav-link text-white" href="#">IQAC</a>
							<a class="nav-link text-white" href="#">ICT Cell</a>
						</div>
					</div>
				</div>
				<div class="col-md-4 p-2">
					<div class="">
						<h4 class="text-light ">FACILITIES</h4>
						<hr>
						<div class="links">
							<a class="nav-link text-white" href="#">Hall of Residence</a>
							<a class="nav-link text-white" href="#">Medical Center</a>
							<a class="nav-link text-white" href="#">Central Library</a>
							<a class="nav-link text-white" href="#">Auditorium</a>
						</div>
					</div>
				</div>
			</div>
		</div>

		<hr>
		<p class="text-center text-light">
			Copyright © IIT NSTU 2021
		</p>
	</div>
</footer>
<script>
	function details(id) {
		console.log((id))
		$('#' + id).collapse('toggle')
	}
	// initialize your calendar, once the page's DOM is ready
	$(document).ready(function() {
		$('#calendar').evoCalendar({
			settingName: 20,
			theme: 'Midnight Blue'
		})

		$('#calendar').evoCalendar('addCalendarEvent', {
			id: 'gjhhk',
			name: 'Academic Meeting',
			description: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit tenetur minima consequatur sint officia architecto molestias harum recusandae quasi facere.',
			date: new Date(),
			type: 'birthday',
			color: '#63d867',

		});
		$('#calendar').evoCalendar('addCalendarEvent', {
			id: 'jg',
			name: 'Varsity Day',
			description: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit tenetur minima consequatur sint officia architecto molestias harum recusandae quasi facere. <button class="btn"><span class="badge badge-primary">Notification</span></button>',
			date: '2-27-2021',
			type: 'birthday'
		});
		$('#calendar').evoCalendar({
			'format': 'dd MM, yyyy'
			// some browsers doesn't support other format, so...
		});
	})
</script>

</html>