import {Component, EventEmitter, Input, OnInit, Output} from '@angular/core';
import { FormControl } from '@angular/forms';
import {Tag} from "../../../../shared/models/tag.model";
import {TagService} from "../../services/tag.service";


@Component({
  selector: 'app-tag-selector',
  templateUrl: './tag-selector.component.html',
  styleUrls: ['./tag-selector.component.scss']
})
export class TagSelectorComponent implements OnInit {

  @Input() selected: number[] = [];
  @Output() selectedChange = new EventEmitter<number[]>();

  tags: Tag[] = [];

  constructor(private tagService: TagService) {}

  ngOnInit() {
    this.tagService.getAll().subscribe(tags => {
      this.tags = tags;
    });
  }

  onSelectionChange(values: number[]) {
    this.selected = values;
    this.selectedChange.emit(values);
  }
}
