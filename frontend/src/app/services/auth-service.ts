import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Router } from '@angular/router';

@Injectable({
  providedIn: 'root'
})
export class AuthService {
  private isLoggedIn = false;
  public token = "";
  private API_URL = '/api/login';

  constructor(private _httpClient: HttpClient, private router: Router) {}

  logout() {
    this.isLoggedIn = false;
    this.router.navigate(['/login']);
  }

  isAuthenticated(): boolean {
    return this.isLoggedIn;
  }

  login(username: string, password: string, airline: string): boolean {
    const headers = new HttpHeaders({ 'Content-Type': 'application/json' });

    const credentialsData = {
        airline: airline,
        username: username,
        password: password
    };

    const body = JSON.stringify(credentialsData);
    console.log(body);

    const httpOptions = {
        headers: new HttpHeaders({
          'Content-Type': 'application/json'
        })
      };

    this._httpClient
        .post(this.API_URL, body, httpOptions)
        .subscribe((response: any) =>
        {
            console.log(response)
            if(response.token)
            {
                this.isLoggedIn = true;
                this.token = response.token
            }
        });
    
    return this.isLoggedIn;
  }
}
