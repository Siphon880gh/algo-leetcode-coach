## Descending caps

1. Sort descending; prev = ∞.
2. cur = min(h, prev − 1); if cur ≤ 0 return −1; add cur; prev = cur.

Examples → 10, 25, −1. Checked against every assignment on 300 small cases.

Lowering a repeated limit by 1 just once: [3, 3, 3] → 3, 2, 2, still a repeat; the answer is 6. Sums reach 10^14; use 64-bit.

Time: O(n log n)  
Space: O(1) beyond sorting

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
