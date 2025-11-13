<!-- main.blade.php -->
<!DOCTYPE html>
<html lang="id">
@include('Layouts.lte.head')
<body>
	<div class="scroll-indicator" id="scrollIndicator"></div>
	<div style="display:flex;min-height:100vh;">
		@include('Layouts.lte.sidebar')
		<div style="flex:1;display:flex;flex-direction:column;min-height:100vh;">
			<header>
				@include('Layouts.lte.navbar')
			</header>
			<main style="flex:1;padding:2rem 2.5rem;">
				@yield('content')
			</main>
			@include('Layouts.lte.footer')
		</div>
	</div>
	<script>
		window.onscroll = function() {
			const scrollIndicator = document.getElementById("scrollIndicator");
			const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
			const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
			const scrolled = (winScroll / height) * 100;
			if (scrollIndicator) {
				scrollIndicator.style.transform = `scaleX(${scrolled / 100})`;
			}
		};
	</script>
	@stack('scripts')
</body>
</html>
