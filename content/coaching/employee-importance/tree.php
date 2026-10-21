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
            'message' => "Read the problem statement above.\nHow do you find a subordinate's record?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A map from id to employee', 'next' => 's2'],
                ['label' => 'Scan the list each time', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Scanning makes it O(n²).\nStep back to when you scanned the list.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Whose importance counts?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The employee\'s and direct reports\' only', 'next' => 'wrong_b'],
                ['label' => 'The employee\'s plus every direct and indirect subordinate\'s', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Indirect reports count too.\nStep back to when you stopped at direct reports.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Do you need a visited set?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: each employee has one leader, so the structure is a forest', 'next' => 'success'],
                ['label' => 'Yes: cycles are possible', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. With one leader each, there are no cycles to guard against.\nStep back to when you added a visited set.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. DFS from the id: O(n). [[1,5,[2,3]],[2,3,[]],[3,3,[]]], id = 1 → 11.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
