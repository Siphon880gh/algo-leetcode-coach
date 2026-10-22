## Median, then palindromes

1. med = the lower median of the sorted array.
2. lo = largest palindrome ≤ med, hi = smallest palindrome ≥ med (walk or build from the first half).
3. Return the smaller of the two costs.

Examples → 6, 11, 22. Checked against trying every palindrome below 2000 on 1,500 random arrays.

The mean is not the right center: [6, 11, 60] → 65 instead of 54. Costs reach about 10^14; use 64-bit.

Time: O(n log n)  
Space: O(1) besides sorting

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Algo Learning IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
