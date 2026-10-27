## Backtrack

1. go(s, cost): length n → record s.
2. Always try 0. Try 1 at index i when s ends in 0 (or is empty) and cost + i ≤ k.

Examples → ["000", "010", "100"], ["0", "1"]. Matched filtering all 2^n strings for every n ≤ 10 and k.

Using 1-based indices for the cost: example 1 → ["000", "100"].

Time: O(F · n), F ≤ 377 strings for n = 12  
Space: O(n)

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
