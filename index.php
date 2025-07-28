<!DOCTYPE html>
<html>
<head>
  <title>Robot Arm Control Panel</title>
  <style>
    body { font-family: Arial; padding: 20px; }
    input[type=range] { width: 200px; margin-bottom: 10px; }
    table, th, td { border: 1px solid #999; border-collapse: collapse; padding: 8px; text-align: center; }
    table { margin-top: 20px; width: 100%; }
    button { margin-right: 5px; }
  </style>
</head>
<body>

  <h2>🤖 Robot Arm Control Panel</h2>

  <?php $motors = ['motor1','motor2','motor3','motor4','motor5','motor6']; ?>

  <?php foreach ($motors as $index => $motor): ?>
    <label>Motor <?= $index + 1 ?>:</label>
    <input type="range" min="0" max="180" value="90" id="<?= $motor ?>">
    <span id="<?= $motor ?>_val">90</span><br>
  <?php endforeach; ?>

  <br>
  <button onclick="resetSliders()">Reset</button>
  <button onclick="savePose()">Save Pose</button>
  <button onclick="runPose()">Run</button>

  <h3>💾 Saved Poses</h3>
  <table>
    <thead>
      <tr>
        <th>#</th>
        <?php foreach ($motors as $m): ?>
          <th><?= ucfirst($m) ?></th>
        <?php endforeach; ?>
        <th>Action</th>
      </tr>
    </thead>
    <tbody id="poseTable"></tbody>
  </table>

<script>
  const motors = ['motor1','motor2','motor3','motor4','motor5','motor6'];

  motors.forEach(m => {
    let slider = document.getElementById(m);
    let val = document.getElementById(m + '_val');
    slider.oninput = () => val.textContent = slider.value;
  });

  function resetSliders() {
    motors.forEach(m => {
      document.getElementById(m).value = 90;
      document.getElementById(m + '_val').textContent = 90;
    });
  }

  function savePose() {
    const data = Object.fromEntries(motors.map(m => [m, document.getElementById(m).value]));
    fetch('save_pose.php', {
      method: 'POST',
      headers: {'Content-Type': 'application/json'},
      body: JSON.stringify(data)
    }).then(() => location.reload());
  }

  function loadPose(pose) {
    motors.forEach(m => {
      document.getElementById(m).value = pose[m];
      document.getElementById(m + '_val').textContent = pose[m];
    });
  }

  function removePose(id) {
    fetch(`remove_pose.php?id=${id}`).then(() => location.reload());
  }

  function runPose() {
    fetch('get_run_pose.php')
      .then(r => r.json())
      .then(pose => {
        if (pose) loadPose(pose);
      });
  }

  fetch('get_poses.php')
    .then(r => r.json())
    .then(poses => {
      const table = document.getElementById('poseTable');
      poses.forEach((p, i) => {
        const row = `<tr>
          <td>${i+1}</td>
          ${motors.map(m => `<td>${p[m]}</td>`).join('')}
          <td>
            <button onclick='loadPose(${JSON.stringify(p)})'>Load</button>
            <button onclick='removePose(${p.id})'>Remove</button>
          </td>
        </tr>`;
        table.innerHTML += row;
      });
    });
</script>

</body>
</html>
