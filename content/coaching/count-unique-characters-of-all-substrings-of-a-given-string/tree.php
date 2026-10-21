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
            'message' => "Read the problem statement above.\nEnumerate substrings and count unique letters?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: sum each position\'s contribution', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is at least O(n²).\nStep back to when you enumerated.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How many substrings count s[i] as unique?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(i + 1) · (n − i)', 'next' => 'wrong_b'],
                ['label' => '(i − prev) · (next − i), using the same letter\'s neighbors', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That counts all substrings containing i, including those with another copy.\nStep back to when you ignored the other copies.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "No previous occurrence. prev = ?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '-1', 'next' => 'success'],
                ['label' => '0', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. With prev = 0 you would lose the substrings starting at 0.\nStep back to when you used 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). \"ABC\" → 10. \"ABA\" → 8. \"LEETCODE\" → 92.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
