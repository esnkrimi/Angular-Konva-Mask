//Color Filter Panel , where user can apply colors on product list to show
import {Component, Output, EventEmitter} from '@angular/core';
import {globals} from '../global-variables';
@Component({
  selector: 'app-filter-color',
  templateUrl: './filter-color.component.html',
  styleUrls: ['./filter-color.component.sass']
})
export class FilterColorComponent  {
  colorList = [
        '#0000FF',
        '#000080',
        '#00FFFF',
        '#00C1FF',
        '#FF0000',
        '#F777D8',
        '#850B3B',
        '#20BC59',
        '#0A5E29',
        '#6EF6A0',
        '#F8E335',
        '#FCF29D',
        '#FFFFFF',
        '#000000',
        '#747474',
        '#B10AFF',
        '#6C00FF',
        '#784212'
        ]; 
  @Output() colorFiltered = new EventEmitter<String>();
  constructor(public globals:globals) {}
  //apply color filter by user
  selColor (colorTitle) {
    this.globals.loadingHome = true;
    this.globals.colorFiltered = colorTitle;
    this.globals.unhyperAction = 'home';
    this.globals.unhyperAction2 = 'home';
    colorTitle = colorTitle.substring (1, colorTitle.length);
    this.colorFiltered.emit(colorTitle);
  } 
}