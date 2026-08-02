var swiper = new Swiper(".mySwiper", {
  slidesPerView: 3,
  spaceBetween: 30,

  loop:true,
  speed: 1000,
  autoplay: {
  delay: 2000, // slide visible time (2 seconds)
  disableOnInteraction: true,
},

   pagination: {
    el: ".custom-pagination",
    clickable: true,
    renderBullet: function (index, className) {
      return `<span class="${className} custom-dot"></span>`;
    },
  },

  breakpoints: {
    // 📱 Mobile
    0: {
      slidesPerView: 1,
      spaceBetween: 10,
    },

    // 📱 Tablet
    640: {
      slidesPerView: 2,
      spaceBetween: 20,
    },

    // 💻 Laptop
    1024: {
      slidesPerView: 3,
      spaceBetween: 30,
    },

    // 🖥️ Large screen
   
  },

 
});


var testimonialSwiper = new Swiper(".testimonialSwiper",{
  slidesPerView: 1,
  spaceBetween: 80,

  loop:true,
  speed: 1000,
  autoplay: {
  delay: 2000, // slide visible time (2 seconds)
  disableOnInteraction: true,
},

   pagination: {
    el: ".custom-pagination",
    clickable: true,
    renderBullet: function (index, className) {
      return `<span class="${className} custom-dot"></span>`;
    },
  },

  breakpoints: {
    // 📱 Mobile
    0: {
      slidesPerView: 1,
      spaceBetween: 80,
    },

    // 📱 Tablet
    640: {
      slidesPerView: 1,
      spaceBetween: 10,
    },

    // 💻 Laptop
    1024: {
      slidesPerView: 2,
      spaceBetween: 50,
    },
  }

});