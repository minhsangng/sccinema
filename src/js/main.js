document.addEventListener("DOMContentLoaded", () => {
  // NAV SHRINK ON SCROLL
  const header = document.querySelector(".nav");
  window.addEventListener("scroll", () => {
    if (
      document.body.scrollTop > 80 ||
      document.documentElement.scrollTop > 80
    ) {
      header?.classList.add("shrink");
    } else {
      header?.classList.remove("shrink");
    }
  });

  // SHOW ELEMENTS ON SCROLL
  const elToShow = document.querySelectorAll(".show-on-scroll");

  const isElInViewPort = (el) => {
    const rect = el.getBoundingClientRect();
    const offset = 200;
    return rect.top <= window.innerHeight - offset;
  };

  const loop = () => {
    elToShow.forEach((el) => {
      if (isElInViewPort(el)) el.classList.add("show");
    });
    requestAnimationFrame(loop);
  };
  loop();

  // PROGRESS BAR
  const scrollPercentage = () => {
    const scrollProgress = document.getElementById("progress-bar");
    if (!scrollProgress) return;

    const pos = document.documentElement.scrollTop;
    const calcHeight =
      document.documentElement.scrollHeight -
      document.documentElement.clientHeight;
    const scrollVal = Math.round((pos * 100) / calcHeight);
    scrollProgress.style.background = `conic-gradient(#e70634 ${scrollVal}%, #2b2f38 ${scrollVal}%)`;
  };

  window.addEventListener("scroll", scrollPercentage);
  scrollPercentage();

  // MOBILE NAV ACTIVE
  const mobileNavItems = document.querySelectorAll(".item");
  mobileNavItems.forEach((item) =>
    item.addEventListener("click", function () {
      mobileNavItems.forEach((el) => el.classList.remove("active"));
      this.classList.add("active");
    })
  );
});
