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
            'message' => "Read the problem statement above.\nCheck every i from 1 to n?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: only i in (n/2, n]', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. n can be 10⁹, and smaller i come for free.\nStep back to when you checked every i.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Why does i ≤ n/2 come for free?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'They are shorter, so always present', 'next' => 'wrong_b'],
                ['label' => 'bin(2i) is bin(i) followed by 0', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Being short does not make a string appear.\nStep back to when you said shorter.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "n − n/2 is larger than len(s). Answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'false', 'next' => 'success'],
                ['label' => 'Check them anyway', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. s does not have that many substrings of one length.\nStep back to when you checked anyway.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(len(s)² log n). s = \"0110\", n = 3 → true. s = \"0110\", n = 4 → false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
