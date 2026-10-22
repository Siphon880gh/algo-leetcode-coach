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
            'message' => "Read the problem statement above.\nd scores x when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'x mod d = 0', 'next' => 's2'],
                ['label' => 'd mod x = 0', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The divisor must divide the number; Example 3 → 20 instead of 10.\nStep back to when you reversed it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Two divisors tie?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep the one listed first', 'next' => 'wrong_b'],
                ['label' => 'Keep the smaller value', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The rule is about values, not positions; nums = [6], divisors = [3,2] → 3 instead of 2.\nStep back to when you kept the first.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · m). Examples → 2, 3, 10.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
