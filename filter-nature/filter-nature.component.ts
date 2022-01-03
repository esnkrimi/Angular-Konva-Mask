//Nature Filter Panel , where user can apply nature(warm-cold-mild) on product list to show
import {Component, OnInit, Output, EventEmitter} from '@angular/core';
import {globals} from '../global-variables';
import {ServicesService} from '../services.service';
import {Subscription} from 'rxjs';

@Component({
  selector: 'app-filter-nature',
  templateUrl: './filter-nature.component.html',
  styleUrls: ['./filter-nature.component.sass'] 
})
export class FilterNatureComponent implements OnInit {
  scentNatureList;len = 5;//default lenght of filter show 
  subscription:Subscription  = new Subscription;
  @Output() scentNatureChanged = new EventEmitter<String>();
  constructor(private Services:ServicesService, public globals:globals) {
    this.scentNatureList = [];  
  }
  ngOnInit(): void {
    this.getScentNatures();
  }
 //fetching list of product natures
  getScentNatures() {
    this.subscription = this.Services.getScentNatures()
    .subscribe (data => {
        this.scentNatureList = data;  
    });
 }
  //apply nature filter on products by user
  scentNatureChangedFunction (scentType) {
    if (scentType!==this.globals.scentNatureFiltered) {
      this.globals.loadingHome = true;
      this.globals.scentNatureFiltered = scentType;
      this.globals.unhyperAction = 'home';
      this.globals.unhyperAction2 = 'home';
      this.globals.filterVIsibilityForMobile = false;
      this.scentNatureChanged.emit(scentType);  
    }
  }
}