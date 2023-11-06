import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Router } from '@angular/router';
import { Observable, map } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class AuthService {
  private isLoggedIn = false;
  private API_URL = '/api/login';

  constructor(private _httpClient: HttpClient, private router: Router) {}

  logout() {
    this.isLoggedIn = false;
    localStorage.removeItem('token');
    this.router.navigate(['/login']);
  }

  
  getToken() {
    return localStorage.getItem('token')?.toString();
  }

  isAuthenticated(): boolean {
    return this.isLoggedIn;
  }

  login(username: string, password: string, airline: string): Observable<boolean> {
    const credentialsData = {
      airline: airline,
      username: username,
      password: password
    };
  
    const body = JSON.stringify(credentialsData);
  
    const httpOptions = {
      headers: new HttpHeaders({
        'Content-Type': 'application/json'
      })
    };
  
    return this._httpClient.post(this.API_URL, body, httpOptions)
      .pipe(
        map((response: any) => {
          if (response.token) {
            this.isLoggedIn = true;
            localStorage.setItem('token', response.token);
            return true;
          }
          return false;
        })
      );
  }
}
