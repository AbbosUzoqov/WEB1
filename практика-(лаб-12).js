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

