document.addEventListener('DOMContentLoaded', function() {
  const chart = initChart();
  dealWithSelect(chart)
});


function initChart() {
  const ctx = document.getElementById('myChart').getContext('2d');
  return new Chart(ctx, {
    type: 'bar',
    data: {
      labels: getLast6Hours(),
      datasets: [{
        label: 'Temperature de la salle',
        data: [23, 19, 21.4, 22, 19, 20,18.8],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });

}

function getLast6Hours() {
  const hour = new Date()
  const hours = [hour.getHours(), hour.getHours()-1,hour.getHours()-2,hour.getHours()-3,hour.getHours()-4,hour.getHours()-5,hour.getHours()-6]

  return hours.reverse()
}

function dealWithSelect(chart) {
  const select = document.querySelector("#capteur")
  select.addEventListener('change', function(evt) {
    const el = evt.currentTarget
    if (el.value === "sound") {
      chart.data.datasets = [{
        label: 'Db dans la salle',
        data: ["50","45","33","32","41","26"],
        borderWidth: 1
      }]
    } else if (el.value === "temp") {
      chart.data.datasets = [{
        label: 'Temperature de la salle',
        data: [23, 19, 21.4, 22, 19, 20,18.8],
        borderWidth: 1
      }]
    } else if (el.value === "all") {
      chart.data = {
        datasets: [{
          type: 'line',
          label: 'Db dans la salle',
          data: ["50","45","33","32","41","26"],
        }, {
          type: 'bar',
          label: 'Temperature de la salle',
          data: [23, 19, 21.4, 22, 19, 20,18.8],
        }],
          labels: getLast6Hours()
      }

    }
    chart.update();
  })
}
export default initChart;
