
<h1>
books page
</h1>

<form method="POST" action="/books">
<input name="name" />
<button>
add
</button>
</form>

<ul>
<?php foreach($books as $book):?>
  <li>
    <?php echo $book["title"]; ?>
  </li>
<?php endforeach;?>
</ul>
