<?php
    $_SESSION['currentPage'] = "Testing Page";
?>

<x-app-layout>
    <div class="py-12">
        <h1>Hi</h1>
        <h3>this is testing page</h3>
        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Blanditiis, quae repellendus voluptas ad similique quod pariatur libero eum repellat non consequatur aliquam, veniam minima tenetur cupiditate beatae? Atque, quia deleniti!</p>
        <hr>
        <br>
        <br>
        <p>test text</p>
    </div>
</x-app-layout>

<?php
    $_SESSION['currentPage'] = null;
?>
