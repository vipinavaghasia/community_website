<div class="sampleFormBox">
  <form action="../../controller/AddNewBookAndAuthorProcess.php" method='post' >
    <fieldset>
      <legend>
        <p class="title">Add New Author information</p>
      </legend>
      <label>Name:</label>
      <input  name="Name" type="text" tabindex="1" required>

      <label>Surname:</label>
      <input  name="Surname"type="text" tabindex="1" required>

      <label>Nationality:</label>
      <input name="Nationality" type="text" tabindex="1" required>

      <label>BirthYear:</label>
      <input name="BirthYear"type="text" tabindex="1" required>

      <label>DeathYear:</label>
      <input  name="DeathYear" type="text" tabindex="1" required>

    </fieldset>


    <fieldset>
      <legend>
        <P class="title">Add New Book </P>
      </legend>


      <label>BookTitle:</label>
      <input name="BookTitle" type="text"  tabindex="1" required>

      <label>OriginalTitle:</label>
      <input name="OriginalTitle"  type="text" tabindex="1" required>


      <label>YearofPublication:</label>
      <input name="YearofPublication"   type="text" tabindex="1"  required >

      <label>Genre :</label>
      <input name="Genre" type="text" tabindex="1" required >

      <label>MillionsSold:</label>
      <input name="MillionsSold" type="text"  tabindex="1" required>


      <label>LanguageWritten:</label>
      <input name="LanguageWritten" type="text" tabindex="1" required  >

      <label>coverImagePath:</label>
      <input  name="coverImagePath"type="text" tabindex="1" >
      <input type="submit" value="Submit">

    </fieldset>



  </form>
</div>
