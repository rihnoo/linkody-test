# linkody-test

1) any non-valid URLs must not be imported

  - Url column has the valid-url constraint in page table. also, the parsed value from csv get validated and store into the table.

2) it is possible in the future that we extend the Page entity and the CSV files with more fields. Write the code so there is minimal change to do in this case.
  - When you extend the Page entity and CSV file, it's supposed to add the columns in page table and update the function that store the parsed line into DB.
  
3) don’t import duplicate URLs

  - Url column has the unique constraint in page table. also, this is checked before storing into the table.

4) the Command must be able to import large volumes of URLs (~1 million) without exhausting memory and in a minimal amount of time.

  - I used the Generator to resolve this.
