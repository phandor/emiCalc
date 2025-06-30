<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>EmiCalc</title>
  <link rel="icon" href="<?php echo e(asset('emicalc-icon.png')); ?>" type="image/png" />
  <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>
</head>
<body class="bg-gray-100">

  <div class="max-w-4xl mx-auto p-4">
    <div class="text-center mb-6">
      <h1 class="text-3xl font-bold text-green-500">EmiCalc</h1>
      <p class="text-lg text-green-700">Emission Calculator</p>
    </div>

    <?php if(session('error')): ?>
      <div class="bg-red-200 text-red-800 p-3 rounded mb-4">
        <?php echo e(session('error')); ?>

      </div>
    <?php endif; ?>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <!-- Form -->
      <div class="bg-white p-4 rounded shadow">
        <h2 class="text-xl font-semibold text-green-700 mb-4">Calculate Your Emissions</h2>
        <form action="<?php echo e(route('emissions.calculate')); ?>" method="POST" class="space-y-4">
          <?php echo csrf_field(); ?>
          <div>
            <label for="name" class="block text-sm">Name</label>
            <input type="text" id="name" name="name" placeholder="Your name" class="w-full border rounded px-2 py-1" value="<?php echo e(old('name')); ?>" />
          </div>

          <div>
            <label for="position" class="block text-sm">Position</label>
            <input type="text" id="position" name="position" placeholder="For example: salesperson, manager..." class="w-full border rounded px-2 py-1" value="<?php echo e(old('position')); ?>" />
          </div>

          <div>
            <label for="facility" class="block text-sm">Facility</label>
            <input type="text" id="facility" name="facility" placeholder="For example: research lab, computing..." class="w-full border rounded px-2 py-1" value="<?php echo e(old('facility')); ?>" />
          </div>

          <div>
            <label for="meansOfTransport" class="block text-sm">Means of Transport</label>
            <select id="meansOfTransport" name="meansOfTransport" class="w-full border rounded px-2 py-1">
              <option value="">Select</option>
              <option value="diesel" <?php echo e(old('meansOfTransport') == 'diesel' ? 'selected' : ''); ?>>Diesel</option>
              <option value="gasoline" <?php echo e(old('meansOfTransport') == 'gasoline' ? 'selected' : ''); ?>>Gasoline</option>
              <option value="electric" <?php echo e(old('meansOfTransport') == 'electric' ? 'selected' : ''); ?>>Electric</option>
              <option value="scooter" <?php echo e(old('meansOfTransport') == 'scooter' ? 'selected' : ''); ?>>E-Scooter</option>
              <option value="bus" <?php echo e(old('meansOfTransport') == 'bus' ? 'selected' : ''); ?>>Bus</option>
              <option value="train" <?php echo e(old('meansOfTransport') == 'train' ? 'selected' : ''); ?>>Train</option>
            </select>
          </div>

          <div>
            <label for="km" class="block text-sm">Distance (km)</label>
            <input type="number" id="km" name="km" placeholder="Enter the distance in kilometre"  min="0" step="0.1" class="w-full border rounded px-2 py-1" value="<?php echo e(old('km')); ?>" />
          </div>

          <button type="submit" class="bg-green-400 text-white px-4 py-2 rounded">
            Calculate
          </button>
        </form>
      </div>

      <!-- Results -->
      <div class="bg-white p-4 rounded shadow">
        <h2 class="text-xl font-semibold text-green-700 mb-4">Your Emission Results</h2>

        <?php if(session('result')): ?>
          <div class="bg-green-100 p-3 rounded mb-4">
            <p><strong>Name:</strong> <?php echo e(session('result.name')); ?></p>
            <p><strong>Position:</strong> <?php echo e(session('result.position')); ?></p>
            <p><strong>Facility:</strong> <?php echo e(session('result.facility')); ?></p>
            <p><strong>Transport:</strong> <?php echo e(session('result.transportName')); ?></p>
          </div>

          <div class="bg-green-100 p-3 rounded">
            <p><strong>Distance:</strong> <?php echo e(number_format(session('result.km'), 1)); ?> km</p>
            <p><strong>CO₂ Emissions:</strong> <?php echo e(number_format(session('result.emission'), 2)); ?> kg</p>

            <?php
              $percentage = min(100, max(5, (session('result.emission') / 20) * 100));
            ?>

            <div class="h-4 bg-gray-300 rounded mt-2">
              <div class="h-4 bg-green-400 rounded" style="width: <?php echo e($percentage); ?>%"></div>
            </div>
            <p class="text-xs text-gray-600 mt-1"><?php echo e(round($percentage)); ?>% of reference</p>
          </div>
        <?php else: ?>
          <p class="text-gray-500 text-center mt-8">Your emission results will appear here after calculation.</p>
        <?php endif; ?>
      </div>
    </div>
  </div>

</body>
</html>
<?php /**PATH C:\Users\Dorella\Desktop\folder3\emiCalc\resources\views/home.blade.php ENDPATH**/ ?>