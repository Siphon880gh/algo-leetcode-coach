## Three plans

1. Count a and b; lo = min, hi = max, h = ⌊(a + b) / 2⌋.
2. Plan 1: (a + b) · flipCost.
3. Plan 2: lo · swapCost + (hi − lo) · flipCost.
4. Plan 3: (h − lo) · crossCost + h · swapCost + (a + b − 2h) · flipCost.
5. Return the smallest.

Examples → 16, 6, 0. Checked against Dijkstra over all string pairs on 500 random cases.

Skipping cross swaps: example 1 → 32 instead of 16.

Time: O(n)  
Space: O(1)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Leetcode Practice Coach IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
