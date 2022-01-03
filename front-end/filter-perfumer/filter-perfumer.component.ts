//Company Filter Panel , where user can apply company on product list to show
import {Component, OnInit, Output, EventEmitter, OnDestroy} from '@angular/core';
import {globals} from '../global-variables';
import {ServicesService} from '../services.service';
import {Subscription} from 'rxjs';

@Component({
  selector: 'app-filter-perfumer',
  templateUrl: './filter-perfumer.component.html',
  styleUrls: ['./filter-perfumer.component.sass']
})
export class FilterPerfumerComponent implements OnInit,OnDestroy {
  perfumerList;
  len = 5;//default lenght of filter show 
  subscription:Subscription  = new Subscription;
  @Output() perfumerChanged = new EventEmitter<String>(); 
  constructor(private Services:ServicesService, public globals:globals) {
    this.perfumerList = [];  
  }
  ngOnInit(): void {
    this.getPerfumers();
  }
  ngOnDestroy(): void {
    this.subscription.unsubscribe();
  }
  //fetching list of product perfumer
  getPerfumers() {
    this.subscription = this.Services.getPerfumers().
    subscribe(data => {
        this.perfumerList = data;  
    });
  }
  //apply perfumer filter on products by user
  perfumeChangedFunction(perfumer) {
    if (perfumer!==this.globals.perfumerFiltered) {
      this.globals.loadingHome = true;
      this.globals.scentFiltered = perfumer;
      this.globals.unhyperAction = 'home';
      this.globals.unhyperAction2 = 'home';
      this.globals.filterVIsibilityForMobile = false
      this.perfumerChanged.emit(perfumer);  
    }
  }
}