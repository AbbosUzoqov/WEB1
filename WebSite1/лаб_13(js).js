document.addEventListener('DOMContentLoaded', () => {
  let selectedPizza = null;

  const pizzaElements = document.querySelectorAll('.pizza');
  pizzaElements.forEach(pizzaElement => {
      pizzaElement.addEventListener('click', () => {
          const type = pizzaElement.getAttribute('data-type');
          selectedPizza = new Pizza(type, "Маленькая"); 
          updateSelectedPizzaInfo();
          setActivePizza(pizzaElement);
      });
  });


  const sizeButtons = document.querySelectorAll('.size');
  sizeButtons.forEach(sizeButton => {
      sizeButton.addEventListener('click', () => {
          const size = sizeButton.getAttribute('data-size');
          if (selectedPizza) {
              selectedPizza.size = size;
              updateSelectedPizzaInfo();
              setActiveSize(sizeButton);
          }
      });
  });

  const toppingElements = document.querySelectorAll('.topping');
  toppingElements.forEach(toppingElement => {
      toppingElement.addEventListener('click', () => {
          const topping = toppingElement.getAttribute('data-topping');
          if (selectedPizza) {
              if (selectedPizza.getToppings().includes(topping)) {
                  selectedPizza.removeTopping(topping);
                  toppingElement.classList.remove('active');
              } else {
                  selectedPizza.addTopping(topping);
                  toppingElement.classList.add('active');
              }
              updateSelectedPizzaInfo();
          }
      });
  });

  function updateSelectedPizzaInfo() {
      if (selectedPizza) {
          const totalPrice = selectedPizza.calculatePrice();
          const totalCalories = selectedPizza.calculateCalories();
          const priceText = `${totalPrice}₽ (${totalCalories} кКал)`;
          console.log(priceText); 
          document.querySelector('.add-to-cart span:last-child').textContent = priceText;
      }
  }

  function setActivePizza(activeElement) {
      pizzaElements.forEach(pizzaElement => pizzaElement.classList.remove('active'));
      activeElement.classList.add('active');
  }

  function setActiveSize(activeElement) {
      sizeButtons.forEach(sizeButton => sizeButton.classList.remove('active'));
      activeElement.classList.add('active');
  }
});

class Pizza {
  constructor(type, size) {
      this.type = type;
      this.size = size;
      this.toppings = [];

      this.basePrices = {
          "Маргарита": { price: 500, calories: 300 },
          "Пепперони": { price: 800, calories: 400 },
          "Баварская": { price: 700, calories: 450 }
      };

      this.sizeModifiers = {
          "Большая": { price: 200, calories: 200 },
          "Маленькая": { price: 100, calories: 100 }
      };

      this.toppingOptions = {
          "Сливочная моцарелла": { price: 50, calories: 20 },
          "Сырный борт": { small: { price: 150, calories: 50 }, large: { price: 300, calories: 50 } },
          "Чедер и пармезан": { small: { price: 150, calories: 50 }, large: { price: 300, calories: 50 } }
      };
  }

  addTopping(topping) {
      this.toppings.push(topping);
  }

  removeTopping(topping) {
      this.toppings = this.toppings.filter(t => t !== topping);
  }

  getToppings() {
      return this.toppings;
  }

  getSize() {
      return this.size;
  }

  getType() {
      return this.type;
  }

  calculatePrice() {
      let price = this.basePrices[this.type].price + this.sizeModifiers[this.size].price;
      
      for (let topping of this.toppings) {
          if (this.toppingOptions[topping]) {
              let toppingPrice = this.toppingOptions[topping][this.size === "Большая" ? "large" : "small"]?.price || this.toppingOptions[topping].price;
              price += toppingPrice;
          }
      }
      return price;
  }

  calculateCalories() {
      let calories = this.basePrices[this.type].calories + this.sizeModifiers[this.size].calories;
      
      for (let topping of this.toppings) {
          if (this.toppingOptions[topping]) {
              let toppingCalories = this.toppingOptions[topping][this.size === "Большая" ? "large" : "small"]?.calories || this.toppingOptions[topping].calories;
              calories += toppingCalories;
          }
      }
      return calories;
  }
}
