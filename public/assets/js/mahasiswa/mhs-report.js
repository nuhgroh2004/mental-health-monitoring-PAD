let currentTab = 'mood';
let currentReportType = 'monthly';
let chart;



function getDaysInMonth(monthNumber) {
    // monthNumber adalah 1-12 dari value select
    const year = new Date().getFullYear();
    // Gunakan monthNumber - 1 karena bulan di JavaScript dimulai dari 0 (0-11)
    return new Date(year, monthNumber, 0).getDate();
  }


  function generateDailyData(selectedMonth) {
    // selectedMonth sekarang berupa angka 1-12
    const daysInMonth = getDaysInMonth(selectedMonth);
    const labels = Array.from({ length: daysInMonth }, (_, i) => `${i + 1}`);

    const dailyMoods = Array.from({ length: daysInMonth }, () => null);

    const moodData = {
      monthly: {
        labels: labels,
        datasets: [
          {
            label: 'Sangat Senang (5)',
            data: dailyMoods,
            backgroundColor: '#4dd0e1',
            stack: 'mood',
            barPercentage: 0.5
          },
          {
            label: 'Senang (4)',
            data: dailyMoods,
            backgroundColor: '#81c784',
            stack: 'mood',
            barPercentage: 0.5
          },
          {
            label: 'Biasa (3)',
            data: dailyMoods,
            backgroundColor: '#fff59d',
            stack: 'mood',
            barPercentage: 0.5
          },
          {
            label: 'Sedih (2)',
            data: dailyMoods,
            backgroundColor: '#ffb74d',
            stack: 'mood',
            barPercentage: 0.5
          },
          {
            label: 'Sangat Sedih (1)',
            data: dailyMoods,
            backgroundColor: '#e57373',
            stack: 'mood',
            barPercentage: 0.5
          }
        ]
      },
      weekly: {
        labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
        datasets: [
          {
            label: 'Sangat Senang (5)',
            data: Array.from({ length: 7 }, () => null),
            backgroundColor: '#4dd0e1',
            stack: 'mood',
            barPercentage: 0.5
          },
          {
            label: 'Senang (4)',
            data: Array.from({ length: 7 }, () => null),
            backgroundColor: '#81c784',
            stack: 'mood',
            barPercentage: 0.5
          },
          {
            label: 'Biasa (3)',
            data: Array.from({ length: 7 }, () => null),
            backgroundColor: '#fff59d',
            stack: 'mood',
            barPercentage: 0.5
          },
          {
            label: 'Sedih (2)',
            data: Array.from({ length: 7 }, () => null),
            backgroundColor: '#ffb74d',
            stack: 'mood',
            barPercentage: 0.5
          },
          {
            label: 'Sangat Sedih (1)',
            data: Array.from({ length: 7 }, () => null),
            backgroundColor: '#e57373',
            stack: 'mood',
            barPercentage: 0.5
          }
        ]
      }
    };

  // Update the datasets to show only the selected mood for each day
  moodData.monthly.datasets.forEach((dataset, index) => {
    const moodValue = 5 - index; // 5, 4, 3, 2, 1
    dataset.data = dailyMoods.map(mood => mood === moodValue ? moodValue : null);
  });

const tugasData = {
  monthly: {
    labels: labels,
    datasets: [
      {
        label: 'Target (jam)',
        data: Array.from({ length: daysInMonth }, () => 0),
        fill: true,
        backgroundColor: 'rgba(76, 175, 80, 0.6)',
        borderColor: 'rgba(76, 175, 80, 1)',
        tension: 0.4
      },
      {
        label: 'Tercapai (jam)',
        data: Array.from({ length: daysInMonth }, () => null),
        fill: true,
        backgroundColor: 'rgba(33, 150, 243, 0.6)',
        borderColor: 'rgba(33, 150, 243, 1)',
        tension: 0.4
      }
    ]
  },
  weekly: {
    labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
    datasets: [
      {
        label: 'Target (jam)',
        data: Array.from({ length: 7 }, () => 8),
        fill: true,
        backgroundColor: 'rgba(76, 175, 80, 0.6)',
        borderColor: 'rgba(76, 175, 80, 1)',
        tension: 0.4
      },
      {
        label: 'Tercapai (jam)',
        data: Array.from({ length: 7 }, () => null),
        fill: true,
        backgroundColor: 'rgba(33, 150, 243, 0.6)',
        borderColor: 'rgba(33, 150, 243, 1)',
        tension: 0.4
      }
    ]
  }
};

  return { moodData, tugasData };
}

function showTab(tab) {
  currentTab = tab;
  const moodTab = document.getElementById('moodTab');
  const tugasTab = document.getElementById('tugasTab');

  if (tab === 'mood') {
    moodTab.classList.remove('bg-gray-200', 'text-black');
    moodTab.classList.add('bg-[#76aeb8]', 'text-white');
    tugasTab.classList.remove('bg-[#76aeb8]', 'text-white');
    tugasTab.classList.add('bg-gray-200', 'text-black');
  } else {
    tugasTab.classList.remove('bg-gray-200', 'text-black');
    tugasTab.classList.add('bg-[#76aeb8]', 'text-white');
    moodTab.classList.remove('bg-[#76aeb8]', 'text-white');
    moodTab.classList.add('bg-gray-200', 'text-black');
  }

  updateChart();
}

function updateReportType() {
  currentReportType = document.getElementById('reportType').value;
  document.getElementById('reportTypeTitle').textContent =
    currentReportType === 'monthly' ? 'Bulanan' : 'Mingguan';
  document.getElementById('weekContainer').classList.toggle('hidden',
    currentReportType === 'monthly');
  updateChart();
}

function updatePeriod() {
    const selectedMonth = parseInt(document.getElementById('selectedMonth').value); // Pastikan value dikonversi ke integer
    updateChart(selectedMonth);
  }

  function updateChart(selectedMonth = parseInt(document.getElementById('selectedMonth').value)) {
    const ctx = document.getElementById('chart').getContext('2d');

  if (chart) {
    chart.destroy();
  }

  const { moodData, tugasData } = generateDailyData(selectedMonth);
  const data = currentTab === 'mood' ? moodData[currentReportType] : tugasData[currentReportType];

  const chartConfig = {
    type: currentTab === 'mood' ? 'bar' : 'line',
    data: data,
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          position: 'top',
        },
        title: {
          display: true,
          text: currentTab === 'mood' ? 'Grafik Mood Harian' : 'Progress Tugas Akhir (Jam)',
          font: {
            size: 16
          }
        },
        tooltip: {
          callbacks: {
            label: function(context) {
              if (currentTab === 'mood') {
                if (context.raw === null) return null;
                return `Mood: ${context.dataset.label}`;
              } else {
                let label = context.dataset.label || '';
                if (label) {
                  label += ': ';
                }
                label += context.parsed.y + ' jam';
                return label;
              }
            }
          }
        }
      },
      scales: {
        x: {
          stacked: currentTab === 'mood',
          title: {
            display: true,
            text: currentReportType === 'monthly' ? 'Tanggal' : 'Hari'
          }
        },
        y: {
          stacked: currentTab === 'mood',
          beginAtZero: true,
          title: {
            display: true,
            text: currentTab === 'mood' ? 'Tingkat Mood (1-5)' : 'Jam'
          },
          max: currentTab === 'mood' ? 5 : undefined,
          ticks: currentTab === 'mood' ? {
            stepSize: 1,
            callback: function(value) {
              return value;
            }
          } : undefined
        }
      },
      animation: {
        duration: 1000,
        easing: 'easeInOutQuart'
      }
    }
  };

  if (currentTab === 'tugas') {
    chartConfig.options.elements = {
      line: {
        fill: true
      }
    };
  }

  chart = new Chart(ctx, chartConfig);
}

document.addEventListener('DOMContentLoaded', () => {
  updateReportType();
  updateChart();
});

window.addEventListener('resize', () => {
  if (chart) {
    chart.resize();
  }
});
