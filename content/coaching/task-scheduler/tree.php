<?php
declare(strict_types=1);

/**
 * Step-by-step tree contract:
 * - start: node id
 * - nodes[id]: message, outcome (continue|wrong|success), choices[{label, next}], optional rewind_to on wrong
 */
return [
    'start' => 'start',
    'nodes' => [
        'start' => [
            'message' => "Read the problem statement above.\nSimulate slot by slot, picking any task that is ready?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: count the frame set by the most frequent task', 'next' => 's2'],
                ['label' => 'Yes: any ready task will do', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Picking arbitrary tasks can leave the frequent task bunched at the end, forcing extra idle time.\nStep back to when you picked any ready task.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How long is the frame?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'mx · (n + 1)', 'next' => 'wrong_b'],
                ['label' => '(mx − 1) · (n + 1) + k, where k tasks are tied at the max count mx', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The last block holds only the tied tasks, with no cooldown after it: A A A B B B, n = 2 → 8, not 9.\nStep back to when you used mx full blocks.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "There are many distinct tasks. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Answer max(len(tasks), frame)', 'next' => 'success'],
                ['label' => 'Answer the frame', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. When the other tasks overflow the gaps, no idle time is needed and the frame undercounts.\nStep back to when you returned only the frame.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. max(len(tasks), (mx − 1) · (n + 1) + k): O(len(tasks)) time. [\"A\",\"A\",\"A\",\"B\",\"B\",\"B\"], n = 2 → 8.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
