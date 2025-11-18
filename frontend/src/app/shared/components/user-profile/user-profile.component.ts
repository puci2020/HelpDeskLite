import { Component, OnInit } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { environment } from '../../../../environments/environment';

@Component({
  selector: 'app-user-profile',
  templateUrl: './user-profile.component.html',
  styleUrls: ['./user-profile.component.scss'],
})
export class UserProfileComponent implements OnInit {

  user: any = null;
  loading = false;
  error: string | null = null;

  constructor(private http: HttpClient) { }

  ngOnInit(): void {
    this.fetchUser();
  }

  fetchUser() {
    this.loading = true;
    this.error = null;

    this.http.get(`${environment.apiUrl}/external-user-data`, { withCredentials: true })
      .subscribe({
        next: (data) => {
          this.user = data;
          this.loading = false;
        },
        error: (err) => {
          console.error(err);
          this.error = 'Nie udało się pobrać danych użytkownika';
          this.loading = false;
        }
      });
  }
}
