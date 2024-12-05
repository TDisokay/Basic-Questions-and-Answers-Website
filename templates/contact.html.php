<h2>Contact Us</h2>

<form method="post" action="contact.php">
    <div class="form-group">
        <label for="subject">Subject:</label>
        <input type="text" id="subject" name="subject" required>
    </div>
    <div class="form-group">
        <label for="message">Message:</label>
        <textarea id="message" name="message" required></textarea>
    </div>
    <input type="submit" name="submit" value="Send Message" class="button">
</form>