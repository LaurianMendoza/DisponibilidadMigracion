var animEscolares= anime.timeline({
	easing: "easeOutExpo",
	loop: true
});

animEscolares.add({
		targets: ".folder",
		translateX: ["180%", 0],
		duration: 1200,
		easing: "easeInOutQuart"
	})
	.add({
		targets: ".folder__front",
		rotateX: [0, "-35deg"],
		translateX: ["-50%", "-50%"],
		translateY: ["-50%", "-50%"],
		duration: 1400
	})
	.add(
		{
			targets: ".folder__paper",
			translateY: ["-250%", 0],
			translateX: ["-50%", "-50%"],
			delay: anime.stagger(100)
		},
		"-=1000"
	)
