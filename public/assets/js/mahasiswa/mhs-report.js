let currentTab = 'mood';
let currentReportType = 'monthly';
let chart;

function getWeekDates(year, month, week) {
  const firstDayOfMonth = new Date(year, month - 1, 1);
  const firstDayOfWeek = firstDayOfMonth.getDay();

  // Menghitung tanggal awal minggu yang dipilih
  const startDate = new Date(year, month - 1, 1 + (week - 1) * 7 - firstDayOfWeek);
  const dates = [];

  // Mengumpulkan 7 hari untuk minggu tersebut
  for (let i = 0; i < 7; i++) {
    const currentDate = new Date(startDate);
    currentDate.setDate(startDate.getDate() + i);
    dates.push(currentDate.getDate());
  }

  return dates;
}

function processChartData(chartData, year, month, week = null) {
  // Process Monthly Data
  const monthlyMoodData = {
    labels: chartData.labels,
    datasets: [
      {
        label: 'Senang (4)',
        data: chartData.labels.map(day => {
          const dayMood = chartData.mood[day];
          return dayMood && dayMood.mood_level === 4 ? dayMood.mood_intensity : null;
        }),
        backgroundColor: '#81c784',
        stack: 'mood',
        barPercentage: 0.5
      },
      {
        label: 'Biasa (3)',
        data: chartData.labels.map(day => {
          const dayMood = chartData.mood[day];
          return dayMood && dayMood.mood_level === 3 ? dayMood.mood_intensity : null;
        }),
        backgroundColor: '#fff59d',
        stack: 'mood',
        barPercentage: 0.5
      },
      {
        label: 'Sedih (2)',
        data: chartData.labels.map(day => {
          const dayMood = chartData.mood[day];
          return dayMood && dayMood.mood_level === 2 ? dayMood.mood_intensity : null;
        }),
        backgroundColor: '#ffb74d',
        stack: 'mood',
        barPercentage: 0.5
      },
      {
        label: 'Marah (1)',
        data: chartData.labels.map(day => {
          const dayMood = chartData.mood[day];
          return dayMood && dayMood.mood_level === 1 ? dayMood.mood_intensity : null;
        }),
        backgroundColor: '#e57373',
        stack: 'mood',
        barPercentage: 0.5
      }
    ]
  };

  const monthlyTugasData = {
    labels: chartData.labels,
    datasets: [
      {
        label: 'Target (jam)',
        data: chartData.labels.map(day => {
          const dayProgress = chartData.progress[day];
          return dayProgress ? dayProgress.expected_target : null;
        }),
        fill: true,
        backgroundColor: 'rgba(76, 175, 80, 0.6)',
        borderColor: 'rgba(76, 175, 80, 1)',
        tension: 0.4
      },
      {
        label: 'Tercapai (jam)',
        data: chartData.labels.map(day => {
          const dayProgress = chartData.progress[day];
          return dayProgress ? dayProgress.actual_target : null;
        }),
        fill: true,
        backgroundColor: 'rgba(33, 150, 243, 0.6)',
        borderColor: 'rgba(33, 150, 243, 1)',
        tension: 0.4
      }
    ]
  };

  // Process Weekly Data
  const weekDates = week ? getWeekDates(year, month, parseInt(week)) : [];
  const weekDayNames = ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'];

  const weeklyMoodData = {
    labels: weekDayNames,
    datasets: monthlyMoodData.datasets.map(dataset => ({
      ...dataset,
      data: weekDates.map(day => {
        const dayMood = chartData.mood[day];
        if (!dayMood) return null;
        const moodLevel = parseInt(dataset.label.match(/\d+/)[0]);
        return dayMood.mood_level === moodLevel ? moodLevel : null;
      })
    }))
  };

  const weeklyTugasData = {
    labels: weekDayNames,
    datasets: monthlyTugasData.datasets.map(dataset => ({
      ...dataset,
      data: weekDates.map(day => {
        const dayProgress = chartData.progress[day];
        if (!dayProgress) return null;
        return dataset.label.includes('Target') ?
          dayProgress.expected_target :
          dayProgress.actual_target;
      })
    }))
  };

  return {
    moodData: {
      monthly: monthlyMoodData,
      weekly: weeklyMoodData
    },
    tugasData: {
      monthly: monthlyTugasData,
      weekly: weeklyTugasData
    }
  };
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

function updateChart() {
  const ctx = document.getElementById('chart').getContext('2d');
  if (chart) {
    chart.destroy();
  }

  const selectedMonth = parseInt(document.getElementById('selectedMonth').value);
  const selectedWeek = document.getElementById('selectedWeek').value;
  const year = new Date().getFullYear();

  const { moodData, tugasData } = processChartData(
    chartData,
    year,
    selectedMonth,
    currentReportType === 'weekly' ? selectedWeek : null
  );

  const data = currentTab === 'mood' ?
    moodData[currentReportType] :
    tugasData[currentReportType];

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
          text: `${currentTab === 'mood' ? 'Grafik Mood' : 'Progress Tugas Akhir'} ${currentReportType === 'monthly' ? 'Bulanan' : 'Mingguan'}`,
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
            text: currentTab === 'mood' ? 'Tingkat Mood' : 'Jam'
          },
          max: currentTab === 'mood'
            ? Math.max(5, ...chartData.labels.map(day => {
                const dayMood = chartData.mood[day];
                return dayMood ? dayMood.mood_intensity : 0;
            }))
            : undefined, // Ambil nilai terbesar, tapi minimal 5
          ticks: currentTab === 'mood' ? {
            stepSize: 1,
            callback: function(value) {
              return value;
            }
          } : undefined
        }
      }
    }
  };

  chart = new Chart(ctx, chartConfig);
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
  const selectedMonth = parseInt(document.getElementById('selectedMonth').value);
  const year = new Date().getFullYear();
  window.location.href = `${window.location.pathname}?month=${selectedMonth}&year=${year}`;
}

// Event Listeners
document.addEventListener('DOMContentLoaded', () => {
  updateChart();
});

window.addEventListener('resize', () => {
  if (chart) {
    chart.resize();
  }
});
