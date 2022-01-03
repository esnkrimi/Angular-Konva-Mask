//Products Autocomplete Search
import {Component, EventEmitter, OnDestroy, OnInit, Output} from '@angular/core';
import {globals} from '../global-variables';
import {Subscription} from 'rxjs';
import {ServicesService} from '../services.service';
import {ActivatedRoute, Router} from '@angular/router';
@Component({
  selector: 'app-product-search',
  templateUrl: './product-search.component.html',
  styleUrls: ['./product-search.component.sass']
})
export class SearchComponent implements OnDestroy{
  @Output() searchWord = new EventEmitter<String>();//input search word for comparison with database
  isLoading = false;//for autocomplete
  found_length = '0';//number of autocomplete founded list
  subscription:Subscription  = new Subscription;
  content;//holding fetched list from API//list of fetched from API
  keyword = 'fullName';//autocomplete keyword
  data  = [{
       do_id: '',
       seName: '' ,
       fullName: '',
       sex: '' 
  },{
      do_id: '',
      seName: '' ,
      fullName: '',
      sex: '' 
    }
  ];
  constructor (
       public globals:globals,
       private Services:ServicesService,
       private router: Router, 
       private route: ActivatedRoute) {
    }
  ngOnDestroy(): void {
    this.subscription.unsubscribe();
  }  
  //ng-autocomplete selected
  selectEvent (item) {
    this.globals.loadingHome = true;
    this.globals.unhyperAction = 'home';
    this.router.navigate(['/home/search/'+item['seName']], {relativeTo: this.route});
    this.searchWord.emit(item['seName']); 
  }
  //ng-autocomplete inputChanged
  onChangeSearch (val: string) {
    this.isLoading = false;
    this.found_length = '0';
    if (val.length>1) {
      this.isLoading = true;
      this.content = [];
      this.subscription = this.Services.Autocomplete(val)
      .subscribe(data => {
        this.content = data;
        this.found_length = this.content.length.toString();
        this.content = this.Services.cusomizeList (10, data);
       });
    }
  }
}