<?php
// dashboard/support.php
require_once 'auth.php';
require_login();

// Handle Logout
if (isset($_GET['logout'])) {
    portal_logout();
}

// User data
$fullName = $user['firstname'] . ' ' . $user['lastname'];
$company = $user['company_name'];
$clientId = "ARDO-" . str_pad($user['client_id'], 4, '0', STR_PAD_LEFT);

// Handle Ticket Submission
$successMsg = '';
$errorMsg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create_ticket'])) {
    // Helper variable for file uploads
    $processedFiles = [];

    // Process Post Data
    $subject = $_POST['subject'] ?? '';
    $department = $_POST['department'] ?? '';
    $priority = $_POST['priority'] ?? '';
    $service = $_POST['service'] ?? '';
    $message = $_POST['message'] ?? '';

    $postData = [
        'subject' => $subject,
        'department' => $department,
        'priority' => $priority,
        'message' => $message,
        'userid' => $user['client_id'],
        'contactid' => $user['contact_id'],
    ];

    // Handle File Uploads
    if (isset($_FILES['attachments']) && !empty($_FILES['attachments']['name'][0])) {
        $count = count($_FILES['attachments']['name']);
        for ($i = 0; $i < $count; $i++) {
            if ($_FILES['attachments']['error'][$i] === UPLOAD_ERR_OK) {
                // Key 'file[$i]' ensures PHP on the receiving end treats it as an array of files under 'file'
                $key = "file[$i]";
                $processedFiles[$key] = [
                    'name' => $_FILES['attachments']['name'][$i],
                    'type' => $_FILES['attachments']['type'][$i],
                    'tmp_name' => $_FILES['attachments']['tmp_name'][$i],
                    'error' => $_FILES['attachments']['error'][$i],
                    'size' => $_FILES['attachments']['size'][$i]
                ];
            }
        }
    }

    $response = api_call('tickets', 'POST', $postData, $processedFiles);

    if (isset($response['status']) && $response['status'] === true) {
        $successMsg = "Ticket created successfully! Ticket #" . $response['record_id'];
        // Clear form? Redirect?
        // header("Location: support.php");
        // exit;
    } else {
        $errorMsg = "Failed to create ticket: " . ($response['message'] ?? 'Unknown error');
    }
}

// Fetch Data
// Retrieve all tickets for the contact
$allTickets = api_call('tickets?contactid=' . $user['contact_id']);
$userTickets = [];

// Helper function to safely extract data from API response
function get_api_data($response)
{
    if (isset($response['status']) && $response['status'] === true && isset($response['data'])) {
        return $response['data'];
    }
    // If response is a direct array (not wrapped)
    if (is_array($response) && !isset($response['status'])) {
        return $response;
    }
    return [];
}

// Filter tickets for this specific user/client if API returns more than needed
// API `tickets` usually returns just the list or {status:true, data:[...]}
$ticketList = get_api_data($allTickets);

if (is_array($ticketList)) {
    foreach ($ticketList as $t) {
        // Ensure we only show tickets for this client
        // Relaxed filter for debugging: accept if userid matches OR contactid matches
        if ((isset($t['userid']) && $t['userid'] == $user['client_id']) || (isset($t['contactid']) && $t['contactid'] == $user['contact_id'])) {
            $userTickets[] = $t;
        }
    }
} else {
    // Debugging only
    // file_put_contents('ticket_debug.log', date('[Y-m-d H:i:s] ') . "Ticket list is not an array.\n", FILE_APPEND);
}

// Sort by date desc
usort($userTickets, function ($a, $b) {
    // Check if date exists
    $dateA = isset($a['date']) ? strtotime($a['date']) : 0;
    $dateB = isset($b['date']) ? strtotime($b['date']) : 0;
    return $dateB - $dateA;
});

// Use data_get endpoint which might be more permissive or standard
$departmentsResp = api_call('common/departments');
$prioritiesResp = api_call('common/priorities');
$departments = get_api_data($departmentsResp);
$priorities = get_api_data($prioritiesResp);

// If departments is empty, it might be due to "No data found" (404) which returns status:false.
// We handled it in get_api_data to return [].

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Support - Ardo</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;family=JetBrains+Mono:wght@500;700&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#00F0FF",
                        "background-light": "#ffffff",
                        "background-dark": "#050505",
                        "neutral-border": "#E5E5E5",
                    },
                    fontFamily: {
                        "display": ["Inter", "sans-serif"],
                        "mono": ["JetBrains Mono", "monospace"]
                    },
                    borderRadius: {
                        "DEFAULT": "4px",
                        "lg": "8px",
                        "xl": "8px",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #ffffff;
        }

        .geist-heading {
            font-weight: 900;
            letter-spacing: -0.02em;
            text-transform: uppercase;
        }

        .glass-card {
            background: #ffffff;
            border: 1px solid #E5E5E5;
        }

        .tech-label {
            font-family: 'JetBrains Mono', monospace;
            letter-spacing: 0.05em;
        }

        .status-badge {
            font-family: 'JetBrains Mono', monospace;
            font-size: 10px;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 4px;
            text-transform: uppercase;
        }

        /* Status Colors - Mapped roughly to Perfex defaults */
        .status-1 {
            background: #fee2e2;
            color: #991b1b;
        }

        /* Open - Red/Urgent feel */
        .status-2 {
            background: #dbeafe;
            color: #1e40af;
        }

        /* In Progress - Blue */
        .status-3 {
            background: #d1fae5;
            color: #065f46;
        }

        /* Answered - Green */
        .status-4 {
            background: #f3f4f6;
            color: #374151;
        }

        /* On Hold - Grey */
        .status-5 {
            background: #f3f4f6;
            color: #1f2937;
        }

        /* Closed - Dark */

        .animate-fade-in {
            animation: fadeIn 0.2s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.95);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }
    </style>
</head>

<body class="bg-background-light text-[#050505] font-display">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar and Nav (Copied from support.php) -->
        <?php include 'sidebar.php'; ?>

        <!-- Main Content -->
        <main class="flex-1 flex flex-col overflow-y-auto bg-gray-50/30">
            <!-- Header -->
            <?php
            $pageHeaderTitle = "Support Tickets";
            include 'header.php';
            ?>

            <!-- Content -->
            <div class="p-8 max-w-7xl mx-auto w-full">

                <?php if ($successMsg): ?>
                    <div class="mb-4 p-4 rounded-lg bg-green-50 text-green-700 border border-green-200">
                        <?php echo htmlspecialchars($successMsg); ?>
                    </div>
                <?php endif; ?>

                <?php if ($errorMsg): ?>
                    <div class="mb-4 p-4 rounded-lg bg-red-50 text-red-700 border border-red-200">
                        <?php echo htmlspecialchars($errorMsg); ?>
                    </div>
                <?php endif; ?>

                <div class="glass-card rounded-lg p-8" style="border-radius: 8px;">
                    <div class="flex items-center justify-between mb-8">
                        <div>
                            <h3 class="text-xl font-bold geist-heading font-black">Ticket History</h3>
                            <p class="text-sm text-gray-500 mt-1">View and manage your support requests</p>
                        </div>
                        <div>
                            <button onclick="document.getElementById('createTicketModal').classList.remove('hidden')"
                                class="bg-[#050505] text-white px-5 py-2.5 rounded-lg text-sm font-medium hover:bg-gray-900 transition-all shadow-lg hover:shadow-xl flex items-center gap-2">
                                <span class="material-symbols-outlined text-[20px]">add</span>
                                Open New Ticket
                            </button>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead
                                class="border-b border-gray-100 text-gray-400 text-[10px] uppercase font-mono tracking-widest">
                                <tr>
                                    <th class="pb-4 px-4">Ticket #</th>
                                    <th class="pb-4 px-4">Subject</th>
                                    <th class="pb-4 px-4">Department</th>
                                    <th class="pb-4 px-4">Status</th>
                                    <th class="pb-4 px-4">Last Reply</th>
                                    <th class="pb-4 px-4 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                <?php if (empty($userTickets)): ?>
                                    <tr>
                                        <td colspan="6"
                                            class="py-20 text-center text-gray-400 font-mono text-xs uppercase tracking-widest">
                                            No tickets found</td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($userTickets as $ticket): ?>
                                        <tr class="hover:bg-gray-50/50 transition-colors group">
                                            <td class="py-5 px-4 font-mono font-bold text-gray-900">
                                                #<?php echo htmlspecialchars($ticket['ticketid']); ?>
                                            </td>
                                            <td class="py-5 px-4 text-sm font-medium text-gray-900">
                                                <?php echo htmlspecialchars($ticket['subject']); ?>
                                            </td>
                                            <td class="py-5 px-4 text-sm text-gray-500">
                                                <?php echo htmlspecialchars($ticket['department_name'] ?? '-'); ?>
                                            </td>
                                            <td class="py-5 px-4">
                                                <span class="status-badge status-<?php echo $ticket['status']; ?>">
                                                    <?php echo htmlspecialchars($ticket['status_name'] ?? 'Unknown'); ?>
                                                </span>
                                            </td>
                                            <td class="py-5 px-4 text-sm text-gray-500">
                                                <?php echo $ticket['lastreply'] ? date('M d, Y H:i', strtotime($ticket['lastreply'])) : '-'; ?>
                                            </td>
                                            <td class="py-5 px-4 text-right">
                                                <!-- Add View Ticket Link later -->
                                                <button class="p-2 hover:bg-gray-100 rounded-lg transition-colors text-gray-400"
                                                    title="View details (Coming Soon)">
                                                    <span class="material-symbols-outlined text-[20px]">visibility</span>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <footer
                class="p-8 mt-auto flex justify-between items-center text-[10px] text-gray-400 font-mono border-t border-neutral-border bg-white tech-label">
                <p><?php echo APP_FOOTER_TEXT; ?></p>
                <div class="flex gap-4">
                    <a class="hover:text-primary transition-colors" href="#">API STATUS: ONLINE</a>
                    <a class="hover:text-primary transition-colors" href="#">PRIVACY POLICY</a>
                    <a class="hover:text-primary transition-colors" href="#">SERVICE TERMS</a>
                </div>
            </footer>
        </main>

        <!-- Create Ticket Modal -->
        <div id="createTicketModal"
            class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
            <div class="bg-white rounded-lg w-full max-w-2xl max-h-[90vh] overflow-y-auto shadow-2xl animate-fade-in">
                <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                    <h3 class="text-lg font-bold geist-heading">Open New Ticket</h3>
                    <button onclick="document.getElementById('createTicketModal').classList.add('hidden')"
                        class="text-gray-400 hover:text-gray-600">
                        <span class="material-symbols-outlined">close</span>
                    </button>
                </div>
                <form method="POST" action="" class="p-6 space-y-6" enctype="multipart/form-data">
                    <input type="hidden" name="create_ticket" value="1">

                    <div class="grid grid-cols-2 gap-6">
                        <div class="col-span-2">
                            <label
                                class="block text-xs font-semibold text-gray-900 uppercase tracking-wide mb-2">Subject</label>
                            <input type="text" name="subject" required
                                class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all text-sm"
                                placeholder="Brief summary of the issue">
                        </div>

                        <div>
                            <label
                                class="block text-xs font-semibold text-gray-900 uppercase tracking-wide mb-2">Department</label>
                            <select name="department" required
                                class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all text-sm appearance-none">
                                <option value="">Select Department</option>
                                <?php if (is_array($departments)): ?>
                                    <?php foreach ($departments as $dept): ?>
                                        <option value="<?php echo $dept['departmentid']; ?>">
                                            <?php echo htmlspecialchars($dept['name']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>

                        <div>
                            <label
                                class="block text-xs font-semibold text-gray-900 uppercase tracking-wide mb-2">Priority</label>
                            <select name="priority" required
                                class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all text-sm appearance-none">
                                <?php if (is_array($priorities)): ?>
                                    <?php foreach ($priorities as $prio): ?>
                                        <option value="<?php echo $prio['priorityid']; ?>">
                                            <?php echo htmlspecialchars($prio['name']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>

                    </div>


                    <div>
                        <label
                            class="block text-xs font-semibold text-gray-900 uppercase tracking-wide mb-2">Message</label>
                        <textarea name="message" required rows="6"
                            class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all text-sm"
                            placeholder="Describe your issue in detail..."></textarea>
                    </div>

                    <div>
                        <label
                            class="block text-xs font-semibold text-gray-900 uppercase tracking-wide mb-2">Attachments
                            (Optional)</label>
                        <input type="file" name="attachments[]" multiple
                            class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all text-sm">
                    </div>

                    <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                        <button type="button"
                            onclick="document.getElementById('createTicketModal').classList.add('hidden')"
                            class="px-5 py-2.5 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-colors">
                            Cancel
                        </button>
                        <button type="submit"
                            class="px-5 py-2.5 text-sm font-medium text-white bg-black hover:bg-gray-900 rounded-lg transition-all shadow-lg hover:shadow-xl">
                            Submit Ticket
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</body>

</html>