import { DatePipe } from '@angular/common';
import { HttpClient } from '@angular/common/http';
import { Component } from '@angular/core';
import { FormBuilder, FormControl, FormGroup, Validators } from '@angular/forms';

@Component({
  selector: 'app-dashboard',
  templateUrl: './dashboard.component.html',
  styleUrls: ['./dashboard.component.css']
})
export class DashboardComponent
{
  private API_URL = '/api/hotels?';
  public searchForm = new FormGroup(
  {
    city: new FormControl('', [Validators.required]),
    guests: new FormControl('', [Validators.required]),
    checkInDate: new FormControl('', [Validators.required]),
    checkOutDate: new FormControl('', [Validators.required]),
  });

  hotels: any[] = [];
    
  constructor(
  private _fb: FormBuilder,
  private _httpClient: HttpClient,
  private datePipe: DatePipe)
  {
  }

  searchHotels() {
    this.hotels = [];
    if (this.searchForm.valid)
    {
      const URL = this.buildAvailableHotelsURL();
      this._httpClient
        .get(URL)
        .subscribe((response: any) =>
        {
          this.hotels = response;
        });
    }
     else
    {
      
    }
  }

  private buildAvailableHotelsURL() : string {
    const formData = this.searchForm.value;
    const checkInDateFormatted = this.datePipe.transform(formData.checkInDate, 'yyyy-MM-dd');
    const checkOutDateFormatted = this.datePipe.transform(formData.checkOutDate, 'yyyy-MM-dd');
    const city = formData.city?.trim().replaceAll(' ', '');
    const guests = formData.guests?.toString().trim().replaceAll(' ', '');

    return this.API_URL += `destination=${city}&guests=${guests}&checkin=${checkInDateFormatted}&checkout=${checkOutDateFormatted}`;
  }
}
