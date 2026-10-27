## Window plus best before

1. `best[0] = 0`; `l = 0`; `ans = 0`.
2. For each `r`: while `p[r] − p[l] > k`, `l++`.
3. `ans = max(ans, (r − l + 1) + best[l])`; `best[r + 1] = max(best[r], r − l + 1)`.
4. Return `ans`.

Examples → 7, 2. Checked against trying every pair of segment starts on 300 random cases.

The best segment ending before l covers prizes disjoint from the window, so no prize is counted twice. Overlapping segments never beat this, because two disjoint ones can cover at least as many.

Time: O(n)  
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
