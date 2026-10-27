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
            'message' => "Read the problem statement above.\nExample 2: value 8 sits at 0, 1, 2, 3. Special?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes, the gaps are equal', 'next' => 'wrong_a'],
                ['label' => 'No, it appears four times', 'next' => 's2'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Special needs exactly three copies. Counting four gives 1 instead of 0.\nStep back to when you allowed four copies.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Example 3: value 8 sits at 0, 3, 4. Special?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes, three copies is enough', 'next' => 'wrong_b'],
                ['label' => 'No, the gaps are 3 and 1', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The gaps differ. Skipping the gap check gives 1 instead of 0.\nStep back to when you skipped it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. One pass to group, one check per value. O(n). Examples give 2, 0 and 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
