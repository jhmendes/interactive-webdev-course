<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tag Cloud</title>
    <style>
        table {
            width: 340px;
            border-collapse: collapse;
        }

        .tagcloud {
            margin: 0;
            padding: 20px;
            width: 500px;
            border: 1px solid black;
           text-align: center;
           line-height: 1.4;
           overflow: auto;
        }

        .tagcloud li {
            display: inline;
            list-style: none;
            padding: 0 5px;

        }

        .tagcloud a {
            padding: 0;
        }

        .tagcloud a.tag1{font-size: .7em; font-weight: 100;}
        .tagcloud a.tag2{font-size: .9em; font-weight: 200;}
        .tagcloud a.tag3{font-size: 1.1em; font-weight: 300;}
        .tagcloud a.tag4{font-size: 1.2em; font-weight: 400;}
        .tagcloud a.tag5{font-size: 1.4em; font-weight: 500;}
        .tagcloud a.tag6{font-size: 1.6em; font-weight: 600;}
        .tagcloud a.tag7{font-size: 1.8em; font-weight: 700;}
        .tagcloud a.tag8{font-size: 2em; font-weight: 800;}
        .tagcloud a.tag9{font-size: 2.2em; font-weight: 800;}
        .tagcloud a.tag10{font-size: 2.5em; font-weight: 900;}
       
    
    
    </style>
</head>
<body>
    <h1>Tag Cloud</h1>
    <h2>List</h2>
    <?php  echo $data['tag_list'] ?>
    <h2>Cloud:</h2>
    <?php  echo $data['tag_cloud'] ?>
</body>
</html>