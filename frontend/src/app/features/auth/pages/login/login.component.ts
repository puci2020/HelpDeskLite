import { Component } from '@angular/core';
import { FormBuilder, Validators } from '@angular/forms';
import { AuthService } from '../../../../core/auth/auth.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class LoginComponent {

  loading = false;
  error = '';

  form = this.fb.group({
    email: ['', [Validators.required, Validators.email]],
    password: ['', Validators.required]
  });

  constructor(
    private fb: FormBuilder,
    private auth: AuthService,
    private router: Router
  ) {}

  submit() {
    if (this.form.invalid) return;

    this.loading = true;
    this.error = '';

    const { email, password } = this.form.value;

    this.auth.login(email!, password!)
      .subscribe({
        next: () => {
          this.auth.fetchUser().subscribe({
            next: () => {
              this.loading = false;
              this.router.navigate(['/tickets']);
            }
          })
        },
        error: err => {
          this.loading = false;
          this.error = 'Invalid email or password';
        }
      });
  }
}
