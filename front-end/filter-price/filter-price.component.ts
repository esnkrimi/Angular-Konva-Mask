//Price Filter Panel , where user can apply price range on product list to show
import {Component, Output, EventEmitter} from '@angular/core';
import {globals} from '../global-variables';
import {Options} from '@angular-slider/ngx-slider';
@Component({
  selector: 'app-filter-price',
  templateUrl: './filter-price.component.html',
  styleUrls: ['./filter-price.component.sass']
})
export class FilterPriceComponent  {
  value: number = 100;
  options: Options = {//for price range slider
    floor: 1,
    ceil: 15
  };
  @Output() priceFiltered = new EventEmitter<String>();
  constructor (public globals:globals) {}
  //apply price filter on products by user
  setPriceRange (value) {
    this.globals.loadingHome = true;
    this.globals.priceFiltered = value;
    this.globals.unhyperAction = 'home';
    this.globals.unhyperAction2 = 'home';
    this.globals.filterVIsibilityForMobile = false
    this.priceFiltered.emit(value);
  }
}