/**
 * Dashboard Analytics
 */

"use strict";

(function () {
  let cardColor, headingColor, axisColor, shadeColor, borderColor;

  cardColor = config.colors.white;
  headingColor = config.colors.headingColor;
  axisColor = config.colors.axisColor;
  borderColor = config.colors.borderColor;

  // Total Revenue Report Chart - Bar Chart
  // --------------------------------------------------------------------
  const totalRevenueChartEl = document.querySelector("#totalRevenueChart"),
    totalRevenueChartOptions = {
      series: [
        {
          name: "2021",
          data: [18, 7, 15, 29, 18, 12, 9],
        },
        {
          name: "2020",
          data: [-13, -18, -9, -14, -5, -17, -15],
        },
      ],
      chart: {
        height: 300,
        stacked: true,
        type: "bar",
        toolbar: { show: false },
      },
      plotOptions: {
        bar: {
          horizontal: false,
          columnWidth: "33%",
          borderRadius: 12,
          startingShape: "rounded",
          endingShape: "rounded",
        },
      },
      colors: [config.colors.primary, config.colors.info],
      dataLabels: {
        enabled: false,
      },
      stroke: {
        curve: "smooth",
        width: 6,
        lineCap: "round",
        colors: [cardColor],
      },
      legend: {
        show: true,
        horizontalAlign: "left",
        position: "top",
        markers: {
          height: 8,
          width: 8,
          radius: 12,
          offsetX: -3,
        },
        labels: {
          colors: axisColor,
        },
        itemMargin: {
          horizontal: 10,
        },
      },
      grid: {
        borderColor: borderColor,
        padding: {
          top: 0,
          bottom: -8,
          left: 20,
          right: 20,
        },
      },
      xaxis: {
        categories: ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul"],
        labels: {
          style: {
            fontSize: "13px",
            colors: axisColor,
          },
        },
        axisTicks: {
          show: false,
        },
        axisBorder: {
          show: false,
        },
      },
      yaxis: {
        labels: {
          style: {
            fontSize: "13px",
            colors: axisColor,
          },
        },
      },
      responsive: [
        {
          breakpoint: 1700,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: "32%",
              },
            },
          },
        },
        {
          breakpoint: 1580,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: "35%",
              },
            },
          },
        },
        {
          breakpoint: 1440,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: "42%",
              },
            },
          },
        },
        {
          breakpoint: 1300,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: "48%",
              },
            },
          },
        },
        {
          breakpoint: 1200,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: "40%",
              },
            },
          },
        },
        {
          breakpoint: 1040,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 11,
                columnWidth: "48%",
              },
            },
          },
        },
        {
          breakpoint: 991,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: "30%",
              },
            },
          },
        },
        {
          breakpoint: 840,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: "35%",
              },
            },
          },
        },
        {
          breakpoint: 768,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: "28%",
              },
            },
          },
        },
        {
          breakpoint: 640,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: "32%",
              },
            },
          },
        },
        {
          breakpoint: 576,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: "37%",
              },
            },
          },
        },
        {
          breakpoint: 480,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: "45%",
              },
            },
          },
        },
        {
          breakpoint: 420,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: "52%",
              },
            },
          },
        },
        {
          breakpoint: 380,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: "60%",
              },
            },
          },
        },
      ],
      states: {
        hover: {
          filter: {
            type: "none",
          },
        },
        active: {
          filter: {
            type: "none",
          },
        },
      },
    };
  if (
    typeof totalRevenueChartEl !== undefined &&
    totalRevenueChartEl !== null
  ) {
    const totalRevenueChart = new ApexCharts(
      totalRevenueChartEl,
      totalRevenueChartOptions
    );
    totalRevenueChart.render();
  }

  // Growth Chart - Radial Bar Chart
  // --------------------------------------------------------------------
  const growthChartEl = document.querySelector("#growthChart"),
    growthChartOptions = {
      series: [78],
      labels: ["Produzido"],
      chart: {
        height: 240,
        type: "radialBar",
      },
      plotOptions: {
        radialBar: {
          size: 150,
          offsetY: 10,
          startAngle: -150,
          endAngle: 150,
          hollow: {
            size: "55%",
          },
          track: {
            background: cardColor,
            strokeWidth: "100%",
          },
          dataLabels: {
            name: {
              offsetY: 15,
              color: headingColor,
              fontSize: "15px",
              fontWeight: "600",
              fontFamily: "Public Sans",
            },
            value: {
              offsetY: -25,
              color: headingColor,
              fontSize: "22px",
              fontWeight: "500",
              fontFamily: "Public Sans",
            },
          },
        },
      },
      colors: [config.colors.primary],
      fill: {
        type: "gradient",
        gradient: {
          shade: "dark",
          shadeIntensity: 0.5,
          gradientToColors: [config.colors.primary],
          inverseColors: true,
          opacityFrom: 1,
          opacityTo: 0.6,
          stops: [30, 70, 100],
        },
      },
      stroke: {
        dashArray: 5,
      },
      grid: {
        padding: {
          top: -35,
          bottom: -10,
        },
      },
      states: {
        hover: {
          filter: {
            type: "none",
          },
        },
        active: {
          filter: {
            type: "none",
          },
        },
      },
    };
  if (typeof growthChartEl !== undefined && growthChartEl !== null) {
    const growthChart = new ApexCharts(growthChartEl, growthChartOptions);
    growthChart.render();
  }

  // Profit Report Line Chart
  // --------------------------------------------------------------------
  const profileReportChartEl = document.querySelector("#profileReportChart"),
    profileReportChartConfig = {
      chart: {
        height: 80,
        // width: 175,
        type: "line",
        toolbar: {
          show: false,
        },
        dropShadow: {
          enabled: true,
          top: 10,
          left: 5,
          blur: 3,
          color: config.colors.warning,
          opacity: 0.15,
        },
        sparkline: {
          enabled: true,
        },
      },
      grid: {
        show: false,
        padding: {
          right: 8,
        },
      },
      colors: [config.colors.warning],
      dataLabels: {
        enabled: false,
      },
      stroke: {
        width: 5,
        curve: "smooth",
      },
      series: [
        {
          data: [13, 17, 15, 14, 16, 15],
        },
      ],
      xaxis: {
        show: false,
        lines: {
          show: false,
        },
        labels: {
          show: false,
        },
        axisBorder: {
          show: false,
        },
      },
      yaxis: {
        show: false,
      },
    };
  if (
    typeof profileReportChartEl !== undefined &&
    profileReportChartEl !== null
  ) {
    const profileReportChart = new ApexCharts(
      profileReportChartEl,
      profileReportChartConfig
    );
    profileReportChart.render();
  }
 
    // Função para obter o valor do span com um determinado ID
    function obterValor(id) {
        var span = document.getElementById(id);
        if (span) {
            // Remove pontos de milhares e converte para número inteiro
            return parseInt(span.textContent.replace(/\./g, ''));
        }
        return 0; // Retorna 0 se o elemento não for encontrado
    }

    // Obtém os valores para cada ano
    
      // ORCAMENTO
    const QtdP0 = obterValor('QtdP0');
    const QtdPo1 = obterValor('QtdPo1');
    const QtdPo2 = obterValor('QtdPo2');
    const QtdPo3 = obterValor('QtdPo3');
    const QtdPo4 = obterValor('QtdPo4');
    const QtdPo5 = obterValor('QtdPo5');
    //// PRODUCAO
    const QtdPP = obterValor('QtdPP');
    const QtdPP1 = obterValor('QtdPP1');
    const QtdPP2 = obterValor('QtdPP2');
    const QtdPP3 = obterValor('QtdPP3');
    const QtdPP4 = obterValor('QtdPP4');
    const QtdPP5 = obterValor('QtdPP5');
     //// Blocos
     const Qtdbloo1 = obterValor('Qtdbloo1');
     const Qtdbloo2 = obterValor('Qtdbloo2');
     const Qtdbloo3 = obterValor('Qtdbloo3');
     const Qtdbloo4 = obterValor('Qtdbloo4');
     const Qtdbloo5 = obterValor('Qtdbloo5');
     const Qtdbloo6 = obterValor('Qtdbloo6');
     //// LIVROS
     const QtdLIVRO1 = obterValor('QtdLIVRO1');
     const QtdLIVRO2 = obterValor('QtdLIVRO2');
     const QtdLIVRO3 = obterValor('QtdLIVRO3');
     const QtdLIVRO4 = obterValor('QtdLIVRO4');
     const QtdLIVRO5 = obterValor('QtdLIVRO5');
     const QtdLIVRO6 = obterValor('QtdLIVRO6');
      //// FOLHA
      const QtdFOLHA1 = obterValor('QtdFOLHA1');
      const QtdFOLHA2 = obterValor('QtdFOLHA2');
      const QtdFOLHA3 = obterValor('QtdFOLHA3');
      const QtdFOLHA4 = obterValor('QtdFOLHA4');
      const QtdFOLHA5 = obterValor('QtdFOLHA5');
      const QtdFOLHA6 = obterValor('QtdFOLHA6');
  /// QUANTITATIVOS
  const QtdPos = document.querySelector("#Qtd_PO"),
  QtdPo = {
    chart: {
      height: 80,
      // width: 175,
      type: "line",
      toolbar: {
        show: false,
      },
      dropShadow: {
        enabled: true,
        top: 10,
        left: 5,
        blur: 3,
        color: config.colors.warning,
        opacity: 0.15,
      },
      sparkline: {
        enabled: true,
      },
    },
    grid: {
      show: false,
      padding: {
        right: 8,
      },
    },
    colors: [config.colors.warning],
    dataLabels: {
      enabled: false,
    },
    stroke: {
      width: 5,
      curve: "smooth",
    },
    series: [
      {
        data: [QtdP0, QtdPo1, QtdPo2, QtdPo3, QtdPo4, QtdPo5]
      },
    ],
    xaxis: {
      show: false,
      lines: {
        show: false,
      },
      labels: {
        show: false,
      },
      axisBorder: {
        show: false,
      },
    },
    yaxis: {
      show: false,
    },
  };
  if (
  typeof QtdPos !== undefined &&
  QtdPos !== null
  ) {
  const profileReportChart = new ApexCharts(
    QtdPos,
    QtdPo
  );
  profileReportChart.render();
  }
  // PRODUÇÃO
  const QtdOps = document.querySelector("#Qtd_Op"),
  QtdOp = {
    chart: {
      height: 80,
      // width: 175,
      type: "line",
      toolbar: {
        show: false,
      },
      dropShadow: {
        enabled: true,
        top: 10,
        left: 5,
        blur: 3,
        color: config.colors.warning,
        opacity: 0.15,
      },
      sparkline: {
        enabled: true,
      },
    },
    grid: {
      show: false,
      padding: {
        right: 8,
      },
    },
    colors: [config.colors.warning],
    dataLabels: {
      enabled: false,
    },
    stroke: {
      width: 5,
      curve: "smooth",
    },
    series: [
      {
        data: [QtdPP, QtdPP1, QtdPP2, QtdPP3, QtdPP4, QtdPP5]
      },
    ],
    xaxis: {
      show: false,
      lines: {
        show: false,
      },
      labels: {
        show: false,
      },
      axisBorder: {
        show: false,
      },
    },
    yaxis: {
      show: false,
    },
  };
  if (
  typeof QtdOps !== undefined &&
  QtdOps !== null
  ) {
  const profileReportChart = new ApexCharts(
    QtdOps,
    QtdOp
  );
  profileReportChart.render();
  }
  /// BLOCOS
  const Qtdblocos = document.querySelector("#Qtd_Blocs"),
  Qtdbloco = {
    chart: {
      height: 80,
      // width: 175,
      type: "line",
      toolbar: {
        show: false,
      },
      dropShadow: {
        enabled: true,
        top: 10,
        left: 5,
        blur: 3,
        color: config.colors.warning,
        opacity: 0.15,
      },
      sparkline: {
        enabled: true,
      },
    },
    grid: {
      show: false,
      padding: {
        right: 8,
      },
    },
    colors: [config.colors.warning],
    dataLabels: {
      enabled: false,
    },
    stroke: {
      width: 5,
      curve: "smooth",
    },
    series: [
      {
        data: [Qtdbloo1, Qtdbloo4, Qtdbloo2, Qtdbloo3, Qtdbloo5, Qtdbloo6]
      },
    ],
    xaxis: {
      show: false,
      lines: {
        show: false,
      },
      labels: {
        show: false,
      },
      axisBorder: {
        show: false,
      },
    },
    yaxis: {
      show: false,
    },
  };
  if (
  typeof Qtdblocos !== undefined &&
  Qtdblocos !== null
  ) {
  const profileReportChart = new ApexCharts(
    Qtdblocos,
    Qtdbloco
  );
  profileReportChart.render();
  }
/// LIVROS
const Qtdlivros = document.querySelector("#Qtd_livors"),
Qtdlivro = {
  chart: {
    height: 80,
    // width: 175,
    type: "line",
    toolbar: {
      show: false,
    },
    dropShadow: {
      enabled: true,
      top: 10,
      left: 5,
      blur: 3,
      color: config.colors.warning,
      opacity: 0.15,
    },
    sparkline: {
      enabled: true,
    },
  },
  grid: {
    show: false,
    padding: {
      right: 8,
    },
  },
  colors: [config.colors.warning],
  dataLabels: {
    enabled: false,
  },
  stroke: {
    width: 5,
    curve: "smooth",
  },
  series: [
    {
      data: [QtdLIVRO1, QtdLIVRO4, QtdLIVRO2, QtdLIVRO3, QtdLIVRO5, QtdLIVRO6]
    },
  ],
  xaxis: {
    show: false,
    lines: {
      show: false,
    },
    labels: {
      show: false,
    },
    axisBorder: {
      show: false,
    },
  },
  yaxis: {
    show: false,
  },
};
if (
typeof Qtdlivros !== undefined &&
Qtdlivros !== null
) {
const profileReportChart = new ApexCharts(
  Qtdlivros,
  Qtdlivro
);
profileReportChart.render();
}
/// FOLHAS/// LIVROS
const Qtdfolhas = document.querySelector("#Qtd_folhas"),
Qtdfolha = {
  chart: {
    height: 80,
    // width: 175,
    type: "line",
    toolbar: {
      show: false,
    },
    dropShadow: {
      enabled: true,
      top: 10,
      left: 5,
      blur: 3,
      color: config.colors.warning,
      opacity: 0.15,
    },
    sparkline: {
      enabled: true,
    },
  },
  grid: {
    show: false,
    padding: {
      right: 8,
    },
  },
  colors: [config.colors.warning],
  dataLabels: {
    enabled: false,
  },
  stroke: {
    width: 5,
    curve: "smooth",
  },
  series: [
    {
      data: [QtdFOLHA1, QtdFOLHA4, QtdFOLHA2, QtdFOLHA3, QtdFOLHA5, QtdFOLHA6]
    },
  ],
  xaxis: {
    show: false,
    lines: {
      show: false,
    },
    labels: {
      show: false,
    },
    axisBorder: {
      show: false,
    },
  },
  yaxis: {
    show: false,
  },
};
if (
typeof Qtdfolhas !== undefined &&
Qtdfolhas !== null
) {
const profileReportChart = new ApexCharts(
  Qtdfolhas,
  Qtdfolha
);
profileReportChart.render();
}


  ///
  // Order Statistics Chart
  // --------------------------------------------------------------------
  const chartOrderStatistics = document.querySelector("#orderStatisticsChart"),
    orderChartConfig = {
      chart: {
        height: 165,
        width: 130,
        type: "donut",
      },
      labels: ["Impressora2", "Impressora3", "Plotter", "Impressora1"],
      series: [85, 15, 50, 50],
      colors: [
        config.colors.primary,
        config.colors.secondary,
        config.colors.info,
        config.colors.success,
      ],
      stroke: {
        width: 5,
        colors: cardColor,
      },
      dataLabels: {
        enabled: false,
        formatter: function (val, opt) {
          return parseInt(val) + "%";
        },
      },
      legend: {
        show: false,
      },
      grid: {
        padding: {
          top: 0,
          bottom: 0,
          right: 15,
        },
      },
      plotOptions: {
        pie: {
          donut: {
            size: "75%",
            labels: {
              show: true,
              value: {
                fontSize: "1.5rem",
                fontFamily: "Public Sans",
                color: headingColor,
                offsetY: -15,
                formatter: function (val) {
                  return parseInt(val) + "%";
                },
              },
              name: {
                offsetY: 20,
                fontFamily: "Public Sans",
              },
              total: {
                show: true,
                fontSize: "0.8125rem",
                color: axisColor,
                label: "Plotter",
                formatter: function (w) {
                  return "38%";
                },
              },
            },
          },
        },
      },
    };
  if (
    typeof chartOrderStatistics !== undefined &&
    chartOrderStatistics !== null
  ) {
    const statisticsChart = new ApexCharts(
      chartOrderStatistics,
      orderChartConfig
    );
    statisticsChart.render();
  }

  // Income Chart - Area chart
  // --------------------------------------------------------------------
  const incomeChartEl = document.querySelector("#incomeChart"),
    incomeChartConfig = {
      series: [
        {
          data: [24, 21, 30, 22, 42, 26, 35, 29],
        },
      ],
      chart: {
        height: 215,
        parentHeightOffset: 0,
        parentWidthOffset: 0,
        toolbar: {
          show: false,
        },
        type: "area",
      },
      dataLabels: {
        enabled: false,
      },
      stroke: {
        width: 2,
        curve: "smooth",
      },
      legend: {
        show: false,
      },
      markers: {
        size: 6,
        colors: "transparent",
        strokeColors: "transparent",
        strokeWidth: 4,
        discrete: [
          {
            fillColor: config.colors.white,
            seriesIndex: 0,
            dataPointIndex: 7,
            strokeColor: config.colors.primary,
            strokeWidth: 2,
            size: 6,
            radius: 8,
          },
        ],
        hover: {
          size: 7,
        },
      },
      colors: [config.colors.primary],
      fill: {
        type: "gradient",
        gradient: {
          shade: shadeColor,
          shadeIntensity: 0.6,
          opacityFrom: 0.5,
          opacityTo: 0.25,
          stops: [0, 95, 100],
        },
      },
      grid: {
        borderColor: borderColor,
        strokeDashArray: 3,
        padding: {
          top: -20,
          bottom: -8,
          left: -10,
          right: 8,
        },
      },
      xaxis: {
        categories: ["", "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul"],
        axisBorder: {
          show: false,
        },
        axisTicks: {
          show: false,
        },
        labels: {
          show: true,
          style: {
            fontSize: "13px",
            colors: axisColor,
          },
        },
      },
      yaxis: {
        labels: {
          show: false,
        },
        min: 10,
        max: 50,
        tickAmount: 4,
      },
    };
  if (typeof incomeChartEl !== undefined && incomeChartEl !== null) {
    const incomeChart = new ApexCharts(incomeChartEl, incomeChartConfig);
    incomeChart.render();
  }

  // Expenses Mini Chart - Radial Chart
  // --------------------------------------------------------------------
  const weeklyExpensesEl = document.querySelector("#expensesOfWeek"),
    weeklyExpensesConfig = {
      series: [65],
      chart: {
        width: 60,
        height: 60,
        type: "radialBar",
      },
      plotOptions: {
        radialBar: {
          startAngle: 0,
          endAngle: 360,
          strokeWidth: "8",
          hollow: {
            margin: 2,
            size: "45%",
          },
          track: {
            strokeWidth: "50%",
            background: borderColor,
          },
          dataLabels: {
            show: true,
            name: {
              show: false,
            },
            value: {
              formatter: function (val) {
                return "$" + parseInt(val);
              },
              offsetY: 5,
              color: "#697a8d",
              fontSize: "13px",
              show: true,
            },
          },
        },
      },
      fill: {
        type: "solid",
        colors: config.colors.primary,
      },
      stroke: {
        lineCap: "round",
      },
      grid: {
        padding: {
          top: -10,
          bottom: -15,
          left: -10,
          right: -10,
        },
      },
      states: {
        hover: {
          filter: {
            type: "none",
          },
        },
        active: {
          filter: {
            type: "none",
          },
        },
      },
    };
  if (typeof weeklyExpensesEl !== undefined && weeklyExpensesEl !== null) {
    const weeklyExpenses = new ApexCharts(
      weeklyExpensesEl,
      weeklyExpensesConfig
    );
    weeklyExpenses.render();
  }
})();
