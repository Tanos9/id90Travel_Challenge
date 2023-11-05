import { Component, OnInit } from '@angular/core';
import { Airline } from '../models/airline.model';
import { Router } from '@angular/router';
import { MatAutocompleteSelectedEvent } from '@angular/material/autocomplete';
import { FormControl, FormGroup, Validators } from '@angular/forms';
import { Observable, map, startWith } from 'rxjs';
import { AuthService } from '../services/auth-service';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent {

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

  public loginForm = new FormGroup(
  {
      airline: new FormControl('', [Validators.required]),
      username: new FormControl('', [Validators.required]),
      password: new FormControl('', [Validators.required])
  });

  constructor(private router: Router, private authService: AuthService) {}

  onAirlineSelected(event: MatAutocompleteSelectedEvent): void {
    const selectedAirlineName = event.option.viewValue;
  }

  login() {
    if (this.loginForm.valid) {
      const formData = this.loginForm.value;
      let isLoggedIn = this.authService.login(formData.username!, formData.password!, formData.airline!);
      if (isLoggedIn)
      {
        this.router.navigate(['/dashboard']);
      }
   }
  }

  private _filter(value: string): Airline[] {
    const filterValue = value.toLowerCase();

    return this.airlines
      .filter(airline => airline.name.toLowerCase().indexOf(filterValue) === 0);
  }
}
