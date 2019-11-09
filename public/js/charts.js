const url = "https://tini-fy.herokuapp.com/api/" + id;
let csrf = document
    .querySelector("meta[name='csrf-token']")
    .getAttribute("content");

function browsers(data) {
    var ctx = document.getElementById("browsers").getContext("2d");
    var myChart = new Chart(ctx, {
        type: "pie",
        data: {
            labels: ["Chrome", "Edge", "FireFox", "Safari", "Others"],
            datasets: [
                {
                    label: "Clicks by Browsers",
                    data: [
                        data.browsers.chrome,
                        data.browsers.edge,
                        data.browsers.firefox,
                        data.browsers.safari,
                        data.browsers.others
                    ],
                    backgroundColor: [
                        "rgba(255, 46, 28, 0.8)",
                        "rgba(35, 132, 198, 0.5)",
                        "rgba(255, 145, 71, 1)",
                        "rgba(5, 163, 255, 1)",
                        "rgba(128, 147, 149, 0.8)"
                    ],
                    borderWidth: 2
                }
            ]
        },
        options: {
            legend: {
                position: "bottom"
            }
        }
    });
}

function platforms(data) {
    var ctx = document.getElementById("platforms").getContext("2d");
    var myChart = new Chart(ctx, {
        type: "pie",
        data: {
            labels: ["Windows", "iOS", "AndroidOS", "Ubuntu", "Others"],
            datasets: [
                {
                    label: "Clicks by platforms",
                    data: [
                        data.platforms.windows,
                        data.platforms.ios,
                        data.platforms.android,
                        data.platforms.ubuntu,
                        data.platforms.others
                    ],
                    backgroundColor: [
                        "rgba(255, 46, 28, 0.8)",
                        "rgba(35, 132, 198, 0.5)",
                        "rgba(255, 145, 71, 1)",
                        "rgba(5, 163, 255, 1)",
                        "rgba(128, 147, 149, 0.8)"
                    ],
                    borderWidth: 1
                }
            ]
        },
        options: {
            legend: {
                position: "bottom"
            }
        }
    });
}

function devices(data) {
    var ctx = document.getElementById("devices").getContext("2d");
    var myChart = new Chart(ctx, {
        type: "pie",
        data: {
            labels: ["Mobile", "Tablet", "Desktop", "Others"],
            datasets: [
                {
                    label: "Clicks by Browsers",
                    data: [
                        data.devices.mobile,
                        data.devices.tablet,
                        data.devices.desktop,
                        data.devices.others
                    ],
                    backgroundColor: [
                        "rgba(255, 46, 28, 0.8)",
                        "rgba(35, 132, 198, 0.5)",
                        "rgba(255, 145, 71, 1)",
                        "rgba(5, 163, 255, 1)",
                        "rgba(128, 147, 149, 0.8)"
                    ],
                    borderWidth: 2
                }
            ]
        },
        options: {
            legend: {
                position: "bottom"
            }
        }
    });
}

let opts = { id: id };

window.onload = function() {
    fetch(url, {
        method: "POST",
        body: JSON.stringify(opts),
        headers: {
            "X-CSRF-TOKEN": csrf
        }
    })
        .then(resp => resp.json())
        .then(data => {
            devices(data);
            browsers(data);
            platforms(data);
        })
        .catch(err => console.log("An Error occured - ", err));
};
