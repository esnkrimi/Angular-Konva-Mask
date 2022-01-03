import {globals} from './global-variables';
import {map} from "rxjs/operators";
import {Injectable} from '@angular/core';
import {HttpClient} from '@angular/common/http';
import {LocalStorageService} from 'src - carpet/app/local-storage.service';
import {NgAnimateScrollService} from 'ng-animate-scroll';
@Injectable ({
  providedIn: 'root'
})
export class ServicesService {
timestamp:any;
user;
constructor (
  private animateScrollService: NgAnimateScrollService,
  private localStorageService: LocalStorageService,
  private http:HttpClient,
  public globals:globals 
) {
 }
//fetching list of brands
brandsFetch (sort) {
  this.timestamp=new Date ().getSeconds ();
  return this.http.get (this.globals.UrlHome+"/drm/web/index.php?time="+this.timestamp+"&id=43&sort="+sort)
  .pipe (map (res => {
    return res;
 }));
}
//fetching user profile informations
getUserInfo (uid) {
  this.timestamp=new Date ().getSeconds ();
  let user_id=this.globals.loginedUserID;
    return this.http.get (this.globals.UrlHome+"/drm/web/index.php?time="+this.timestamp+"&id=23&uid="+user_id)
    .pipe (map (res => {
      return res;
   }));
 } 
//fetching user payments history
userPaymentList () {
  this.timestamp=new Date ().getSeconds ();
  let user_id=this.globals.loginedUserID;
  //alert (this.globals.UrlHome+"/drm/web/index.php?time="+this.timestamp+"&id=46&uid="+user_id);
  return this.http.get (this.globals.UrlHome+"/drm/web/index.php?time="+this.timestamp+"&id=46&uid="+user_id)
  .pipe (map (res => {
    return res;
 }));
}
//sign up via user name and password (not google social login) 
userSignup (mobile,email,name) {
  let user_id=this.globals.loginedUserID;
  this.timestamp=new Date ().getSeconds ();
  //alert (this.globals.UrlHome+"/drm/web/index.php?id=0&name="+name+"&mobile="+mobile+"&email="+email+"&ts="+this.timestamp);
  return this.http.get (this.globals.UrlHome+"/drm/web/index.php?id=0&name="+name+"&mobile="+mobile+"&email="+email+"&ts="+this.timestamp)
  .pipe (map (res => {
    return res; 
 }));
}
//update user profile datas
editProfile (Name,Family,Mobile,Password,Comment) {
  this.timestamp=new Date ().getSeconds ();
  let user_id=this.globals.loginedUserID;
  //alert (this.globals.UrlHome+"/drm/web/index.php?id=62&Name="+Name+"&Family="+Family+"&Mobile="+Mobile+"&Password="+Password+"&adrs="+Comment+"&user_id="+user_id+"&ts="+this.timestamp);
  return this.http.get (this.globals.UrlHome+"/drm/web/index.php?id=62&Name="+Name+"&Family="+Family+"&Mobile="+Mobile+"&Password="+Password+"&adrs="+Comment+"&user_id="+user_id+"&ts="+this.timestamp)
  .pipe (map (res => {
    return res; 
 }));
}
//user login attempt
userLogin (email,pass) {
  this.timestamp=new Date ().getSeconds ();
  return this.http.get (this.globals.UrlHome+"/drm/web/index.php?id=1&email="+email+"&pass="+pass+"&ts="+this.timestamp)
  .pipe (map (res => {
    return res; 
 }));
}
//autocomplete search
Autocomplete (val) {
  this.timestamp=new Date ().getSeconds ();
  //alert (this.globals.UrlHome+"/drm/web/index.php?id=57&word="+val+"&ts="+this.timestamp);
  return this.http.get (this.globals.UrlHome+"/drm/web/index.php?id=57&word="+val+"&ts="+this.timestamp)
  .pipe (map (res => {
    return res; 
 }));
}
  //get list of product scent
  getScentExact () {
    this.timestamp=new Date ().getSeconds ();
    return this.http.get (this.globals.UrlHome+"/drm/web/index.php?id=76&ts="+this.timestamp)
    .pipe (map (res => {
      return res; 
   }));
 }
//get list of product ScentType
getScentNatures () {
  this.timestamp=new Date ().getSeconds ();
  return this.http.get (this.globals.UrlHome+"/drm/web/index.php?id=75&ts="+this.timestamp)
  .pipe (map (res => {
    return res; 
 }));
}

//get list of product sex
getSex () {
  this.timestamp=new Date ().getSeconds ();
  return this.http.get (this.globals.UrlHome+"/drm/web/index.php?id=69&ts="+this.timestamp)
  .pipe (map (res => {
    return res; 
 }));
}
//get list of product perfumer
getPerfumers () {
  this.timestamp=new Date ().getSeconds ();
  return this.http.get (this.globals.UrlHome+"/drm/web/index.php?id=71&ts="+this.timestamp)
  .pipe (map (res => {
    return res; 
 }));
}
//get list of product madeIn
getCountries () {
    this.timestamp=new Date ().getSeconds ();
    return this.http.get (this.globals.UrlHome+"/drm/web/index.php?id=77&ts="+this.timestamp)
    .pipe (map (res => {
      return res; 
   }));
 }
//get list of product material
getScentGroup () {
  this.timestamp=new Date ().getSeconds ();
  return this.http.get (this.globals.UrlHome+"/drm/web/index.php?id=70&ts="+this.timestamp)
  .pipe (map (res => {
    return res; 
 }));
}
//get list of product size
getSizes () {
  this.timestamp=new Date ().getSeconds ();
  return this.http.get (this.globals.UrlHome+"/drm/web/index.php?id=65&ts="+this.timestamp)
  .pipe (map (res => {
    return res; 
 }));
}
//get list of product city
contentByCity (type) {
  let user_id=this.globals.loginedUserID;
  let Sort=this.globals.sortFiltered;
  this.timestamp=new Date ().getSeconds ();
  return this.http.get (this.globals.UrlHome+"/drm/web/index.php?id=5&sortParameter="+Sort+"&uid="+user_id+"&type="+type+"&campaign=0&ts="+this.timestamp)
  .pipe (map (res => {
    return res; 
 }));
}
//searching a product without autocomplete
search (word) {
  let user_id=this.globals.loginedUserID;
  let Sort=this.globals.sortFiltered;
  this.timestamp=new Date ().getSeconds ();
  //alert (this.globals.UrlHome+"/drm/web/index.php?id=5&sortParameter="+Sort+"&campaign=0&uid="+user_id+"&word="+word+"&ts="+this.timestamp);
  return this.http.get (this.globals.UrlHome+"/drm/web/index.php?id=5&sortParameter="+Sort+"&campaign=0&uid="+user_id+"&word="+word+"&ts="+this.timestamp)
  .pipe (map (res => {
    return res; 
 }));
}
//delete an item in basket
deleteFromBasket (basket_id) {
  this.timestamp=new Date ().getSeconds ();
  return this.http.get (this.globals.UrlHome+"/drm/web/index.php?time="+this.timestamp+"&id=41&basketId="+basket_id+"&ts="+this.timestamp)
  .pipe (map (res => {
      return res;
 }));
}
//convert basket total price into dogeCoin
paymentInDoecoinPrice () {
  this.timestamp=new Date ().getSeconds ();
  let user_id=this.globals.loginedUserID;
  return this.http.get ("https://min-api.cryptocompare.com/data/price?fsym=DOGE&tsyms=usd")
  .pipe (map (res => {
    return res;
 }));
}
//fetching basket list
userBasketlist () {
  this.timestamp=new Date ().getSeconds ();
  let user_id=this.globals.loginedUserID;
  //console.log(this.globals.UrlHome+"/drm/web/index.php?time="+this.timestamp+"&id=40&uid="+user_id+"&ts="+this.timestamp);
  return this.http.get (this.globals.UrlHome+"/drm/web/index.php?time="+this.timestamp+"&id=40&uid="+user_id+"&ts="+this.timestamp)
  .pipe (map (res => {
    return res;
 }));
}
//fetching wishlist items
wishLists () {
  this.timestamp=new Date ().getSeconds ();
  let user_id=this.globals.loginedUserID;
  return this.http.get (this.globals.UrlHome+"/drm/web/index.php?time="+this.timestamp+"&id=26&uid="+user_id+"&ts="+this.timestamp)
  .pipe (map (res => {
    return res;
 }));
}
//scroll to #beginPrd 
navigateToHeader (duration ? : number) {
    this.animateScrollService.scrollToElement ('beginPrd', duration)
}
//fetching product list after applying some filters
FetchPrdByFilters () {
  let Branch="Carpets";
  this.navigateToHeader (200);
  let user_id=this.globals.loginedUserID;
  this.timestamp=new Date ().getSeconds ();
  let Brand=this.globals.brandFiltered;
  let campaignFiltered=this.globals.campaignFiltered;
  let Type=this.globals.typeFiltered;
  let Size=this.globals.sizeFiltered;
  let Price=this.globals.priceFiltered;
  let colorID=this.globals.colorFiltered;
  let sex=this.globals.sexFiltered;    
  let scentGroup=this.globals.scentGroupFiltered;    
  let Sort=this.globals.sortFiltered;
  let perfumer=this.globals.perfumerFiltered;
  let scentTypeFiltered=this.globals.scentNatureFiltered;
  let scentExactFiltered=this.globals.scentExactFiltered;
  let madeinFiltered=this.globals.madeinFiltered;
  let searchFiltered=this.globals.searchFiltered;
  if  (Brand 
    || (campaignFiltered!=="0") 
    || Size  
    || Price 
    || sex 
    || colorID 
    || scentTypeFiltered 
    || scentExactFiltered 
    || scentGroup 
    || madeinFiltered 
    || perfumer) {
      searchFiltered="";
  }
  this.globals.searchFiltered="";
  let url=this.globals.UrlHome+"/drm/web/index.php?id=5&sortParameter="+Sort+"&scentExactFiltered="+scentExactFiltered+"&madeinFiltered="+madeinFiltered+"&perfumer="+perfumer+"&scentGroup="+scentGroup+"&sex="+sex+"&campaign="+campaignFiltered+"&brand="+Brand+"&word="+searchFiltered+"&scentTypeFiltered="+scentTypeFiltered+"&cat="+Branch+"&type="+Type+"&colorSetInput="+colorID+"&priceCeil="+Price+"&sizes="+Size+"&uid="+user_id+"&ts="+this.timestamp;
  this.globals.isOpen = !this.globals.isOpen;
  return this.http.get (url) 
  .pipe (map (res => {
    return res; 
 }));
}
//clear all filters on products 
clearFilters () {
  this.globals.campaignFiltered="0";
  this.globals.sortFiltered='do_id desc';
  this.globals.brandFiltered="";
  this.globals.typeFiltered="";  
  this.globals.branchFiltered="";
  this.globals.colorFiltered="";
  this.globals.colorFiltered="";
  this.globals.sizeFiltered="";
  this.globals.priceFiltered=10;
  this.globals.patternFiltered="";
  this.globals.scentNatureFiltered="";
  this.globals.scentExactFiltered="";
  this.globals.perfumerFiltered="";
  this.globals.scentFiltered="";
  this.globals.EnglishscentFiltered="";
  this.globals.madeinFiltered="";
  this.globals.sexFiltered="";
  this.globals.scentGroupFiltered="";
  this.globals.searchFiltered="";
}  
//innsert a comment by users under product page
insertComment (do_id,content) {
  this.timestamp=new Date ().getSeconds ();
  let userId=this.globals.loginedUserID;
  //alert (this.globals.UrlHome+"/drm/web/index.php?time="+this.timestamp+"&id=73&pid="+do_id+"&uid="+userId+"&content="+content);
  return this.http.get (this.globals.UrlHome+"/drm/web/index.php?time="+this.timestamp+"&id=73&pid="+do_id+"&uid="+userId+"&content="+content)
  .pipe (map (res => {
      return res;
 }));
}
//fetching comment list inserted by users  
allComments (do_id) {
  this.timestamp=new Date ().getSeconds ();
  //alert (this.globals.UrlHome+"/drm/web/index.php?time="+this.timestamp+"&id=74&pid="+do_id);
  return this.http.get (this.globals.UrlHome+"/drm/web/index.php?time="+this.timestamp+"&id=74&pid="+do_id)
  .pipe (map (res => {
      return res;
 }));
} 
//get Full Details Of Product 
getFullDetailsOfProduct (do_id) {
  let user_id=this.globals.loginedUserID;
  this.timestamp=new Date ().getSeconds ();
  //alert (this.globals.UrlHome+"/drm/web/index.php?id=8&do_id="+do_id+"&user_id="+user_id+"&ts="+this.timestamp);
  return this.http.get (this.globals.UrlHome+"/drm/web/index.php?id=8&do_id="+do_id+"&user_id="+user_id+"&ts="+this.timestamp)
  .pipe (map (res => {
    return res; 
 }));
}
//fetching products order by sort (e.g. used in footer.HTML)
fetchProductList (sort:String,limit) {
  this.timestamp=new Date ().getSeconds ();
  //alert (this.globals.UrlHome+"/drm/web/index.php?id=64&sort="+sort+"&limit="+limit+"&ts="+this.timestamp);
  return this.http.get (this.globals.UrlHome+"/drm/web/index.php?id=64&sort="+sort+"&limit="+limit+"&ts="+this.timestamp)
  .pipe (map (res => {
    return res; 
 }));
}
//save fetched datas into to contentNews |contentTop | contentOffer
cusomizeList (len,data) {
  let language;
  language=this.localStorageService.getItem ('Language');
  for (let i=0; i < len; i++) {
    if ((language === 'en') && data[i]) {
      data[i].do_price=data[i].USD; 
      data[i].price_after=data[i].USD_after;
    } else {
      if ((language === 'ar') && data[i]) {
        data[i].do_price=data[i].AED; 
        data[i].price_after=data[i].AED_after;
      }
      }
 }
  return data;
}
//save fetched datas into to contentNews |contentTop | contentOffer
cusomizeMoneyPostfix (product) {
  let language;
  let money=[];
  language=this.globals.language;
  switch (language) {
    case 'ar':
      money['price']=new Intl.NumberFormat ('ar-SA', {maximumSignificantDigits: 3}).format (product.AED);
      money['final_price']=new Intl.NumberFormat ('ar-SA', {maximumSignificantDigits: 3}).format (product.AED_after);  
      break;
    case 'en':
      money['price']=product.USD;
      money['final_price']=product.USD_after;
      break;
    default:
      money['price']=product.do_price;
      money['final_price']=product.price_after;
 }
  return money;
}
//carousel products in masterHTML
caroselPageOne (sort:String) {
  this.timestamp=new Date ().getSeconds ();
  //alert (this.globals.UrlHome+"/drm/web/index.php?id=63&sort="+sort+"&ts="+this.timestamp);
  return this.http.get (this.globals.UrlHome+"/drm/web/index.php?id=63&sort="+sort+"&ts="+this.timestamp)
  .pipe (map (res => {
    return res; 
 }));
}
//fetching list of brands
brandList (sort) {
  this.timestamp=new Date ().getSeconds ();
  return this.http.get (this.globals.UrlHome+"/drm/web/index.php?id=43&sort="+sort+"&ts="+this.timestamp)
  .pipe (map (res => {
    return res; 
 }));
}
//also Discovered Products
alsoDiscoveredProducts (campId:String,doid:string) {
  let user_id=this.globals.loginedUserID;
  this.timestamp=new Date ().getSeconds ();
    return this.http.get (this.globals.UrlHome+"/drm/web/index.php?id=59&doid="+doid+"&campId="+campId+"&uid="+user_id+"&ts="+this.timestamp)
  .pipe (map (res => {
    return res; 
 }));
}
//add an item into basket list
addToBasket (do_id:String,color_id:String,basketSelected:number,Size:String) {
  this.timestamp=new Date ().getSeconds ();
  let userId=this.globals.loginedUserID;
//    alert (this.globals.UrlHome+"/drm/web/index.php?time="+this.timestamp+"&id=39&do_id="+do_id+"&uid="+userId+"&color_id="+color_id+"&count="+basketSelected+"&Size="+Size);
  return this.http.get (this.globals.UrlHome+"/drm/web/index.php?time="+this.timestamp+"&id=39&do_id="+do_id+"&uid="+userId+"&color_id="+color_id+"&count="+basketSelected+"&Size="+Size)
  .pipe (map (res => {
      return res;
 }));
}
//return number of items in wislist
userWishListCount () {
  this.timestamp=new Date ().getSeconds ();
  let userId=this.globals.loginedUserID;
  return this.http.get (this.globals.UrlHome+"/drm/web/index.php?time="+this.timestamp+"&id=61&uid="+userId)
  .pipe (map (res => {
    return res;
 }));
}
//return number of items in user basket
getBasketProductsCounts () {
  this.timestamp=new Date ().getSeconds ();
  let userId=this.globals.loginedUserID;
  return this.http.get (this.globals.UrlHome+"/drm/web/index.php?time="+this.timestamp+"&id=42&uid="+userId)
  .pipe (map (res => {
    return res;
 }));
}
//fetching items in user wishlist
userWishlist () {
  this.timestamp=new Date ().getSeconds ();
  let userId=this.globals.loginedUserID;
  return this.http.get (this.globals.UrlHome+"/drm/web/index.php?time="+this.timestamp+"&id=26&uid="+userId)
  .pipe (map (res => {
    return res;
 }));
}
//add an item into users wishlist  
addToWishList (do_id:String) {
  this.timestamp=new Date ().getSeconds ();
  let userId=this.globals.loginedUserID;
  return this.http.get (this.globals.UrlHome+"/drm/web/index.php?time="+this.timestamp+"&id=27&do_id="+do_id+"&uid="+userId)
  .pipe (map (res => {
      return res;
 }));
}
//fetching countries
getBranches () {
  this.timestamp=new Date ().getSeconds ();
  return this.http.get (this.globals.UrlHome+"/drm/web/index.php?id=14"+"&ts="+this.timestamp)
  .pipe (map (res => {
    return res; 
 }));
}
//fetching cities after selecting a country
locationBranch (country) {
  this.timestamp=new Date ().getSeconds ();
  return this.http.get (this.globals.UrlHome+"/drm/web/index.php?id=13&bid="+country+"&ts="+this.timestamp)
  .pipe (map (res => {
    return res; 
 }));
}
}