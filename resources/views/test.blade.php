<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css"
    integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

    <title>TEST PG</title>
</head>
<body>
    
    <div class="row">

        <div class="col-12">
            <div class="container">
                <div class="role-perms mt-5">
                    <h4>Role: Manager</h4>
                    <form action="{{ route('testPost') }}" method="post">@csrf
                    @foreach ($permissions as $perm)
                    <h5 class="mt-5">{{ $perm->name }}</h5>
                    @if(!empty($perm->permissions))
                        @foreach ($perm->permissions as $sub_perm)
                        <div class="form-check form-check-inline">
                            <input type="hidden" class="perms_unchecked" name="perms_unchecked[]" data-unchecked-id="{{ $sub_perm->id }}" value="">
                            <input class="form-check-input check-demo" data-id="{{ $sub_perm->id }}" @if($role->hasPermission($sub_perm->id)) checked @endif name="perms[]" type="checkbox" id="{{ $sub_perm->slug }}" value="{{ $sub_perm->id }}">
                            <label class="form-check-label" for="{{ $sub_perm->slug }}">{{ $sub_perm->name }}</label>
                        </div>
                        @endforeach
                    @endif
                    
                    @endforeach
                    <button type="submit" class="btn btn-success btn-sm d-block mt-3">Submit</button>
                    </form>
                     
                </div>
                
            </div>
            
        </div>
        
    </div>
    
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js"
integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</html>

<script>
$(".check-demo").click(function(){
if($(this).is(':not(:checked)')){

    var id_checked = $(this).attr("data-id");
    //alert($(this).val());   
    var perms_unchecked = $("input[data-unchecked-id='" + id_checked +"']");
    // console.log(perms_unchecked.attr("data-id"));
    unchecked_val = perms_unchecked.val(id_checked);
    // console.log(unchecked_val); 
}
 if($(this).is(":checked")) {

    var id_checked = $(this).attr("data-id");
    //alert($(this).val());   
    var perms_unchecked = $("input[data-unchecked-id='" + id_checked +"']");
    // console.log(perms_unchecked.attr("data-id"));
    unchecked_val = perms_unchecked.val('');
    // console.log(unchecked_val);
   }
});
</script>