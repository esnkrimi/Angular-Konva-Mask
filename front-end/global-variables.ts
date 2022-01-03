import {Injectable} from '@angular/core';
@Injectable()
export class globals {
  isOpen = false;
  language='en';
  sticky=false;
  loginedUserID;
  loginedUser=false;
  loginedUserName;
  loginedUserEmail;
  loginedUserPhotoUrl;
  slideshow;
  UrlHome="http://burjcrown.com"; 
  unhyperAction="";
  unhyperAction2="";
  loadingHome=false;
  masterAction="";
  //filters:
  campaignFiltered="0";
  sortFiltered='do_id desc';
  brandFiltered="";
  typeFiltered="";  
  branchFiltered="";
  colorFiltered="";
  sizeFiltered="";
  priceFiltered=10;
  patternFiltered="";
  scentNatureFiltered="";
  scentExactFiltered="";
  perfumerFiltered="";
  scentFiltered="";
  EnglishscentFiltered="";
  sexFiltered="";
  madeinFiltered="";
  scentGroupFiltered="";
  searchFiltered="";
  //-------filters END
  drawerToggle=false;//for verticalmenu after user logined
  menuShow=true;//menu show on pc devices only
  BasketCount=0;//number of product exist in basket
  WishlistCount=0;//number of product exist in wishlist
  devicePc=true;//user uses PC | Mobile?
  filterVIsibilityForMobile=false;
  fixedHeader=false;//for styling header to position:fixed
  wishlistUpdateList=false;
  message="";//message for modals
  messageLink="";//message link for modals
}