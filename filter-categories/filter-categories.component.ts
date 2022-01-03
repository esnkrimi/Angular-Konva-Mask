//Categories Filter Panel , where user can apply categories on product list to show
import {Component, Input, OnDestroy, OnInit} from '@angular/core';
import {ServicesService} from '../services.service';
import {Subscription} from 'rxjs';
import {ActivatedRoute} from '@angular/router';
import {globals} from '../global-variables';
@Component({
  selector: 'app-filter-categories',
  templateUrl: './filter-categories.component.html',
  styleUrls: ['./filter-categories.component.sass'],
})
export class FilterCategoriesComponent implements OnInit,OnDestroy {
  dataBranches;
  dataTypes;
  cityFromHREF; 
  @Input() parentProductBranch;//products branch level 1
  @Input() childProductBranch;//products branch level 2
  sortProgress = false;
  level = 2;
  subscription:Subscription  = new Subscription;
  constructor(
    private Services:ServicesService,
    private route: ActivatedRoute,
    public globals:globals) {}
  ngOnDestroy (): void {
    this.subscription.unsubscribe();
  }
  ngOnInit (): void {
    if (this.level === 1) this.getBranches();
    this.subscription = this.route.params
    .subscribe(params => {
      this.childProductBranch = params['city'];    
    });
    this.parentProductBranch = 'Categories';
    this.selectBranch(this.parentProductBranch);
  }
  loadBranchesChild () {
    this.globals.filterVIsibilityForMobile = false;
    this.globals.loadingHome = true;
  }
  selectBranch (country) {
    this.globals.loadingHome = true;
    this.sortProgress = true;
    this.level = 2;
    this.subscription = this.Services.locationBranch(country)
    .subscribe (data => {
        this.dataTypes = data;
        this.sortProgress = false;
        this.globals.filterVIsibilityForMobile = false
    },err => {
      this.sortProgress = false;
    });
  }
  //fetching list of branches
  getBranches() {
    this.dataBranches = [];
    this.subscription = this.Services.getBranches()
    .subscribe(data => {
        this.dataBranches = data;
    });
  }
}