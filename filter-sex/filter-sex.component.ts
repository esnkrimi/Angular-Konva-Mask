//Sex Filter Panel , where user can apply sex on product list to show
import {Component, OnInit, Output, EventEmitter} from '@angular/core';
import {globals} from '../global-variables';
import {ServicesService} from '../services.service';
import {Subscription} from 'rxjs';

@Component({
  selector: 'app-filter-sex',
  templateUrl: './filter-sex.component.html',
  styleUrls: ['./filter-sex.component.sass']
})
export class FilterSexComponent implements OnInit {
  sexList;
  len = 5;//default lenght of filter show 
  subscription:Subscription  = new Subscription;
  @Output() sexChanged = new EventEmitter<String>();
  constructor(private Services:ServicesService, public globals:globals) {
    this.sexList = [];  
  }
  ngOnInit(): void {
    this.getSex();
  }
  //fetching list of sex
  getSex() {
    this.subscription = this.Services.getSex()
    .subscribe(data => {
        this.sexList = data;  
    });
  }
  //apply sex filter on products by user
  sexChangedFunction (sex) {
    if (sex!==this.globals.sexFiltered) {
      this.globals.loadingHome = true;
      this.globals.scentFiltered = sex;
      this.globals.unhyperAction = 'home';
      this.globals.unhyperAction2 = 'home';
      this.globals.filterVIsibilityForMobile = false
      this.sexChanged.emit(sex);  
    }
  }
}