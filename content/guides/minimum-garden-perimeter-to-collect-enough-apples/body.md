## Apples in a square of half-side k

1. `total(k) = 2k(k + 1)(2k + 1)`.
2. Smallest `k` with `total(k) ≥ needed`; return `8k`.

`1` → 8. `13` → 16. `10^9` → 5040. The formula matches direct summation for k = 1 … 5.

The total grows like 4k³, so k stays below about 10^5 for needed ≤ 10^15; binary search is optional. Perimeter of side `2k` is `8k`.

Time: O(cbrt(needed)), or O(log) with binary search  
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
