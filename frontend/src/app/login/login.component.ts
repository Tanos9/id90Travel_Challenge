import { Component, OnInit } from '@angular/core';
import { Airline } from '../models/airline.model';
import { Router } from '@angular/router';
import { MatAutocompleteSelectedEvent } from '@angular/material/autocomplete';
import { FormControl } from '@angular/forms';
import { Observable, map, startWith } from 'rxjs';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {

  ngOnInit(){
    this.filteredAirlines = this.airlineControl.valueChanges
      .pipe(
        startWith(''),
        map((value: string) => this._filter(value))
      );
  }

  private _filter(value: string): Airline[] {
    const filterValue = value.toLowerCase();

    return this.airlines
      .filter(airline => airline.name.toLowerCase().indexOf(filterValue) === 0);
  }

  airlines: Airline[] =
  [
    {
       id: 1,
       name: 'Aerolinea 1'
    },
    {
       id: 2,
       name: 'Aerolinea 2'
    },
    {
       id: 3,
       name: 'Aerolinea 3'
    },
    {
       id: 4,
       name: 'Aerolinea 4'
    },
    {
       id: 5,
       name: 'Aerolinea 5 '
    }
  ]
  filteredAirlines!: Observable<Airline[]> ;
  airlineControl = new FormControl();

  constructor(private router: Router) {}


  onAirlineSelected(event: MatAutocompleteSelectedEvent): void {
    const selectedAirlineName = event.option.viewValue;
  }

  login() {
      this.router.navigate(['/dashboard']);
   }
}
