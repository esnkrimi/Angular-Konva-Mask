//Horizontal Menu - in master page
import {Component, OnDestroy, OnInit} from '@angular/core';
import {Subscription} from 'rxjs';
import {globals} from '../global-variables';
import {ServicesService} from '../services.service';

@Component({
  selector: 'app-panel-horizontal-menu',
  templateUrl: './panel-horizontal-menu.component.html',
  styleUrls: ['./panel-horizontal-menu.component.sass']
})
export class PanelHorizontalMenuComponent implements OnInit ,OnDestroy{
  parentProductBranch;
  sizeList;
  sexList;
  scentGrouplList;
  perfumersList; 
  sortProgress = false;
  dataBranch;
  subscription:Subscription  = new Subscription;
  constructor (private Services:ServicesService, public globals:globals) {
    this.parentProductBranch = 'Perfume';
    this.locationBranch(this.parentProductBranch);
  }
  ngOnInit() {
    this.getSizes();
    this.getSex();
    this.getScentGroup();
    this.getPerfumers();    
  }
  ngOnDestroy(): void {
    this.subscription.unsubscribe();
  }
  //fetching cities after selecting a country
  locationBranch (country) {
    this.globals.loadingHome = true;
    this.sortProgress = true;
    this.subscription = this.Services.locationBranch(country)
    .subscribe (data => {
      this.dataBranch = data;
      this.sortProgress = false;
      this.globals.filterVIsibilityForMobile = false
    });
 }
  //get list of product perfumer
  getPerfumers() {
    this.subscription = this.Services.getPerfumers()
    .subscribe (data => {
        this.perfumersList = data;  
    });
  }
//get list of product material
  getScentGroup() {
    this.subscription = this.Services.getScentGroup()
    .subscribe (data => {
        this.scentGrouplList = data;  
    });
 }
  //get list of product sex
  getSex() {
    this.subscription = this.Services.getSex()
    .subscribe (data => {
      this.sexList = data;  
    });
  }
  //get list of product size
  getSizes() {
    this.subscription = this.Services.getSizes()
    .subscribe (data => {
      this.sizeList = data;  
    });
 }
 //clear all filters applied on productlist
  clearFilters() {
    this.Services.clearFilters();
  }
}