import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { environment } from '../../../../environments/environment';
import { Tag } from '../../../shared/models/tag.model';

@Injectable({ providedIn: 'root' })
export class TagService {

  constructor(private http: HttpClient) {}

  getAll() {
    return this.http.get<Tag[]>(`${environment.apiUrl}/tags`);
  }
}
