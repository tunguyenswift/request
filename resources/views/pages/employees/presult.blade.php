<table  class="table table-striped table-bordered table-hover">
                <thead class=" text-primary">
                  <th>
                    STT
                  </th>
                  <th>
                    Tên nhân viên
                  </th>
                  <th>
                    Chức danh
                  </th>
                  <th>
                    Email
                  </th>
                  <th>
                    Phone
                  </th>
                  <th>
                    Phòng ban
                  </th>
                  <!-- <th style="text-align: center;">
                    Hành động
                  </th> -->
                </thead>
                <tbody>
                  
                 @foreach($employees as $e)
                  <tr>
                    <td>
                     <!-- {{$e->id}} -->
                     {{ $loop->iteration }}
                    </td>
                    <td>
                      @if(isset($e->name))
                      {{$e->name}}
                      @endif
                    </td>
                    <td>
                      @if(isset($e->chucdanh))
                      {{$e->chucdanh}}
                      @endif
                    </td>
                    <td>
                      @if(isset($e->email))
                      {{$e->email}}
                      @endif
                    </td>
                    <td>
                      @if(isset($e->mobile))
                      {{$e->mobile}}
                      @endif
                    </td>
                    <td>
                      @if(isset($e->Unit->name))
                      {{$e->Unit->name}}
                      @endif
                    </td>
                    <!-- <td class="text-primary" style="text-align: center;">
                      <a rel="tooltip" class="btn btn-success btn-link" href="#" data-original-title="" title="">
                        <i class="material-icons">edit</i>
                        <div class="ripple-container"></div>
                        <a rel="tooltip" class="btn btn-success btn-link" href="#" data-original-title="" title="">
                        <i class="material-icons">delete</i>
                        <div class="ripple-container"></div>
                      </a>
                      </a>
                    </td> -->
                  </tr>
                  @endforeach
                </tbody>
              </table>
              {!! $employees->render() !!}