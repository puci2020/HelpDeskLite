import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { tap } from 'rxjs/operators';
import { Router } from '@angular/router';
import { environment } from '../../../environments/environment';
import {User} from "../../shared/models/user.model";

@Injectable({
  providedIn: 'root'
})
export class AuthService {

  private tokenKey = 'auth_token';
  private loggedUserKey = 'logged_user';

  constructor(
    private http: HttpClient,
    private router: Router
  ) {}

  login(email: string, password: string) {
    return this.http.post<{ access_token: string }>(`${environment.apiUrl}/login`, {
      email,
      password
    }).pipe(
      tap(res => {
        localStorage.setItem(this.tokenKey, res.access_token);
      })
    );
  }

  fetchUser() {
    return this.http.get(`${environment.apiUrl}/user`).pipe(
      tap(user => {
        localStorage.setItem(this.loggedUserKey, JSON.stringify(user));
      }) // zapisujemy w serwisie
    );
  }

  getUser(): User | null {
    const userData = localStorage.getItem(this.loggedUserKey);
    return userData ? JSON.parse(userData) as User : null;
  }

  logout() {
    return this.http.post(`${environment.apiUrl}/logout`, {})
      .pipe(
        tap(() => {
          localStorage.removeItem(this.tokenKey);
          this.router.navigate(['/login']);
        })
      );
  }

  getToken(): string | null {
    return localStorage.getItem(this.tokenKey);
  }

  isLoggedIn(): boolean {
    return !!this.getToken();
  }
}
