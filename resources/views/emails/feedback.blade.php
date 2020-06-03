<body>
<p><?php echo ($caption) ? "Форма &laquo;" . $caption . "&raquo;" : ''; ?></p>
<ul>
    <li>Имя: <?php echo $name; ?></li>
    <li>Телефон: <?php echo $phone; ?></li>
    <li>Город: <?php echo $city; ?></li>
    <li><a href="<?php echo $url; ?>"><?php echo $url; ?></a></li>
    <li>Комментарий: <?php echo $comment; ?></li>
</ul>
</body>
