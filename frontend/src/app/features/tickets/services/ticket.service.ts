import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import {map, Observable} from 'rxjs';
import { Ticket } from '../../../shared/models/ticket.model';
import { environment } from '../../../../environments/environment';
import {Tag} from "../../../shared/models/tag.model";

@Injectable({
  providedIn: 'root'
})
export class TicketService {
  private baseUrl = `${environment.apiUrl}/tickets`;

  constructor(private http: HttpClient) {}

  getTickets(filters?: any): Observable<Ticket[]> {
    return this.http.get<Ticket[]>(this.baseUrl, { params: filters, withCredentials: true });
  }

  getTicket(id: number): Observable<Ticket> {
    return this.http.get<Ticket>(`${this.baseUrl}/${id}`)
  }

  createTicket(data: Partial<Ticket>): Observable<Ticket> {
    return this.http.post<Ticket>(this.baseUrl, data);
  }

  updateTicket(id: number, data: Partial<Ticket>): Observable<Ticket> {
    return this.http.put<Ticket>(`${this.baseUrl}/${id}`, data);
  }

  deleteTicket(id: number): Observable<void> {
    return this.http.delete<void>(`${this.baseUrl}/${id}`);
  }

  suggestTriage(id: number): Observable<any> {
    return this.http.get<any>(`${this.baseUrl}/${id}/triage-suggest`);
  }
}
