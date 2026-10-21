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
            'message' => "Read the problem statement above.\nHow does insertFront work?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'head = (head − 1 + k) % k, then write the value there', 'next' => 's2'],
                ['label' => 'Shift everything right by one slot', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Shifting is O(k) per insert; moving the head is O(1).\nStep back to when you shifted.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How do you tell full from empty?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'head == tail', 'next' => 'wrong_b'],
                ['label' => 'A size counter', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. head == tail happens both when it is full and when it is empty.\nStep back to when you compared the pointers.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Where is the rear?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'a[(head + size − 1) % k]', 'next' => 'success'],
                ['label' => 'a[k − 1]', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. After wrapping, the last item can be anywhere in the array.\nStep back to when you used the last slot.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. One array, a head and a size, with every index mod k: O(1) per operation, O(k) space.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
