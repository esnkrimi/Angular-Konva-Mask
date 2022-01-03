//Size Filter Panel , where user can apply size on product list to show
import {Component,  OnInit, Output, EventEmitter, OnDestroy} from '@angular/core';
import {globals} from '../global-variables';
import {ServicesService} from '../services.service';
import {Subscription} from 'rxjs';
@Component({
  selector: 'app-filter-size',
  templateUrl: './filter-size.component.html',
  styleUrls: ['./filter-size.component.sass']
})
export class FilterSizeComponent implements OnInit ,OnDestroy{
  sizeList;
  len = 5;//default lenght of filter show 
  subscription:Subscription  = new Subscription;
  @Output() sizeChanged = new EventEmitter<String>();
  constructor(private Services:ServicesService, public globals:globals) {
    this.sizeList = [];  
  }
  ngOnInit(): void {
    this.getSizes();
  }
  ngOnDestroy(): void {
    this.subscription.unsubscribe();
  }
  //fetching list of product size
  getSizes() {
    this.subscription = this.Services.getSizes()
    .subscribe (data => {
        this.sizeList = data;  
    });
  }
//apply size filter on products by user
  sizeChangedFunction (size) {
    if (size!==this.globals.sizeFiltered) {
      this.globals.loadingHome = true;
      this.globals.sizeFiltered = size;
      this.globals.unhyperAction = 'home';
      this.globals.unhyperAction2 = 'home';
      this.globals.filterVIsibilityForMobile = false
      this.sizeChanged.emit(size); 
    }        
  }
}