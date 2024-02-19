<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHP form with validations, Save to Database and Send Email</title>
</head>

<body>

  <h2>Form PHP</h2>
  <form action="action/query.php" method="POST">
    <label for="name">Name:</label><br>
    <input type="text" id="name" name="name" required><br><br>

    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" required><br><br>

    <label for="phone">Phone Number:</label><br>
    <input type="tel" id="phone" name="phone" pattern="[0-9]{10}" minlength="10" maxlength="10" required><br><br>

    <label>Services:</label><br>
    <input type="checkbox" id="service1" name="services[]" value="Service 1"> <label for="service1">Service 1</label><br>
    <input type="checkbox" id="service2" name="services[]" value="Service 2"> <label for="service2">Service 2</label><br>
    <input type="checkbox" id="service3" name="services[]" value="Service 3"> <label for="service3">Service 3</label><br>
    <input type="checkbox" id="service4" name="services[]" value="Service 4"> <label for="service4">Service 4</label><br><br>

    <label for="job">Are you looking for Job?</label><br>
    <select name="job" id="" required>
      <option value="" selected>Choose one</option>
      <option value="YES">YES</option>
      <option value="NO">NO</option>
    </select>
    <br><br>

    <label for="state">State</label><br>
    <select name="state" required>
      <option value="" selected>Select a State</option>
      <option value="Andhra Pradesh">Andhra Pradesh</option>
      <option value="Arunachal Pradesh">Arunachal Pradesh</option>
      <option value="Assam">Assam</option>
      <option value="Bihar">Bihar</option>
      <option value="Chhattisgarh">Chhattisgarh</option>
      <option value="Goa">Goa</option>
      <option value="Gujarat">Gujarat</option>
      <option value="Haryana">Haryana</option>
      <option value="Himachal Pradesh">Himachal Pradesh</option>
      <option value="Jharkhand">Jharkhand</option>
      <option value="Karnataka">Karnataka</option>
      <option value="Kerala">Kerala</option>
      <option value="Madhya Pradesh">Madhya Pradesh</option>
      <option value="Maharashtra">Maharashtra</option>
      <option value="Manipur">Manipur</option>
      <option value="Meghalaya">Meghalaya</option>
      <option value="Mizoram">Mizoram</option>
      <option value="Nagaland">Nagaland</option>
      <option value="Odisha">Odisha</option>
      <option value="Punjab">Punjab</option>
      <option value="Rajasthan">Rajasthan</option>
      <option value="Sikkim">Sikkim</option>
      <option value="Tamil Nadu">Tamil Nadu</option>
      <option value="Telangana">Telangana</option>
      <option value="Tripura">Tripura</option>
      <option value="Uttar Pradesh">Uttar Pradesh</option>
      <option value="Uttarakhand">Uttarakhand</option>
      <option value="West Bengal">West Bengal</option>
      <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
      <option value="Chandigarh">Chandigarh</option>
      <option value="Dadra and Nagar Haveli">Dadra and Nagar Haveli</option>
      <option value="Daman and Diu">Daman and Diu</option>
      <option value="Lakshadweep">Lakshadweep</option>
      <option value="Delhi">Delhi</option>
      <option value="Puducherry">Puducherry</option>
    </select>
    <br><br>

    <label for="city">City</label><br>
    <input type="text" id="city" name="city" required><br><br>

    <!-- Honeypot field -->
    <div style="display: none;">
      <label for="honeypot">Do not fill this field:</label>
      <input type="text" id="honeypot" name="honeypot">
    </div>

    <!-- Captcha -->
    <label for="captcha">Please enter the characters shown below:</label><br>
    <img src="action/captcha.php" alt="Captcha Image"><br>
    <input type="text" id="captcha" name="captcha" required><br><br>

    <input type="submit" value="Submit">
  </form>


</body>

</html>