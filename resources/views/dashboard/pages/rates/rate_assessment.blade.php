<input type="hidden" id="assessment_id" name="assessment_id" value="{{$assessment->id}}">
<input type="hidden" id="user_id" name="user_id" value="{{$user_id}}">
<input type="hidden" id="rate_id" name="rate_id" value="{{$rate_id}}">

<div class="flex col-12 row" style="height:80%; padding-top: 2%">
<div  style="height:100%;width:74%;margin:auto;text-align:center; overflow-y:auto;">

        <ul class="nav nav-pills scroll-sm-nav-pills flex-md-column rounded bg-white myTab1" id="myTab1"
            role="tablist">
            <h4 class="num_question"></h4>
            @foreach($assessment->questions as $index => $question)
                <li class="nav-item " index="{{ $index }}">
                        <a class="nav-link visit-item active"
                        data-id="{{$question->id}}" data-bs-toggle="tab"  id="questionid"
                        data-toggle="tab" href="#req{{$question->id}}" style="font-size: 18px">
                         {{$question->title}}
                     </a><br>
                </li>

            @endforeach
        </ul>
    </div>

    <div class="card col-md-6 modal-card card-custom gutter-b mb-2 card-shadowless" style="width:70%;margin:auto;text-align:center;">
        <div class="card-body">
            <div class="row tab-content" id="myTabContent">
                <!--begin: Datatable-->
                @foreach($assessment->questions as $index => $question)
                    <div class="col-12 tab-pane pane-dev fade @if($index == 0) show active @endif" id="req{{$question->id}}" role="tabpanel" data-index="{{$index}}">
                        <div class="input-wrapper">
                            <input type="hidden" name="questions[{{ $question->id }}][rate]" id="rate_id_{{$question->id}}" value="{{isset($answers[$question->id])? $answers[$question->id]['rate'] :''}}">
                            <div class="w-lg-50" style="margin:auto">
                                <label class="fs-6 fw-semibold mb-2">
                                    Question score
                                    <span class="m2-1" data-bs-toggle="tooltip" title="Choose the score assigned to this question and it must be from 0 to 100">
                                        <i  class="fa-solid fa-info"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                    </span>
                                </label>
                                <div class="d-flex flex-column text-center">
                                    <div class="d-flex align-items-start justify-content-center mb-7">
                                        <h6 id="show-degree-{{ $question->id }}"></h6>
                                        <span class="fw-bold fs-3x" id="kt_modal_create_campaign_budget_label_{{$question->id}}"></span>
                                    </div>
                                    <div id="kt_modal_create_campaign_budget_slider_{{$question->id}}" class="noUi-sm" data-bs-target="#req{{$question->id}}"></div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <textarea type="text" min="0" max="100" id="note{{$index}}" name="questions.{{ $question->id }}.note" class="form-control mt-4 form-control-solid mb-3 mb-lg-0 note-input" placeholder="note">{{isset($answers[$question->id])? $answers[$question->id]['note'] :''}}</textarea>
                            <div class="text-danger error-message{{$index}}-note error-message"></div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div style="display: flex; justify-content:space-between">
                <div class="mt-4">
                    <button type="button"  class="btn btn-primary btn-sm" disabled index="0"  id="prevBtn">Previous</button>
                    <button type="button"  class="btn btn-primary btn-sm"  index="0"  id="nextBtn">Next</button>
                </div>
                <div class="mt-4">
                    <button type="submit" class="btn btn-sm btn-primary" id="submitButton"
                        data-kt-stepper-action="submit">
                        <span class="indicator-label">
                            Save And Close
                        </span>
                        <span class="indicator-progress">
                            Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                </div>
            </div>


        </div>
    </div>
</div><!--------validation to check the input degree must between 0-100----->

<script>
    $(document).ready(function() {
        $('.rate-input').on('input', function() {
            var index = $(this).closest('.tab-pane').data('index');
            var rate = parseInt($(this).val());
            if (isNaN(rate) || rate < 0 || rate > 100) {
                $('#rate'+index).addClass('is-invalid');
                $('.error-message'+index+'-rate').text('Please enter a valid number between 0 and 100.').show();
            } else {
                $('#rate'+index).removeClass('is-invalid');
                $('.error-message'+index+'-rate').hide();
            }
        });

        $('.note-input').on('input', function() {
            var index = $(this).attr('id').replace('note', '');
            var note = $(this).val();
            if (note.includes(',')) {
                $('#note'+index).addClass('is-invalid');
                $('.error-message'+index+'-note').text('Please do not enter a comma ",".').show();
            } else if(note.trim() === '') {
                $('#note'+index).removeClass('is-invalid');
                $('.error-message'+index+'-note').hide();
            } else {
                $('#note'+index).removeClass('is-invalid');
                $('.error-message'+index+'-note').hide();
            }
        });
    });

</script>
<script>
       var currentQuestionIndex = 0;
       var totalQuestions = {{ count($assessment->questions) }};
    // Variables to keep track of current question index and total number of questions
    // Function to handle next button click
    $('#nextBtn').on('click', function() {

        var currentQuestionLink = $('.nav-link.active');
        var nextQuestionLink = currentQuestionLink.parent().next().find('.nav-link');

        if (nextQuestionLink.length) {
            currentQuestionLink.parent().hide();
            nextQuestionLink.parent().show();
            var questionId = nextQuestionLink.data('id');
            showQuestion(questionId);
        }

    });

    // Function to handle previous button click
    $('#prevBtn').on('click', function() {

        var currentQuestionLink = $('.nav-link.active');
        var prevQuestionLink = currentQuestionLink.parent().prev().find('.nav-link');

        if (prevQuestionLink.length) {
            currentQuestionLink.parent().hide();
            prevQuestionLink.parent().show();
            var questionId = prevQuestionLink.data('id');
            showQuestion(questionId);
        }
    });

    // Function to show the question with the given ID
    function showQuestion(questionId) {
    // Hide all questions except for the current question
    $('.nav-link').removeClass('active');
    $('.pane-dev').removeClass('show active');
    $('#req' + questionId).addClass('show active');
    $('.nav-link[data-id="' + questionId + '"]').addClass('active');
    $('.nav-link[data-id!="' + questionId + '"]').parent().hide();

    var indexNumber = $('.nav-link[data-id="' + questionId + '"]').parent().attr('index');

    var questionNumber = parseInt(indexNumber) + 1;
    $('.num_question').text('Question ' + questionNumber + ' of ' + totalQuestions);

    $('#prevBtn').attr("value", indexNumber);
    $('#nextBtn').attr("value", indexNumber);

    if ($('#prevBtn').attr("value") == 0) {
        $("#prevBtn").prop('disabled',true);
    } else {
        $("#prevBtn").prop('disabled',false);
    }

    if ($('#nextBtn').attr("value") == totalQuestions-1) {
        $("#nextBtn").prop('disabled',true);
    } else {
        $("#nextBtn").prop('disabled',false);
    }

}
    // Show the initial question when the modal is opened
    $('#myModal').on('shown.bs.modal', function() {
        showQuestion(currentQuestionIndex);
    });
    $(document).ready(function () {
        $("#submitButton").on('click', function (e) {
                e.preventDefault();

                var data = $("#myForm").serializeArray();
                // console.log(data)
                // alert(data)
                $.ajax({
                    url: "/assessment/show/update-rate", // replace with your URL
                    type: 'POST',
                    data: data,
                    success: (response) => {
                        // $('#rateAssessment').modal('hide');
                        location.reload();
                        $('#new_rate').text('Rate : ' + response.newRate.rate + ' %');
                        var rate_id = response.newRate.id;
                        $('.rate_assessment[data-user="' + response.newRate.user_id + '"]').attr('data-rate', rate_id);
                        $('#kt_modal_create_app').modal('hide');
                        toastr.success("Employee Rate Saved Successfully");
                        $('.rate_assessment[data-user="' + response.newRate.user_id + '"]').attr('data-rate', rate_id);
                        $('#rate').val(response.newRate.rate);
                        $('#note').val(response.newRate.note);
                    },
                    error: (xhr, status, error) => {
                    let errors = xhr.responseJSON.errors;
                        $.each(errors, function (key, error) {
                            console.log(key, error);
                            let errorMsg = '<div class="error-msg">' + error[0] + '</div>';
                            $('[name="' + key + '"]').addClass('is-invalid').after(errorMsg);
                        });
                    }
                });
            });
    })
</script>
<!------------------------------show degree on the bar &&and get the status of degree--------------------------------------->
@foreach($assessment->questions as $index => $question)
    <script>
        $(document).ready(function() {
            var budgetSlider = document.querySelector("#kt_modal_create_campaign_budget_slider_{{$question->id}}");
            var budgetValue = document.querySelector("#kt_modal_create_campaign_budget_label_{{$question->id}}");

            noUiSlider.create(budgetSlider, {
                //check the value of degree
                start: [{{isset($answers[$question->id]) &&  $answers[$question->id]['rate'] !==Null? $answers[$question->id]['rate'] : 0}}],
                connect: true,
                range: {
                    "min": 0,
                    "max": 100
                },
            });

            budgetSlider.noUiSlider.on("update", function (values, handle) {
                budgetValue.innerHTML = Math.round(values[handle]);
                updateRateId({{ $question->id }}, values[handle]);
                if (values[handle] > 0 && values[handle] <= 25) {
                $("#show-degree-{{ $question->id }}").text("bad").css("color","#EA2027")
            }
            else if(values[handle] > 25 && values[handle] <= 50) {
                $("#show-degree-{{ $question->id }}").text("Good").css("color","#F79F1F")
            }

            else if(values[handle] > 50 && values[handle] <= 75) {
                $("#show-degree-{{ $question->id }}").text("Verygood").css("color","#009432")
            }
                        else if(values[handle] > 75 && values[handle] <= 100) {
                $("#show-degree-{{ $question->id }}").text("Excellent").css("color","#0652DD");
            }

            });

            function updateRateId(questionId, value) {
                $('#rate_id_' + questionId).val(Math.round(value));
            }
        });

    </script>
@endforeach
