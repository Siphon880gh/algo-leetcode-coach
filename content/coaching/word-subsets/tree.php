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
            'message' => "Read the problem statement above.\nCheck every pair (a, b)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: merge words2 first', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(|words1| · |words2| · length).\nStep back to when you checked pairs.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Merge with the max or the sum per letter?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The sum', 'next' => 'wrong_b'],
                ['label' => 'The max', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Each b must fit separately, so a needs only the largest per-letter need.\nStep back to when you summed.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "A word meets the requirement when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Its count ≥ need for all 26 letters', 'next' => 'success'],
                ['label' => 'It contains every needed letter at least once', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Counts matter: \"oo\" needs two o's.\nStep back to when you ignored counts.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(total letters). words1 = [\"amazon\",\"apple\",\"facebook\",\"google\",\"leetcode\"], words2 = [\"e\",\"o\"] → [\"facebook\",\"google\",\"leetcode\"]. words2 = [\"l\",\"e\"] → [\"apple\",\"google\",\"leetcode\"].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
