import {NgModule} from '@angular/core';
import {BrowserModule} from '@angular/platform-browser';
import {TranslateModule,TranslateLoader} from '@ngx-translate/core'
import {TranslateHttpLoader} from '@ngx-translate/http-loader'
import {HttpClient, HttpClientModule} from '@angular/common/http';
import {RouterModule} from '@angular/router';
import {AppRoutingModule} from './app-routing.module';
import {FormsModule} from '@angular/forms';
import {MatSelectModule} from '@angular/material/select';
import {MatCheckboxModule} from '@angular/material/checkbox';
import {MatChipsModule} from '@angular/material/chips';
import {MatIconModule} from '@angular/material/icon';
import {MatButtonModule} from '@angular/material/button';
import {NgxSliderModule} from '@angular-slider/ngx-slider';
import {MatSidenavModule} from '@angular/material/sidenav';
import {NavbarModule, WavesModule, ButtonsModule} from 'angular-bootstrap-md';
import {NgxPaginationModule} from 'ngx-pagination'; 
import {IvyCarouselModule} from 'angular-responsive-carousel';
import {PinchZoomModule} from 'ngx-pinch-zoom';
import {MatBadgeModule} from '@angular/material/badge'; 
import {AngularEditorModule} from '@kolkov/angular-editor';
import {BrowserAnimationsModule} from '@angular/platform-browser/animations';
import {AutocompleteLibModule} from 'angular-ng-autocomplete'; 
import {MatProgressBarModule} from '@angular/material/progress-bar';
import {SlideshowModule} from 'ng-simple-slideshow';
import {ReactiveFormsModule} from '@angular/forms';
import {SocialLoginModule, SocialAuthServiceConfig} from 'angularx-social-login';
import {GoogleLoginProvider} from 'angularx-social-login';
import {PanelHorizontalMenuComponent} from './panel-horizontal-menu/panel-horizontal-menu.component';
import {MdbModule} from 'mdb-angular-ui-kit';
import {globals}  from './global-variables'; 
import {AppComponent} from './app.component';
import {SignupComponent} from './user-signup/user-signup.component';
import {SigninComponent} from './user-signin/user-signin.component';
import {HeaderComponent} from './are-header/are-header.component';
import {FooterComponent} from './are-footer/are-footer.component';
import {ProductAlsoDiscoveredComponent} from './product-also-discovered/product-also-discovered.component';
import {ProductPageComponent} from './product-page/product-page.component';
import {ProfileComponent} from './user-profile/user-profile.component';
import {SearchComponent} from './product-search/product-search.component';
import {PoolComponent} from './product-pool/product-pool.component';
import {FilterCategoriesComponent} from './filter-categories/filter-categories.component';
import {WishlistComponent} from './user-wishlist/user-wishlist.component';
import {HomeComponent} from './area-main/area-main.component';
import {ShopcardComponent} from './user-basket/user-basket.component';
import {FilterBrandComponent} from './filter-brand/filter-brand.component';
import {FilterSizeComponent} from './filter-size/filter-size.component';
import {FilterSexComponent} from './filter-sex/filter-sex.component';
import {FilterNatureComponent} from './filter-nature/filter-nature.component';
import {FilterScentExactComponent} from './filter-scent-exact/filter-scent-exact.component';
import {FilterMadeinComponent} from './filter-madein/filter-madein.component';
import {FilterPriceComponent} from './filter-price/filter-price.component';
import {FilterColorComponent} from './filter-color/filter-color.component';
import {FilterScentGroupsComponent} from './filter-scent-groups/filter-scent-groups.component';
import {ProductThumbnailComponent} from './product-thumbnail/product-thumbnail.component';
import {OrdersComponent} from './user-orders/user-orders.component';
import {MasterComponent} from './area-body/area-body.component';
import {ProductCaroselComponent} from './product-carosel/product-carosel.component';
import {FilterPerfumerComponent} from './filter-perfumer/filter-perfumer.component';
import {CommentComponent} from './user-comments/user-comments.component';
import {UsermenuComponent} from './user-menu/user-menu.component';                                             
@NgModule({
  declarations: [
    AppComponent,
    SignupComponent,
    SigninComponent,
    HeaderComponent,
    FooterComponent,
    ProductAlsoDiscoveredComponent,
    ProductPageComponent,
    ProfileComponent,
    SearchComponent,
    PoolComponent,
    FilterCategoriesComponent,
    WishlistComponent,
    HomeComponent,
    PanelHorizontalMenuComponent,
    ShopcardComponent,
    FilterBrandComponent,
    FilterMadeinComponent,    
    FilterSizeComponent,
    FilterSexComponent,
    FilterNatureComponent,
    FilterScentExactComponent,
    FilterPriceComponent,
    FilterColorComponent,
    FilterScentGroupsComponent,
    ProductThumbnailComponent,
    OrdersComponent,
    MasterComponent,
    ProductCaroselComponent,
    FilterPerfumerComponent,
    CommentComponent,
    UsermenuComponent,
    ],
  imports: [
    PinchZoomModule,
    MatBadgeModule,
    IvyCarouselModule,
    NgxPaginationModule,
    NavbarModule, WavesModule, ButtonsModule,
    MatSidenavModule,
    NgxSliderModule,
    MatButtonModule,
    MatIconModule,
    MatChipsModule,
    MatCheckboxModule,
    MatSelectModule,
    ReactiveFormsModule,
    SocialLoginModule,
    SlideshowModule,
    FormsModule,
    MatProgressBarModule,
    AutocompleteLibModule,
    BrowserAnimationsModule,
    AngularEditorModule,
    RouterModule.forRoot([
      {path:'', component: HomeComponent, pathMatch: 'full' },
      {path:'master', component: MasterComponent},
      {path:'home', component: HomeComponent},
      {path:'Signup',component : SignupComponent},
      {path:'Signin',component :SigninComponent} ,
      {path:'location/:id',component :HomeComponent}  ,
      {path:'location/:id/:city',component :HomeComponent} ,
      {path:'experience/:title', component :HomeComponent} ,
      {path:'product/:productID',component :HomeComponent} ,
      {path:':action',component :MasterComponent} ,
      {path:'home/:action',component :HomeComponent} ,
      {path:'home/:action/:value',component :HomeComponent}  
    ],{useHash: true}
    ),
    BrowserModule,
    AppRoutingModule,
    HttpClientModule,
    RouterModule,
    TranslateModule.forRoot(
      {
        loader:{
          provide:TranslateLoader,
          useFactory:(http:HttpClient) =>{
            return new TranslateHttpLoader(http, './assets/trn/','.json')
         },
          deps:[HttpClient]
       }
     }
    ),
    MdbModule
  ],
  providers: [globals,{
      provide: 'SocialAuthServiceConfig',
      useValue: {
        autoLogin: false,
        providers: [{
            id: GoogleLoginProvider.PROVIDER_ID,
            provider: new GoogleLoginProvider('274228121469-4chlvbgksve7j50l77d939a1e22hh8sa.apps.googleusercontent.com')
         }]
     } as SocialAuthServiceConfig,
   }    
  ],
  bootstrap: [AppComponent]
})
export class AppModule {}