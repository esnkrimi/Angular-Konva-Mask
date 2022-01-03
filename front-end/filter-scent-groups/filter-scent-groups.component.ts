//ScentGroup Filter Panel , where user can apply scentGroup on product list to show
import {Component,  OnInit, Output, EventEmitter} from '@angular/core';
import {globals} from '../global-variables';
import {ServicesService} from '../services.service';
import {Subscription} from 'rxjs';
import {OnDestroy} from '@angular/core';
@Component({
  selector: 'app-filter-scent-groups',
  templateUrl: './filter-scent-groups.component.html',
  styleUrls: ['./filter-scent-groups.component.sass'] 
})
export class FilterScentGroupsComponent implements OnInit,OnDestroy {
  @Output() scentGroupsChanged = new EventEmitter<String>();
  scentGroupList;len = 5;//default lenght of filter show 
  subscription:Subscription  = new Subscription;
  constructor(private Services:ServicesService, public globals:globals) {
    this.scentGroupList = [];
  }
  ngOnInit(): void {
    this.getScentGroup();
  }
//fetching list of product scent group
  getScentGroup() {
    this.subscription = this.Services.getScentGroup()
    .subscribe(data =>{
      this.scentGroupList = data;  
    });
 }
//apply scent group filter on products by user
  scentGroupChangedFunction(scentGroup) {
    if (scentGroup!==this.globals.scentGroupFiltered) {
      this.globals.loadingHome = true;
      this.globals.scentGroupFiltered = scentGroup;
      this.globals.unhyperAction = 'home';
      this.globals.unhyperAction2 = 'home';
      this.globals.filterVIsibilityForMobile = false
      this.scentGroupsChanged.emit(scentGroup);  
    }       
  }
  ngOnDestroy(): void {
    this.subscription.unsubscribe();
  }
}