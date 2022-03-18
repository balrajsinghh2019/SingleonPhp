<?php

include 'Connection.php';

$instance = Connection::getInstance();
$conn = $instance->getConnection();

$studentName = (!empty($_POST['student_name']) ? $_POST['student_name'] : '');
$studentPhone = (!empty($_POST['student_phone']) ? $_POST['student_phone'] : '');

// Set SQL
$sql = 'INSERT INTO students (student_name, student_phone) VALUES (:name, :phone)';
// Prepare query
$query = $conn->prepare($sql);

$submitStatus = false;
if(!empty($studentName) && !empty($studentPhone)) {
	try {
		// Execute query
		$query->execute(array(':name' => $studentName, ':phone' => $studentPhone));
		$submitStatus = true;
	}
	catch (PDOException $e) {
		echo "Information not submitted.";
	}
}

?>
<html>
	<head>
		<script src="https://cdn.tailwindcss.com"></script>
	</head>
	<body>
	<section class="bg-white font-dm-sans">
  	<div class="py-12 mx-6 md:py-[90px] md:m-auto max-w-7xl">
      <div class="px-6 py-12 md:py-[90px] md:px-[100px] bg-gradient-to-r from-pink-100 to-yellow-200 rounded-3xl">
      	<div class="flex flex-col items-center justify-between md:flex-row">
					<div class="w-full max-w-m">
						
						<form action="index.php" method="post" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
							<div class="mb-4">
								<label class="block text-gray-700 text-sm font-bold mb-2" for="username">
								Name
								</label>
								<input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required="true" id="username" type="text" name="student_name" placeholder="Student Name">
							</div>
							<div class="mb-6">
								<label class="block text-gray-700 text-sm font-bold mb-2" for="password">
								Phone
								</label>
								<input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required="true" id="password" type="text" name="student_phone" placeholder="Student Phone">
							</div>
							<div class="flex items-center justify-between">
								<button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
									SUBMIT
								</button>
							</div>
						</form>
					</div>		
				</div>
			</div>
		</div>
	</section>
	</body>
</html>