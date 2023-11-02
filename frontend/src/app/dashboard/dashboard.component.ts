import { Component } from '@angular/core';
import { FormBuilder, FormGroup } from '@angular/forms';

@Component({
  selector: 'app-dashboard',
  templateUrl: './dashboard.component.html',
  styleUrls: ['./dashboard.component.css']
})
export class DashboardComponent {
  searchForm: FormGroup;

  hotels: any[] = [];

searchHotels() {
  this.hotels = [
    { name: 'Hotel 1', description: 'Descripción del Hotel 1' },
    { name: 'Hotel 2', description: 'Descripción del Hotel 2' },
  ];
}

  constructor(private fb: FormBuilder) {
    this.searchForm = this.fb.group({
      city: [''],
      checkInDate: [''],
      checkOutDate: [''],
      guests: [''],
    });
  }
}
