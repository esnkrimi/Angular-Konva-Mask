//Scent Filter Panel , where user can apply scent on product list to show
import {Component, OnInit, Output, EventEmitter} from '@angular/core';
import {globals} from '../global-variables';
import {ServicesService} from '../services.service';
import {Subscription} from 'rxjs';

@Component({
  selector: 'app-filter-scent-exact',
  templateUrl: './filter-scent-exact.component.html',
  styleUrls: ['./filter-scent-exact.component.sass'] 
})
export class FilterScentExactComponent implements OnInit {
  scent;len = 5;//default lenght of filter show 
  subscription:Subscription  = new Subscription;
  @Output() scentExactChanged = new EventEmitter<String>();
  constructor (private Services:ServicesService, public globals:globals) {
    this.scent = [];  
 }
  ngOnInit(): void {
    this.getScentExact();
 }
  //fetching list of product scent exact
  getScentExact() {
    this.subscription = this.Services.getScentExact()
    .subscribe (data =>{
      this.scent = data;  
    });
 }
//apply scent exact type filter on products by user
  scentExactChangedFunction (scent) {
    if (scent!==this.globals.scentExactFiltered) {
      this.globals.loadingHome = true;
      this.globals.scentExactFiltered = scent;
      this.globals.unhyperAction = 'home';
      this.globals.unhyperAction2 = 'home';
      this.globals.filterVIsibilityForMobile = false;
      this.scentExactChanged.emit(scent);  
    }
  }
}