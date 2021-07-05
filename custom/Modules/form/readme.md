### Manual

**sample for creating dynamic form**

sample:
```html
<link rel="stylesheet" href="assets/css/bootstrap.css">
```
```php
$arrayForm[] = array(
    'Ime',     // label
    'ime',     // name
    'Priimek', // label
    'priimek', // name
    'Email',   // label
    'Email',   // name
    'Tel',     // label
    'tel'      // name
   );

echo form($arrayForm, 'contact-form', 'col-sm-5' , null);
//arrayForm[],   styleForm,   styleInput,  post to file(null = this file or "index.php")

if ($_POST['form']) {
  echo $_POST['ime'];
  echo "<br>";
  echo $_POST['priimek'];
  echo "<br>";
  echo $_POST['Email'];
  echo "<br>";
  echo $_POST['tel'];
}
```
