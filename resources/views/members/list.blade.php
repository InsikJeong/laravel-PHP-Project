@if ($attachments->count())
    <ul class="attachment__article">
        @foreach($attachments as $attachment)
        <li>
            <img src="http://127.0.0.1:8000/files/{{$attachment->filename}}" alt="11"
            onclick="imgClick({{$member->id}})"></img>
        </li>
        @endforeach
    </ul>
    <script>
        var check =1;

        function imgClick(id){
            $.ajax({
                type:"GET",
                url:'/members/'
            }).then(function(e){
                console.log("id"+id);
                if(check == 1){
                    console.log("이프"+check);
                    document.getElementById("nameDiv"+id).style.display="block";
                    document.getElementById("commentsDiv"+id).style.display="block";
                    check= 2;
                }
                else{
                    console.log("엘스"+check);
                    document.getElementById("nameDiv"+id).style.display="none";
                    document.getElementById("commentsDiv"+id).style.display="none";
                    check=1;
                }
            })
        };
    </script>
@endif
