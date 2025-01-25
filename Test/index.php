<?php
$conn = new mysqli("localhost", "root", "", "library");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT id, title, author, yearofpublication, genre FROM books";
$result = $conn->query($sql);
$books = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $books[] = $row;
    }
}
$conn->close();


$tokens = [];
if (file_exists('token.json')) {
    $json = file_get_contents('token.json');
    $tokens = json_decode($json, true) ?? [];
}


$usedTokens = [];
if (file_exists('used_tokens.json')) {
    $json = file_get_contents('used_tokens.json');
    $usedTokens = json_decode($json, true) ?? [];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
    <title>Library Management</title>
</head>
<body>
    <main>
    <aside class="box3">
    <h2>Used Token</h2>
    <ul class="token-list">
        <?php foreach ($usedTokens as $used): ?>
            <li><strong><?php echo htmlspecialchars($used['token']); ?></strong></li>
        <?php endforeach; ?>
    </ul>
    </aside>
        <div>
            <section>
            <div class="box1">
            <h2 class="header-title">All Database Books</h2>
                    <ul>
                        <?php foreach ($books as $book): ?>
                            <li><?php echo htmlspecialchars($book['title']) . " by " . htmlspecialchars($book['author']) . " at " . htmlspecialchars($book['yearofpublication']); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="box1">
                <h2 class="header-title">Add or Remove Book</h2>
                    <form action="add_remove_book.php" method="post">
                        <input type="text" name="title" placeholder="Book Title" required>
                        <input type="text" name="author" placeholder="Author" required>
                        <input type="number" name="yearofpublication" placeholder="Year of Publication" required>
                        <input type="text" name="genre" placeholder="Genre" required>
                        <div class="form-buttons"> 
                            <button type="submit" name="action" value="add" id="buttonAdd"><b>Add Book</b></button>
                            <button type="submit" name="action" value="remove" id="buttonRemove"><b>Remove Book</b></button>
                        </div>
                    </form>
                </div>
                <div class="box1">
                <h2 class="header-title">Edit Book Information</h2>
                    <form action="edit_book.php" method="post">
                        <input type="number" name="id" placeholder="Book ID" required>
                        <input type="text" name="title" placeholder="New Title">
                        <input type="text" name="author" placeholder="New Author">
                        <input type="number" name="yearofpublication" placeholder="New Year of Publication">
                        <input type="text" name="genre" placeholder="New Genre">
                        <div class="button-container">
                             <button type="submit" id="buttonUpdate"><b>Update</b></button>
                        </div>
                    </form>
                </div>
            </section>
            <section class="section2">
                <div class="box2">
                    <strong>Library Events</strong> <br>
                    <p>
                    The library is a hub of literary excitement, regularly organizing engaging events for visitors to dive into the world of books and stories. Here’s what’s coming up:
                    </p>
                    <ul style="list-style-type: square;">
                        <li>Meet the Author</li>
                        <li>Monthly Book Club Gathering</li>
                        <li>Evening of Poetry and Performance</li>
                        <li>Creative Writing Workshop</li>
                    </ul>
                </div>
                <div class="box2">
                    <strong style="text-align: center;">Time</strong> <br>
                    <p>Our operating hours are as follows:</p>
                    <ul>
                        <li><strong>Friday:</strong> Closed</li>
                        <li><strong>Saturday to Thursday:</strong> 9:00 AM – 7:00 PM</li>
                        <li><strong>Lunch Break:</strong> 1:30 PM – 2:30 PM</li>
                    </ul>
                </div>
                <div class="box2">
                    <strong>Books</strong> <br>
                    <ul style="list-style-type: square;">
                        <li><strong>Available Books:</strong></li>
                        <li>Pride and Prejudice</li>
                        <li>The Great Gatsboy</li>
                        <li>Sherlock Homes</li>
                        <li>The Alchemist</li>
                        <li>One Hundred Years of Solitude</li>
                        <li>Harry Potter Series</li>
                        <li>War and Peace</li>
                        <li>Jane Eyre</li>
                        <li>Twilight</li>
                        <li>Midnight Sun</li>
                        <li>Breaking Dawn</li>
                        <li>New Moon</li>
                    </ul>
                </div>
            </section>

            <section class="section2">
                <div class="box22a">
                    <form action="process.php" method="post">
                        <b>Student Name</b> 
                        <br><input type="text" placeholder="Student Full Name" name="studentname" id="studentname" required><br>
                        <b>Student ID</b>
                        <br><input type="text" placeholder="Student ID" name="studentid" id="studentID" required><br>
                        <b>Student Email</b>
                        <br><input type="email" placeholder="Student Email" name="email" id="email" required><br>
                        <label for="booktitle"><b>Select A Book : </b></label><br>
                        <select name="booktitle" id="booktitle" required>
                            <option value="Select a Book" disabled selected>Select a Book</option>
                            <option value="Pride and prejudice">Pride and prejudice</option>
                            <option value="The Great Gatsboy">The Great Gatsboy</option>
                            <option value="Sherlock Homes">Sherlock Homes</option>
                            <option value="The Alchemist">The Alchemist</option>
                            <option value="One Hundred Years of Solitude">One Hundred Years of Solitude</option>
                            <option value="Harry Potter Series">Harry Potter Series</option>
                            <option value="War and Peace">War and Peace</option>
                            <option value="Jane Eyre">Jane Eyre</option>
                            <option value="Twilight">Twilight</option>
                            <option value="Midnight Sun">Midnight Sun</option>
                            <option value="Breaking Dawn">Breaking Dawn</option>
                            <option value="New Moon">New Moon</option>
                        </select><br>
                        <b>Borrow date</b>
                        <br><input type="date" name="borrowdate" id="borrowdate" required><br>
                        <b>Return date</b>
                        <br><input type="date" name="returndate" id="returndate" required><br>
                        <b>Token</b>
                        <br><input type="text" placeholder="Token Number" name="token" id="token" required><br>
                        
                
                        <button type="submit" name="submit" id="button"><b>Submit</b></button>
                    </form>
                </div>
                <?php
                if (file_exists('token.json')) {
                    $tokens_json = file_get_contents('token.json');
                    $tokens = json_decode($tokens_json, true);
                    if ($tokens === null) {
                        echo "Error decoding JSON.";
                    }
                } else {
                    echo "token.json file not found.";
                }
                ?>
                <div class="box22b">
                    <h3 style="text-align: center;">Available Tokens</h3>
                    <ul>
                    <?php if (isset($tokens) && is_array($tokens)): ?>
                        <?php foreach ($tokens as $token): ?>
                            <?php if (isset($token['token'])): ?>
                                <button class="token-button">
                                    <strong><?php echo htmlspecialchars($token['token']); ?></strong>
                                </button><br>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>No tokens available or an error occurred while loading the tokens.</p>
                    <?php endif; ?>
                    </ul>
                </div>
            </section>
        </div>
        <div class="box3">
            <h2 style="text-align: center;">Details of the Library </h2>
            <img src="images.jpg" alt="Picture" width="250px" height="250px" style="border-radius: 50%; border: 1px solid black;">
            <hr>
            <Label><b>About</b></Label>
            <p>The AIUB Library was started in 1994 in order to cater to the academic and research needs of the faculty, research scholars, students, and officers. Over the years, the Library has grown steadily and expanded its services and holdings by leaps and bounds to live-up to the expectations of its immediate patrons. The book stock is arranged in a classified sequence based on the Dewey Decimal System (DDC), and the great majority of volumes in the Library are on open shelves, available for borrowing.</p>
            <hr>
            <div class="social-icons">
                <a href="https://www.facebook.com/aiub.edu" target="_blank">
                    <i class="fab fa-facebook"></i>
                </a>                  
                <a href="https://www.linkedin.com/school/aiubedu/" target="_blank">
                    <i class="fab fa-linkedin"></i>
                </a> 
            </div>

            
        </div>
    </main>
</body>
</html>