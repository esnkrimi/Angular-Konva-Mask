//MadeIn Country Filter Panel , where user can apply countries on product list to show
import {Component,  OnInit, Output, EventEmitter} from '@angular/core';
import {globals} from '../global-variables';
import {ServicesService} from '../services.service';
import {Subscription} from 'rxjs';
import {OnDestroy} from '@angular/core';
@Component({
  selector: 'app-filter-madein',
  templateUrl: './filter-madein.component.html',
  styleUrls: ['./filter-madein.component.sass']
})
export class FilterMadeinComponent implements OnInit,OnDestroy {
  @Output()  madeinChanged = new EventEmitter<String>();
  madeinlList;len = 5;//default lenght of filter show  
  subscription:Subscription  = new Subscription;
  constructor(private Services:ServicesService, public globals:globals) {
    this.madeinlList = [];
  }
  ngOnInit(): void {
    this.getCountries();
  }
  //apply Country FIlter on products by user
  countryChangedFunction (country) {
    if (country!==this.globals.madeinFiltered) {
      this.globals.loadingHome = true;
      this.globals.madeinFiltered = country;
      this.globals.unhyperAction = 'home'; 
      this.globals.unhyperAction2 = 'home'; 
      this.globals.filterVIsibilityForMobile = false;
      this.madeinChanged.emit(country); 
  }        
  }
  ngOnDestroy(): void {
    this.subscription.unsubscribe();
  }
  //get list of product madeIn
  getCountries() {
    this.subscription = this.Services.getCountries()
    .subscribe(data => {
        this.madeinlList = data;  
    });
  }
}