<!DOCTYPE html>
<html>
    <body>
        <h1>"{{$key_word}}"検索結果</h1>        
        <a>検索結果は{{$search_result->ResultCount}}件です。</a>
        @while($search_result->IsHasNext()===True)
        <?php $record = $search_result->NextResult()?>
        <h3><?php echo $record->{'volumeInfo'}->{'title'} ?></h3>        
        <h4>著者：
            <?php
            if(property_exists($record->{'volumeInfo'},'authors')){
                foreach($record->{'volumeInfo'}->{'authors'} as $author)
                {
                    echo $author . ",";
                }
            }
            if(property_exists($record->{'volumeInfo'},'publishedDate')){
                echo $record->{'volumeInfo'}->{'publishedDate'} . "\n";  
            }
            ?>            
        </h4>
        <a>
        <?php      
            if(property_exists($record->{'volumeInfo'},'description'))
            {
                echo $record->{'volumeInfo'}->{'description'} . "\n";  
            }
        ?>
        </a>        
        @endwhile
    </body>
</html>