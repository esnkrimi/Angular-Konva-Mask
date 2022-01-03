//Brand Filter Panel , where user can apply brands on product list to show
import {Component,  OnInit, Output, EventEmitter, OnDestroy} from '@angular/core';
import {globals} from '../global-variables';
import {ServicesService} from '../services.service';
import {Subscription} from 'rxjs';
@Component({
  selector: 'app-filter-brand',
  templateUrl: './filter-brand.component.html',
  styleUrls: ['./filter-brand.component.sass']
})
export class FilterBrandComponent implements OnInit,OnDestroy {
  len = 10;//default lenght of filter show 
  brand;//saving fetched brand list
  brandList;//rholding brands matched in first charachter of firstChar variable
  firstChar = 'A';//first charachter of brand (can filtered by user to find brand)
  @Output() brandChanged = new EventEmitter<String>(); 
  subscription:Subscription  = new Subscription;
  constructor (private Services:ServicesService, public globals:globals) {
    this.brandList = [];
  }
  ngOnInit(): void {
    this.brandsFetch();
  }
  ngOnDestroy(): void {
    this.subscription.unsubscribe();
  }
  brandChangedFunction(brand) {
    if (brand!==this.globals.brandFiltered) {
      this.globals.loadingHome = true;
      this.globals.brandFiltered = brand;
      this.globals.unhyperAction = 'home';
      this.globals.unhyperAction2 = 'home';
      this.globals.filterVIsibilityForMobile = false;
      this.globals.searchFiltered = '';
      this.brandChanged.emit(brand); 
    }        
  }
  changeFirstCharachter(e) {
    if (this.firstChar.length === 0) {
      this.firstChar = 'A';
    }
    this.firstChar = e;
    this.similarBrands(this.firstChar);
    this.firstChar = (this.firstChar.charAt(0).toUpperCase())+(this.firstChar.substring(1, this.firstChar.length).toUpperCase());
  }
  similarBrands(firstChar) {
    this.brandList = [];
    let j = 0;
    for (let i = 0; i < this.brand.length; i++)
      if (this.brand[i].brand.substr(0, firstChar.length).toUpperCase() === firstChar.toUpperCase()) {
        this.brandList[j] = this.brand[i];
        j++;
    }
  }
  brandsFetch(): void {
    this.subscription = this.Services.brandsFetch('1')
    .subscribe (data => {
            this.brand = data;
            this.brandList = data;
        }
    );}  
}