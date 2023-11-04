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
    if (this.searchForm.valid)
    {
      const formData = this.searchForm.value;
  
      const checkInDateFormatted = this.datePipe.transform(formData.checkInDate, 'yyyy-MM-dd');
      const checkOutDateFormatted = this.datePipe.transform(formData.checkOutDate, 'yyyy-MM-dd');
  
      // Construir la URL de la API con los datos del formulario
      const apiUrl = `/api/hotels?destination=${formData.city}&guests=${formData.guests}&checkin=${checkInDateFormatted}&checkout=${checkOutDateFormatted}`;
  
      this._httpClient
        .get(apiUrl)
        .subscribe((response: any) =>
        {
          this.hotels = response;
        });
    }
     else
    {
      
    }
  }
  

}
