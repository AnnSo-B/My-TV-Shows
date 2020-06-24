const app = {
  init: () => {
    app.initBurgerMenu();
  },

  // method to init all functions needed to animate the menu on smarthphone and tablet
  initBurgerMenu: () => {
    app.burger = document.querySelector('.burger');

    app.burger.addEventListener('click', () => {
      app.toggleMenu();
      app.animateLinks();
      app.animateBurger();
    });
  },

  // method to make the menu appear
  toggleMenu: () => {
    const nav = document.querySelector('.nav-links');
    // toggle nav
    nav.classList.toggle('nav-active');
  },

  // method to animate the links
  animateLinks: () => {
    const links = document.querySelectorAll('.nav-item');

    links.forEach((link, index) => {
      if (link.style.animation) {
        link.style.animation = '';
      } 
      else {
        link.style.animation = `navLinkFade 0.5s ease forwards ${index / 7 + 0.5}s`;
      }
    });
  },

  // method to animate the button
  animateBurger: () => {
    app.burger.classList.toggle('toggle');
  }
}

// initialise JS app when the dom is loaded
document.addEventListener('DOMContentLoaded', app.init);