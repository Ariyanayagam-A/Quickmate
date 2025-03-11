<?php 
$ldap_server = 'ldap://10.0.0.5'; // or 'ldap://20.168.243.12' for non-SSL
$ldap_port = 389; // Use 389 for non-SSL

$connection = ldap_connect($ldap_server, $ldap_port);
if (!$connection) {
    die("Could not connect to LDAP server.");
}
ldap_set_option($connection, LDAP_OPT_PROTOCOL_VERSION, 3);
ldap_set_option($connection, LDAP_OPT_REFERRALS, 0);

$bind_dn = "dcadmin@demodc.local"; // try different formats if necessary
$bind_password = "User@123";

if (!@ldap_bind($connection, $bind_dn, $bind_password)) {
    die("LDAP bind failed: " . ldap_error($connection));
}
echo "LDAP bind successful!";

$search_base   = "DC=demodc,DC=local"; // Adjust based on your AD structure
#$search_filter = "(userPrincipalName=shyam)"; // Use the UPN to locate the user
$search_filter = "(&(objectClass=user)(objectCategory=person))";

$search_result = ldap_search($connection, $search_base, $search_filter);
if (!$search_result) {
    die("LDAP search failed: " . ldap_error($connection));
}

// Get the entries from the search result
$entries = ldap_get_entries($connection, $search_result);
echo "count : ".$entries["count"];
echo "<br/>";
if ($entries["count"] > 0) {
    echo "<pre>";
    print_r($entries[0]); // Print the first (and likely only) user entry
    echo "</pre>";
} else {
    echo "No user found.";
}


ldap_unbind($connection);

?>
