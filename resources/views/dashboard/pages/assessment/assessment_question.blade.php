<style>
    .questions-list {
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 10px;
    /* background-color: #aaecca; */
    box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.1);
  }

  .questions-list h3 {
    margin-top: 0;
    color:718093;
  }

  .questions-list ul {
    list-style: none;
    margin: 0;
    padding: 0;
  }

  .questions-list li {
    padding: 5px 10px;
    border-bottom: 1px solid #ccc;
    border-radius: 2px;
  }

  .questions-list li:last-child {
    border-bottom: none;

  }
  .list-group {
  margin-bottom: 0;
}
.list-group-item {
  border-color: #dee2e6;
  background:whitesmoke ;
  margin-top: 4px;
    height: 37px;
    width: 75%;

}
.list-group-item:first-child {
  border-top-left-radius: .25rem;
  border-top-right-radius: .25rem;
}
.list-group-item:last-child {
  border-bottom-left-radius: .25rem;
  border-bottom-right-radius: .25rem;
}
</style>
<div class="questions-list">
    <h3 >{{$assessment_question->title}} Questions For {{$assessment_question->start_date->format('y-m-d')}}</h3><br>
    <ul class="list-group">
        @foreach($assessment_question->questions as $question)
          <li  class="list-group-item"><h5 style="color:rgb(52, 9, 108);">{{ $question->title }}</h5></li><br>
        @endforeach
      </ul>
  </div>
