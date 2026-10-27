## Total units plus three drives

1. `ans` = total length of all strings in `garbage`.
2. For each type in M, P, G: find the last house `i` containing it; add `travel[0] + … + travel[i − 1]`.
3. Return `ans`.

Examples → 21, 37.

Trucks never work at the same time, so their minutes simply add. A truck whose type never appears stays at house 0 and costs nothing. Totals stay below about 3 · 10^7, so 32-bit is fine.

Time: O(total length)  
Space: O(n) for prefix sums, or O(1)

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
