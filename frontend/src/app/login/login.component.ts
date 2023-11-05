import { Component, OnInit } from '@angular/core';
import { Airline } from '../models/airline.model';
import { Router } from '@angular/router';
import { MatAutocompleteSelectedEvent } from '@angular/material/autocomplete';
import { FormControl, FormGroup, Validators } from '@angular/forms';
import { Observable, map, startWith } from 'rxjs';
import { AuthService } from '../services/auth-service';
import { MatSnackBar} from '@angular/material/snack-bar';
import { HttpClient } from '@angular/common/http';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent {
  private API_AIRLINES_URL = '/api/airlines/names';

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
  snackBar!: MatSnackBar;
  airlineControl = new FormControl();

  public loginForm = new FormGroup(
  {
      airline: new FormControl('', [Validators.required]),
      username: new FormControl('', [Validators.required]),
      password: new FormControl('', [Validators.required])
  });

  constructor(
    private router: Router,
    private authService: AuthService,
    private httpClient: HttpClient,
    snackBar: MatSnackBar,
    )
  {
    this.snackBar = snackBar;
  }

  ngOnInit() {
    this.getAirlines();
  }

  onAirlineSelected(event: MatAutocompleteSelectedEvent): void {
    const selectedAirlineName = event.option.viewValue;
  }

login() {
  if (this.loginForm.valid) {
    const formData = this.loginForm.value;
    this.authService.login(formData.username!, formData.password!, formData.airline!)
      .subscribe(isLoggedIn => {
        if (isLoggedIn) {
          this.router.navigate(['/dashboard']);
        } else {
          this.openSnackBar('Invalid Credentials', 'OK');
        }
      });
  }
}

getAirlines() {
  return this.httpClient
    .get(this.API_AIRLINES_URL)
    .subscribe((response: any) =>
    {
      this.airlines = response;
    });
}

openSnackBar(message: string, action: string) {
  this.snackBar.open(message, action, {
    duration: 3000,
  });
}

private _filter(value: string): Airline[] {
  const filterValue = value.toLowerCase();

  return this.airlines.filter((airline) =>
    airline.name.toLowerCase().includes(filterValue)
  );
}

}
