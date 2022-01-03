//Products List Pool
import {AfterViewInit, Component, HostListener, OnChanges, OnDestroy, OnInit} from '@angular/core';
import {trigger,state,style,animate,transition} from '@angular/animations';
import {Input} from '@angular/core';
import {globals} from '../global-variables';
import {Subscription} from 'rxjs';
import {ServicesService} from '../services.service';
import {FormBuilder} from '@angular/forms';
import {NgAnimateScrollService} from 'ng-animate-scroll';
import {ActivatedRoute} from '@angular/router';
import {LocalStorageService} from '../local-storage.service';
import {TranslateService} from '@ngx-translate/core';

@Component({
  selector: 'app-product-pool',
  templateUrl: './product-pool.component.html',
  styleUrls: ['./product-pool.component.sass'],
  animations: [
    trigger('openClose', [
      state('open', style({
        opacity: 1
     }),
     ),
      state('closed', style({
        opacity: 1 
     })),
      transition('open => closed', [
        style({opacity: 0}), 
        animate(2000, style({opacity: 1}))
      ]),
      transition('closed => open', [
        style({opacity: 0.1}), 
        animate(2000, style({opacity: 1}))
      ]),
    ]),
  ]
})
export class PoolComponent implements AfterViewInit, OnInit,OnChanges,OnDestroy {
  p: number = 1;//page number ngfor pagination 
  supportLanguages = ['en','ar'];
  checkoutForm = this.formBuilder.group({
    comment: ''
  });
  more_column = true;
  array2Dimensional;
  @Input() language;
  @Input() sexChanged;
  @Input() scentGroupChanged;
  @Input() scentExactChanged;  
  @Input() scentNatureChanged;  
  @Input() perfumerChanged;  
  @Input() patternChanged;  
  @Input() scentChanged;
  @Input() parentProductBranch: string = '';
  @Input() childProductBranch: string = '';
  @Input() brandChangeds;
  @Input() searchChangedValue;    
  @Input() colorChanged;  
  @Input() sizeChanged;  
  @Input() priceChanged;  
  @Input() madeinChangedValue;  
  currentPosition = 0;//holding offset x,y scrolling
  content;//holding fetched list from API
  subscription:Subscription  = new Subscription;
  constructor(
    private translateservise:TranslateService,
    private localStorageService: LocalStorageService,
    private route: ActivatedRoute,
    private animateScrollService: NgAnimateScrollService,
    private formBuilder: FormBuilder,
    public globals:globals,
    private Services:ServicesService) {
  this.content = [];
  }
  ngOnInit(): void {
  this.globals.loadingHome = true;
  }
  ngOnDestroy(): void {
    this.subscription.unsubscribe();
  }
  ngOnChanges() {
    this.p = 1; 
    if (this.searchChangedValue) {
      this.search(this.searchChangedValue);
    } else {
      if (this.parentProductBranch!== 'undefined')  this.FetchingProductByFilters();
    }
}
  //searching products fromautocomplete input
  search(val: string) {
    this.content = [];
    this.subscription = this.Services.search(val)
    .subscribe(data => {
      this.content = data;
      this.data2double();
      this.globals.loadingHome = false;
    },err => {
      this.globals.loadingHome = false;
    });
}

//activate animation
  toggle() {
    this.globals.isOpen = !this.globals.isOpen;
  }

//convert data 1D array into 2D array for show Double Column in ngFor
  data2double() {
    this.array2Dimensional = [];
    this.array2Dimensional = this.content.reduce((acc, col, i) => {
    if (i % 2 === 0) {
      acc.push({column1: col});
    } else {
      acc[acc.length - 1].column2 = col;
    }       
      return acc;
  }, []);
  }

  //change order of product list
  Sort(sort_parameter) {
    this.globals.loadingHome = true;
    this.p = 0;
    this.globals.sortFiltered = sort_parameter.target.value;
    this.FetchingProductByFilters();
  }

  //apply filters selected by user on product list to show
  FetchingProductByFilters() {
    this.content = [];
    let action;
    this.subscription = this.route.params  .subscribe (params => {
      action = params['action'];    
    });
    if (action === 'sort') {
      this.subscription = this.route.params  .subscribe (params => {
        if (params['value'] === 'new') { 
        this.globals.sortFiltered = 'do_id desc';
      } else { 
        if (params['value'] === 'sale') {
          this.globals.sortFiltered = 'do_certificate desc';
        } else { 
          if (params['value'] === 'buy') { 
            this.globals.sortFiltered = 'do_look desc';
          }
          }
        }
      }); 
    } else
      if (action === 'language') {
        this.subscription = this.route.params  .subscribe(params => {
        this.globals.language = params['value'];
        this.localStorageService.setItem('Language',params['value']);
        this.changingLanguage(params['value']);
      }); 
      }  
    this.subscription = this.Services.FetchPrdByFilters()
    .subscribe(data =>{
      this.content = [];
      this.content = data;
      this.data2double();
      this.globals.loadingHome = false;
      this.subscription?.unsubscribe();
    },err => {
      this.globals.loadingHome = false;
    });
  }
  pageChanged() {
    window.scroll(0,0);
    this.globals.isOpen=!this.globals.isOpen;
  }
  changingLanguage (LanguageSelected:string) {
    this.translateservise.addLangs (this.supportLanguages);
    this.translateservise.setDefaultLang (LanguageSelected);
    this.globals.language = LanguageSelected;
    this.localStorageService.setItem ('Language', LanguageSelected);
  }
  ngAfterViewInit() {
      this.globals.loadingHome = false;
  } 
  }