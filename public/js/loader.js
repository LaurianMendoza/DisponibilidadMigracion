const tl = gsap.timeline({
    defaults: {
      repeat: -1,
      ease: "none",
      duration: 0.8
    }
  });

  tl.set("svg", { visibility: "visible" })
    .to("#loader", { rotation: 360 })
    .fromTo(
      "#circleOne",
      { drawSVG: "0%" },
      { drawSVG: "40%", yoyoEase: true },
      "0"
    )
    .fromTo(
      "#circleTwo",
      { drawSVG: "0%" },
      { drawSVG: "-10%", ease: "none", yoyoEase: Power1.easeOut },
      "0.25"
    )
    .fromTo(
      "#circleThree",
      { drawSVG: "0%" },
      { drawSVG: "-20%", ease: "none", yoyoEase: Power1.easeOut },
      "0.30"
    )
    .fromTo(
      "#circleFour",
      { drawSVG: "0%" },
      { drawSVG: "-30%", ease: "none", yoyoEase: Power1.easeOut },
      "0.35"
    );
