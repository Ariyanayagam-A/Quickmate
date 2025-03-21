$(document).ready(function () {
    let data = [
        { name: "Instance Settings", url: "instance-settings.html", category: "Instance Configurations" },
        { name: "Regions", url: "regions.html", category: "Instance Configurations" },
        { name: "Sites", url: "sites.html", category: "Instance Configurations" },
        { name: "Operational Hours", url: "operational-hours.html", category: "Instance Configurations" },
        { name: "Holiday Groups", url: "holiday-groups.html", category: "Instance Configurations" },
        { name: "Unavailability Types", url: "unavailability-types.html", category: "Instance Configurations" },
        { name: "Departments", url: "departments.html", category: "Instance Configurations" },
        { name: "Organization Roles", url: "Organization-Roles.html", category: "Instance Configurations" },
        { name: "Roles", url: "roles.html", category: "Users & Permissions" },
        { name: "Users", url: "users.html", category: "Users & Permissions" },
        { name: "User Groups", url: "user-groups.html", category: "Users & Permissions" },
        { name: "Technician Groups", url: "technician-groups.html", category: "Users & Permissions" },
        { name: "Privacy Settings", url: "privacysettings.html", category: "Users & Permissions" },
        { name: "Mail Server Settings", url: "mail-server-settings.html", category: "Mail Settings" },
        { name: "Mail Addresses", url: "mail-addresses.html", category: "Mail Settings" },
        { name: "Customization", url: "customization.html", category: "Customization" }
    ];

    function showResults(searchValue = "") {
        let filteredResults = data.filter(item => item.name.toLowerCase().includes(searchValue));

        let groupedResults = {};
        filteredResults.forEach(item => {
            if (!groupedResults[item.category]) {
                groupedResults[item.category] = [];
            }
            groupedResults[item.category].push(item);
        });

        let resultHtml = "";
        for (let category in groupedResults) {
            resultHtml += `<div class="category">${category}</div>`;
            groupedResults[category].forEach(item => {
                resultHtml += `<a href="${item.url}">${item.name}</a>`;
            });
        }

        if (resultHtml) {
            $("#results").html(resultHtml).fadeIn();
        } else {
            $("#results").fadeOut();
        }
    }

    // Show dropdown when clicking inside the search box
    $("#searchBoxx").on("focus", function () {
        let searchValue = $(this).val().toLowerCase();
        showResults(searchValue);
    });

    // Update dropdown while typing
    $("#searchBoxx").on("keyup", function () {
        let searchValue = $(this).val().toLowerCase();
        showResults(searchValue);
    });

    // Click event for search results
    $(document).on("click", "#results a", function (e) {
        e.preventDefault();
        window.location.href = $(this).attr("href");
    });

    // Hide dropdown when clicking outside
    $(document).click(function (e) {
        if (!$(e.target).closest(".search-container").length) {
            $("#results").fadeOut();
        }
    });
});
