<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tenorium Feedback widget</title>

    @vite(['resources/sass/widget.scss', 'resources/js/widget.js'])
</head>
<body class="col">
<header>
    <h2 class="text">Feedback form</h2>
</header>
<main class="col">
    <form class="form col">
        <div class="col mb-10">
            <label for="text">Name:<sup class="required">*</sup>
            </label>
            <input type="text" id="name" class="text-input" name="name" required>
        </div>
        <div class="col mb-10">
            <label for="email">Email:<sup class="required">*</sup>
            </label>
            <input type="email" id="email" class="text-input" name="email" required>
        </div>
        <div class="col mb-10">
            <label for="phone">Phone number:</label>
            <input type="tel" id="phone-number" class="text-input" name="phone" pattern="{{ trim(config('validation.phoneRegex'), '/') }}">
        </div>
        <div class="col mb-10">
            <label for="subject">Subject:<sup class="required">*</sup>
            </label>
            <input type="text" id="subject" class="text-input" name="subject" required>
        </div>
        <div class="col mb-10">
            <label for="text">Text:<sup class="required">*</sup>
            </label>
            <textarea id="text" class="text-input" name="text" required></textarea>
        </div>
        <input class="mb-10" type="file" id="files" name="files[]" data-max-count="{{ config('validation.maxFileCount') }}" data-max-size="{{ config('validation.maxFileSize') }}" multiple >
        <div class="alert" hidden></div>
        <button type="submit" id="submit">Submit</button>
    </form>
</main>
<script>
    window.API_URL = "{{ route('api.tickets.create') }}";
</script>
</body>
</html>

