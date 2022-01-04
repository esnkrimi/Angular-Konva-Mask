import {Component, OnInit} from '@angular/core';
import Konva from 'konva';
import {Options} from '@angular-slider/ngx-slider';
 
@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.sass']
})
export class AppComponent implements OnInit {
  intensityvalue: number = 300;
  options: Options = {
    floor: 100,
    ceil: 300
  };
  constructor(){}

  changeMaskIntensity(Intensity): void {
    function loadImages(sources, callback) {
      var images = {};
      var loadedImages = 0;
      var numImages = 0;
      for (var src in sources) {
        numImages++;
      }
      for (var src in sources) {
        images[src] = new Image();
        images[src].onload = function () {
          if (++loadedImages >= numImages) {
            callback(images);
          }
        };
        images[src].src = sources[src];
      }
    }

    function build(images) {
      var stage = new Konva.Stage({
        container: 'container',
        width: 300,
        height: 300,
      });

      var layer = new Konva.Layer({
        width: 200,
        height: 200
      });

      var vader = new Konva.Image({
        image: images.vader,
        x: 80,
        y: 30,
        width: 200,
        height: 200,
        threshold: 20,
        draggable: true,
      });

      vader.cache();
      vader.filters([Konva.Filters.Mask]);
      layer.add(vader);
      stage.add(layer);
      vader.threshold(Intensity);
    }
    var source = {
      vader: '/assets/img/lion.jpg',
    };
    loadImages(source, build);
    }

  ngOnInit(){
    this.changeMaskIntensity(300);
  }
}