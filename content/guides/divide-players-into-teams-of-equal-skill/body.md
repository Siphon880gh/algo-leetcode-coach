## Pair ends inward

1. Sort `skill`; `t = skill[0] + skill[n − 1]`.
2. For `i < n / 2`: if `skill[i] + skill[n − 1 − i] ≠ t`, return −1; else add `skill[i] · skill[n − 1 − i]`.
3. Return the sum.

Examples → 22, 12, −1.

If the smallest player paired with anyone but the largest, the largest would need a partner smaller than the smallest. The total chemistry can reach 5 · 10^4 teams · 10^6 = 5 · 10^10, so use 64-bit. Counting skills up to 1000 instead of sorting gives O(n + 1000).

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
